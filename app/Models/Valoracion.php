<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'fk_user_id');
    }
    public $timestamps = false;
    public $table = 'valoracions';
    protected $primaryKey = 'pk_id_valoracion';
    protected $foreignKey = 'fk_user_id';
    public $incrementing = true;

    protected $fillable = [
        'pk_id_valoracion',
        'comentario',
        'puntos',
        'fk_user_id',
    ];
}
