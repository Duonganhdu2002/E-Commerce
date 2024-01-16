import { Typography, Button } from '@material-tailwind/react';
import React from 'react';

const ShopOrder = () => {
    return (
        <div className='shadow-lg shadow-blue-gray-900/15 h-auto'>
            <div className=' justify-between p-2 flex items-center '>
                <Typography className=' text-md font-semibold text-gray-700 pl-2'>Orders</Typography>
                <Button variant="text" className="flex text-[11px] text-gray-700 items-center gap-2">
                    See Orders History{" "}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        strokeWidth={2}
                        stroke="currentColor"
                        className="h-5 w-5"
                    >
                        <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"
                        />
                    </svg>
                </Button>
            </div>
            <div className=' grid-cols-4 gap-2 flex pt-0 p-2'>
                <div className=' cursor-pointer w-full py-2 bg-opacity-50 bg-gray-200  rounded-md flex flex-col justify-center items-center'>
                    <Typography className=' text-xl font-bold'>0</Typography>
                    <Typography className=' text-xs text-center text-gray-700'>Waiting for delivery</Typography>
                </div>
                <div className=' cursor-pointer w-full py-2 bg-opacity-50 bg-gray-200  rounded-md flex flex-col justify-center items-center'>
                    <Typography className=' text-xl font-bold'>0</Typography>
                    <Typography className=' text-xs text-center text-gray-700'>Waiting for delivery</Typography>
                </div>
                <div className=' cursor-pointer w-full py-2 bg-opacity-50 bg-gray-200  rounded-md flex flex-col justify-center items-center'>
                    <Typography className=' text-xl font-bold'>0</Typography>
                    <Typography className=' text-xs text-center text-gray-700'>Waiting for delivery</Typography>
                </div>
                <div className=' cursor-pointer w-full py-2 bg-opacity-50 bg-gray-200  rounded-md flex flex-col justify-center items-center'>
                    <Typography className=' text-xl font-bold'>0</Typography>
                    <Typography className=' text-xs text-center text-gray-700'>Waiting for delivery</Typography>
                </div>
            </div>
        </div>
    );
}

export default ShopOrder;
