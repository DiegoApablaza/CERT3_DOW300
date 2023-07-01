@extends('Layouts.supremeMaster')
@yield('funcionEx')
<body>
   <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Iniciar sesión</div>
                    @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('public.userStore') }}">
                        @csrf

                        <div class="form-group">
                            <label>Usuario</label>
                            <input id="user" type="user" class="form-control" name="user" required autofocus>
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
                            <label for="perfil_id">Perfil</label>
                            <div>
                                <input id="perfil_admin" type="radio" name="perfil_id" value="1" required>
                                <label for="perfil_admin">Administrador</label>
                            </div>
                            <div>
                                <input id="perfil_artista" type="radio" name="perfil_id" value="2" required>
                                <label for="perfil_artista">Artista</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Crear Cuenta</button>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-header">Iniciar sesión ADMIN</div>
                    <div class="card-body">
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
                                <label>Usuario</label>
                                <input id="user" type="user" class="form-control" name="user" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">Iniciar sesión ARTISTA</div>
                        <div class="card-body">
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
                                    <label>Usuario</label>
                                    <input id="user" type="user" class="form-control" name="user" required autofocus>
                                </div>
    
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
    
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                                </div>
                            </form>
                        </div>
                    <div class="card">
                        <div class="card-header">Iniciar sesión</div>
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