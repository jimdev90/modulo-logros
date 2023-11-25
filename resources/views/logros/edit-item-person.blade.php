@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="text-center">Editar Registro de GRUPOS DELICTIVOS ORGANIZADOS</h3>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-danger">
                                        <p class="text-center"><strong>Asegurate </strong></p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-6">
                                            <form method="post" action="{{ route('edit-item-person.put', ['data'  => $data->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="">Tipo</label>
                                                    <input type="text" class="form-control" value="{{ $data->type_person->name }}" readonly>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="">Unidad</label>
                                                    <input type="text" class="form-control" value="{{ $data->unidad->name }}" readonly>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="">Registrado por:</label>
                                                    <input type="text" class="form-control" value="{{ $data->user->nombre }}" readonly>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="">Cantidad</label>
                                                    <input name="quantity" type="text" class="form-control" value="{{ $data->quantity }}">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <button class="btn btn-success">Editar</button>
                                                </div>
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
        const ItemPersonModule = function () {


            return {
                init: function () {
                }
            }
        }();

        document.addEventListener('DOMContentLoaded', function () {
            ItemPersonModule.init();
        })
    </script>
@endpush
