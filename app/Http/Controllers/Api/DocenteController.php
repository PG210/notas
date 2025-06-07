<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Docente::all();
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
                'formacion' => 'required',
            ]);
            
            $enc = Docente::where('correo', $request->correo)->first();
            if(!$enc)
               $docente = Docente::create($request->all()); 
            
            return response()->json($docente, 200);

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
            'apellidos' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'formacion' => 'required',
        ]);

        $docente = Docente::find($id);

        if(!$docente){
           return response()->json(['error' => 'Docente no encontrado'], 404);
        }
        
        $docente->nombre = $request->nombre;
        $docente->apellidos = $request->apellidos;
        $docente->telefono = $request->telefono;
        $docente->direccion = $request->direccion;
        $docente->correo = $request->correo;
        $docente->formacion = $request->formacion;
        $docente->save();

        return response()->json($docente, 200);
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
         Docente::find($id)->delete();
         return response()->json(null, 200);
      }catch (\Exception $e){
         return response()->json(['error' => 'Error, en el servidor'], 500);
      }
    }
}
