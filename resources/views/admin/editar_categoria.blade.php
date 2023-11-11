@extends('adminlte::page')

@section('title', 'Categoria')

@section('content_header')
<h1>Actualizar Categoria</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="card-title"></h5>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="abs-center-registro">
                <form action="{{ route('categoria.update', $categoria->idcategoria) }}" method="POST" style="margin:10px" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="categoria">Categoria <b style="color: red">*</b></label>
                                <input type="text" name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror" value="{{ $categoria->categoria }}">
                                <div class="invalid-feedback" id="categoria-error"></div>
                            </div>
                            <div class="form-group">
                                <label for="imagencat">Imagen:</label>
                                <input type="file" class="form-control @error('imagencat') is-invalid @enderror" id="imagencat" name="imagencat"><br>
                                {{ $categoria->imagencat }}
                                <img src="{{ asset('imgcategorias/' . $categoria->imagencat) }}" alt="{{ $categoria->categoria }}" height="100px" width="100px" class="img-thumbnail">
                                <div class="invalid-feedback" id="imagen-error"></div>
                            </div>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                            <a href="{{ route('categorias') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
        'Buen Trabajo!'
        , 'Tarea exitosa!'
        , 'success'
    )

</script>
<script>
    // Obtenemos el formulario y agregamos un event listener para validar los campos antes de enviar
    const formulario = document.querySelector('form');
    formulario.addEventListener('submit', function(event) {
        // Prevenimos el envío del formulario para poder validar los campos
        event.preventDefault();

        // Validamos los campos del formulario
        let formValid = true;
        formValid = validarCategoria() && formValid;

        // Verificamos si todos los campos son válidos
        if (formValid) {
            formulario.submit();
        } else {
            // Buscamos el primer campo que tenga un error de validación y mostramos el mensaje de error correspondiente
            let invalidField = formulario.querySelector('.is-invalid');
            invalidField.focus();
            mostrarError(invalidField, invalidField.nextElementSibling.innerHTML);
        }
    });



    // Obtenemos los elementos del formulario que necesitamos validar
    const categoria = document.getElementById('categoria');

    // Agregamos event listeners para los campos que queremos validar
    categoria.addEventListener('input', validarCategoria);

    // Funciones de validación para cada campo
    function validarCategoria() {
        if (categoria.value.trim() === '') {
            mostrarError(categoria, 'La categoria es obligatoria.');
        } else {
            mostrarExito(categoria);
        }
    }


    // Función para mostrar un mensaje de error para un campo
    function mostrarError(campo, mensaje) {
        campo.classList.add('is-invalid');
        campo.nextElementSibling.innerHTML = mensaje;
        campo.nextElementSibling.style.display = 'block';
    }

    // Función para mostrar que un campo es válido
    function mostrarExito(campo) {
        campo.classList.remove('is-invalid');
        campo.nextElementSibling.innerHTML = '';
        campo.nextElementSibling.style.display = 'none';
    }

</script>
@stop
