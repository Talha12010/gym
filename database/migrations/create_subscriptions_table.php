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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id('Sub_id'); // Primary key with custom name
            $table->string('Plan_name')->nullable(); // Plan name can be null if not required
            $table->integer('Duration')->nullable(); // Duration in some unit (e.g., days, months)
            $table->decimal('Price', 8, 2)->nullable(); // Price with 8 digits total, 2 after decimal
            $table->text('Feature')->nullable(); // Features as text (can be JSON or comma-separated)
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};