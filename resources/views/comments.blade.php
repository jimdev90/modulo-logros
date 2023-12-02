<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="row">
            <div class="mt-2 mb-" id="editor-container">
                <form id="comments-form" action="{{ $route }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="model_id" value="{{ $model->id }}">
                        <input type="hidden" name="parent_id" value="0">
                        <x-tiny-editor name="content" :editor-id="$editorId" />
                    </div>
                    <button type="submit" class="btn btn-primary mt-2 float-end">Comentar</button>
                </form>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-12 col-lg-12">
                <div class="card text-dark">
                    <div class="card-header p-4 mb-2">
                        <h4 class="mb-0">Comentarios</h4>
                    </div>

                    @forelse($comments as $comment)
                        <x-comment :comment="$comment" />
                    @empty
                        <div class="card-body">
                            <div class="alert alert-info">
                                No hay comentarios
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    @include("tiny_editor_js")
    <script>
        window.addEventListener("load", function() {
            if (window.location.hash) {
                setTimeout(function() {
                    document.querySelector(window.location.hash).scrollIntoView({
                        behavior: "smooth",
                        block: "start",
                    });
                }, 500);
            }

            // on click any element that id starts with reply-
            document.querySelectorAll("[id^=reply-]").forEach(reply => {
                reply.addEventListener('click', function (event) {
                    const commentId = event.target.id.split("-")[1];
                    const comment = document.getElementById("comment-" + commentId);

                    // set parent_id in form
                    document.querySelector("input[name=parent_id]").value = commentId;

                    // move editor after comment
                    const content = comment.querySelector(".content");
                    const editor = document.getElementById("editor-container");
                    const fragment = document.createDocumentFragment();
                    fragment.appendChild(editor);
                    content.after(fragment);

                    // refresh tinyMCE
                    tinymce.remove();
                    initTinyMCE();

                    // scroll to editor
                    setTimeout(function() {
                        editor.scrollIntoView({
                            behavior: "smooth",
                            block: "start",
                        });
                    }, 100);
                })
            });

            // submit form with ajax
            document.getElementById('comments-form').addEventListener('submit', function (event) {
                event.preventDefault();

                const formData = new FormData(this);
                const url = this.getAttribute("action");

                // get comment from editor and set in formData
                const comment = tinymce.get("{{ $editorId }}").getContent();
                formData.set("content", comment);

                // send ajax request
                axios.post(url, formData, {
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json",
                    }
                })
                    .then(response => response.data)
                    .then(data => {
                        window.location.hash = `comment-${data.comment.id}`;
                        window.location.reload();
                    })
                    .catch(e => {
                        if (e.response.status === 422) {
                            const errors = e.response.data.errors;
                            const error = Object.keys(errors)[0];
                            const errorMessage = errors[error][0];
                            tinymce.get("{{ $editorId }}").notificationManager.open({
                                text: errorMessage,
                                type: "error",
                                color: "red",
                                timeout: 5000,
                            });
                            return;
                        }

                        tinymce.get("{{ $editorId }}").notificationManager.open({
                            text: "Error al procesar el comentario",
                            type: "error",
                            color: "red",
                            timeout: 5000,
                        });
                    });
            });
        });
    </script>
@endpush

