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
                                    <h3 class="text-center">ARMAS DE FUEGO O DE GUERRA INCAUTADAS (Und.)</h3>
                                    <div>
                                        <div id="chart_12" class="d-flex justify-content-center"
                                             style="height: 100px"></div>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-outline-dark">
                                            PISTOLA <span class="badge bg-secondary">{{ $dataCount['pistola'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            REVOLVER <span
                                                class="badge bg-secondary">{{ $dataCount['revolver'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            FUSILES <span class="badge bg-secondary">{{ $dataCount['fusiles'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            GRANADAS <span
                                                class="badge bg-secondary">{{ $dataCount['granadas'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            CARABINAS <span
                                                class="badge bg-secondary">{{ $dataCount['carabinas'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            CARABINAS R15 <span
                                                class="badge bg-secondary">{{ $dataCount['carabinas_mr15'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            ARMAS ARTESANALES <span
                                                class="badge bg-secondary">{{ $dataCount['armas_artesanales'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-dark">
                                            MUNICIÓN INCAUTADA (Und.) <span
                                                class="badge bg-secondary">{{ $dataCount['municion_incautada'] }}</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('register-firearms.store') }}" method="post"
                                          class="row">
                                        @csrf
                                        <div class="form-group col-6">
                                            <label for="id_type_firearm" class="control-label">Tipo</label>
                                            <select name="id_type_firearm" id="id_type_firearm" class="form-control">
                                                <option value="">Seleccione...</option>
                                                @foreach($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_type_firearm')
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
                                                    <td>{{ $grupo->type_firearm->name }}</td>
                                                    <td>{{ $grupo->quantity }}</td>
                                                    <td>{{ $grupo->time_create }}</td>
                                                    <td>{{ $grupo->user->nombre }}</td>
                                                    <td>
                                                        @if($grupo->user_create == auth()->user()->idusuarios)
                                                            <form method="post"
                                                                  action="{{ route('register-firearms.delete', ['data' => $grupo->id]) }}"
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
        const FirearmsModule = function () {

            const _initChart = function () {

                const pistola = '#6993FF';
                const revolver = '#1BC5BD';
                const fusiles = '#c51b6d';
                const granadas = '#56c51b';
                const carabinas = '#c5921b';
                const carabinas_mr15 = '#013f0e';
                const armas_artesanales = '#8e2306';
                const municion_incautada = '#e2a237';

                let countPista = "{{ $dataCount['pistola'] }}";
                let countRevolver = "{{ $dataCount['revolver'] }}";
                let countFusiles = "{{ $dataCount['fusiles'] }}";
                let countGranadas = "{{ $dataCount['granadas'] }}";
                let countCarabinas = "{{ $dataCount['carabinas'] }}";
                let countCarabinasMR15 = "{{ $dataCount['carabinas_mr15'] }}";
                let countArmasArtesanales = "{{ $dataCount['armas_artesanales'] }}";
                let countMunicionEncautada = "{{ $dataCount['municion_incautada'] }}";

                const options = {
                    series: [
                        parseInt(countPista),
                        parseInt(countRevolver),
                        parseInt(countFusiles),
                        parseInt(countGranadas),
                        parseInt(countCarabinas),
                        parseInt(countCarabinasMR15),
                        parseInt(countArmasArtesanales),
                        parseInt(countMunicionEncautada),
                    ],
                    chart: {
                        width: 500,
                        type: 'pie',
                    },
                    labels: [
                        'Pistola',
                        'Revolver',
                        'Fusiles',
                        'Granadas',
                        'Carabinas',
                        'Carabinas R15',
                        'Armas Artesanales',
                        'Munición Incautada (Und.)',
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
                        pistola,
                        revolver,
                        fusiles,
                        granadas,
                        carabinas,
                        carabinas_mr15,
                        armas_artesanales,
                        municion_incautada,
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
            FirearmsModule.init();
        })
    </script>
@endpush
