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
                                <h3 class="text-center"> LOGROS DE INTELIGENCIA</h3>
                                <div class="alert alert-danger">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad amet, autem distinctio dolor doloribus eaque eveniet fuga inventore ipsam nulla numquam odio placeat quis quo sequi sit, voluptate voluptatem.</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row w-auto h-auto">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('img/banda_criminal.png') }}" class="card-img-top" alt="...">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">GRUPOS DELICTIVOS ORGANIZADOS</h5>
                                                <a href="{{ route('register-criminal-groups') }}" class="btn btn-primary">Agregar registro</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('img/detenidos.png') }}" class="card-img-top" alt="...">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">PERSONAS</h5>
                                                <a href="{{ route('register-persons') }}" class="btn btn-primary">Agregar registro</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('img/monedas.png') }}" class="card-img-top" alt="...">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">MONEDA NACIONAL Y EXTRANJERA</h5>
                                                <a href="{{ route('register-currencies') }}" class="btn btn-primary">Agregar registro</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('img/drogas.png') }}" class="card-img-top" alt="...">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">DROGAS</h5>
                                                <a href="{{ route('register-drugs') }}" class="btn btn-primary">Agregar registro</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('img/armas_fuego.png') }}" class="card-img-top" alt="...">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">ARMAS DE FUEGO O DE GUERRA INCAUTADAS</h5>
                                                <a href="{{ route('register-firearms') }}" class="btn btn-primary">Agregar registro</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('img/explosivos.png') }}" class="card-img-top" alt="...">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">EXPLOSIVOS</h5>
                                                <a href="{{ route('register-explosives') }}" class="btn btn-primary">Agregar registro</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('img/fuel.png') }}" class="card-img-top" alt="...">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">COMBUSTIBLE</h5>
                                                <a href="{{ route('register-fuels') }}" class="btn btn-primary">Agregar registro</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{ asset('img/otros.png') }}" class="card-img-top" alt="...">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">OTROS</h5>
                                                <a href="{{ route('register-others') }}" class="btn btn-primary">Agregar registro</a>
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
    </div>
</div>
@endsection
@push('js')
  <!--  <script src="{{ mix('js/app.js') }}" defer></script>-->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/form-wizard/form-wizard-two.js') }}"></script>
@endpush
