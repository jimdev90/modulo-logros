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
                                            <input type="hidden" name="date" value="{{ $date }}" >
                                            <input type="hidden" name="date_next" value="{{ $dateNext }}" >
                                            <input type="hidden" name="id_unidad" value="{{ $id_unidad }}" >
                                            <button class="btn btn-outline-info">Descargar</button>
                                        </form>

                                    </div>
                                </div>
                                <div class="card-body">
                                    {{--GRUPOS DELICTIVOS ORGANIZADOS--}}
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
                                                @endphp

                                                @forelse($criminalGroups as $criminalGroup)
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
                                                    @foreach($dataCountCriminalGroups as $dcg)
                                                        <tr>
                                                            <th>{{ $dcg->category }}</th>
                                                            <th>TOTAL : {{ $dcg->total }}</th>
                                                        </tr>
                                                    @endforeach
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    {{--PERSONAS--}}
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
                                                @foreach($dataCountPersons as $dcp)
                                                    <tr>
                                                        <th>{{ $dcp->category }}</th>
                                                        <th>TOTAL : {{ $dcp->total }}</th>
                                                    </tr>
                                                @endforeach
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    {{--COMBUSTIBLE--}}
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
                                                @foreach($dataCountFuels as $dcf)
                                                    <tr>
                                                        <th>{{ $dcf->category }}</th>
                                                        <th>TOTAL : {{ $dcf->total }}</th>
                                                    </tr>
                                                @endforeach
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    {{--MONEDA NACIONAL Y EXTRANJERA--}}
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
                                                @foreach($dataCountCurrencies as $dcc)
                                                    <tr>
                                                        <th>{{ $dcc->category }}</th>
                                                        <th>TOTAL : {{ $dcc->total }}</th>
                                                    </tr>
                                                @endforeach
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    {{--ARMAS DE FUEGO O DE GUERRA INCAUTADAS--}}
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
                                                @foreach($dataCountFireArms as $dcfa)
                                                    <tr>
                                                        <th>{{ $dcfa->category }}</th>
                                                        <th>TOTAL : {{ $dcfa->total }}</th>
                                                    </tr>
                                                @endforeach
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    {{--EXPLOSIVOS--}}
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
                                                @foreach($dataCountExplosives as $dce)
                                                    <tr>
                                                        <th>{{ $dce->category }}</th>
                                                        <th>TOTAL : {{ $dce->total }}</th>
                                                    </tr>
                                                @endforeach
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    {{--OTROS--}}
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
                                                @foreach($dataCountOthers as $dco)
                                                    <tr>
                                                        <th>{{ $dco->category }}</th>
                                                        <th>TOTAL : {{ $dco->total }}</th>
                                                    </tr>
                                                @endforeach
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
