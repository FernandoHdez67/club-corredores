@extends('adminlte::page')

@section('title', 'Marca')

@section('content_header')
<h1>Marcas de Productos</h1>
@stop

@section('content')
<div class="card">
    <form action="{{ route('insertar.marca') }}" method="POST" style="margin:10px">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="marca">Marca <b style="color: red">*</b></label>
                    <input type="text" name="marca" id="marca" class="form-control @error('marca') is-invalid @enderror" value="{{ old('marca') }}">
                    <div class="invalid-feedback" id="marca-error"></div>
                </div>
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Agregar Marca</button>
            </div>
        </div>
    </form>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marca as $marca)
                    <tr>

                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $marca->marca }}</td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('marca.edit', $marca->idmarca) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form method="POST" action="{{ route('destroy.marca', $marca->idmarca) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta marca?')"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
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