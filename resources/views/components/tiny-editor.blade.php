<textarea
    name="{{ $name }}"
    id="{{ $editorId }}"
    class="form-control"
>
{!! old($name, $content) !!}
</textarea>
