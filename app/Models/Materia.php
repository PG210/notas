<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'dia', 'horain', 'horafin', 'docente_id'];

    public function notas() {
      return $this->hasMany(Nota::class);
    }
    public function docentes() {
      return $this->belongsTo(Docente::class);
    }
} 
