<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;
use App\Models\User;

class Payment extends Model
{
    use HasFactory, Billable;

    protected $fillable = [
        'user_id', 'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
