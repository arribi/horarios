<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidades';

    protected $fillable = [
        'nombre',
    ];

    // public function getRouteKeyName()
    // {
    //     return 'especialidad';
    // }

    public function modulos()
    {
        return $this->hasMany(Modulo::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
