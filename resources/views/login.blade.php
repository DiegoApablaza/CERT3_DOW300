@extends('Layouts.supremeMaster')
@yield('funcionEx')
<body>
   <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Iniciar sesión</div>
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
                        <form method="POST" action="{{ route('public.login') }}">
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
                                <button type="submit" class="btn btn-primary" id="perfil_id" type="number" name="perfil_id" value="2" required>Crear Cuenta</button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-3 text-center">
                        <p>Selecciona un tipo de usuario:</p>
                        <a href="{{ route('admin.home') }}" class="btn btn-secondary">ADMIN</a>
                        <a href="{{ route('artista.Home') }}" class="btn btn-secondary">ARTISTA</a>
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