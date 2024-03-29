<?php include_once 'views/templates/header.php'; ?>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div></div>
            <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo BASE_URL . 'tpi/inactivos'; ?>"><i class="fas fa-trash text-danger"></i> Inactivos</a>
                    </li>
                </ul>
            </div>
        </div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-tpi-tab" data-bs-toggle="tab" data-bs-target="#nav-tpi" type="button" role="tab" aria-controls="nav-tpi" aria-selected="true">Indicador</button>
                <button class="nav-link" id="nav-nuevo-tab" data-bs-toggle="tab" data-bs-target="#nav-nuevo" type="button" role="tab" aria-controls="nav-nuevo" aria-selected="false">Nuevo</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active mt-3" id="nav-tpi" role="tabpanel" aria-labelledby="nav-tpi-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-tags"></i> Tasa de Precisión de Inventario</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover nowrap" id="tblTpi" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Resultado</th>
                                <th>Cantidad</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade p-3" id="nav-nuevo" role="tabpanel" aria-labelledby="nav-nuevo-tab" tabindex="0">
                <form id="formulario" autocomplete="off">
                    <input type="hidden" id="id" name="id">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="codigo">Buscar Por Código</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input class="form-control" type="text" name="codigo" id="codigo" placeholder="Buscar Producto por Código">
                            </div>
                            <span class="text-danger fw-bold mb-2" id="errorCodigo"></span>
                        </div>

                        <div class="col-md-7">
                            <label for="descripcion"> Nombre del Producto <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-box"></i></span>
                                <input class="form-control" type="text" name="descripcion" id="descripcion" placeholder="Descripción del Producto" readonly>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="stock"> Cantidad en el Sistema <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <input class="form-control" type="number" name="stock" id="stock" placeholder="Stock en Sistema" readonly>
                            </div>
                        </div>

                        <div class="col-md-2 mt-3">
                            <label for="cantidad"> Cantidad Actual <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <input class="form-control" type="number" name="cantidad" id="cantidad" placeholder="Cantidad">
                            </div>
                            <span id="errorCantidad_Actual" class="text-danger"></span>
                        </div>

                        <div class="col-md-3 mt-3">
                            <label for="tpi">Tasa de Presición de Inventario <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <input class="form-control" type="number" name="tpi" id="tpi" placeholder="TPI" readonly>
                            </div>
                        </div>

                        <div class="col-md-7 mt-4 text-end">
                            <button class="btn btn-danger" type="button" id="btnNuevo">Nuevo</button>
                            <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/templates/footer.php'; ?>