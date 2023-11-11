@extends('principal')

@section('title',"Productos | Cachorro PET")

@section ('contenido')

<div class="container">
    <nav class="navbar navbar-light ">
        <div class="container-fluid justify-content-end">
            <a class="navbar-brand"></a>
            <form class="d-flex" action="{{ route('productos.buscar') }}" method="get" style="margin-top: 10px">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" name="texto">
                <button class="btn btn-success" type="submit">Buscar</button>
            </form>
            {{-- <form class="d-flex ms-auto" method="GET" action="{{ route('productos.buscar') }}" style="margin-top: 10px">
                <label for="ordenar">Ordenar:</label>
                <select class="form-select form-select-sm me-2" id="ordenar" name="ordenar">
                    <option value="precio_asc">menor precio</option>
                    <option value="precio_desc">mayor precio</option>
                </select>
                <button type="submit" class="btn btn-success">Ordenar</button>
            </form> --}}
            {{-- <form method="GET" action="{{ route('prod.buscar') }}" class="ms-auto">
                <div class="row">
                    <div class="col-4">
                        <label for="categoria">Categoría:</label>
                        <select class="form-select form-select-sm me-2" name="categoria" id="categoria">
                            <option value="{{ old('categoria') }}">Todas las categorías</option>
                            @foreach($categoria as $categoria_item)
                            <option value="{{ $categoria_item->idcategoria }}">{{ $categoria_item->categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="marca">Marca:</label>
                        <select class="form-select form-select-sm me-2" name="marca" id="marca">
                            <option value="{{ old('marca') }}">Todas las marcas</option>
                            @foreach($marca as $marca_item)
                            <option value="{{ $marca_item->idmarca }}">{{ $marca_item->marca }}</option>
                            @endforeach
                        </select> <br>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-success" type="submit"><i class="fa-solid fa-search"></i> Buscar</button>
                    </div>
                </div>
            </form> --}}
        </div>
    </nav>

    <br>

    @if(count($productos)<=0) <center>
        <h2>No se han encontrado resultados de su busqueda</h2>
        <img src="{{ asset('img/perro.jpg') }}" alt="" width="80px" height="100px">
        </center> <br><br><br><br><br><br>
        @else
        <center>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($productos as $productos)
                <div class="">
                    <div class="col hvr-glow">
                        <div class="card shadow-sm " style="width: 18rem;">
                            <a href="{{ route('detalles', [$productos->idproducto]) }}"><img src="{{ 'img/productos/'.$productos->imagen}}" class="card-img-top" alt="{{$productos->nombre}}" width="300px" height="200px"></a>
                            <div class="card-body">
                                <h5 class="card-title">{{$productos->nombre}}</h5>
                                <p class="card-text"><b>$</b> {{$productos->precio}}</p>
                                <a id="div-btn1" href="{{ route('detalles', [$productos->idproducto]) }}" class="btn btn-success">Detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </center>
        @endif
</div>
</div> <br><br>
@endsection
