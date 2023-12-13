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
                            @if (session('message'))
                                <div class=" my-2 rounded-lg text-lg p-2">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <div class="mb-3 font-weight-bold text-3xl ">
                                <label for="correo" class="form-label">Correo electrónico</label>
                                <input type="email" placeholder="nombre@ejemplo.com" id="email" name="email" class="form-control">
                                @error('email')
                                    <p class="my-2 rounded-lg text-lg p-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 font-weight-bold text-3xl ">
                                <label for="contraseña" class="form-label">Contraseña</label>
                                <input type="password" placeholder="Ingrese su contraseña" id="password" name="password" class="form-control">
                                @error('password')
                                    <p class="textRed my-2 rounded-lg text-lg p-2">{{ $message }}</p>
                                @enderror
                            </div>

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
