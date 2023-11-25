<?php include_once 'views/templates/header.php'; ?>

<div class="card">
    <div class="card-body">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-compras-tab" data-bs-toggle="tab" data-bs-target="#nav-compras" type="button" role="tab" aria-controls="nav-compras" aria-selected="true">Ingresos</button>
                <button class="nav-link" id="nav-historial-tab" data-bs-toggle="tab" data-bs-target="#nav-historial" type="button" role="tab" aria-controls="nav-historial" aria-selected="false">Historial</button>
                <button class="nav-link" id="nav-editar-tab" data-bs-toggle="tab" data-bs-target="#nav-editar" type="button" role="tab" aria-controls="nav-editar" aria-selected="false">Ver</button>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active p-3" id="nav-compras" role="tabpanel" aria-labelledby="nav-compras-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-truck"></i> Nuevo Ingreso</h5>
                <hr>
                <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                    <label class="btn btn-dark">
                        <input type="radio" id="barcode" checked name="buscarProducto"> <i class="fas fa-barcode"></i> Barcode
                    </label>
                    <label class="btn" style="background: #cccc;">
                        <input type="radio" id="nombre" name="buscarProducto"> <i class="fas fa-list"></i> Nombre
                    </label>
                </div>
                <!-- input para buscar codigo -->
                <div class="input-group mb-2" id="containerCodigo">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input class="form-control" type="text" id="buscarProductoCodigo" placeholder="Ingrese Barcode - Enter">
                </div>

                <!-- input para buscar nombre -->
                <div class="input-group d-none mb-2" id="containerNombre">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input class="form-control" type="text" id="buscarProductoNombre" placeholder="Buscar Producto">
                </div>

                <span class="text-danger fw-bold mb-2" id="errorBusqueda"></span>

                <!-- table productos -->

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" id="tblNuevaCompra" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <!-- <th>Precio</th> -->
                                <th>Cantidad</th>
                                <!-- <th>SubTotal</th> -->
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <div class="col-md-4">
                        <label>Buscar Proveedor</label>
                        <div class="input-group mb-2">
                            <input type="hidden" id="idProveedor">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input class="form-control" type="text" id="buscarProveedor" placeholder="Buscar Proveedor">
                        </div>
                        <span class="text-danger fw-bold mb-2" id="errorProveedor"></span>
                        <label>Telefono</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input class="form-control" type="text" id="telefonoProveedor" placeholder="Telefono" disabled>
                        </div>

                        <label>Dirección</label>
                        <ul class="list-group">
                            <li class="list-group-item" id="proveedorDireccion"><i class="fas fa-home"></i></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <label>Operador</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input class="form-control" type="text" value="<?php echo $_SESSION['nombre_usuario']; ?>" placeholder="Operador" disabled>
                        </div>

                        <label style="display: none">Total a Pagar</label>
                        <div class="input-group mb-2" style="display: none">
                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            <input class="form-control" type="text" id="totalPagar" placeholder="Total Pagar" disabled>
                        </div>

                        <label>Serie</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa-solid fa-shuffle"></i></span>
                            <input class="form-control" type="text" id="serie" placeholder="Serie Compra">
                        </div>

                        <br>

                        <div class="d-grid">
                            <button class="btn btn-primary" type="button" id="btnAccion">Completar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade p-3" id="nav-historial" role="tabpanel" aria-labelledby="nav-historial-tab" tabindex="0">
                <div class="d-flex justify-content-center mb-3">
                    <div class="form-group">
                        <label for="desde">Desde</label>
                        <input id="desde" class="form-control" type="date">
                    </div>&nbsp;
                    <div class="form-group">
                        <label for="hasta">Hasta</label>
                        <input id="hasta" class="form-control" type="date">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle nowrap" id="tblHistorial" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Serie</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <!-- <th>Total</th> -->
                                <th>Proveedor</th>
                                <th>Hora</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>

            <!-- INICIO EVALUACIÓN -->
            <div class="tab-pane fade p-3" id="nav-editar" role="tabpanel" aria-labelledby="nav-editar-tab" tabindex="0">
                <form id="formulario" autocomplete="off">
                    <input type="hidden" id="id" name="id">
                    <div class="row mb-3">
                        <div class="col-md-3 mb-3">
                            <label for="serieEditar">Serie <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <input class="form-control" type="number" name="serieEditar" id="serieEditar" placeholder="Serie de Compra">
                            </div>
                            <span id="errorSerie" class="text-danger"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nombreEditar">Nombre <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <input class="form-control" type="text" name="nombreEditar" id="nombreEditar" placeholder="Nombre">
                            </div>
                            <span id="errorNombre" class="text-danger"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cantidad">Cantidad</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input class="form-control" type="text" name="cantidad" id="cantidad" placeholder="Cantidad">
                            </div>
                            <span id="errorCantidad" class="text-danger"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="proveedor">Proveedor</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input class="form-control" type="text" name="proveedor" id="proveedor" placeholder="Proveedor">
                            </div>
                            <span id="errorProveedor" class="text-danger"></span>
                        </div>
                        <?php $fecha = date('Y-m-d'); ?>
                        <div class="col-md-3 mb-3">
                            <label for="fechaActual">Fecha</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input class="form-control" type="date" name="fechaActual" id="fechaActual" value="<?php echo $fecha; ?>" placeholder="Fecha">
                            </div>
                            <span id="errorFecha" class="text-danger"></span>
                        </div>
                        <?php $hora = date('h:i:s A'); ?>
                        <div class="col-md-3 mb-3">
                            <label for="horaActual">Hora</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input class="form-control" type="datetime" name="horaActual" id="horaActual" value="<?php echo $hora; ?>" placeholder="Hora">
                            </div>
                            <span id="errorHora" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="text-end">
                        <!-- <button class="btn btn-danger" type="button" id="btnNuevo">Nuevo</button> -->
                        <button class="btn btn-primary" type="submit" id="btnActualizar">Actualizar</button>
                    </div>
                </form>
            </div>
            <!-- FIN EVALUACIÓN -->
        </div>
    </div>
</div>

<?php include_once 'views/templates/footer.php'; ?>