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
        Schema::create('employment_skills', function (Blueprint $table) {
            $table->unsignedBigInteger('skill_id');
            $table->unsignedBigInteger('employment_id');
            $table->primary(['skill_id', 'employment_id']);
            $table->integer('experience');
            $table->integer('level');
            $table->timestamps();

            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->foreign('employment_id')->references('id')->on('employments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_skills');
    }
};
