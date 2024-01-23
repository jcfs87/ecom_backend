<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'fk_user_id');
    }

    public $timestamps = false;
    protected $table = 'publicacions';
    protected $primaryKey = 'pk_id_publicacion';
    protected $foreignKey = 'fk_user_id';
    public $incrementing = true;

    protected $fillable = [
        'pk_id_publicacion',
        'title',
        'description',
        'create_at',
        'fk_user_id',
        'type',
    ];
}
