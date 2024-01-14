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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('profession', ['user', 'company']);
            $table->unsignedBigInteger('evaluated_user_id')->nullable();
            $table->unsignedBigInteger('evaluated_company_id')->nullable();
            $table->integer('vote');
            $table->text('review');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('evaluated_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('evaluated_company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
