@extends('Layouts.supremeMaster')
@yield('funcionEx')
<body>
   <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Editando Usuario  <a href="{{ route('admin.volver',['administrador' => $administrador]) }}" class="text-decoration-underline">Cancelar</a></div>
                    <div class="card-body">
                        Admin: {{ $administrador->user }}.
                        Editando a {{ $cuenta->user }}
                    </div>
                    
                </div>
                <div class="card">
                    <div class="card-header">
                        editamos admin
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.updateCuenta', $cuenta ->user) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $cuenta->nombre }}"required>
                            </div>
                        
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input id="apellido" type="text" class="form-control" name="apellido" value="{{ $cuenta->apellido }}" required>
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
                            <button type="submit" class="btn btn-info mt-4">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</body>
</html>