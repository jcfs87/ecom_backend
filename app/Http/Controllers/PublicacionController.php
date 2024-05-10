<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\User;
use App\Models\Valoracion;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePublicacionRequest;
use App\Http\Requests\UpdatePublicacionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
                             ->leftJoin('valoracions', 'users.users_id', '=', 'valoracions.fk_user_id')
                             ->join('publicacions', 'users.users_id', '=', 'publicacions.fk_user_id')
                             ->select('publicacions.title', DB::raw('SUM(valoracions.puntos) as total_puntos'), 'publicacions.description', 'users.name', 'users.photo', 'publicacions.created_at')
                             ->groupBy('users.users_id', 'publicacions.title', 'publicacions.description', 'users.name', 'users.photo', 'publicacions.created_at')
                            ->get();
             return response()->json($publicacion);
        } catch (\Exception $e) {
             report($e);
             return response()->json(['error' => 'Error en esta función'], 500);
        }
    }
    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'type' => 'nullable|string',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
            $user = Auth::user();
            if (!$user) {
                throw ValidationException::withMessages([
                    'message' => ['User not authenticated'],
                ]);
            }
                $publicacion = Publicacion::create([
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'type' => $request->input('type'),
                    'fk_user_id' => $user->users_id,
                ]);
                return response()->json([
                    'message' => 'Publicacion succesfully created',
                     'Publicacion' => $publicacion,
                ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
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
