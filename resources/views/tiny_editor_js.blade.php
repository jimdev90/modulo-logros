
<script>
    const editorCfg = {
        language: 'es',
        height: 300,
        selector: '#{{ $editorId }}',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    };

    const initTinyMCE = () => {
        tinymce.init(editorCfg);
    }

    window.addEventListener("load", function() {
        initTinyMCE();
    });
</script>
