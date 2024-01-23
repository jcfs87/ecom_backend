<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Publicacion;
use App\Models\User;

class PublicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $users->each(function ($user) {
            Publicacion::factory()->count(3)->create(['fk_user_id' => $user->users_id]);
        });
    }
}
