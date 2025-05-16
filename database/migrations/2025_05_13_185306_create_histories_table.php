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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->float('light');          // Store lux value
            $table->float('temperature')->nullable(); // Optional if you're not always sending it
            $table->string('led_state');
            $table->string('motion'); 
            $table->float('humidity');      // true = ON, false = OFF
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};


