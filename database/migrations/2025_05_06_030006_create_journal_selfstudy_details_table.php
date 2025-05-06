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
        Schema::create('journal_selfstudy_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('journal_id');
            $table->date('date');
            $table->string('skills_module', 255)->nullable();
            $table->text('lesson_summary')->nullable();
            $table->string('time_allocation', 50)->nullable();
            $table->text('learning_resources')->nullable();
            $table->text('learning_activities')->nullable();
            $table->tinyInteger('concentration')->nullable();
            $table->text('plan_follow_reflection')->nullable();
            $table->text('work_evaluation')->nullable();
            $table->text('reinforce_techniques')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('journal_id')->references('id')->on('journals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_selfstudy_details');
    }
};
