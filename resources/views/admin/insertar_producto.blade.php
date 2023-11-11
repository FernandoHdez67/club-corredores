@extends('adminlte::page')

@section('title', 'Configuracion')

@section('content_header')
<h1>Agregar producto</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="card-title"></h5>
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="container">
            <div class="abs-center-registro">

                <form method="POST" action="{{ route('insertar.producto') }}" class="border p-3 form-2" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre <b style="color: red">*</b></label>
                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}">
                        <div class="invalid-feedback" id="nombre-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio <b style="color: red">*</b></label>
                        <input type="text" name="precio" id="precio" class="form-control @error('precio') is-invalid @enderror" value="{{ old('precio') }}">
                        <div class="invalid-feedback" id="precio-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Stock <b style="color: red">*</b></label>
                        <input type="text" name="cantidad" id="cantidad" class="form-control @error('cantidad') is-invalid @enderror" value="{{ old('cantidad') }}">
                        <div class="invalid-feedback" id="cantidad-error"></div>
                        {{-- @error('cantidad')
                        <div class="invalid-feedback">{{ $message }}
                    </div>
                    @enderror --}}
            </div>
            <div class="form-group">
                <label for="marca">Marca <b style="color: red">*</b></label>
                <select class="form-select @error('marca') is-invalid @enderror" aria-label="Default select example" id="marca" name="marca">
                    <option selected>[Seleccionar]</option>
                    @foreach($marca as $marca_item)
                    <option value="{{ $marca_item->idmarca }}">{{ $marca_item->marca }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback" id="marca-error"></div>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria <b style="color: red">*</b></label>
                <select class="form-select @error('categoria') is-invalid @enderror" aria-label="Default select example" id="categoria" name="categoria">
                    <option selected>[Seleccionar]</option>
                    @foreach($categoria as $categoria_item)
                    <option value="{{ $categoria_item->idcategoria }}">{{ $categoria_item->categoria }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback" id="categoria-error"></div>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion <b style="color: red">*</b></label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                <div class="invalid-feedback" id="descripcion-error"></div>
            </div>
            <div class="form-group">
                <label for="imagen" class="form-label">Imagen</label>
                <input class="form-control @error('imagen') is-invalid @enderror" name="imagen" type="file" id="imagen" accept="image/jpeg, image/png">
                <div class="invalid-feedback" id="imagen-error"></div>
            </div>


            <button type="submit" class="btn btn-success">Guardar</button>

            <a href="{{ route('productoss') }}" class="btn btn-secondary">Cancelar</a>

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
        formValid = validarNombre() && formValid;
        formValid = validarPrecio() && formValid;
        formValid = validarCategoria() && formValid;
        formValid = validarMarca() && formValid;
        formValid = validarCantidad() && formValid;
        formValid = validarDescripcion() && formValid;
        formValid = validarImagen() && formValid;

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
    const nombre = document.getElementById('nombre');
    const precio = document.getElementById('precio');
    const categoria = document.getElementById('categoria');
    const marca = document.getElementById('marca');
    const cantidad = document.getElementById('cantidad');
    const descripcion = document.getElementById('descripcion');
    const imagen = document.getElementById('imagen');

    // Agregamos event listeners para los campos que queremos validar
    nombre.addEventListener('input', validarNombre);
    precio.addEventListener('input', validarPrecio);
    categoria.addEventListener('input', validarCategoria);
    marca.addEventListener('input', validarMarca);
    cantidad.addEventListener('input', validarCantidad);
    descripcion.addEventListener('input', validarDescripcion);
    imagen.addEventListener('change', validarImagen);

    // Funciones de validación para cada campo
    function validarNombre() {
        if (nombre.value.trim() === '') {
            mostrarError(nombre, 'El Nombre del producto es obligatorio.');
        } else {
            mostrarExito(nombre);
        }
    }

    function validarPrecio() {
        if (precio.value.trim() === '') {
            mostrarError(precio, 'El precio es obligatorio.');
        } else if (isNaN(precio.value)) {
            mostrarError(precio, 'El precio debe ser un número.');
        } else if (parseFloat(precio.value) < 1) {
            mostrarError(precio, 'El precio debe ser mayor o igual a un peso.');
        } else {
            mostrarExito(precio);
        }
    }

    function validarCategoria() {
        if (categoria.value.trim() === '') {
            mostrarError(categoria, 'La categoria del producto es obligatoria.');
        } else {
            mostrarExito(categoria);
        }
    }

    function validarMarca() {
        if (marca.value.trim() === '') {
            mostrarError(marca, 'La marca del producto es obligatoria.');
        } else {
            mostrarExito(marca);
        }
    }

    function validarCantidad() {
        const maxCantidad = 10000; // Valor máximo permitido por la columna 'cantidad'
        if (cantidad.value.trim() === '') {
            mostrarError(cantidad, 'La Cantidad de Stock es obligatoria.');
        } else if (isNaN(cantidad.value)) {
            mostrarError(cantidad, 'La Cantidad de debe ser un número.');
        } else if (parseInt(cantidad.value) < 0) {
            mostrarError(cantidad, 'La Cantidad de Stock debe ser mayor o igual a cero.');
        } else if (parseInt(cantidad.value) > maxCantidad) {
            mostrarError(cantidad, `La Cantidad de Stock no puede ser mayor a ${maxCantidad}.`);
        } else {
            mostrarExito(cantidad);
        }
    }


    function validarDescripcion() {
        if (descripcion.value.trim() === '') {
            mostrarError(descripcion, 'La Descripcion es obligatoria.');
        } else {
            mostrarExito(descripcion);
        }
    }

    function validarImagen() {
        if (imagen.value.trim() === '') {
            mostrarError(imagen, 'Debe seleccionar una imagen.');
        } else if (imagen.files[0].size > 10240 * 1024) {
            mostrarError(imagen, 'El tamaño máximo de la imagen es 10 MB.');
        } else if (!['image/jpeg', 'image/png'].includes(imagen.files[0].type)) {
            mostrarError(imagen, 'El archivo seleccionado debe ser una imagen (JPEG, PNG).');
        } else {
            mostrarExito(imagen);
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
