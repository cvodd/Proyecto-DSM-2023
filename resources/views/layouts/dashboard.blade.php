@extends('layouts.app')
@section('title')
    Menu
@endsection
@section('content')

// There will be a box with the number of posts. The box is in blue color.
// There will be a box with the number of users inhabilitated by the admin. The box is in red color.
// The will be a box with the post with the most likes and comments. This is the most popular post of the App.

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
                        @if ($mostPopularPost)
                            <p class="card-text">{{ $mostPopularPost->title }}</p>
                            <p class="card-text">Likes: {{ $mostPopularPost->likesCount }}</p>
                            <p class="card-text">Comentarios: {{ $mostPopularPost->comments }}</p>
                        @else
                            <p class="card-text">No hay publicaciones disponibles.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>



    </div>



@endsection
