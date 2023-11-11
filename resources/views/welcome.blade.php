@extends('principal')

@section('title',"Inicio | Cachorro PET")

@section ('contenido')

<div class="container" style="margin-top: 15px">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('imagenes/carrusel/1.png') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('imagenes/carrusel/2.png') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('imagenes/carrusel/3.png') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <br><br><br><br><br>
    <hr>
    <center>
        <h2>Eventos destacados</h2>
    </center><br>
    <div class="row">
        {{-- Evento 1 --}}
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Evento 1</h5>
                    <p class="card-text">Descripción 1.</p>
                    <a href="#" class="btn btn-primary">Inscribirme</a>
                </div>
            </div>
        </div>

        {{-- Evento 2 --}}
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Evento 2</h5>
                    <p class="card-text">Descripción 2.</p>
                    <a href="#" class="btn btn-primary">Inscribirme</a>
                </div>
            </div>
        </div>

        {{-- Evento 3 --}}
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Evento 3</h5>
                    <p class="card-text">Descripción 3.</p>
                    <a href="#" class="btn btn-primary">Inscribirme</a>
                </div>
            </div>
        </div>


    </div>

    <center>
        <a href="#" class="btn btn-primary" type="submit">Mas eventos</a>
    </center> <br><br>

    <hr>
    <center>
        <h2>Lo mas vendido</h2>
    </center><br>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('imagenes/productos/2.jpg') }}" width="200px" height="200px" class="card-img-top"
                    alt="Producto 2">
                <div class="card-body">
                    <h5 class="card-title">Producto 2</h5>
                    <p class="card-text">Descripción 2.</p>
                    <p class="card-text">$249.99</p>
                    <a href="#" class="btn btn-primary">Comprar</a>
                </div>
            </div>
        </div>

        {{-- Producto 3 --}}
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('imagenes/productos/3.jpg') }}" width="200px" height="200px" class="card-img-top"
                    alt="Producto 3">
                <div class="card-body">
                    <h5 class="card-title">Producto 3</h5>
                    <p class="card-text">Descripción 3.</p>
                    <p class="card-text">$279.99</p>
                    <a href="#" class="btn btn-primary">Comprar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('imagenes/productos/4.jpg') }}" width="200px" height="200px" class="card-img-top"
                    alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Producto 1</h5>
                    <p class="card-text">Descripción 1.</p>
                    <p class="card-text">$569.99</p>
                    <a href="#" class="btn btn-primary">Comprar</a>
                </div>
            </div>
        </div>
        <center>
            <a href="#" class="btn btn-primary" type="submit">Mas productos</a>
        </center> <br><br>
    </div>


</div><br><br><br><br>

@endsection
