<?php include_once 'views/templates/header.php'; ?>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div></div>
            <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo BASE_URL . 'categorias/inactivos'; ?>"><i class="fas fa-trash text-danger"></i> Inactivos</a>
                    </li>
                </ul>
            </div>
        </div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-tpiconsolidado-tab" data-bs-toggle="tab" data-bs-target="#nav-tpiconsolidado" type="button" role="tab" aria-controls="nav-tpiconsolidado" aria-selected="true">Indicador</button>
                <button class="nav-link" id="nav-graficos-tab" data-bs-toggle="tab" data-bs-target="#nav-graficos" type="button" role="tab" aria-controls="nav-graficos" aria-selected="false">Gráfico</button>
                <button class="nav-link" id="nav-nuevo-tab" data-bs-toggle="tab" data-bs-target="#nav-nuevo" type="button" role="tab" aria-controls="nav-nuevo" aria-selected="false">Nuevo</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade fade show active p-3" id="nav-tpiconsolidado" role="tabpanel" aria-labelledby="nav-tpiconsolidado-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-tags"></i> Tasa de Precisión de Inventario - Consolidado</h5>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-12 mb-3">
                        <label for="descripcionProducto">Nombre del Producto <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-box"></i></span>
                            <input class="form-control" type="text" id="descripcionProducto" placeholder="Descripción del Producto">
                        </div>
                        <span class="text-danger fw-bold mb-2" id="errorDescripcionProducto"></span>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="desde">Fecha Inicio</label>
                            <input id="desde" class="form-control" type="date">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hasta">Fecha Fin</label>
                            <input id="hasta" class="form-control" type="date">
                        </div>
                    </div>

                    <div class="col-md-4 text-end mt-3">
                        <label for="">&nbsp;</label>
                        <button class="btn btn-primary" type="button" id="btnMostrar"><span><i class="fas fa-eye"></i></span> Mostrar </button>
                        <button class="btn btn-warning" type="submit" id="btnBorrar"><span><i class="fas fa-trash"></i></span> Limpiar</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle nowrap" id="tblTpiConsolidados" style="width: 100%;">
                        <thead>
                            <tr>
                                <!-- <th>Código</th> -->
                                <th>Descripción</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Resultado</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="tab-pane fade fade p-3" id="nav-graficos" role="tabpanel" aria-labelledby="nav-graficos-tab" tabindex="0">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="form-control d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">TASA DE PRESICIÓN DE INVENTARIO PRE TEST</h6>
                                    </div>
                                    <div class="dropdown ms-auto">
                                        <i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </div>
                                </div>
                                <div class="form-control hart-container-2 mt-2">
                                    <canvas id="barChart"></canvas>
                                </div>
                                <div style="padding-top: 15px;">
                                    <div class="pagination">
                                        <button class="form-control" type="button" id="prevPage">Anterior</button>
                                        <button class="form-control" type="button" id="nextPage">Siguiente</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="form-control d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">TASA DE PRESICIÓN DE INVENTARIO POST TEST</h6>
                                    </div>
                                    <div class="dropdown ms-auto">
                                        <i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </div>
                                </div>
                                <div class="form-control hart-container-2 mt-2">
                                    <canvas id="barChartPost"></canvas>
                                </div>
                                <div style="padding-top: 15px;">
                                    <div class="pagination">
                                        <button class="form-control" type="button" id="prevPagePost">Anterior</button>
                                        <button class="form-control" type="button" id="nextPagePost">Siguiente</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade p-3" id="nav-nuevo" role="tabpanel" aria-labelledby="nav-nuevo-tab" tabindex="0">
                <form id="consultaForm" autocomplete="off">
                    <input type="hidden" id="id" name="id">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="codigo">Buscar Por Código <span class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input class="form-control" type="text" name="codigo" id="codigo" placeholder="Buscar Producto por Código">
                            </div>
                            <span class="text-danger fw-bold mb-2" id="errorCodigo"></span>
                        </div>

                        <div class="col-md-4">
                            <label for="descripcion">Nombre del Producto <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-box"></i></span>
                                <input class="form-control" type="text" name="descripcion" id="descripcion" placeholder="Descripción del Producto" readonly>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="fecha_inicial">Fecha Inicio <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                                <input class="form-control" type="date" name="fecha_inicial" id="fecha_inicial" placeholder="Código">
                            </div>
                            <span id="errorFechaInicio" class="text-danger"></span>
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_final">Fecha Fin <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                                <input class="form-control" type="date" name="fecha_final" id="fecha_final" placeholder="Código">
                            </div>
                            <span id="errorFechaFin" class="text-danger"></span>
                        </div>

                        <div class="col-md-3 mt-2" style="font-size: 12px;" >
                            <label for="tpi">Tasa de Presición de Inventario <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <input class="form-control" type="number" name="tpi" id="tpi" placeholder="TPI" readonly>
                            </div>
                        </div>

                        <div class="col-md-4 text-end" style="margin-top: 4px;">
                            <label for="">&nbsp;</label>
                            <div class="input-group">
                                <button class="btn btn-danger" type="button" id="btnConsultar">Calcular</button>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-danger" type="button" id="btnNuevo">Nuevo</button>
                            <button class="btn btn-primary" type="submit" id="btnGuardar">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php include_once 'views/templates/footer.php'; ?>