<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;

    protected $table = 'bonus';
    
    protected $fillable = [
        'user_id',
        'invitation_id',
        'amount',
        'currency'
    ];

    public function invitation() {
        return belongsTo(Invitation::class);
    }

    public function user() {
        return belongsTo(User::class);
    }
}
