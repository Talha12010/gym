<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('sub', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->string('contact');
        $table->string('payment');
        $table->string('plan_name');
        $table->integer('duration');
        $table->decimal('price', 8, 2);
        $table->string('feature');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('sub');
}

};
