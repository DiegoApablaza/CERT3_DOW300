@extends('Layouts.supremeMaster')
@yield('funcionEx')
<body>
   <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">ADMINISTRADOR<a href="{{ route('public.cerrarSesion') }}" class="text-decoration-underline">Cerrar sesión</a></div>
                    <div class="card-body">
                        ERES ADMIN
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
                                <button class="nav-link" id="tabla3-tab" data-bs-toggle="tab" data-bs-target="#tabla3" type="button" role="tab" aria-controls="tabla3" aria-selected="false">Imagenes</button>
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
                                                <td>{{ $cuenta->nombre }}</td>
                                                <td>{{ $cuenta->apellido }}</td>
                                                <td>{{ $cuenta->perfil_id }}</td>
                                                <td>
                                                    <form method="POST" action="{{ route('admin.deleteCuenta', $cuenta->user) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="bi bi-x-circle"></i>
                                                        </button>
                                                    </form>
                                                    <form method="GET" action="{{ route('admin.editCuenta', $cuenta->user) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="bi bi-pencil"></i> <!-- Icono de lápiz u otro icono de edición -->
                                                        </button>
                                                    </form>
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="tabla3" role="tabpanel" aria-labelledby="tabla3-tab">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>titulo</th>
                                            <th>Archivo</th>
                                            <th>Baneada</th>
                                            <th>motivo_ban</th>
                                            <th>cuenta_user</th>      
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($imagenes as $imagen)
                                            <tr>
                                                <td>{{ $imagen->id }}</td>
                                                <td>{{ $imagen->titulo }}</td>
                                                <td>{{ $imagen->archivo }}</td>
                                                <td>{{ $imagen->baneada }}</td>
                                                <td>{{ $imagen->motivo_ban }}</td>
                                                <td>{{ $imagen->cuenta_user }}</td>
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
                                        <input type="text" id="user" class="form-control" name="user" required>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input id="password" type="password" class="form-control" name="password" required>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input id="nombre" type="text" class="form-control" name="nombre" required>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="apellido">Apellido</label>
                                        <input id="apellido" type="text" class="form-control" name="apellido" required>
                                    </div>
                                
                                    <div class="form-group">
                                        <label>ID de Perfil</label>
                                        <input id="perfil_id" type="number" class="form-control" name="perfil_id" required>
                                    </div>
                                    <button type="submit" class="btn btn-info">Guardar</button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</body>
</html>