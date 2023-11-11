@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<h1>Usuarios</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Contraseña</th>
                        {{-- <th scope="col">Acciones</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usurarios as $usuario )
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ str_repeat("*", strlen($usuario->password)) }}</td>
                        {{-- <td>
                            <a class="btn btn-success btn-block btn-sm" href="#">Editar</a>
                            <a class="btn btn-danger btn-block btn-sm" href="#">Eliminar</a>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    Swal.fire(
            'Buen Trabajo!',
            'Tarea exitosa!',
            'success'
        )
</script>
@stop
