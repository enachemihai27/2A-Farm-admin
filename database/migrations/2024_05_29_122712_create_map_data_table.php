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
        Schema::create('map_data', function (Blueprint $table) {
            $table->id('primary_key');
            $table->text('d');
            $table->string('title');
            $table->string('id')->unique();
            $table->string('symbol')->unique();
            $table->text('path');
            $table->text('textPath');
            $table->string('pathColor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_data');
    }
};
