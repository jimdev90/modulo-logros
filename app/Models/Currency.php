<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'currencies';
    protected $fillable = [
        'id_type_currency',
        'quantity',
        'date_create',
        'time_create',
        'cod_uni1',
        'user_create',
    ];

    public function type_currency(): BelongsTo
    {
        return $this->belongsTo(TypeCurrency::class, 'id_type_currency', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_create', 'idusuarios');
    }
}
