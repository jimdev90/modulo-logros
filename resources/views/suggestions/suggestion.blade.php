@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h1>{{ $suggestion->title }}</h1>
                                    <p>
                                        <span class="badge bg-primary">{{ $suggestion->author->nombre }}</span>
                                        <span
                                            class="badge bg-secondary">{{ $suggestion->created_at->format("d/m/Y") }}</span>
                                        <span
                                            class="badge bg-warning">{{ $suggestion->comments_count }} comentarios</span>
                                    </p>
                                </div>
                                <div class="card-body">
                                    <p class="lead">{!! $suggestion->content !!}</p>
                                    <hr>
                                    @include('comments', [
                                          'model' => $suggestion,
                                      ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection
