<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'Name',
        'Date',
        'AM_In',
        'AM_Out',
        'PM_In',
        'PM_Out',
        'Total',
    ];


    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
