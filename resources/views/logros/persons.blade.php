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
                                    <h3 class="text-center">PERSONAS</h3>
                                    <div>
                                        <div id="chart_12" class="d-flex justify-content-center"
                                             style="height: 100px"></div>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-outline-dark">
                                            DETENIDOS EXTRANJEROS <span
                                                class="badge bg-secondary">{{ $dataCount['detenidos_extranjero'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            DETENIDOS NACIONALES <span
                                                class="badge bg-secondary">{{ $dataCount['detenidos_nacional'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            DETENIDOS (TERRORISMO) <span
                                                class="badge bg-secondary">{{ $dataCount['detenidos_terrorismo'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            DETENIDOS (TID) <span
                                                class="badge bg-secondary">{{ $dataCount['detenidos_tid'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            CAPTURADOS CAPTURADOS POR REQUISITORIA (RQ) <span
                                                class="badge bg-secondary">{{ $dataCount['capturas_rq'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            MENORES RETENIDOS <span
                                                class="badge bg-secondary">{{ $dataCount['menores_retenidos'] }}</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('register-persons.store') }}" method="post"
                                          class="row">
                                        @csrf
                                        <div class="form-group col-6">
                                            <label for="id_type_person" class="control-label">Detenidos
                                                Extranjeros</label>
                                            <select name="id_type_person" class="form-control" id="id_type_person">
                                                <option value="">Seleccione...</option>
                                                @foreach($types as $type)
                                                    <option value="{{ $type->id }}">
                                                        {{ $type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('detenidos_extranjero')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="quantity" class="control-label">Cantidad</label>
                                            <input id="quantity" name="quantity" class="form-control"
                                                   type="number" placeholder="0" value="0">
                                            @error('quantity')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-3">
                                            <button class="btn btn-outline-success">Registrar</button>
                                        </div>
                                    </form>
                                    <div class="mt-4">
                                        <table class="table" id="datatable">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Hora</th>
                                                <th scope="col">Registrado por:</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @forelse($data as $grupo)
                                                <tr>
                                                    <th scope="row">{{ $i++ }}</th>
                                                    <td>{{ $grupo->type_person->name }}</td>
                                                    <td>{{ $grupo->quantity }}</td>
                                                    <td>{{ $grupo->time_create }}</td>
                                                    <td>{{ $grupo->user->nombre }}</td>
                                                    <td>
                                                        @if($grupo->user_create == auth()->user()->idusuarios)
                                                            <form method="post"
                                                                  action="{{ route('register-persons.delete', ['data' => $grupo->id]) }}"
                                                                  class="form-delete">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger">
                                                                    Eliminar
                                                                </button>
                                                            </form>
                                                        @endif

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
    </div>
@endsection
@push('js')
    <script>
        const PersonModule = function () {

            const _initChart = function () {

                const detenidos_extranjero = '#6993FF';
                const detenidos_nacional = '#1BC5BD';
                const detenidos_terrorismo = '#c51b6d';
                const detenidos_tid = '#56c51b';
                const capturas_rq = '#c5921b';
                const menores_retenidos = '#013f0e';

                let countDetenidoExtranjero = "{{ $dataCount['detenidos_extranjero'] }}";
                let countDetenidoNacional = "{{ $dataCount['detenidos_nacional'] }}";
                let countDetenidoTerrorismo = "{{ $dataCount['detenidos_terrorismo'] }}";
                let countDetenidoTID = "{{ $dataCount['detenidos_tid'] }}";
                let countCapturaRQ = "{{ $dataCount['capturas_rq'] }}";
                let countMenoresRetenidos = "{{ $dataCount['menores_retenidos'] }}";

                const options = {
                    series: [
                        parseInt(countDetenidoExtranjero),
                        parseInt(countDetenidoNacional),
                        parseInt(countDetenidoTerrorismo),
                        parseInt(countDetenidoTID),
                        parseInt(countCapturaRQ),
                        parseInt(countMenoresRetenidos),
                    ],
                    chart: {
                        width: 500,
                        type: 'pie',
                    },
                    labels: [
                        'Detenidos Extranjeros',
                        'Detenidos Nacional',
                        'Detenidos Terrorismo',
                        'Detenidos TID',
                        'Captura RQ',
                        'Menores Retenidos',
                    ],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 600,
                                height: 1500
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                    colors: [
                        detenidos_extranjero,
                        detenidos_nacional,
                        detenidos_terrorismo,
                        detenidos_tid,
                        capturas_rq,
                        menores_retenidos,
                    ]
                };

                const chart = new ApexCharts(document.querySelector("#chart_12"), options);

                chart.render();
            }

            const _initDatatable = function () {
                let table = new DataTable('#datatable');
                table.on('click', 'form.form-delete', function (e) {
                    e.preventDefault()
                    const form = $(this);
                    console.log(form)
                    Swal.fire({
                        title: "¿Desea eliminar el registro?",
                        text: "Eliminar un registro es permanente. No es posible deshacer la operación. ¿Desea continuar?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si eliminar!",
                        cancelButtonText: "Cancelar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.unbind().submit();
                        }
                    });
                })
            }

            return {
                init: function () {
                    _initChart();
                    _initDatatable();
                }
            }
        }();

        document.addEventListener('DOMContentLoaded', function () {
            PersonModule.init();
        })
    </script>
@endpush
