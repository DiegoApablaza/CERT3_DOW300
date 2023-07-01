@extends('Layouts.supremeMaster')
@yield('funcionEx')
<body>
   <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">ADMINISTRADOR<a href="{{ route('public.cerrarSesion') }}" class="text-decoration-underline">Cerrar sesión</a></div>
                    <div class="card-body">
                        ADMIN USER:  {{$cuenta->user}}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                         @endif
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                    
                </div>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="tabla1-tab" data-bs-toggle="tab" data-bs-target="#tabla1" type="button" role="tab" aria-controls="tabla1" aria-selected="true">Perfiles</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tabla2-tab" data-bs-toggle="tab" data-bs-target="#tabla2" type="button" role="tab" aria-controls="tabla2" aria-selected="false">Cuentas</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tabla4-tab" data-bs-toggle="tab" data-bs-target="#tabla4" type="button" role="tab" aria-controls="tabla4" aria-selected="false">Crear Cuenta</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tabla1" role="tabpanel" aria-labelledby="tabla1-tab">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($perfiles as $perfil)
                                        <tr>
                                            <td>{{ $perfil->id }}</td>
                                            <td>{{ $perfil->nombre }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="tabla2" role="tabpanel" aria-labelledby="tabla2-tab">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Perfil</th>
                                            <th>Acciones</th>   
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($cuentas as $cuenta)
                                            <tr>
                                                <td>{{ $cuenta->user }}</td>
                                                <td>
                                                    {{ $cuenta->nombre }}
                                                    @if ($cuenta->perfil_id == 2)
                                                    <form action="{{route('admin.editarNombre',$cuenta->user)}}" method="POST">
                                                        @csrf
                                                        <input type="text" name="nombreNuevo" placeholder="{{$cuenta->nombre}}">
                                                        <button class="btn btn-info mt-4" type="submit" onclick="return confirm('Seguro de cambiar el nombre de {{$cuenta->nombre}}')">Cambiar Nombre</button>
                                                    </form>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $cuenta->apellido }}
                                                    @if ($cuenta->perfil_id == 2)
                                                    <form action="{{route('admin.editarApellido',$cuenta->user)}}" method="POST">
                                                        @csrf
                                                        <input type="text" name="apellidoNuevo" placeholder="{{$cuenta->apellido}}">
                                                        <button class="btn btn-info mt-4" type="submit" onclick="return confirm('Seguro de cambiar el apellido de {{$cuenta->apellido}}')">Cambiar Apellido</button>
                                                    </form>
                                                    @endif
                                                </td>
                                                <td>{{ $cuenta->perfil_id }}</td>
                                                @if ($cuenta->perfil_id == 2)
                                                <td>
                                                    <form method="POST" action="{{ route('admin.deleteCuenta', $cuenta->user) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Seguro de eliminar {{$cuenta->user}}')">
                                                            <i class="bi bi-x-circle"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                @endif
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="tabla4" role="tabpanel" aria-labelledby="tabla4-tab">
                                <form method="POST" action="{{ route('admin.userStore') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Usuario</label>
                                        <input type="text" id="user" class="form-control" name="user">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input id="password" type="password" class="form-control" name="password" >
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input id="nombre" type="text" class="form-control" name="nombre" >
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="apellido">Apellido</label>
                                        <input id="apellido" type="text" class="form-control" name="apellido" >
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="perfil_id">Perfil</label>
                                        <div>
                                            <input id="perfil_admin" type="radio" name="perfil_id" value="1" >
                                            <label for="perfil_admin">Administrador</label>
                                        </div>
                                        <div>
                                            <input id="perfil_artista" type="radio" name="perfil_id" value="2">
                                            <label for="perfil_artista">Artista</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info mt-4">Guardar</button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
                

                </div>

            </div>
            <div class="card" style="background: linear-gradient(to bottom, #a7b11a, #e8e693)">
                <div class="row">
                    @foreach($imagenes as $imagen)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="text-center">
                                    <img class="card-img-top w-100" src="{{Storage::url($imagen->archivo)}}" alt="{{$imagen->titulo}}">
                                </div>
                                <div class="card-body">
                                    @if ($imagen->baneada)
                                        <form action="{{route('admin.banearImagen',$imagen->id)}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Desbanear Imagen</button>
                                        </form>
                                    @else
                                        <form action="{{route('admin.banearImagen',$imagen->id)}}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="motivo_ban" class="form-label">Motivo del Ban</label>
                                                <input type="text" class="form-control" id="motivo_ban" name="motivo_ban">
                                            </div>
                                            <button type="submit" class="btn btn-danger">Banear Imagen</button>
                                        </form>
                                        @endif
                                    <h5 class="card-title">{{$imagen->titulo}}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</body>
</html>