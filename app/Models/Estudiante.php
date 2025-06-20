<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'apellidos', 'direccion', 'telefono', 'correo', 'grado'];
    public function notas() {
    return $this->hasMany(Nota::class);
}
}

