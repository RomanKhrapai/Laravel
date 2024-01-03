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
        Schema::create('employment_languages', function (Blueprint $table) {
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('employment_id');
            $table->primary(['language_id', 'employment_id']);
            $table->integer('level');
            $table->timestamps();

            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->foreign('employment_id')->references('id')->on('employments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_languages');
    }
};
