<?php include_once 'views/templates/header.php'; ?>

<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <?php if ($data['usuario']['perfil'] == null) {
                                $perfil = BASE_URL . 'assets/images/logo-icon.png';
                            }else{
                                $perfil = BASE_URL . $data['usuario']['perfil'];
                            } ?>
                            <img src="<?php echo  $perfil; ?>" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                            <div class="mt-3">
                                <h4><?php echo $data['usuario']['nombre'] . ' ' . $data['usuario']['apellido']; ?></h4>
                                <p class="text-secondary mb-1"><i class="fas fa-envelope"></i> <?php echo $data['usuario']['correo']; ?></p>
                                <p class="text-secondary mb-1"><i class="fas fa-phone"></i> <?php echo $data['usuario']['telefono']; ?></p>
                                <p class="text-muted font-size-sm"><i class="fas fa-home"></i> <?php echo $data['usuario']['direccion']; ?></p>
                                <hr>
                                <h5 class="text-center">Fecha Registro</h5>
                                <p class="text-muted font-size-sm"> <?php echo $data['usuario']['fecha']; ?></p>
                                <hr>
                                <h5 class="text-center">Rol</h5>
                                <p class="text-muted font-size-sm"> <?php echo ($data['usuario']['rol'] == 1) ? 'ADMINISTRADOR' : 'VENDEDOR'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form id="formularioPerfil" autocomplete="off">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nombre</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="nombrePerfil" name="nombrePerfil" value="<?php echo $data['usuario']['nombre']; ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Apellido</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="apellidoPerfil" name="apellidoPerfil" value="<?php echo $data['usuario']['apellido']; ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Correo</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="correoPerfil" name="correoPerfil" value="<?php echo $data['usuario']['correo']; ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Teléfono</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="telefonoPerfil" name="telefonoPerfil" value="<?php echo $data['usuario']['telefono']; ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Dirección</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" id="direccionPerfil" name="direccionPerfil" value="<?php echo $data['usuario']['direccion']; ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="">Contraseña Actual</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" id="claveActual" name="claveActual" placeholder="Contraseña Actual" />
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <label for="">Nueva Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" id="claveNueva" name="claveNueva" placeholder="Contraseña Nueva" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Perfil</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="file" class="form-control" id="fotoPerfil" name="fotoPerfil"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" id="btnGuardarCambios" value="Guardar Cambios" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/templates/footer.php'; ?>