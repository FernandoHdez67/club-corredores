@extends('principal')

@section('title',"Detalle | Cachorro PET")

@section ('contenido')

<div>
    <div class="container" style="margin-top: 8%">
        <div class="card">
            <center>
                <h4>Detalles del producto</h4>
            </center> <br><br>
            <div class="row">
                <div class="col-md-6" style="width: 20rem; margin-left:20px">
                    <img src="{{ asset('img/productos/'.$producto->imagen)}}" class="card-img-top" alt="" width="250px" height="200px"> <br>
                </div>
                <div class="col-md-6" style="margin-left:20px">
                    <h5>Descripción</h5>
                    <p class="card-title">{{ $producto->nombre }}</p>
                    <p class="card-text">{{ $producto->descripcion }}</p>
                    <p class="card-text">${{ $producto->precio }}</p>
                    <p class="card-text">Categoria: {{ $producto->categoria }}</p>
                    <p class="card-text">Marca: {{ $producto->marca }}</p>
                    <p style="color:gray" class="card-text">{{ $producto->cantidad }} productos en existencia </p>
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" id="menos">-</button>
                        </span>
                        <input type="number" class="form-control-2" id="cantidad" name="cantidad" value="1">
                        <span class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="mas">+</button>
                        </span>
                    </div>

                    @if ($producto->cantidad > 0)
                    <p>Producto: <b style="color: rgb(5, 192, 5)">En existencia</b></p>
                    @else
                    <p>Producto: <b style="color: rgb(255, 189, 9)">Agotado</b></p>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <a id="div-btn1" href="#" class="btn btn-rojopet"><i class="fa-solid fa-shop"></i> Comprar ahora</a><br><br>
                        </div>
                        <div class="col-md-6">
                            <a id="div-btn1" href="#" class="btn btn-success"><i class="fa-solid fa-plus"></i> Agregar al carrito</a><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<style>
    .input-group input[type="number"] {
        text-align: center;

    }

    .input-group .btn {
        font-size: 0.8rem;
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
    }

</style>

<script>
    $(function() {
        $('#mas').click(function() {
            var value = parseInt($('#cantidad').val(), 10);
            value = isNaN(value) ? 1 : value;
            $('#cantidad').val(value + 1);
        });

        $('#menos').click(function() {
            var value = parseInt($('#cantidad').val(), 10);
            value = isNaN(value) ? 1 : value;
            $('#cantidad').val(value - 1);
        });
    });

</script>

@endsection
