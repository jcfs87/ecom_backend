<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValoracionRequest;
use App\Http\Requests\UpdateValoracionRequest;
use Throwable;

use function Laravel\Prompts\select;

class ValoracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          // Obtener todas las valoraciones
        $valoraciones = Valoracion::all();
          // Devolver los datos en formato JSON
        return response()->json(['valoraciones' => $valoraciones]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreValoracionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Valoracion $valoracion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Valoracion $valoracion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateValoracionRequest $request, Valoracion $valoracion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Valoracion $valoracion)
    {
        //
    }
    public function getRatingSum($id)
    {
        try {
            $valoraciones = Valoracion::where('fk_user_id', $id)->get();
            $sumaPuntos = 0;
            foreach ($valoraciones as $valoracion) {
                $sumaPuntos += $valoracion->puntos;
            }
            return response()->json(['rating_sum' => $sumaPuntos], 200);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['error' => 'Error en esta función'], 500);
        }
    }
}
