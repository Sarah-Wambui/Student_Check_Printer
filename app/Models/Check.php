<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'check_number',
        'amount',
        'status',
        'printed_at'
    ];

    public function user()
    {
    return $this->belongsTo(User::class);
    }


    public function company()
    {
    return $this->belongsTo(Company::class,'company_id');
    }
}
