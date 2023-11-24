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
                                    <h5> LOGROS DE INTELIGENCIA</h5>
                                </div>
                                <div class="card-body">
                                    <div class="stepwizard">
                                        <div class="stepwizard-row setup-panel">
                                            <div class="stepwizard-step"><a class="btn btn-primary" href="#step-1">1</a>
                                                <p>PERSONAS / OTROS</p>
                                            </div>
                                            <div class="stepwizard-step"><a class="btn btn-light" href="#step-2">2</a>
                                                <p>MONEDA EXTRANJERA INCAUTADA ($, Etc)</p>
                                            </div>
                                            <div class="stepwizard-step"><a class="btn btn-light" href="#step-3">3</a>
                                                <p>ARMAS DE FUEGO INCAUTADAS (Und.)</p>
                                            </div>

                                        </div>
                                    </div>
                                    <form action="" method="POST"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="setup-content" id="step-1">
                                            <div class="col-xs-12">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">ORGANIZACIONES CRIMINALES</label>
                                                        <input id="organizacionescriminales" name="organizacionescriminales" class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">BANDAS DESARTICULADAS</label>
                                                        <input id="bandasdesarticuladas" name="bandasdesarticuladas"  class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">DETENIDOS (TERRORISMO)</label>
                                                        <input id="detenidosterrorismo" name="detenidosterrorismo"  class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">DETENIDOS (TID)</label>
                                                        <input id="detenidostid" name="detenidostid" class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">DETENIDOS NACIONALES</label>
                                                        <input id="detenidosnacional" name="detenidosnacional" class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">DETENIDOS EXTRANJEROS</label>
                                                        <input id="detenidosextranjeros" name="detenidosextranjeros" class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">CAPTURADOS  POR  REQUISITORIA  (RQ)</label>
                                                        <input id="capturadosrq" name="capturadosrq" class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">MENORES RETENIDOS</label>
                                                        <input id="menoresretenidos" name="menoresretenidos" class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">BIENES MUEBLES INCAUTADOS (Und)</label>
                                                        <input id="mueblesincautados" name="mueblesincautados" class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">MADERA (PIES TABLARES)</label>
                                                        <input id="madera" name="madera" class="form-control" type="number" placeholder="0.00" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">MONEDA NACIONAL INCAUTADA (S/.)</label>
                                                        <input id="monedanacional" name="monedanacional" class="form-control" type="number" placeholder="0.00" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">MERCADERIA DE CONTRABANDO (Valor Comercial S/.)</label>
                                                        <input id="mercaderia" name="mercaderia" class="form-control" type="number" placeholder="0.00" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">COMBUSTIBLE (galones)</label>
                                                        <input id="combustible" name="combustible" class="form-control" type="number" placeholder="0.00" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">CLORHIDRATO CC. (Kg.)</label>
                                                        <input id="clorhidrato" name="clorhidrato" class="form-control" type="number" placeholder="0.00" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">PBC (Kg.)</label>
                                                        <input id="pbc" name="pbc" class="form-control" type="number" placeholder="0.00" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">MARIHUANA  (Kg.)</label>
                                                        <input id="marihuana" name="marihuana" class="form-control" type="number" placeholder="0.00" >
                                                    </div>
                                                    <button class="btn btn-primary nextBtn pull-right" type="button">Siguiente</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="setup-content" id="step-2">
                                            <div class="col-xs-12">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Tipo de moneda Extranjera</label>
                                                        <input id="monedaextranjera" name="monedaextranjera" class="form-control" type="text" placeholder="soles" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Monto</label>
                                                        <input id="montomonedaextranjera" name="montomonedaextranjera" class="form-control" type="number" placeholder="0.00" >
                                                    </div>
                                                    <button class="btn btn-primary nextBtn pull-right" type="button">Siguiente</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="setup-content" id="step-3">
                                            <div class="col-xs-12">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">PISTOLA</label>
                                                        <input id="pistola" name="pistola" class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">REVOLVER</label>
                                                        <input id="revolver" name="revolver" class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">FUSILES</label>
                                                        <input id="fusiles" name="fusiles" class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">CARABINAS</label>
                                                        <input id="carabinas" name="carabinas" class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">CARABINAS R15</label>
                                                        <input id="carabinasr15" name="carabinasr15" class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">ARMAS ARTESANALES</label>
                                                        <input id="armasartesanales" name="armasartesanales" class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">MUNICION INCAUTADA (Und.)</label>
                                                        <input id="municionincautada" name="municionincautada" class="form-control" type="number" placeholder="0" >
                                                    </div>
                                                    <button class="btn btn-secondary pull-right" type="submit">Finalizar!</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
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
