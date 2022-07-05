<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    use HasFactory;

    public $table = 'pays';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'currency',
        'symbol',
        'tax'
    ];

    public function villes() {
        return $this->hasMany(Ville::class);
    }
}
