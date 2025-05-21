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
        Schema::create('self_study_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('weekly_study_plan_id');

            $table->foreign('weekly_study_plan_id')
                ->references('id')
                ->on('weekly_study_plans')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('self_study_plans');
    }
};
