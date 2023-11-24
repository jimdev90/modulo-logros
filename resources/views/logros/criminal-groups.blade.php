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
                                    <h3 class="text-center">GRUPOS DELICTIVOS ORGANIZADOS</h3>
                                    <div>
                                        <div id="chart_12" class="d-flex justify-content-center"
                                             style="height: 100px"></div>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-outline-dark">
                                            ORGANIZACIONES CRIMINALES <span class="badge bg-secondary">{{ $dataCount['organizacion_criminal'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            BANDA CRIMINAL <span class="badge bg-secondary">{{ $dataCount['banda_criminal'] }}</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('register-criminal-groups.store') }}" method="post"
                                          class="row">
                                        @csrf
                                        <div class="form-group col-6">
                                            <label for="id_type_criminal_group" class="control-label">Tipo</label>
                                            <select name="id_type_criminal_group" id="id_type_criminal_group" class="form-control">
                                                <option value="">Seleccione...</option>
                                                @foreach($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_type_criminal_group')
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
                                                    <td>{{ $grupo->type_criminal_group->name }}</td>
                                                    <td>{{ $grupo->quantity }}</td>
                                                    <td>{{ $grupo->time_create }}</td>
                                                    <td>{{ $grupo->user->nombre }}</td>
                                                    <td>
                                                        @if($grupo->user_create == auth()->user()->idusuarios)
                                                        <form method="post" action="{{ route('register-criminal-groups.delete', ['data' => $grupo->id]) }}" class="form-delete">
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
        const CriminalGroupModule = function () {

            const _initChart = function () {

                const organizacion_criminal = '#6993FF';
                const banda_criminal = '#1BC5BD';
                let countOrganizacionCriminal = "{{ $dataCount['organizacion_criminal'] }}";
                let countBandaCriminal = "{{ $dataCount['banda_criminal'] }}";

                const options = {
                    series: [parseInt(countOrganizacionCriminal), parseInt(countBandaCriminal)],
                    chart: {
                        width: 500,
                        type: 'pie',
                    },
                    labels: ['Organización Criminal', 'Banda Criminal'],
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
                    colors: [organizacion_criminal, banda_criminal]
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
                init: function (){
                    _initChart();
                    _initDatatable();
                }
            }
        }();

        document.addEventListener('DOMContentLoaded', function () {
            CriminalGroupModule.init();
        })
    </script>
@endpush
