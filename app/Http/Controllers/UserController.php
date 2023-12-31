<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource as UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Mã hóa 


class UserController extends Controller
{

    public function createUser(Request $request)
    {
        try {
            
            $input = $request->all();
            $validateUser = Validator::make(
                $input,
                [
                    'username' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => 401,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([

                'username' => $request->username,
                'type_account_id' => $request->input('type_account_id', 1),
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function loginUser(Request $request)
    {
        try {

            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => 401,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!User::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => 200,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logoutUser(Request $request)
    {
        try {
            // Đăng xuất người dùng
            User::logout();

            // Trả về một phản hồi JSON chỉ ra rằng quá trình đăng xuất thành công
            return response()->json([
                'status' => true,
                'message' => 'Người dùng đã đăng xuất thành công',
            ], 200);
        } catch (\Throwable $th) {
            // Xử lý mọi ngoại lệ có thể xảy ra trong quá trình đăng xuất
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function userList()
    {
        $this->middleware('auth:sanctum');
        $user = User::all();

        $arr = [
            'status' => true,
            'message' => 'Danh sách tài khoản',
            'data' => UserResource::collection($user)
        ];

        return response()->json($arr, 200);
    }

    public function show(string $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            $arr = [
                'status' => false,
                'message' => 'Không có người dùng này',
                'data' => null
            ];
            return response()->json($arr, 404);
        }

        $arr = [
            'status' => true,
            'message' => "Thông tin",
            'data' => $user,
        ];
        return response()->json($arr, 200);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            $arr = [
                'status' => false,
                'message' => 'Không có người dùng này',
                'data' => null
            ];
            return response()->json($arr, 404);
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'username' => 'required',
        ]);

        if ($validator->fails()) {
            $arr = [
                'success' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ];
            return response()->json($arr, 200);
        }

        $user->update($input);

        $arr = [
            'status' => true,
            'message' => 'Thông tin người dùng đã được cập nhật thành công',
            'data' => new UserResource($user)
        ];

        return response()->json($arr, 200);
    }


    public function delete(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            $arr = [
                'status' => true,
                'message' => 'Người dùng đã được xóa thành công',
                'data' => null
            ];

            return response()->json($arr, 200);
        } catch (ModelNotFoundException $e) {
            $arr = [
                'success' => false,
                'message' => 'Người dùng không tồn tại',
                'data' => null
            ];

            return response()->json($arr, 404);
        }
    }

    public function getTotalUsers()
    {
        // Sử dụng SQL raw query để lấy tổng số người dùng
        $totalUsers = DB::table('user')->selectRaw('COUNT(*) as total_users')->first();

        // Trả về kết quả
        return response()->json([
            'status' => true,
            'message' => 'Tổng số người dùng',
            'data' => [
                'total_users' => $totalUsers->total_users,
            ],
        ], 200);
    }

    public function authenticate(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Mật khẩu đúng, thực hiện xác thực thành công
            return response()->json(['message' => 'Authentication successful'], 200);
        } else {
            // Mật khẩu không đúng
            return response()->json(['message' => 'Authentication failed'], 401);
        }
    }
}
