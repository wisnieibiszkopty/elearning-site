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
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('available');
            $table->string('file_path')->nullable();
            $table->timestamp('finish_date');
            $table->timestamps();

            //$table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });

        // not sure if this is everything i need
        Schema::create('tasks', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->foreignId('homework_id')->constrained();
            //$table->foreignId('author_id')->constrained();
            $table->string('file_path');
            $table->string('comment');
            $table->timestamps();

            //$table->foreign('homework_id')->references('id')->on('homework')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homework');
        Schema::dropIfExists('task');
    }
};
