<?php include_once 'views/templates/header.php'; ?>

<div class="card">
    <div class="card-body">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-inventarios-tab" data-bs-toggle="tab" data-bs-target="#nav-inventarios" type="button" role="tab" aria-controls="nav-inventarios" aria-selected="true">Inventario</button>
                <button class="nav-link" id="nav-kardex-tab" data-bs-toggle="tab" data-bs-target="#nav-kardex" type="button" role="tab" aria-controls="nav-kardex" aria-selected="false">Kardex</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active mt-2" id="nav-inventarios" role="tabpanel" aria-labelledby="nav-inventarios-tab" tabindex="0">
                <div class="alert alert-info border-0 bg-info alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="font-35 text-white"><i class='fas fa-check-circle'></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 text-white">MOVIMIENTOS DE LOS PRODUCTOS</h6>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <label for="mes">Mes Inventario</label>
                <div class="d-flex mb-2">
                    <div class="form-group">
                        <input id="mes" class="form-control" type="month">
                    </div>
                    <div>
                        <button class="btn btn-primary" type="button" id="btnBuscar"><i class="fas fa-search"></i></button>
                        <button class="btn btn-danger" type="button" id="btnReporte"><i class="fas fa-file-pdf"></i></button>
                        <button class="btn btn-info" type="button" id="btnAjuste"><i class="fas fa-cog"></i></button>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle nowrap" id="tblInventario" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Movimiento</th>
                                <th>Fecha</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade p-3" id="nav-kardex" role="tabpanel" aria-labelledby="nav-kardex-tab" tabindex="0">

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
                    <input class="form-control" type="text" id="buscarProductoCodigo" placeholder="Ingrese Barcode - Enter" autocomplete="off">
                    <span class="input-group-text"><button class="btn btn-danger" type="button"><i class="fas fa-file-pdf"></i></button></span>
                </div>

                <!-- input para buscar nombre -->
                <div class="input-group d-none mb-2" id="containerNombre">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input class="form-control" type="text" id="buscarProductoNombre" placeholder="Buscar Producto" autocomplete="off">
                    <span class="input-group-text"><button class="btn btn-danger" type="button"><i class="fas fa-file-pdf"></i></button></span>
                </div>
                <span class="text-danger fw-bold mb-2" id="errorBusqueda">
            </div>
        </div>

    </div>
</div>

<div id="modalAjuste" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajuste de Inventario</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="alert border-0 border-start border-5 border-primary alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="font-35 text-primary"><i class='bx bx-bookmark-heart'></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 text-primary">INGRESE NUMERO NEGATIVO SI DESEA DESCONTAR</h6>
                            <hr>
                            <h6 class="mb-0 text-primary">INGRESE NUMERO POSITIVO SI DESEA AUMENTAR</h6>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <input type="hidden" id="idProductoAjuste">
                <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                    <label class="btn btn-dark">
                        <input type="radio" id="barcodeAjuste" name="radioAjuste" checked> <i class="fas fa-barcode"></i> Barcode
                    </label>
                    <label class="btn" style="background: #cccc;">
                        <input type="radio" id="nombreAjuste" name="radioAjuste"> <i class="fas fa-list"></i> Nombre
                    </label>
                </div>

                <div>
                    <!-- input para buscar codigo -->
                    <div class="input-group mb-2" id="containerCodigoAjuste">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input class="form-control" type="text" id="buscarCodigoAjuste" placeholder="Ingrese Barcode - Enter" autocomplete="off">
                    </div>

                    <!-- input para buscar nombre -->
                    <div class="input-group d-none mb-2" id="containerNombreAjuste">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input class="form-control" type="text" id="buscarNombreAjuste" placeholder="Buscar Producto" autocomplete="off">
                    </div>
                    <span class="text-danger fw-bold mb-2" id="errorBusquedaAjuste">
                </div>
                <label for="cantidadAjuste">Ajuste - / +</label>
                <div class="d-flex justify-content-between">
                    <div class="form-group">
                        <input id="cantidadAjuste" class="form-control" type="number" placeholder="Cantidad">
                    </div>
                    <button class="btn btn-primary" type="button" id="btnProcesar">Procesar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/templates/footer.php'; ?>