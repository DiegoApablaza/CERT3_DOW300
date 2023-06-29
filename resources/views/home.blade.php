@extends('Layouts.supremeMaster')
@yield('funcionEx')
<body>
   <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Iniciar sesiónHOME</div>
                    <div class="card-body">
                        hola
                    </div>
                    <div class="mt-3 text-center">
                        <p>Selecciona un tipo de usuario:</p>
                        <a href="{{ route('artista.Home') }}" class="btn btn-secondary">Usuario A</a>
                        <a href="{{ route('login') }}" class="btn btn-secondary">Usuario B</a>
                        <a href="{{ route('login') }}" class="btn btn-secondary">Usuario C</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="card">
                <div class="card-header">Iniciar sesiónHOME</div>
                    <div class="card-body">
                        Contenido de la segunda card
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                <div class="card-header">Iniciar sesiónHOME</div>
                    <div class="card-body">
                        Contenido de la tercera card
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                <div class="card-header">Iniciar sesiónHOME</div>
                    <div class="card-body">
                        Contenido de la cuarta card
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</body>
</html>