<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FireArm extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'firearms';
    protected $fillable = [
        'id_type_firearm',
        'quantity',
        'date_create',
        'time_create',
        'cod_uni1',
        'user_create',
    ];

    public function type_firearm(): BelongsTo
    {
        return $this->belongsTo(TypeFireArm::class, 'id_type_firearm', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_create', 'idusuarios');
    }
}
