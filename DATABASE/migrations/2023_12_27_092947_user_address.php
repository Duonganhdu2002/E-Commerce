<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_address', function (Blueprint $table) {
            $table->bigIncrements('user_address_id'); 
            $table->unsignedBigInteger('user_id');
            $table->string('number', 50)->nullable();
            $table->string('street', 50)->nullable();
            $table->string('commune', 50)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('province', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('postal_code', 50)->nullable();
            $table->timestamps();

            // Khóa ngoại user_id
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            // Các cài đặt khác có thể được thêm vào tùy thuộc vào yêu cầu cụ thể của bạn
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('user_address');
    }
};
