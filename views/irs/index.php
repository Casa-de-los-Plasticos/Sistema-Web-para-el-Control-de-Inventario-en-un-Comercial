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
                <button class="nav-link active" id="nav-irs-tab" data-bs-toggle="tab" data-bs-target="#nav-irs" type="button" role="tab" aria-controls="nav-irs" aria-selected="true">Indicador</button>
                <button class="nav-link" id="nav-graficos-tab" data-bs-toggle="tab" data-bs-target="#nav-graficos" type="button" role="tab" aria-controls="nav-graficos" aria-selected="false">Gráfico</button>
                <button class="nav-link" id="nav-nuevo-tab" data-bs-toggle="tab" data-bs-target="#nav-nuevo" type="button" role="tab" aria-controls="nav-nuevo" aria-selected="false">Nuevo</button>
                <button class="nav-link" id="nav-lunes-tab" data-bs-toggle="tab" data-bs-target="#nav-lunes" type="button" role="tab" aria-controls="nav-lunes" aria-selected="false">Lunes</button>
                <button class="nav-link" id="nav-viernes-tab" data-bs-toggle="tab" data-bs-target="#nav-viernes" type="button" role="tab" aria-controls="nav-viernes" aria-selected="false">Viernes</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active mt-3" id="nav-irs" role="tabpanel" aria-labelledby="nav-irs-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-tags"></i> Índice de Rotación de Stock</h5>
                <hr>
                <!-- <form id="formulario" autocomplete="off"> -->
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
                <!-- </form> -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover nowrap" id="tblIrs" style="width: 100%;">
                        <thead>
                            <tr>
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
                                        <h6 class="mb-0">ÍNDICE DE ROTACIÓN DE STOCK PRE TEST</h6>
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
                                        <h6 class="mb-0">ÍNDICE DE ROTACIÓN DE STOCK POST TEST</h6>
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
                <form id="formularioIrs" autocomplete="off">
                    <input type="hidden" id="id" name="id">
                    <div class="row mb-3">
                        <h5 class="card-title text-center"><i class="fas fa-tags"></i> Índice de Rotación de Stock</h5>
                        <hr>
                        <div class="col-md-12">
                            <label for="nombre">Buscar Por Descripción del Producto</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Buscar Por Descripción del Producto">
                            </div>
                            <span class="text-danger fw-bold mb-2" id="errorNombre"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fecha_inicial">Fecha Inicio</label>
                                <input id="fecha_inicial" name="fecha_inicial" class="form-control" type="date">
                            </div>
                            <span class="text-danger fw-bold mb-2" id="errorFechaInicial"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fecha_final">Fecha Fin</label>
                                <input id="fecha_final" name="fecha_final" class="form-control" type="date">
                            </div>
                            <span class="text-danger fw-bold mb-2" id="errorFechaFinal"></span>
                        </div>

                        <div class="col-md-2">
                            <label for="SumaTotalSalidas">Suma de Salidas<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <input class="form-control" type="number" name="SumaTotalSalidas" id="SumaTotalSalidas" placeholder="STS" readonly>
                            </div>
                        </div>

                        <div class="col-md-2 text-end">
                            <label>&nbsp;</label>
                            <div>
                                <button class="btn btn-danger" type="button" id="btnConsultar">Calcular</button>
                            </div>
                        </div>

                        <label>&nbsp;</label>
                        <hr>

                        <div class="col-md-4">
                            <label for="cantidadInicialNuevo"> Cantidad Inicial <span class="text-danger">*</span>(<a href="#" class="text-danger" style="font-weight: bold;">Stock de Lunes</a> )</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1"></i></span>
                                <input class="form-control" type="number" name="cantidadInicialNuevo" id="cantidadInicialNuevo" placeholder="Cantidad Inicial">
                            </div>
                            <span id="errorcantidadInicialNuevo" class="text-danger"></span>
                        </div>

                        <div class="col-md-4">
                            <label for="cantidadFinalNuevo"> Cantidad Final <span class="text-danger">*</span> (<a href="#" class="text-danger" style="font-weight: bold;">Stock de Viernes</a> )</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1"></i></span>
                                <input class="form-control" type="number" name="cantidadFinalNuevo" id="cantidadFinalNuevo" placeholder="Stock Actual">
                            </div>
                            <span id="errorcantidadFinalNuevo" class="text-danger"></span>
                        </div>

                        <div class="col-md-2">
                            <label for="cantidadMediaNuevo">Cantidad Media <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1"></i></span>
                                <input class="form-control" type="number" name="cantidadMediaNuevo" id="cantidadMediaNuevo" placeholder="Cantidad Media de Stock" readonly>
                            </div>
                            <span id="errorcantidadMediaNuevo" class="text-danger"></span>
                        </div>

                        <div class="col-md-2 text-end">
                            <label>&nbsp;</label>
                            <div>
                                <button class="btn btn-danger" type="button" id="btnCalcularNuevo">Calcular</button>
                            </div>
                        </div>

                        &nbsp;
                        <hr>

                        <div class="col-md-4">
                            <label for="irsNuevo">índice de Rotación de Stock <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-location-crosshairs"></i></span>
                                <input class="form-control" type="number" name="irsNuevo" id="irsNuevo" placeholder="IRS" readonly>
                            </div>
                        </div>

                        <div class="col-md-8 text-end">
                            <label>&nbsp;</label>
                            <div>
                                <button class="btn btn-danger rounded-pill" type="button" id="btnCalcularIrs">Calcular</button>
                                <button class="btn btn-warning rounded-pill" type="button" id="btnLimpiar">Nuevo</button>
                                <button class="btn btn-primary rounded-pill" type="submit" id="btnGuardar">Registrar</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="tab-pane fade p-3" id="nav-lunes" role="tabpanel" aria-labelledby="nav-lunes-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-users"></i> Stock de Lunes</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle nowrap" id="tblLunes" style="width: 100%;">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade p-3" id="nav-viernes" role="tabpanel" aria-labelledby="nav-viernes-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-users"></i> Stock de Viernes</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle nowrap" id="tblViernes" style="width: 100%;">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Fecha</th>
                                <th>Hora</th>
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

<?php include_once 'views/templates/footer.php'; ?>