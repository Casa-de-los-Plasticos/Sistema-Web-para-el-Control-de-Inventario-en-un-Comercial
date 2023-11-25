<?php include_once 'views/templates/header.php'; ?>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div></div>
            <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo BASE_URL . 'usuarios/inactivos'; ?>"><i class="fas fa-trash text-danger"></i> Inactivos</a>
                    </li>
                </ul>
            </div>
        </div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-usuarios-tab" data-bs-toggle="tab" data-bs-target="#nav-usuarios" type="button" role="tab" aria-controls="nav-usuarios" aria-selected="true">Usuarios</button>
                <button class="nav-link" id="nav-nuevo-tab" data-bs-toggle="tab" data-bs-target="#nav-nuevo" type="button" role="tab" aria-controls="nav-nuevo" aria-selected="false">Nuevo</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active mt-3" id="nav-usuarios" role="tabpanel" aria-labelledby="nav-usuarios-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-user"></i> Listado de Usuarios</h5>
                <hr>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover nowrap" id="tblUsuarios" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Rol</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="tab-pane fade mt-3" id="nav-nuevo" role="tabpanel" aria-labelledby="nav-nuevo-tab" tabindex="0">
                <form class="" id="formulario" autocomplete="off">
                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <label>Nombres</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <input type="text" id="nombres" name="nombres" class="form-control" placeholder="Nombres">
                            </div>
                            <span id="errorNombre" class="text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <label>Apellidos</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                                <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Apellidos">
                            </div>
                            <span id="errorApellido" class="text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <label>Correo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo Electrónico">
                            </div>
                            <span id="errorCorreo" class="text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <label>Teléfono</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="number" id="telefono" name="telefono" class="form-control" placeholder="Teléfono">
                            </div>
                            <span id="errorTelefono" class="text-danger"></span>
                        </div>
                        <div class="col-lg-8 col-sm-6 mb-2">
                            <label>Dirección</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                                <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Dirección">
                            </div>
                            <span id="errorDireccion" class="text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <label>Clave</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" id="clave" name="clave" class="form-control" placeholder="Contraseña">
                            </div>
                            <span id="errorClave" class="text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-sm-6 mb-2">
                            <label>Rol</label>
                            <div class="input-group">
                                <label class="input-group-text" for="rol"><i class="fas fa-id-card"></i></label>
                                <select class="form-select" id="rol" name="rol">
                                    <option value="" selected>Seleccionar</option>
                                    <option value="1">ADMINISTRADOR</option>
                                    <option value="2">OPERARIO</option>
                                </select>
                            </div>
                            <span id="errorRol" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-danger" type="button" id="btnNuevo">Nuevo</button>
                        <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/templates/footer.php'; ?>