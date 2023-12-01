<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Comment extends Component
{

    public function __construct(public \App\Models\Comment $comment)
    {
        //
    }


    public function render()
    {
        return view('components.comment');
    }
}
