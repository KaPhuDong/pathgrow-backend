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
        Schema::create('self_study_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('self_study_plan_id');
            $table->date('date')->nullable();
            $table->unsignedInteger('subject_id')->nullable();
            $table->text('my_lesson')->nullable();
            $table->string('time_allocation')->nullable();
            $table->text('learning_resources')->nullable();
            $table->text('learning_activities')->nullable();
            $table->enum('concentration', ['Yes', 'No', 'Not sure'])->nullable();
            $table->enum('plan_follow_reflection', ['Yes', 'No', 'Not sure'])->nullable();
            $table->text('evaluation')->nullable();
            $table->text('reinforcing_learning')->nullable();
            $table->text('notes')->nullable();

            // Khóa ngoại trỏ đến bảng self_study_plans
            $table->foreign('self_study_plan_id')
                ->references('id')
                ->on('self_study_plans')
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
        Schema::dropIfExists('self_study_subject');
    }
};
