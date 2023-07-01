@extends('Layouts.supremeMaster')
@yield('funcionEx')
<body>
   <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="tabla1-tab" data-bs-toggle="tab" data-bs-target="#tabla1" type="button" role="tab" aria-controls="tabla1" aria-selected="true">Login Artistas</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tabla2-tab" data-bs-toggle="tab" data-bs-target="#tabla2" type="button" role="tab" aria-controls="tabla2" aria-selected="false">Login Admin</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tabla4-tab" data-bs-toggle="tab" data-bs-target="#tabla4" type="button" role="tab" aria-controls="tabla4" aria-selected="false">Crear Cuenta</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tabla1" role="tabpanel" aria-labelledby="tabla1-tab">
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
                                <form method="GET" action="{{ route('artista.index') }}">
                                    @csrf
        
                                    <div class="form-group">
                                        <label>ARTISTA-Usuario</label>
                                        <input id="user" type="user" class="form-control" name="user" autofocus>
                                    </div>
        
                                    <div class="form-group">
                                        <label for="password">ARTISTA-Contraseña</label>
                                        <input id="password" type="password" class="form-control" name="password">
                                    </div>
        
                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="tabla2" role="tabpanel" aria-labelledby="tabla2-tab">
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
                                <form method="GET" action="{{ route('admin.index') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label>ADMIN-Usuario</label>
                                        <input id="user" type="user" class="form-control" name="user" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">ADMIN-Contraseña</label>
                                        <input id="password" type="password" class="form-control" name="password">
                                    </div>

                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="tabla4" role="tabpanel" aria-labelledby="tabla4-tab">
                                @if(session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('error')}}
                                </div>
                                @endif
                                <form method="POST" action="{{ route('public.userStore') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label>Usuario</label>
                                        <input id="user" type="user" class="form-control" name="user" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input id="password" type="password" class="form-control" name="password">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input id="nombre" type="text" class="form-control" name="nombre">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="apellido">Apellido</label>
                                        <input id="apellido" type="text" class="form-control" name="apellido">
                                    </div>

                                    <div class="form-group">
                                        <label for="perfil_id">Perfil</label>
                                        <div>
                                            <input id="perfil_admin" type="radio" name="perfil_id" value="1">
                                            <label for="perfil_admin">Administrador</label>
                                        </div>
                                        <div>
                                            <input id="perfil_artista" type="radio" name="perfil_id" value="2">
                                            <label for="perfil_artista">Artista</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Crear Cuenta</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Ingreso Publico</div>
                    <div class="mt-3 text-center">
                        <a href="{{ route('public.home') }}" class="btn btn-secondary">PUBLICO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</body>
</html>