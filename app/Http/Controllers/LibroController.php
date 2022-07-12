<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use Illuminate\Support\Facades\Validator;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all = Libro::all();
        if($all->count()>0){
            return response()->json([
                'data' => $all,
                'code' => 200,
            ]);
        }

        return response()->json([
            'code' => 401,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'autor' => 'required|max:100', 
            'titulo' => 'required|max:120',
            'edicion' => 'required|max:60',
            'datos_publicacion' => 'required|max:200',
            'tipo_contenido' => 'required|max:100',
            'restricciones' => 'required|max:100',
            'materia' => 'required|max:100',
            'proveedor' => 'required|max:80',
        ]);

        if ($validator->fails()) { 
            return response()->json([
                'code' => 401,
                'errors' => $validator->errors()
            ]);
        }

        $libro = Libro::create($request->all());

        return response()->json([
            'code'=> 200,
            'data'=> $libro,
            'message' => 'Se ha creado correctamente.'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        //
        return response()->json([
            'code'=> 200,
            'data'=> $libro,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        //
        $validator = Validator::make($request->all(), [
            'autor' => 'required|max:100', 
            'titulo' => 'required|max:120',
            'edicion' => 'required|max:60',
            'datos_publicacion' => 'required|max:200',
            'tipo_contenido' => 'required|max:100',
            'restricciones' => 'required|max:100',
            'materia' => 'required|max:100',
            'proveedor' => 'required|max:80',
        ]);

        if ($validator->fails()) { 
            return response()->json([
                'code' => 401,
                'errors' => $validator->errors()
            ]);
        }

        $data = $libro->fill($request->all())->save();
        return response()->json([
            'code'=> 200,
            'data'=> $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        //
        $libro->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Se ha eliminado correctamente.'
        ]);
    }
}
