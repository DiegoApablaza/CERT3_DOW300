@extends('Layouts.supremeMaster')
@yield('funcionEx')
<body>
   <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">ARTISTA<a href="{{ route('public.cerrarSesion') }}" class="text-decoration-underline">Cerrar sesión</a></div>
                    <div class="card-body">
                        Artista: {{$cuenta->user}}
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="tabla2-tab" data-bs-toggle="tab" data-bs-target="#tabla1" type="button" role="tab" aria-controls="tabla1" aria-selected="true">Nueva Imagen</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tabla3-tab" data-bs-toggle="tab" data-bs-target="#tabla3" type="button" role="tab" aria-controls="tabla3" aria-selected="false">Imagenes Baneadas</button>
                            </li>

                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tabla1" role="tabpanel" aria-labelledby="tabla1-tab">
                                <form method="POST" action="{{ route('artista.subirImagen') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="cuenta_user">{{$cuenta->user}}</label>
                                        <input type="hidden" name="cuenta_user" value="{{$cuenta->user}}">
                                        <label>Titulo</label>
                                        <input type="text" id="titulo" class="form-control" name="titulo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="archivo">Archivo</label>
                                        <input id="archivo" type="file" class="form-control" name="archivo" required>
                                    </div>
                                
                                    <button type="submit" class="btn btn-info">Guardar</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="tabla3" role="tabpanel" aria-labelledby="tabla3-tab">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Titulo</th>
                                            <th>Imagen</th>
                                            <th>Motivo Ban</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cuenta->imagenes as $imagen)
                                            @if ($imagen->baneada)
                                                <tr>
                                                    <td>{{ $imagen->titulo }}</td>
                                                    <td><img class="card-img-top w-100" src="{{Storage::url($imagen->archivo)}}" alt="{{$imagen->titulo}}"></td>
                                                    <td>{{ $imagen->motivo_ban }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="background: linear-gradient(to bottom, #a7b11a, #e8e693)">
            <div class="row">
                @foreach($cuenta->imagenes as $imagen)
                @if (!$imagen->baneada)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="text-center">
                                <img class="card-img-top w-100" src="{{Storage::url($imagen->archivo)}}" alt="{{$imagen->titulo}}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$imagen->titulo}}</h5>
                                <form action="{{route('artista.eliminarImagen',$imagen->id)}}" method="POST" id="eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Seguro de eliminar {{$imagen->titulo}}')">Eliminar Imagen</button>
                                </form>
                                <form action="{{route('artista.editarImagen',$imagen->id)}}" method="POST">
                                    @csrf
                                    <input type="text" name="tituloNuevo" placeholder="Nuevo título">
                                    <button type="submit" onclick="return confirm('Seguro de cambiar el nombre de {{$imagen->titulo}}')">Cambiar Titulo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                @endforeach
            </div>
        </div>
        
        
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</body>
</html>