<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rut',
        'email',
        'phone',
        'address',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}