<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use Illuminate\Http\Request;
use App\Models\Docente;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doc = Docente::all();
        $asig = Materia::join('docentes', 'docente_id', '=', 'docentes.id')
                ->select('materias.id', 'materias.nombre', 'dia', 'horain', 'horafin', 'docentes.nombre as nomdoc', 'docentes.apellidos', 'docentes.id as idoc')
                ->get();

        $query = [
          'doc' => $doc,
          'asig' => $asig
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
                'nombre' => 'required',
                'dia' => 'required',
                'horain' => 'required',
                'horafin' => 'required',
                'docente' => 'required'
            ]);
            
            $mat = new Materia();
            $mat->nombre = $request->nombre;
            $mat->dia = $request->dia;
            $mat->horain = $request->horain;
            $mat->horafin = $request->horafin;
            $mat->docente_id = $request->docente;
            $mat->save();

            return response()->json($mat, 200);

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
       $request->validate([
                'nombre' => 'required',
                'dia' => 'required',
                'horain' => 'required',
                'horafin' => 'required',
                'idoc' => 'required'
        ]);

        $mat = Materia::find($id);

        if(!$mat){
           return response()->json(['error' => 'Asignatura no encontrada'], 404);
        }
        
        $mat->nombre = $request->nombre;
        $mat->dia = $request->dia;
        $mat->horain = $request->horain;
        $mat->horafin = $request->horafin;
        $mat->docente_id = $request->idoc;
        $mat->save();

        return response()->json($mat, 200);
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
         Materia::find($id)->delete();
         return response()->json(null, 200);
      }catch (\Exception $e){
         return response()->json(['error' => 'Error, en el servidor'], 500);
      }
    }
}
