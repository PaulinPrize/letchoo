<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable /*implements MustVerifyEmail*/
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use HasRoles;

    public $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'email',
        'telephone',
        'password',
        'last_seen',
        //'user_has_role',
        //'paypalEmail',
        'facebook_id',
        'google_id',
        'payment_method_choose', 
        'paypal_email', 
        'bank_account',
        'discount'
    ];

    /**
     * Comme on ajoute une colonne de date (last_seen) 
     * on va la déclarer dans la propriété $dates pour bénéficier de Carbon
     *
    */
    protected $dates = [
        'last_seen',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function invitations()
    {
        return $this->belongsToMany(\App\Models\Invitation::class);
    }

    public function discounts() {
        return $this->hasMany(Discount::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    public function bonus() {
        return hasMany(Bonus::class);
    }
}
