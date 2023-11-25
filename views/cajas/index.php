<?php include_once 'views/templates/header.php'; ?>

<div class="card">
    <div class="card-body">
        <div class="alert alert-<?php echo (!empty($data['caja'])) ? 'success' : 'danger'; ?> border-0 bg-<?php echo (!empty($data['caja'])) ? 'success' : 'danger'; ?> alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="font-35 text-white">
                    <!-- <i class="bx bxs-check-circle"></i> -->
                    <?php if (!empty($data['caja'])) {
                        echo '<i class="fas fa-unlock"></i>';
                    } else {
                        echo '<i class="fas fa-lock"></i>';
                    } ?>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-white">
                        <?php if (!empty($data['caja'])) {
                            echo 'CAJA ABIERTA';
                        } else {
                            echo 'CAJA CERRADA';
                        } ?></h6>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <hr>
        <div class="d-flex align-items-center">
            <div>
                <h5 class="card-title text-center"><i class="fas fa-box"></i> Historial Cajas</h5>
            </div>
            <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                </a>
                <ul class="dropdown-menu">
                    <?php if (empty($data['caja'])) { ?>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalCaja"><i class="fas fa-box"></i> Abrir Caja</a>
                        </li>
                    <?php } else { ?>
                        <li><a class="dropdown-item" href="#" onclick="cerrarCaja()"><i class="fas fa-lock"></i> Cerrar Caja</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php if (!empty($data['caja'])) { ?>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-apertura-tab" data-bs-toggle="tab" data-bs-target="#nav-apertura" type="button" role="tab" aria-controls="nav-apertura" aria-selected="true">Apertura y Cierre</button>
                    <button class="nav-link" id="nav-nuevo-tab" data-bs-toggle="tab" data-bs-target="#nav-nuevo" type="button" role="tab" aria-controls="nav-nuevo" aria-selected="false">Nuevo Gasto</button>
                    <button class="nav-link" id="nav-historial-tab" data-bs-toggle="tab" data-bs-target="#nav-historial" type="button" role="tab" aria-controls="nav-historial" aria-selected="false">Historial Gastos</button>
                    <button class="nav-link" id="nav-movimientos-tab" data-bs-toggle="tab" data-bs-target="#nav-movimientos" type="button" role="tab" aria-controls="nav-movimientos" aria-selected="false">Movimientos</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active mt-3" id="nav-apertura" role="tabpanel" aria-labelledby="nav-apertura-tab" tabindex="0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle nowrap" id="tblAperturaCierre" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Monto Inicial</th>
                                    <th>Fecha Apertura</th>
                                    <th>Fecha Cierre</th>
                                    <th>Monto Final</th>
                                    <th>Total Ventas</th>
                                    <th>Usuario</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade p-3" id="nav-nuevo" role="tabpanel" aria-labelledby="nav-nuevo-tab" tabindex="0">
                    <form id="formulario">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" id="id">
                                <label>Monto <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    <input class="form-control" type="number" step="0.01" min="0.01" id="monto" name="monto" placeholder="Monto">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="descripcion">Descripcion <span class="text-danger">*</span></label>
                                    <textarea id="descripcion" class="form-control" name="descripcion" rows="3" placeholder="Descripción"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="foto">Foto (Opcional)</label>
                                    <input id="foto" class="form-control" type="file" name="foto">
                                </div>
                                <div id="containerPreview">

                                </div>
                            </div>
                        </div>
                        <div class="float-end">
                            <button class="btn btn-primary" type="submit" id="btnRegistrarGasto">Registrar</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade p-3" id="nav-historial" role="tabpanel" aria-labelledby="nav-historial-tab" tabindex="0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle nowrap" id="tblGastos" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Monto</th>
                                    <th>Descripción</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade p-3" id="nav-movimientos" role="tabpanel" aria-labelledby="nav-movimientos-tab" tabindex="0">
                    <div class="d-flex align-items-center">
                        <div></div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo BASE_URL . 'cajas/reporte'; ?>" target="_blank"><i class="fas fa-file-pdf text-danger"></i> Reporte</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="chart-container-1">
                        <canvas id="reporteMovimiento"></canvas>
                    </div>
                    <ul class="list-group list-group-flush" id="listaMovimientos"></ul>
                </div>
            </div>

        <?php } ?>
    </div>
</div>

<div id="modalCaja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Abrir Caja</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <label>Monto Inicial</label>
                <div class="input-group mb-2">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    <input class="form-control" type="text" id="monto_inicial" placeholder="Monto Inicial">
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary" type="button" id="btnAbrirCaja">Abrir</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/templates/footer.php'; ?>