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
        Schema::create('in_class_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('in_class_plan_id');
            $table->date('date')->nullable();
            $table->unsignedInteger('subject_id')->nullable();
            $table->text('my_lesson')->nullable();
            $table->tinyInteger('self_assessment')->nullable(); // 1: Need more practice, 2: Sometimes difficult, 3: No problem
            $table->text('my_difficulties')->nullable();
            $table->text('my_plan')->nullable();
            $table->enum('problem_solved', ['Yes', 'Not yet'])->nullable();

            // Khóa ngoại trỏ đến bảng in_class_plans
            $table->foreign('in_class_plan_id')
                ->references('id')
                ->on('in_class_plans')
                ->onDelete('cascade');
            // Khóa ngoại trỏ đến bảng subjects
            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_class_subject');
    }
};
