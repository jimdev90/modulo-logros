@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h3 class="text-center">Editar Sugerencia</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-8">
                                            <form action="{{ route('suggestions.update', ['suggestion' => $suggestion]) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="title">Asunto</label>
                                                    <input id="title" type="text" class="form-control" name="title"
                                                           value="{{ old('title', $suggestion->title) }}">

                                                    @error('title')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="content">Contenido</label>
                                                    <textarea id="content" class="form-control" name="content" cols="30"
                                                              rows="10">{{ old('content', $suggestion->content) }}</textarea>
                                                    @error('content')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <button class="btn btn-success mt-2">Editar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        const EditSuggestionModule = function () {

            const initTinyMCE = () => {
                tinymce.init({
                    selector: 'textarea',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                });
            }
            return {
                init: function () {
                    initTinyMCE();
                }
            }
        }();

        document.addEventListener('DOMContentLoaded', function () {
            EditSuggestionModule.init();
        })
    </script>
@endpush
