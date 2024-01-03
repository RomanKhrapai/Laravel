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
        Schema::create('employments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('experience');
            $table->text('description');
            $table->text('interests')->nullable();
            $table->integer('salary_min');
            $table->integer('salary_max')->nullable();
            $table->unsignedBigInteger('area_id');
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employments');
    }
};
