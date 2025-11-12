<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafiraCash extends Model
{
    use HasFactory;

    protected $table = 'Safira_Cash';

    protected $fillable = [
        'user_id',
        'withdrawal_id',
        'amount',
        'status'
    ];
}
