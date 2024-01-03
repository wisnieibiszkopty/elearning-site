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
        Schema::table('posts', function(Blueprint $table){
           $table->boolean('edited')->default(false);
        });

        Schema::table('comments', function(Blueprint $table){
            $table->boolean('edited')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function(Blueprint $table){
            $table->dropColumn('edited');
        });

        Schema::table('comments', function(Blueprint $table){
            $table->dropColumn('edited');
        });
    }
};
