<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'desc',
        'montant',
        'subscription_type',
    ];
    public function Subscription_User()
    {
        return $this->hasMany(Subscription_User::class);
    }
}
