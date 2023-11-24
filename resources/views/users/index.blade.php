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
                                    <h3 class="text-center">HABILITAR USUARIOS</h3>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <form action="">
                                            <div class="form-group">
                                                <label for="cip">Nro. CIP</label>
                                                <input type="text" class="form-control" id="cip">
                                            </div>
                                            <div class="form-group">
                                               <button id="btn-search-person" class="btn btn-success">Consultar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="mt-5">
                                        <h2 class="text-center">Resultados de la consulta</h2>
                                        <form action="{{ route('users.store') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Nombres Completos</label>
                                                <input type="text" class="form-control" id="name" name="name" readonly>
                                                @error('name')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="idusuarios">Nro. CIP</label>
                                                <input type="text" class="form-control" id="idusuarios" name="idusuarios" readonly>
                                                @error('idusuarios')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="id_unidad">Unidad</label>
                                                <select name="id_unidad" id="id_unidad" class="form-control">
                                                    <option value="">Seleccione...</option>
                                                    @foreach($unidades as $unidad)
                                                        <option value="{{ $unidad->id }}">
                                                            {{ $unidad->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('id_unidad')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-3">
                                                <button class="btn btn-outline-success w-100">Habilitar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="mt-5">
                                        <h2 class="text-center">Bandeja de Usuarios</h2>
                                    </div>
                                    <table class="table" id="datatable">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombres</th>
                                            <th scope="col">Cip</th>
                                            <th scope="col">Unidad</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i =1;
                                        @endphp
                                        @forelse($users as $user)
                                            <tr>
                                                <th scope="row">{{ $i++ }}</th>
                                                <td>{{ $user->user->nombre }}</td>
                                                <td>{{ $user->idusuarios }}</td>
                                                <td>{{ $user->unidad->name }}</td>
                                                <td>
                                                    @if($user->state === 'active')
                                                        <form method="post" action="{{ route('users.inactive', ['user' => $user->id]) }}" class="form-inactive">
                                                            @csrf
                                                            @method('PUT')
                                                            <button class="btn btn-sm btn-danger">Desactivar</button>
                                                        </form>

                                                    @else
                                                        <form method="post" action="{{ route('users.active', ['user' => $user->id]) }}" class="form-active">
                                                            @csrf
                                                            @method('PUT')
                                                            <button class="btn btn-sm btn-success">Activar</button>
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
@endsection
@push('js')
    <script>
        'use strict';
        const HOST_URL = "{{ config('app.url') }}"
        const ModuleUsers = function () {

            const _inputCip = $('#cip');
            const _inputName = $('#name');
            const _inputIdusuarios = $('#idusuarios');
            const _btnSearchPerson = $('#btn-search-person');

            _btnSearchPerson.on('click', async function (e) {
                e.preventDefault();
                const cip = _inputCip.val();
                _btnSearchPerson.text('Consultando...')
                _btnSearchPerson.attr('disabled', true);
                try {

                    const res = await _searchUser(cip);
                    const data = res.data.data;
                    let {idusuarios, nombre} = data
                    _inputName.val(nombre);
                    _inputIdusuarios.val(idusuarios);
                    _inputCip.val('');
                    _btnSearchPerson.text('Consultar')
                    _btnSearchPerson.attr('disabled', false);
                }catch (e) {
                    console.table(e.response.data)
                    const data = e.response.data
                    let error = ''
                    if (data.errors){
                        if(data.errors.cip) error = data.errors.cip[0]
                        Swal.fire({
                            title: "Lo sentimos!!",
                            text: `${error}`,
                            icon: "warning",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Ok!",
                        })
                        _btnSearchPerson.text('Consultar')
                        _btnSearchPerson.attr('disabled', false);
                    }else {
                        Swal.fire({
                            title: "Lo sentimos!!",
                            text: `${data.message}`,
                            icon: "warning",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Ok!",
                        })
                        _btnSearchPerson.text('Consultar')
                        _btnSearchPerson.attr('disabled', false);
                    }
                }
            })

            const _searchUser = async function (cip) {
                return await window.axios.post(`${HOST_URL}/users/search`, {
                    cip: cip
                })
            }

            const _initDatatable = function () {
                let table = new DataTable('#datatable');
                table.on('click', 'form.form-inactive', function (e) {
                    e.preventDefault()
                    const form = $(this);
                    console.log(form)
                    Swal.fire({
                        title: "¿Desea desactivar al usuario?",
                        text: "Al desactivar el usuario, no podrá acceder a este modulo. ¿Desea continuar?",
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

                table.on('click', 'form.form-active', function (e) {
                    e.preventDefault()
                    const form = $(this);
                    console.log(form)
                    Swal.fire({
                        title: "¿Desea activar al usuario?",
                        text: "Al inhabilitar el usuario, no podrá acceder a este modulo. ¿Desea continuar?",
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
                init : function (){
                    _initDatatable()
                }
            }
        }();
        document.addEventListener('DOMContentLoaded', function() {
            ModuleUsers.init();
        });

    </script>
@endpush
