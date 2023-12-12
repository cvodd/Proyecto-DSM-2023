@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3  ">
                <div class="card text-center text-bg-primary">
                    <div class="card-body">
                        <p class="card-title"> {{ $numberOfPosts }}</p>
                        <h3 class="card-text">Número de Posts</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-3  ">
                <div class="card text-center text-bg-success">
                    <div class="card-body">
                        <p class="card-title"> {{ $numberOfActiveUsers }}</p>
                        <h3 class="card-text">Número de usuarios habilitados</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-3  ">
                <div class="card text-center text-bg-danger">
                    <div class="card-body">
                        <p class="card-title"> {{ $numberOfDisabledUsers }}</p>
                        <h3 class="card-text">Número de usuarios deshabilitados</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 ">
                <div class="card text-center text-bg-light">
                    <div class="card-body">
                        <h3 class="card-title">Publicación con mayor repercusión en la red social</h3>
                        <hr>
                        @if ($mostPopularPost)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postModal">
                                {{ $mostPopularPost->title }}
                            </button>

                            <div class="modal fade" id = "postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id = "postModalLabel">Detalles de la publicación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" id = "postModalBody">
                                            <p>{{ $mostPopularPost->title }}</p>
                                            <p>{{ $mostPopularPost->user->name }}</p>
                                            <p>Descripción: {{ $mostPopularPost->description }}</p>
                                            <p >Likes: {{ $mostPopularPost->likesCount }}</p>
                                            <p >Comentarios: {{ $mostPopularPost->comments }}</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="card-text">No hay publicaciones disponibles.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
