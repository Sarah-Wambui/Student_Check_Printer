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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Basic details
            $table->string('employee_id')->nullable();
            $table->string('username')->nullable();
            $table->string('time_clock_name')->nullable();
            $table->string('legal_first_name')->nullable();
            $table->string('legal_last_name')->nullable();
            $table->string('hebrew_yiddish_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->enum('role', ['admin','employee'])->default('employee');
            $table->boolean('is_suspended')->default(false);

            // Address
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();

            // Contact
            $table->string('phone_home')->nullable();
            $table->string('phone_cell')->nullable();

            // Sensitive Data
            $table->date('dob')->nullable();
            $table->string('ssn')->nullable();

            // School + Status
            $table->string('leu_percent')->nullable();
            $table->string('status_2025_26')->nullable();

            $table->string('high_school')->nullable();
            $table->string('hs_city_state')->nullable();
            $table->string('hs_grad_date')->nullable();
            $table->string('diploma_attached')->nullable();

            // Previous BM
            $table->string('prev_bm1_name')->nullable();
            $table->string('prev_bm1_city_state')->nullable();
            $table->string('prev_bm1_dates')->nullable();
            $table->string('prev_bm1_transcript')->nullable();

            $table->string('prev_bm2_name')->nullable();
            $table->string('prev_bm2_city_state')->nullable();
            $table->string('prev_bm2_dates')->nullable();
            $table->string('prev_bm2_transcript')->nullable();

            // Other Yeshivas
            $table->string('other_yeshivas')->nullable();

            // Admissions
            $table->string('date_enrolled_amidei')->nullable();
            $table->string('level_admitted')->nullable();

            // Family
            $table->string('fathers_name')->nullable();
            $table->string('father_in_law_name')->nullable();
            $table->string('fil_address')->nullable();
            $table->string('fil_phone')->nullable();

            // Chabira
            $table->string('chabira_farmitug')->nullable();
            $table->string('chabira_nuchmitug')->nullable();

            // Additional
            $table->string('location_kollel')->nullable();
            $table->string('notes')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
