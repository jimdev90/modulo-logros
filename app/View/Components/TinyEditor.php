<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TinyEditor extends Component
{

    public function __construct(
        public string $editorId,
        public string $name,
        public ?string $content = null,
    )
    {
        //
    }


    public function render()
    {
        return view('components.tiny-editor');
    }
}
