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
                                    <h3 class="text-center">DROGAS</h3>
                                    <div>
                                        <div id="chart_12" class="d-flex justify-content-center"
                                             style="height: 100px"></div>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-outline-dark">
                                            CLORHIDRATO CC. (Kg.) <span
                                                class="badge bg-secondary"></span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            PBC (Kg.) <span class="badge bg-secondary"></span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            MARIHUANA (Kg.) <span
                                                class="badge bg-secondary"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('register-drugs.store') }}" method="post"
                                          class="row">
                                        @csrf
                                        <div class="col-7">
                                            <div class="form-group">
                                                <label for="id_type_drug" class="control-label">Tipo</label>
                                                <select name="id_type_drug" id="id_type_drug" class="form-control">
                                                    <option value="">Seleccione...</option>
                                                    @foreach($types as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_type_drug')
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="ton" class="control-label">Toneladas</label>
                                                <input id="ton" name="ton" class="form-control"
                                                       type="text" placeholder="0" value="0">
                                                @error('ton')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kilogram" class="control-label">Kilogramos</label>
                                                <input id="kilogram" name="kilogram" class="form-control"
                                                       type="text" placeholder="0" value="0">
                                                @error('kilogram')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="gram" class="control-label">Gramos</label>
                                                <input id="gram" name="gram" class="form-control"
                                                       type="text" placeholder="0" value="0">
                                                @error('gram')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
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
                                                <th scope="col">Toneladas</th>
                                                <th scope="col">Kilos</th>
                                                <th scope="col">Gramos</th>
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
                                                    <td>{{ $grupo->type_drug->name }}</td>
                                                    <td>{{ $grupo->ton }}</td>
                                                    <td>{{ $grupo->kilogram }}</td>
                                                    <td>{{ $grupo->gram }}</td>
                                                    <td>{{ $grupo->time_create }}</td>
                                                    <td>{{ $grupo->user->nombre }}</td>
                                                    <td>
                                                        @if($grupo->user_create == auth()->user()->idusuarios)
                                                            <form method="post"
                                                                  action="{{ route('register-drugs.delete', ['data' => $grupo->id]) }}"
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
        const DrugsModule = function () {

            const _initChart = function () {

                const clorhidrato = '#6993FF';
                const pbc = '#0a8329';
                const marihuana = '#1BC5BD';
                let countClorhidrato = "";
                let countPBC = "";
                let countMarihuana = "";

                const options = {
                    series: [
                        parseFloat(countClorhidrato),
                        parseFloat(countPBC),
                        parseFloat(countMarihuana),
                    ],
                    chart: {
                        width: 500,
                        type: 'pie',
                    },
                    labels: [
                        'CLORHIDRATO CC. (Kg.)',
                        'PBC (Kg.)',
                        'MARIHUANA  (Kg.)',
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
                    colors: [clorhidrato, pbc, marihuana]
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
            DrugsModule.init();
        })
    </script>
@endpush
