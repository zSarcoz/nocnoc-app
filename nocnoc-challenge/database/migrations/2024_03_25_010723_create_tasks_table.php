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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->text('description')->max(400);            
            $table->string('image_uri',255)->nullable();
            $table->text('comment')->max(200)->nullable();
            $table->string("status", 20)->default("Pendiente");  
            $table->string("content_uri", 255);
            $table->string("user_assigned", 40);
            $table->bigInteger("user_id")->unsigned();
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
