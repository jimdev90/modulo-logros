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
                                    <h3 class="text-center">MONEDA NACIONAL Y EXTRANJERA</h3>
                                    <div>
                                        <div id="chart_12" class="d-flex justify-content-center"
                                             style="height: 100px"></div>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-outline-dark">
                                            SOLES <span
                                                class="badge bg-secondary">{{ $dataCount['nuevos_soles'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            DÓLARES <span class="badge bg-secondary">{{ $dataCount['dolares'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            EUROS <span class="badge bg-secondary">{{ $dataCount['euros'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            PESOS <span class="badge bg-secondary">{{ $dataCount['pesos'] }}</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('register-currencies.store') }}" method="post" class="row">
                                        @csrf
                                        <div class="form-group col-6">
                                            <label for="id_type_currency" class="control-label">Tipo</label>
                                            <select name="id_type_currency" id="id_type_currency" class="form-control">
                                                <option value="">Seleccione...</option>
                                                @foreach($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_type_currency')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="quantity" class="control-label">Cantidad</label>
                                            <input id="quantity" name="quantity" class="form-control"
                                                   type="text" placeholder="0" value="0">
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
                                                    <td>{{ $grupo->type_currency->name }}</td>
                                                    <td>{{ $grupo->quantity }}</td>
                                                    <td>{{ $grupo->time_create }}</td>
                                                    <td>{{ $grupo->user->nombre }}</td>
                                                    <td>
                                                        @if($grupo->user_create == auth()->user()->idusuarios)
                                                            <form method="post"
                                                                  action="{{ route('register-currencies.delete', ['data' => $grupo->id]) }}"
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
        const CurrencyModule = function () {

            const _initChart = function () {

                const nuevos_soles = '#6993FF';
                const dolares = '#1BC5BD';
                const euros = '#0a8016';
                const pesos = '#6e0656';

                let countNuevosSoles = "{{ $dataCount['nuevos_soles'] }}";
                let countDolares = "{{ $dataCount['dolares'] }}";
                let countEuros = "{{ $dataCount['euros'] }}";
                let countPesos = "{{ $dataCount['pesos'] }}";

                const options = {
                    series: [
                        parseFloat(countNuevosSoles),
                        parseFloat(countDolares),
                        parseFloat(countEuros),
                        parseFloat(countPesos),
                    ],
                    chart: {
                        width: 500,
                        type: 'pie',
                    },
                    labels: [
                        'NUEVOS SOLES',
                        'DÓLARES',
                        'EUROS',
                        'PESOS',
                    ],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 1000,
                                height: 1500
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                    colors: [nuevos_soles, dolares, euros, pesos]
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
            CurrencyModule.init();
        })
    </script>
@endpush
