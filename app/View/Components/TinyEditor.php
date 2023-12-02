<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TinyEditor extends Component
{
    public $editorId;
    public $name;
    public $content;

    public function __construct(
        $editorId,
        $name,
        $content = null
    )
    {
        //
        $this->editorId = $editorId;
        $this->name = $name;
        $this->content = $content;
    }


    public function render()
    {
        return view('components.tiny-editor');
    }
}
