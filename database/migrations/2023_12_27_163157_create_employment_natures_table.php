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
        Schema::create('employment_natures', function (Blueprint $table) {
            $table->unsignedBigInteger('employment_id');
            $table->unsignedBigInteger('nature_id');
            $table->primary(['employment_id', 'nature_id']);

            $table->foreign('employment_id')->references('id')->on('employments')->onDelete('cascade');
            $table->foreign('nature_id')->references('id')->on('natures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_natures');
    }
};
