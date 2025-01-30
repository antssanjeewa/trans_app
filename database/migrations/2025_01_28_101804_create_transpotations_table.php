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
        Schema::create('transportation', function (Blueprint $table) {
            $table->id();
            $table->string('from');
            $table->string('to');
            $table->date('date');
            $table->string('description')->nullable();
            $table->string('distance')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('driver_id')->constrained('users');
            $table->foreignId('vehicle_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportation');
    }
};
