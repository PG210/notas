<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use Illuminate\Http\Request;


class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Estudiante::all();
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
            'apellidos' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'grado' => 'required',
        ]);
        
        $enc = Estudiante::where('correo', $request->correo)->first();
        if($enc){
           return response()->json(['error' => 'Ya existe un estudiante con el correo.'], 404);
        }
        
        $estudiante = Estudiante::create($request->all()); 
        return response()->json($estudiante, 200);
       
      
      }catch (\Exception $e){
         return response()->json(['error' => 'Error en el servidor'], 500);
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    $estudiante = Estudiante::find($id);
         return $estudiante;
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
            'apellidos' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'grado' => 'required',
        ]);

        $estudiante = Estudiante::find($id);

        if(!$estudiante){
           return response()->json(['error' => 'Estudiante no encontrado'], 404);
        }
        
        $estudiante->nombre = $request->nombre;
        $estudiante->apellidos = $request->apellidos;
        $estudiante->telefono = $request->telefono;
        $estudiante->direccion = $request->direccion;
        $estudiante->correo = $request->correo;
        $estudiante->grado = $request->grado;
        $estudiante->save();

        return response()->json($estudiante, 200);

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
         Estudiante::find($id)->delete();
         return response()->json(null, 200);
      }catch (\Exception $e){
         return response()->json(['error' => 'Error en el servidor'], 500);
      }
    }
}
