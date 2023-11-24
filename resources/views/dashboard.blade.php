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
                                    <h3 class="text-center">Bienvenido</h3>
                                </div>
                                <div class="card-body">
                                    <h4 class="text-center">{{ auth()->user()->nombre }}</h4>
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
                init: function (){
                }
            }
        }();

        document.addEventListener('DOMContentLoaded', function () {
            DashboardModule.init();
        })
    </script>
@endpush
