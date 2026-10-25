<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id('S_id'); // Primary key
            $table->unsignedBigInteger('C_id'); // Foreign key referencing classes
            $table->string('day');
            $table->time('start_time');
            $table->time('end_time');

            $table->foreign('C_id')->references('C_id')->on('classes')->onDelete('cascade'); // Relationship with classes table

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedule');
    }
};