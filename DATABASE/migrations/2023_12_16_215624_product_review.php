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
        Schema::create('product_review', function (Blueprint $table) {
            $table->integer('product_review_id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->integer('rating')->nullable();
            $table->string('comment', 150)->nullable();
            $table->timestamps();

            // Chỉ định cột là khóa chính
            $table->primary('product_review_id');

            // Khóa ngoại user_id
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');

            // Khóa ngoại product_id
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');

            // Các cài đặt khác có thể được thêm vào tùy thuộc vào yêu cầu cụ thể của bạn
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_review');
    }
};
