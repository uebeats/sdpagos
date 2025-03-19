<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'billing_cycle'];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}