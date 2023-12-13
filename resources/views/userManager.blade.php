@extends('layouts.app')
@section('title')
    Administrar usuarios
@endsection
@section('content')
    <div class="container ">
        <div class="text-center mb-4 rounded customWhite">
            <h1>Administración de usuarios</h1>
        </div>
        <form action="{{ route('admin.searchUser') }}" method="GET" novalidate class="mb-4">
            @csrf
            <div class="d-flex justify-content-center">
                <input type="text" name="search" class="form-control w-25" placeholder="Ingrese nombre y/o apellido...">
                <button type="submit" class="btn btn-primary col-auto ms-4 ">Buscar usuario</button>
                <a href="{{ route('admin') }}" class="btn btn-secondary col-auto ms-4">Refrescar</a>
            </div>
        </form>

        @if (session('message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @if($users->isEmpty())
            <p>No se encontraron usuarios.</p>
        @else
            <table id="userTable" class="table mt-3">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Nombre de usuario</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="userTable">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->lastName }}</td>
                            <td>{{ $user->userName }}</td>
                            <td>{{ $user->email }}</td>

                            @if ($user->status == 'active')
                                <td>Habilitado</td>
                            @else
                                <td>Deshabilitado</td>
                            @endif

                            <td>
                                <form action="{{ route('admin.update', ['id' => $user->id] ) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    @if ($user->status == 'active')
                                        <button type="submit" class="btn btn-danger">Deshabilitar</button>
                                    @else
                                        <button type="submit" class="btn btn-success">Habilitar</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="d-flex justify-content-center">
                {!! $users->links('vendor.pagination.custom') !!}
            </div>
        @endif

    </div>
@endsection
