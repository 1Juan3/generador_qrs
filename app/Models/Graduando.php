<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduando extends Model
{
    use HasFactory;
    protected $table = 'informacion_graduando';
    protected $fillable = ['nombres', 'apellidos', 'cedula','nombre_invitados','titulo' ];

}
