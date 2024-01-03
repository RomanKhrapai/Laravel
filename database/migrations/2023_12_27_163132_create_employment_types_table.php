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
        Schema::create('employment_types', function (Blueprint $table) {
            $table->unsignedBigInteger('employment_id');
            $table->unsignedBigInteger('type_id');
            $table->primary(['employment_id', 'type_id']);

            $table->foreign('employment_id')->references('id')->on('employments')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_types');
    }
};
