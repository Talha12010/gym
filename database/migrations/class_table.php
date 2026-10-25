<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id('C_id'); // Primary key
            $table->string('class_name');
            $table->integer('max_capacity');

            // Foreign key referencing the users table (no role check here, handled in app logic)
            $table->unsignedBigInteger('T_id');
            $table->foreign('T_id')->references('id')->on('users')->onDelete('cascade'); // Optional: Add onDelete behavior

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};