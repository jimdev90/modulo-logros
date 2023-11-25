
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
                                    <h3 class="text-center">Reportes Logros Inteligencia</h3>
                                    <div class="text-center">
                                        <img width="200" src="{{ asset('img/report.png') }}" alt="reportes">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="alert alert-success text-center">
                                                <h3>Reporte General por día</h3>
                                            </div>
                                            <form action="{{ route('process-report-general') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="date">Fecha</label>
                                                    <input type="date" class="form-control" id="date" name="date">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="type_report">Tipo de Reporte</label>
                                                    <select class="form-control" name="type_report" id="type_report">
                                                        <option value="">Seleccione...</option>
                                                        <option value="excel">EXCEL</option>
                                                        <option value="pdf">PDF</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <button class="btn btn-outline-success w-100">Descargar</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    <div class="card mt-5">
                                        <div class="card-body">
                                            <div class="alert alert-info text-center">
                                                <h3>Reporte de Unidades por día</h3>
                                            </div>
                                            <form action="{{ route('report.preview') }}" method="GET">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="date">Fecha</label>
                                                    <input type="date" class="form-control" id="date" name="date">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="type_report">Tipo de Reporte</label>
                                                    <select class="form-control" name="type_report" id="type_report">
                                                        <option value="">Seleccione...</option>
                                                        <option value="excel">EXCEL</option>
                                                        <option value="pdf">PDF</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="id_unidad">Unidad</label>
                                                    <select class="form-control" name="id_unidad" id="id_unidad">
                                                        <option value="">Seleccione...</option>
                                                        @foreach($unidades as $unidad)
                                                            <option value="{{ $unidad->id }}">{{ $unidad->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <button class="btn btn-outline-info w-100">Descargar</button>
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

@endpush
