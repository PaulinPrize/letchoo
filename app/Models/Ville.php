<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    public $table = 'villes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'ville_code_postal',
        'ville_longitude',
        'ville_latitude',
        'ville_longitude_grd',
        'ville_latitude_grd',
        'ville_longitude_dms',
        'ville_latitude_dms',
        'ville_zmin',
        'ville_zmax',
        'pays_id'
    ];

    public function pays()
    {
        return $this->belongsTo(\App\Models\Pays::class);
    }
}
