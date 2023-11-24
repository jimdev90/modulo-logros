<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CriminalGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'criminal_groups';
    protected $fillable = [
        'id_type_criminal_group',
        'quantity',
        'date_create',
        'time_create',
        'cod_uni1',
        'user_create',
        'user_delete',
    ];

    public function type_criminal_group()
    {
        return $this->belongsTo(TypeCriminalGroup::class, 'id_type_criminal_group', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_create', 'idusuarios');
    }
}
