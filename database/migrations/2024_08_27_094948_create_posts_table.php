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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            //we connected the post to a user the column name would be user_id the constrained() function is to define the table that connected with the post and cascadeOnDelete() is to delete the posts of a user when the user get deleted
            //since we named the column user_id we dont have to define any thing in the constrained function because it will automatically understand that the connection is with user table column id
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); 
            $table->string('title');
            $table->text('body');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
