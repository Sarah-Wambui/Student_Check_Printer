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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();

            // Keep relationship to users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Also keep a plain name column for the sheet import
            $table->string('Name');

            // Attendance fields
            $table->date('Date')->nullable();
            $table->time('AM_In')->nullable();
            $table->time('AM_Out')->nullable();
            $table->time('PM_In')->nullable();
            $table->time('PM_Out')->nullable();

            // Total column
            $table->decimal('Total', 12, 2)->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
