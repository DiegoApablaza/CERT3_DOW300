@extends('Layouts.supremeMaster')
@yield('funcionEx')
<body>
   <div class="container" id="imagenes-container">
    <div class="card" style="background: linear-gradient(to bottom, #a7b11a, #e8e693)">
        <div class="card-header">CompARTE<a href="{{ route('public.cerrarSesion') }}" class="text-decoration-underline">Cerrar sesión</a></div>
        <div class="row-mt-4">
            <div class="col">
                <div class="form-group">
                    <label for="filtro-artista">Filtrar por artista</label>
                    <select class="form-control" id="filtro-artista" onchange="filtrarPorArtista(this.value)">
                        <option value="">Todos</option>
                        @foreach($cuentas as $cuenta)
                            <option value="{{$cuenta->user}}">{{$cuenta->user}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($imagenes as $imagen)
            @unless ($imagen->baneada)
                <div class="col-md-3" data-artista="{{ $imagen->cuenta->user}}">
                    <div class="card">
                        <div class="card-header">
                            <p>Usuario: {{ $imagen->cuenta->user}}</p>
                        </div>
                        <div class="text-center">
                            <img class="card-img-top w-100" src="{{Storage::url($imagen->archivo)}}" alt="{{$imagen->titulo}}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$imagen->titulo}}</h5>
                        </div>
                    </div>
                </div>
            @endunless
            @endforeach
        </div>
    </div>
    <script>
        function filtrarPorArtista(artista) {
            const imagenesContainer = document.getElementById('imagenes-container');
            const imagenes = imagenesContainer.getElementsByClassName('col-md-3');

            for (let i = 0; i < imagenes.length; i++) {
                const imagen = imagenes[i];
                const artistaImagen = imagen.getAttribute('data-artista');

                if (artista && artistaImagen !== artista) {
                imagen.style.display = 'none';
                } else {
                imagen.style.display = 'block';
                }
            }
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</body>
</html>