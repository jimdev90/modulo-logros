<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Comment extends Model
{
    use HasFactory, HasRecursiveRelationships;

    protected $fillable = [
        'parent_id',
        'author_id',
        'content',
        'approved',
        'commentable_id',
        'commentable_type'
    ];

    public function getLocalKeyName(): string
    {
        return 'id';
    }

    public function getParentKeyName(): string
    {
        return 'parent_id';
    }

    public function getDepthName(): string
    {
        return 'depth';
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'idusuarios');
    }

    public function timeAgo(): Attribute
    {
        return new Attribute(function (){
            return $this->created_at->diffForHumans();
        });
    }

    public function status(): Attribute
    {
        return new Attribute(function (){
            return $this->approved ? 'Aprobado' : 'Pendiente';
        });
    }

    public function statusClass(): Attribute
    {
        return new Attribute(function (){
            return $this->approved ? 'success' : 'warning';
        });
    }

}
