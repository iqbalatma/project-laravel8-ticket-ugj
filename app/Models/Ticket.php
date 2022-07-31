<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'order_number',
        'order_status',
        'checkin_status',
        'name',
        'phone',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
