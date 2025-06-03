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
     Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('student_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image_url'); // link ảnh từ Cloudinary
             $table->string('image_public_id')->nullable();
            $table->timestamps();


            // Nếu liên kết student_id với bảng users/students
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }

};
