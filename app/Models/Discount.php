<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'state',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
