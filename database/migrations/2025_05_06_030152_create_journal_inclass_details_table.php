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
        Schema::create('journal_inclass_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('journal_id');
            $table->date('date');
            $table->string('skills_module', 255)->nullable();
            $table->text('lesson_summary')->nullable();
            $table->tinyInteger('self_assessment')->nullable();
            $table->text('difficulties')->nullable();
            $table->text('improvement_plan')->nullable();
            $table->boolean('problem_solved')->default(false);
            $table->timestamps();

            $table->foreign('journal_id')->references('id')->on('journals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_inclass_details');
    }
};
