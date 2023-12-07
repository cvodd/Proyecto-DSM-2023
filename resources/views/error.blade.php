@extends('layouts.app')
@section('title')
    Error
@endsection
@section('content')

    <div class="container">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Error!</h4>
            <p>{{ $message }}</p>
        </div>
    </div>
@endsection
