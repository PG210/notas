<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Materia;
use Illuminate\Http\Request;
use App\Models\Nota;
use DB;
class HomeController extends Controller
{
    public function index(){
        $notas = Nota::all();
        $aprobados = Nota::where('calificacion', '>=', 3)->get();
        $reprobados = Nota::where('calificacion', '<', 3)->get();
        $asig = Materia::count();
        $promedio = Nota::select('materia_id', DB::raw('AVG(calificacion) as promedio'))
                     ->groupBy('materia_id')->with('materia')->get();

        $malta = $promedio->sortByDesc('promedio')->first();
        $mbajo = $promedio->sortBy('promedio')->first();

        $docentes = Docente::count();
        $estu = Estudiante::count();

        $query = [
            'notas' => $notas,
            'aprobados' => $aprobados,
            'reprobados' => $reprobados,
            'asig' => $asig,
            'malta' => $malta,
            'mbajo' => $mbajo,
            'docentes' => $docentes,
            'estu' => $estu
            
        ];
        return $query;
    }
}
