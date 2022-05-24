<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInvitation extends Model
{
    use HasFactory;

    public $table = 'invitation_user';

    public $fillable = [ 'user_id', 'subscriber_name', 'invitation_id', 'menu', 'owner_id', 'amount', 'currency',  'activeUser'];
}
