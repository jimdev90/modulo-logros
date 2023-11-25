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
                                    <h3 class="text-center">Vista Previa General de Reporte</h3>
                                    <div class="text-center">
                                        <h4>El siguiente reporte corresponde a todas las unidades del SIDPOL</h4>
                                        <h5>Fecha: {{ $date }}</h5>
                                        <form action="{{ route('report.export-general') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="date" value="{{ $date }}">
                                            <input type="hidden" name="date_next" value="{{ $dateNext }}">
                                            <input type="hidden" name="unidades[]" value="{{ $unidadesRegistroArrayValue }}">
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
                                            <table class="table" id="datatable_criminal_groups">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Hora</th>
                                                    <th scope="col">Unidad</th>
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
                                                        <td>{{ $criminalGroup->unidad->name }}</td>
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
{{--                                                            <a href="{{ route('edit-item-criminal-group', ['data' => $criminalGroup->id]) }}" class="btn btn-outline-warning">Editar</a>--}}

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
                                    {{--DROGAS--}}
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">DROGAS</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Detalle</h6>
                                            <table class="table" id="datatable_drugs">
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
                                                @forelse($drugs as $drug)
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $drug->type_drug->name }}</td>
                                                        <td>{{ $drug->ton }}</td>
                                                        <td>{{ $drug->kilogram }}</td>
                                                        <td>{{ $drug->gram }}</td>
                                                        <td>{{ $drug->time_create }}</td>
                                                        <td>{{ $drug->user->nombre }}</td>
                                                        <td>
                                                            <form method="post"
                                                                  action="{{ route('register-drugs.delete', ['data' => $drug->id]) }}"
                                                                  class="form-delete">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger">
                                                                    Eliminar
                                                                </button>
                                                            </form>
{{--                                                            <a href="{{ route('edit-item-drug', ['data' => $drug->id]) }}" class="btn btn-outline-warning">Editar</a>--}}
                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse
                                                </tbody>
                                                <tfoot>
                                                @foreach($dataCountDrug as $dcd)
                                                    <tr>
                                                        <th>{{ $dcd->category }}</th>
                                                        <th>
                                                            <p>TOTAL TONELADAS : {{ $dcd->totalTon }}</p>
                                                            <p>TOTAL KILOGRAMOS : {{ $dcd->totalKilogram }}</p>
                                                            <p>TOTAL GRAMOS : {{ $dcd->totalGram }}</p>
                                                        </th>
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
                                            <table class="table" id="datatable_persons">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Hora</th>
                                                    <th scope="col">Unidad</th>
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
                                                        <td>{{ $person->unidad->name }}</td>
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
{{--                                                            <a href="{{ route('edit-item-person', ['data' => $person->id]) }}" class="btn btn-outline-warning">Editar</a>--}}
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
                                            <table class="table" id="datatable_fuels">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Hora</th>
                                                    <th scope="col">Unidad</th>
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
                                                        <td>{{ $fuel->unidad->name }}</td>
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
{{--                                                            <a href="{{ route('edit-item-fuel', ['data' => $fuel->id]) }}" class="btn btn-outline-warning">Editar</a>--}}

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
                                            <table class="table" id="datatable_currencies">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Hora</th>
                                                    <th scope="col">Unidad</th>
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
                                                        <td>{{ $currency->unidad->name }}</td>
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
                                            <table class="table" id="datatable_firearms">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Hora</th>
                                                    <th scope="col">Unidad</th>
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
                                                        <td>{{ $firearm->unidad->name }}</td>
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
                                            <table class="table" id="datatable_explosives">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Hora</th>
                                                    <th scope="col">Unidad</th>
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
                                                        <td>{{ $explosive->unidad->name }}</td>
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
                                            <table class="table" id="datatable_others">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Hora</th>
                                                    <th scope="col">Unidad</th>
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
                                                        <td>{{ $other->unidad->name }}</td>
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

            const _initDatatableCriminalGroup = function () {
                let table = new DataTable('#datatable_criminal_groups');
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

            const _initDatatableDrugs = function () {
                let table = new DataTable('#datatable_drugs');
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

            const _initDatatablePersons = function () {
                let table = new DataTable('#datatable_persons');
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

            const _initDatatableFuels = function () {
                let table = new DataTable('#datatable_fuels');
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

            const _initDatatableCurrencies = function () {
                let table = new DataTable('#datatable_currencies');
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

            const _initDatatableFireArms = function () {
                let table = new DataTable('#datatable_firearms');
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

            const _initDatatableExplosives = function () {
                let table = new DataTable('#datatable_explosives');
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

            const _initDatatableOthers = function () {
                let table = new DataTable('#datatable_others');
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
                    _initDatatableCriminalGroup();
                    _initDatatableDrugs();
                    _initDatatablePersons();
                    _initDatatableFuels();
                    _initDatatableCurrencies();
                    _initDatatableFireArms();
                    _initDatatableExplosives();
                    _initDatatableOthers();
                }
            }
        }();

        document.addEventListener('DOMContentLoaded', function () {
            DashboardModule.init();
        })
    </script>
@endpush
