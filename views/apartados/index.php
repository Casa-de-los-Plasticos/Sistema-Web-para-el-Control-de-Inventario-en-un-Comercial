<?php include_once 'views/templates/header.php'; ?>

<div class="card">
    <div class="card-body">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-apartados-tab" data-bs-toggle="tab" data-bs-target="#nav-apartados" type="button" role="tab" aria-controls="nav-apartados" aria-selected="true">Apartados</button>
                <button class="nav-link" id="nav-historial-tab" data-bs-toggle="tab" data-bs-target="#nav-historial" type="button" role="tab" aria-controls="nav-historial" aria-selected="false">Historial</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active p-3" id="nav-apartados" role="tabpanel" aria-labelledby="nav-apartados-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-list-alt"></i> Nuevo Apartado</h5>
                <hr>
                <div id='calendar'></div>
                <input type="hidden" id="fechaActual" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="tab-pane fade p-3" id="nav-historial" role="tabpanel" aria-labelledby="nav-historial-tab" tabindex="0">
                <div class="d-flex justify-content-center mb-3">
                    <div class="form-group">
                        <label for="desde">Desde</label>
                        <input id="desde" class="form-control" type="date">
                    </div>
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
                                <th>Cliente</th>
                                <th>Abono</th>
                                <th>Total</th>
                                <th>Fecha Apartado</th>
                                <th>Fecha retiro</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="modalApartado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apartar Productos</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                            <label class="btn btn-dark">
                                <input type="radio" id="barcode" checked name="buscarProducto"> <i class="fas fa-barcode"></i> Barcode
                            </label>
                            <label class="btn" style="background: #cccc;">
                                <input type="radio" id="nombre" name="buscarProducto"> <i class="fas fa-list"></i> Nombre
                            </label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <!-- input para buscar codigo -->
                        <div class="input-group mb-2" id="containerCodigo">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input class="form-control" type="text" id="buscarProductoCodigo" placeholder="Ingrese Barcode - Enter" autocomplete="off">
                        </div>

                        <!-- input para buscar nombre -->
                        <div class="input-group d-none mb-2" id="containerNombre">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input class="form-control" type="text" id="buscarProductoNombre" placeholder="Buscar Producto" autocomplete="off">
                        </div>
                    </div>

                    <span class="text-danger fw-bold mb-2" id="errorBusqueda"></span>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle" id="tblNuevoApartado" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>SubTotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <hr>

                <div class="row justify-content-between">
                    <div class="col-md-4">
                        <div>
                            <label>Buscar Cliente</label>
                            <div class="input-group mb-2">
                                <input type="hidden" id="idCliente">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input class="form-control" type="text" id="buscarCliente" placeholder="Buscar Cliente">
                            </div>
                            <span class="text-danger fw-bold mb-2" id="errorCliente"></span>
                        </div>

                        <label>Telefono</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input class="form-control" type="text" id="telefonoCliente" placeholder="Telefono" disabled>
                        </div>

                        <label>Dirección</label>
                        <ul class="list-group">
                            <li class="list-group-item" id="direccionCliente"><i class="fas fa-home"></i></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <label>Vendedor</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input class="form-control" type="text" value="<?php echo $_SESSION['nombre_usuario']; ?>" placeholder="Vendedor" disabled>
                        </div>

                        <label>Total a Pagar</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            <input class="form-control" type="text" id="totalPagar" placeholder="Total Pagar" disabled>
                        </div>

                        <label>Fecha Apartado</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input class="form-control" type="date" id="fecha_apartado" min="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label>Fecha Retiro</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input class="form-control" type="date" id="fecha_retiro">
                        </div>

                        <label>Abono</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            <input class="form-control" type="number" step="0.01" min="0.01" id="abono" placeholder="Abono">
                        </div>

                        <label>Color</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-fill-drip"></i></span>
                            <input class="form-control" type="color" id="color">
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-outline-primary" type="button" id="btnAccion">Completar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalEntrega" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Procesar Entrega</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idApartado">
                <label>Cliente</label>
                <div class="input-group mb-2">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                    <input class="form-control" type="text" id="clienteApartado" disabled>
                </div>
                <label>Monto Abonado</label>
                <div class="input-group mb-2">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    <input class="form-control" type="text" id="monto_abonado" disabled>
                </div>
                <label>Monto Total</label>
                <div class="input-group mb-2">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    <input class="form-control" type="text" id="monto_total" disabled>
                </div>
                <label>Monto Pendiente</label>
                <div class="input-group mb-2">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    <input class="form-control" type="text" id="monto_pendiente" disabled>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary" type="button" id="btnProcesar">Procesar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/templates/footer.php'; ?>