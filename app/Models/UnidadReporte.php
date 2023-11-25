<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UnidadReporte extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'unidades_reportes';
    protected $fillable = [
        'id_unidad',
        'date_init',
        'date_finish',
        'user_init',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_init', 'idusuarios');
    }
}
