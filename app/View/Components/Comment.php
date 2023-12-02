<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Comment as ModelsComment;

class Comment extends Component
{

    public $comment;

    public function __construct(ModelsComment $comment)
    {
        //
        $this->comment = $comment;
    }


    public function render()
    {
        return view('components.comment');
    }
}
