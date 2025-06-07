<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Nota;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estu = Estudiante::all();
        $doc = Docente::all();
        $asig = Materia::join('docentes', 'docente_id', '=', 'docentes.id')
                ->select('materias.id', 'materias.nombre', 'materias.docente_id', 'docentes.nombre as nomdoc', 'docentes.apellidos')->get();

        $notas = Nota::join('estudiantes', 'notas.estudiante_id', '=', 'estudiantes.id')
                ->join('materias', 'notas.materia_id', '=', 'materias.id')
                ->join('docentes', 'materias.docente_id', '=', 'docentes.id')
                ->select('notas.id as idnota', 'notas.periodo', 'notas.calificacion', 'notas.nota1',
                    'notas.nota2', 'notas.nota3', 'estudiantes.id as idest',
                    'estudiantes.nombre as nomestu', 'estudiantes.apellidos as apestu', 'materias.id as idmat', 'materias.nombre as asignatura',
                    'docentes.nombre as nomdoc', 'docentes.apellidos as docape')->get();

        $query = [
          'estu' => $estu,
          'doc' => $doc,
          'notas' => $notas,
          'asig' => $asig,
        ];
        return $query;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'asignatura' => 'required',
                'estudiante' => 'required',
                'nota1' => 'required',
                'nota2' => 'required',
                'nota3' => 'required',
                'periodo' => 'required'
            ]);

            $enc = Nota::where('estudiante_id', $request->estudiante)->where('materia_id', $request->asignatura)->exists();
            if($enc)
              return response()->json(['error' => 'Error, datos duplicados'], 404);
              
            $nota1 = $request->nota1;
            $nota2 = $request->nota2;
            $nota3 = $request->nota3;
            $resultado = round(($nota1 + $nota2 + $nota3)/3, 1);
            
            $nota = new Nota();
            $nota->estudiante_id = $request->estudiante;
            $nota->materia_id = $request->asignatura;
            $nota->periodo = $request->periodo;
            $nota->nota1 = $nota1;
            $nota->nota2 = $nota2;
            $nota->nota3 = $nota3;
            $nota->calificacion = $resultado;
            $nota->save();

            return response()->json($nota, 200);

        }catch (\Exception $e){
            return response()->json(['error' => 'Error, en el servidor'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try{
         Nota::find($id)->delete();
         return response()->json(null, 200);
      }catch (\Exception $e){
         return response()->json(['error' => 'Error, en el servidor'], 500);
      }
    }
}
