<?php

namespace App\Models;

use App\Traits\Commentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suggestion extends Model
{
    use Commentable, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'slug',
    ];
}
