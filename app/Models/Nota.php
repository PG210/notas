<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    protected $fillable = ['estudiante_id', 'materia_id', 'periodo', 'nota1', 'nota2', 'nota3', 'calificacion'];

    public function estudiante() {
        return $this->belongsTo(Estudiante::class);
    }

    public function materia() {
        return $this->belongsTo(Materia::class);
    }
}
