@extends('layouts.app')
@section('title')
    Iniciar sesión
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header font-weight-bold text-3xl  text-center">
                        <h4>Iniciar Sesión</h4>
                    </div>
                    <div class="card-body rounded-5">
                        <form action="{{ route('loginAuth') }}" method="POST" novalidate>
                            @csrf

                            <div class="mb-3 font-weight-bold text-3xl ">
                                <label for="correo" class="form-label">Correo electrónico</label>
                                <input type="email" placeholder="nombre@ejemplo.com" id="email" name="email" class="form-control">
                                @error('email')
                                    <div class="my-2 alert alert-danger alert-dismissible fade show p-2" role="alert">
                                        <p>{{ $message }}</p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 font-weight-bold text-3xl ">
                                <label for="contraseña" class="form-label">Contraseña</label>
                                <input type="password" placeholder="Ingrese su contraseña" id="password" name="password" class="form-control">
                                @error('password')
                                    <div class="my-2 alert alert-danger alert-dismissible fade show p-2" role="alert">
                                        <p>{{ $message }}</p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                                    </div>
                                @enderror
                            </div>

                            @if (session('message'))
                                <div class="my-2 alert alert-danger alert-dismissible fade show p-2" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                                </div>
                            @endif

                            <div class= "text-center rounded-5">
                                <button type="submit" class="formButton btn btn-primary" >Iniciar Sesión</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
