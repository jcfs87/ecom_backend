<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\User;
use App\Models\Valoracion;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePublicacionRequest;
use App\Http\Requests\UpdatePublicacionRequest;
use Illuminate\Support\Facades\DB;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicaciones = Publicacion::all();
        // Devolver los datos en formato JSON
        return response()->json([$publicaciones]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function getPublicacionWithUserAndValoracion()
    {
        try {
             $publicacion = DB::table('users')
                            ->join('valoracions', 'users.users_id', '=', 'valoracions.fk_user_id')
                            ->join('publicacions', 'users.users_id', '=', 'publicacions.fk_user_id')
                            ->select('users.users_id', 'publicacions.title', DB::raw('SUM(valoracions.puntos) as total_puntos'), 'publicacions.description', 'users.name')
                            ->groupBy('users.users_id', 'publicacions.title', 'publicacions.description', 'users.name')
                            ->get();
             return response()->json($publicacion);
        } catch (\Exception $e) {
             report($e);
             return response()->json(['error' => 'Error en esta función'], 500);
        }
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePublicacionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Publicacion $publicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publicacion $publicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePublicacionRequest $request, Publicacion $publicacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publicacion $publicacion)
    {
        //
    }
}
