<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{

    use HasFactory;
    protected $fillable = ['nombre', 'apellidos', 'direccion', 'telefono', 'correo', 'formacion'];

    public function materias() {
      return $this->hasMany(Materia::class);
    }
}
