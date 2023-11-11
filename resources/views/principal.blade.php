<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Club de corredores">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>@yield('title')</title>
</head>

<body>
    <div class="contentido">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a href="/"><img src="{{ asset('imagenes/logo.png') }}" height="50px" width="50px" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/"><b>Inicio</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ Route('somos') }}"><b>Quienes Somos</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"><b>Eventos</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('products') }}"><b>Tienda</b></a>
                        </li>
                    </ul>
                    <form action="{{ route('login') }}" method="GET" class="d-flex">
                        <button class="btn btn-success" type="submit">Iniciar Sesion</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>


    @yield('contenido')


</body>
<footer class="bg-dark text-white pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3>Running Club</h3>
                <hr>
                <ul class="list-unstyled text-secondary">
                    <li><a class="text-decoration-none link-secondary" href="#">Quienes somos</a>
                    </li>
                    <li><a class="text-decoration-none link-secondary" href="#">Términos y
                            Condiciones</a></li>
                    <li><a target="_blank" class="text-decoration-none link-secondary" href="#">Aviso de privacidad</a>
                    </li>
                    <li><a class="text-decoration-none link-secondary" href="#">Ayuda</a></li>
                </ul>

            </div>
            <div class="col-md-3">
                <h3>Contacto</h3>
                <hr>
                <ul class="list-unstyled text-secondary">
                    <li><i class="fa-brands fa-twitter"></i> <a class="text-decoration-none link-secondary"
                            href="#">Twitter</a></li>
                    <li><i class="fa-brands fa-square-facebook"></i> <a class="text-decoration-none link-secondary"
                            href="#" target="_blank">Facebook</a>
                    </li>
                    <li><i class="fa-brands fa-instagram"></i> <a class="text-decoration-none link-secondary"
                            href="#">Instagram</a></li>
                    <li><i class="fa-solid fa-envelope"></i> <a class="text-decoration-none link-secondary"
                            href="#">Contacto</a></li>

            </div>
            <div class="col-md-3">
                <h3>Eventos</h3>
                <hr>
                <ul class="list-unstyled text-secondary">
                    <li><a class="text-decoration-none link-secondary" href="#">Esterica canina</a></li>
                    <li><a class="text-decoration-none link-secondary" href="#">Ultrasonido</a></li>
                    <li><a class="text-decoration-none link-secondary" href="#">Cirugias</a></li>
                    <li><a class="text-decoration-none link-secondary" href="#">Otros</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Dirección</h3>
                <hr>
                <ul class="list-unstyled text-secondary">

                    <li>
                    <li>Adolfo López Mateos 34
                        Aviación Civil
                        43000 Huejutla, Hgo.
                        México</li>
                    </li>
                </ul>
            </div>
            <hr>
            <center>
                <p class="text-decoration-none link-secondary">&copy;
                    <?php echo date("Y"); ?> Todos los derechos reservados
                </p>
            </center>
        </div>
    </div>
</footer>

</html>
