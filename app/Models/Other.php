<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Other extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'others';
    protected $fillable = [
        'id_type_other',
        'quantity',
        'date_create',
        'time_create',
        'cod_uni1',
        'user_create',
    ];

    public function type_other(): BelongsTo
    {
        return $this->belongsTo(TypeOther::class, 'id_type_other', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_create', 'idusuarios');
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'cod_uni1', 'id')->withDefault([
            'name' => 'sin registros'
        ]);
    }
}
