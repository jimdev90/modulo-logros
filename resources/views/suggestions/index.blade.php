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
                                    <h3 class="text-center">Estimados usuarios</h3>
                                    <h5 class="text-danger text-center">Queremos mejorar continuamente nuestro sistema para brindarles la mejor experiencia posible. Sus opiniones son fundamentales para este proceso. Si tienen alguna queja o sugerencia de mejora, les animamos a compartirla con nosotros.</h5>
                                </div>
                                <div class="card-body text-center">
                                    <a href="{{ route('suggestions.create') }}" class="btn btn-success btn-sm">Agregar nuevo registro</a>

                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Titulo</th>
                                            <th scope="col">Creado por:</th>
                                            <th scope="col">Unidad</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @forelse($suggestions as $suggestion)
                                            <tr>
                                                <th scope="row">{{ $i++ }}</th>
                                                <td>{{ $suggestion->title }}</td>
                                                <td>{{ $suggestion->author->nombre }}</td>
                                                <td>{{ $suggestion->author->unidad_usuario->unidad->name }}</td>
                                                <td>{{ $suggestion->created_at->diffForHumans() }}</td>
                                                <td>
                                                    @if($suggestion->author_id === auth()->user()->idusuarios)
                                                        <a href="{{ route('suggestions.edit', ['suggestion' => $suggestion]) }}" class="btn btn-warning btn-sm">Editar</a>
                                                        <form class="d-inline" action="{{ route('suggestions.delete', ['suggestion' => $suggestion]) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm">Eliminar</button>
                                                        </form>

                                                    @endif
                                                        <a href="{{ route('suggestion.show', ['id' => $suggestion->id]) }}" class="btn btn-info btn-sm">Leer más</a>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse

                                        </tbody>
                                    </table>
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
        const DashboardModule = function () {


            return {
                init: function () {
                }
            }
        }();

        document.addEventListener('DOMContentLoaded', function () {
            DashboardModule.init();
        })
    </script>
@endpush
