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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->timestamps();
            //User reference and post reference:

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id');

            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('post_id')->references('id')->on('posts');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
