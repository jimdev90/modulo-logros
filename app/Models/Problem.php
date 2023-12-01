<?php

namespace App\Models;

use App\Traits\Commentable;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use Commentable;

    protected $fillable = [
        'title',
        'content'
    ];
}
