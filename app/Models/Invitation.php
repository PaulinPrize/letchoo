<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    public $table = 'invitations';

    public $fillable = [
        'menu',
        'type_of_cuisine',
        'description',
        'country',
        'city',
        'currency',
        'tax',
        'place',
        'postal_code',
        'date',
        'heure',
        'price',
        'income',
        'total',
        'number_of_guests',
        'image',        
        'active',
        'complete',
        'direct_payment',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
