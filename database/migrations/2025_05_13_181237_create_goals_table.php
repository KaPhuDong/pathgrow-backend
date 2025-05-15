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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('semester_id'); // ✅ thay vì 'semester', dùng 'semester_id' và làm khóa ngoại
            $table->unsignedInteger('subject_id');  // khóa ngoại đến bảng subjects

            $table->text('expect_course')->nullable();
            $table->text('expect_teacher')->nullable();
            $table->text('expect_myself')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade'); // ✅ khóa ngoại mới
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

     /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
