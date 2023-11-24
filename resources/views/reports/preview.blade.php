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
                                    <h3 class="text-center">Vista Previa de Reporte</h3>
                                    <div class="text-center">
                                        <h4>Unidad: {{ $unidad->name }}</h4>
                                        <h5>Fecha: {{ $date }}</h5>
                                        <form action="{{ route('report.export') }}" method="post" >
                                            @csrf
                                            <button class="btn btn-outline-info">Descargar</button>
                                        </form>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">GRUPOS DELICTIVOS ORGANIZADOS</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Detalle</h6>
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
                                                    $orgCriminalCount = 0;
                                                    $bandaCriminalCount = 0;
                                                @endphp

                                                @forelse($criminalGroups as $criminalGroup)
                                                    @php
                                                        if ($criminalGroup->id_type_criminal_group == 1){
                                                            $orgCriminalCount += $criminalGroup->quantity;
                                                        }elseif ($criminalGroup->id_type_criminal_group == 2){
                                                            $bandaCriminalCount += $criminalGroup->quantity;
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $criminalGroup->type_criminal_group->name }}</td>
                                                        <td>{{ $criminalGroup->quantity }}</td>
                                                        <td>{{ $criminalGroup->time_create }}</td>
                                                        <td>{{ $criminalGroup->user->nombre }}</td>
                                                        <td>
                                                            <form method="post"
                                                                  action="{{ route('register-criminal-groups.delete', ['data' => $criminalGroup->id]) }}"
                                                                  class="form-delete">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger">
                                                                    Eliminar
                                                                </button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>ORGANIZACIÓN CRIMINAL</th>
                                                        <th colspan="2">{{ $dataCountCriminalGroups["organizacion_criminal"] }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>BANDA CRIMINAL</th>
                                                        <th colspan="2">{{ $dataCountCriminalGroups["banda_criminal"] }}</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <h5 class="card-title">PERSONAS</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Detalle</h6>
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
                                                @forelse($persons as $person)
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $person->type_person->name }}</td>
                                                        <td>{{ $person->quantity }}</td>
                                                        <td>{{ $person->time_create }}</td>
                                                        <td>{{ $person->user->nombre }}</td>
                                                        <td>
                                                            <form method="post"
                                                                  action="{{ route('register-persons.delete', ['data' => $person->id]) }}"
                                                                  class="form-delete">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger">
                                                                    Eliminar
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>DETENIDOS EXTRANJEROS</th>
                                                    <th colspan="2">{{ $dataCountPersons["detenidos_extranjero"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>DETENIDOS NACIONALES</th>
                                                    <th colspan="2">{{ $dataCountPersons["detenidos_nacional"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>DETENIDOS (TERRORISMO)</th>
                                                    <th colspan="2">{{ $dataCountPersons["detenidos_terrorismo"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>DETENIDOS (TID)</th>
                                                    <th colspan="2">{{ $dataCountPersons["detenidos_tid"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>CAPTURADOS POR REQUISITORIA (RQ)</th>
                                                    <th colspan="2">{{ $dataCountPersons["capturas_rq"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>MENORES RETENIDOS</th>
                                                    <th colspan="2">{{ $dataCountPersons["menores_retenidos"] }}</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <h5 class="card-title">COMBUSTIBLE</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Detalle</h6>
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
                                                @forelse($fuels as $fuel)
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $fuel->type_fuel->name }}</td>
                                                        <td>{{ $fuel->quantity }}</td>
                                                        <td>{{ $fuel->time_create }}</td>
                                                        <td>{{ $fuel->user->nombre }}</td>
                                                        <td>

                                                            <form method="post"
                                                                  action="{{ route('register-fuels.delete', ['data' => $fuel->id]) }}"
                                                                  class="form-delete">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger">
                                                                    Eliminar
                                                                </button>
                                                            </form>


                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>PETROLEO</th>
                                                    <th colspan="2">{{ $dataCountFuels["petroleo"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>GASOLINA</th>
                                                    <th colspan="2">{{ $dataCountFuels["gasolina"] }}</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <h5 class="card-title">MONEDA NACIONAL Y EXTRANJERA</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Detalle</h6>
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
                                                @forelse($currencies as $currency)
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $currency->type_currency->name }}</td>
                                                        <td>{{ $currency->quantity }}</td>
                                                        <td>{{ $currency->time_create }}</td>
                                                        <td>{{ $currency->user->nombre }}</td>
                                                        <td>

                                                            <form method="post"
                                                                  action="{{ route('register-currencies.delete', ['data' => $currency->id]) }}"
                                                                  class="form-delete">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger">
                                                                    Eliminar
                                                                </button>
                                                            </form>


                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>SOLES</th>
                                                    <th colspan="2">{{ $dataCountCurrencies["nuevos_soles"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>DÓLARES</th>
                                                    <th colspan="2">{{ $dataCountCurrencies["dolares"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>EUROS</th>
                                                    <th colspan="2">{{ $dataCountCurrencies["euros"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>PESOS</th>
                                                    <th colspan="2">{{ $dataCountCurrencies["pesos"] }}</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <h5 class="card-title">ARMAS DE FUEGO O DE GUERRA INCAUTADAS</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Detalle</h6>
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
                                                @forelse($firearms as $firearm)
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $firearm->type_firearm->name }}</td>
                                                        <td>{{ $firearm->quantity }}</td>
                                                        <td>{{ $firearm->time_create }}</td>
                                                        <td>{{ $firearm->user->nombre }}</td>
                                                        <td>
                                                            <form method="post"
                                                                  action="{{ route('register-firearms.delete', ['data' => $firearm->id]) }}"
                                                                  class="form-delete">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger">
                                                                    Eliminar
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>SOLES</th>
                                                    <th colspan="2">{{ $dataCountFireArms["pistola"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>REVOLVER</th>
                                                    <th colspan="2">{{ $dataCountFireArms["revolver"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>FUSILES</th>
                                                    <th colspan="2">{{ $dataCountFireArms["fusiles"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>GRANADAS</th>
                                                    <th colspan="2">{{ $dataCountFireArms["granadas"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>CARABINAS</th>
                                                    <th colspan="2">{{ $dataCountFireArms["carabinas"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>CARABINAS R15</th>
                                                    <th colspan="2">{{ $dataCountFireArms["carabinas_mr15"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>ARMAS ARTESANALES</th>
                                                    <th colspan="2">{{ $dataCountFireArms["armas_artesanales"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>MUNICION INCAUTADA</th>
                                                    <th colspan="2">{{ $dataCountFireArms["municion_incautada"] }}</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <h5 class="card-title">EXPLOSIVOS</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Detalle</h6>
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
                                                @forelse($explosives as $explosive)
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $explosive->type_explosive->name }}</td>
                                                        <td>{{ $explosive->quantity }}</td>
                                                        <td>{{ $explosive->time_create }}</td>
                                                        <td>{{ $explosive->user->nombre }}</td>
                                                        <td>
                                                            <form method="post"
                                                                  action="{{ route('register-explosives.delete', ['data' => $explosive->id]) }}"
                                                                  class="form-delete">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger">
                                                                    Eliminar
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>DINAMITA</th>
                                                    <th colspan="2">{{ $dataCountExplosives["dinamita"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>ARTEFACTOS PIROTÉCNICOS</th>
                                                    <th colspan="2">{{ $dataCountExplosives["artefacto_pirotecnico"] }}</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <h5 class="card-title">OTROS</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Detalle</h6>
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
                                                @forelse($others as $other)
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $other->type_other->name }}</td>
                                                        <td>{{ $other->quantity }}</td>
                                                        <td>{{ $other->time_create }}</td>
                                                        <td>{{ $other->user->nombre }}</td>
                                                        <td>

                                                            <form method="post"
                                                                  action="{{ route('register-others.delete', ['data' => $other->id]) }}"
                                                                  class="form-delete">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger">
                                                                    Eliminar
                                                                </button>
                                                            </form>


                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>BIENES MUEBLES INCAUTADOS</th>
                                                    <th colspan="2">{{ $dataCountOthers["bienes_muebles_incautados"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>BIENES INMUEBLES INCAUTADOS</th>
                                                    <th colspan="2">{{ $dataCountOthers["bienes_inmuebles_incautados"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>MADERA</th>
                                                    <th colspan="2">{{ $dataCountOthers["madera"] }}</th>
                                                </tr>
                                                <tr>
                                                    <th>MERCADERIA DE CONTRABANDO</th>
                                                    <th colspan="2">{{ $dataCountOthers["mercaderia_contrabando"] }}</th>
                                                </tr>
                                                </tfoot>
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
