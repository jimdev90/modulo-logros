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
                                    <h3 class="text-center">Bienvenido</h3>
                                </div>
                                <div class="card-body">
                                    <h4 class="text-center">{{ auth()->user()->nombre }}</h4>
                                </div>
                                <div class="card-body">
                                    @if(auth()->user()->unidad_usuario->profile === '99')
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="alert alert-success text-center">
                                                    <h3>Unidades con logros el día de hoy</h3>
                                                </div>
                                                <div class="list-group">
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @forelse($unidadesConLogros as $ucl)
                                                        <a href="#" class="list-group-item list-group-item-action">
                                                            {{ $i++ }} .- {{ $ucl->unidad->name }}
                                                        </a>
                                                    @empty
                                                        <p class="text-center fw-bold">
                                                            <stron>Sin registros</stron>
                                                        </p>
                                                    @endforelse
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="alert alert-danger text-center">
                                                    <h3>Unidades sin logros el día de hoy</h3>
                                                </div>
                                                <div class="list-group">
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @forelse($unidadesSinLogros as $usl)
                                                        <a href="#" class="list-group-item list-group-item-action">
                                                            {{ $i++ }} .- {{ $usl->unidad->name }}
                                                        </a>
                                                    @empty
                                                        <p class="text-center fw-bold">
                                                            <stron>Sin registros</stron>
                                                        </p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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
