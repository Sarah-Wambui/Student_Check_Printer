<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'username',
        'time_clock_name',
        'legal_first_name',
        'legal_last_name',
        'hebrew_yiddish_name',
        'email',
        'password',
        'role',
        'is_suspended',
        'address',
        'city',
        'state',
        'zip',
        'phone_home',
        'phone_cell',
        'dob',
        'ssn',
        'leu_percent',
        'status_2025_26',
        'high_school',
        'hs_city_state',
        'hs_grad_date',
        'diploma_attached',
        'prev_bm1_name',
        'prev_bm1_city_state',
        'prev_bm1_dates',
        'prev_bm1_transcript',
        'prev_bm2_name',
        'prev_bm2_city_state',
        'prev_bm2_dates',
        'prev_bm2_transcript',
        'other_yeshivas',
        'date_enrolled_amidei',
        'level_admitted',
        'fathers_name',
        'father_in_law_name',
        'fil_address',
        'fil_phone',
        'chabira_farmitug',
        'chabira_nuchmitug',
        'location_kollel',
        'notes',
    ];


     public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'user_deposits' => 'decimal:2',
        'user_deposits_spent' => 'decimal:2',
        'user_deposits_remaining' => 'decimal:2',
    ];
}
