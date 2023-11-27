<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ModuloResource;
use App\Models\Especialidad;
use App\Models\Modulo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class ModuloController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Especialidad $especialidad = null)
    {
        // request()->exists('modulos')
        //Módulos de una especialidad
        $modulos = $especialidad ? $especialidad->modulos : Modulo::paginate(1);

        return ModuloResource::collection($modulos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Validar los datos
        $validator = Validator::make($data, [
            'codigo' => 'required|string|max:255',
            'materia' => 'required|string|max:255',
            'h_semanales' => 'required|integer',
            'h_totales' => 'required|integer',
        ]);

        $modulo = Modulo::create($data);

        return new ModuloResource($modulo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Modulo $modulo)
    {
        return new ModuloResource($modulo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modulo $modulo)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'codigo' => 'required|string|max:255',
            'materia' => 'required|string|max:255',
            'h_semanales' => 'required|integer',
            'h_totales' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Actualizar los datos del módulo
        $modulo->fill($data);
        $modulo->save();

        return new ModuloResource($modulo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modulo $modulo)
    {
        $modulo->delete();

        return response()->json(['message' => 'El módulo se ha eliminado correctamente'], 204);
    }
}
