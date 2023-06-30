@extends('Layouts.supremeMaster')
@yield('funcionEx')
<body>
   <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Iniciar sesiónSOYADMIN</div>
                    <div class="card-body">
                        ERES ADMIN
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</body>
</html>