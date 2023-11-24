<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UnidadUser extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'unidades_usuarios';
    protected $fillable = [
        'idusuarios',
        'id_unidad',
        'state',
        'user_create',
    ];

    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class, 'id_unidad', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idusuarios', 'idusuarios');
    }
}
