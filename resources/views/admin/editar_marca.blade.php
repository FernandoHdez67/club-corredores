@extends('adminlte::page')

@section('title', 'Marca')

@section('content_header')
<h1>Actualizar Marca</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="card-title"></h5>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="abs-center-registro">
                <form action="{{ route('marca.update', $marca->idmarca) }}" method="POST" style="margin:10px">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="marca">Marca <b style="color: red">*</b></label>
                                <input type="text" name="marca" id="marca" class="form-control @error('marca') is-invalid @enderror" value="{{ $marca->marca }}">
                                <div class="invalid-feedback" id="marca-error"></div>
                            </div>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                            <a href="{{ route('marcas') }}" class="btn btn-secondary">Cancelar</a>
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
        formValid = validarMarca() && formValid;

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
    const marca = document.getElementById('marca');

    // Agregamos event listeners para los campos que queremos validar
    marca.addEventListener('input', validarMarca);

    // Funciones de validación para cada campo
    function validarMarca() {
        if (marca.value.trim() === '') {
            mostrarError(marca, 'El Marca es obligatoria.');
        } else {
            mostrarExito(marca);
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
