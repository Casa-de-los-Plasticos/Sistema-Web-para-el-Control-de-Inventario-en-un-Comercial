<?php include_once 'views/templates/header.php'; ?>

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0"> Usuarios </p>
                        <h4 class="my-1 text-info"><?php echo $data['usuarios']['total']; ?></h4>
                        <a class="mb-0 font-13 text-primary" href="<?php echo BASE_URL . 'usuarios'; ?>">Detalle</a>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                        <i class='fas fa-user'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0"> Transportistas </p>
                        <h4 class="my-1 text-danger"><?php echo $data['clientes']['total']; ?></h4>
                        <a class="mb-0 font-13 text-danger" href="<?php echo BASE_URL . 'clientes'; ?>">Detalle</a>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='fas fa-users'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0"> Proveedores </p>
                        <h4 class="my-1 text-success"><?php echo $data['proveedores']['total']; ?></h4>
                        <a class="mb-0 font-13 text-success" href="<?php echo BASE_URL . 'proveedor'; ?>">Detalle</a>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                        <i class='fas fa-home'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0"> Productos </p>
                        <h4 class="my-1 text-warning"><?php echo $data['productos']['total']; ?></h4>
                        <a class="mb-0 font-13 text-warning" href="<?php echo BASE_URL . 'productos'; ?>">Detalle</a>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                        <i class='fas fa-list'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-lg-12" hidden>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0"><strong> Gráfico </strong><i> Estadístico Usuarios </i></h6>
                </div>
            </div>
            <div class="chart-container" id="donut-container">
                <div id="chartdiv"></div>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($data['usuario'] as $usuarios) { ?>
                <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                    <?php echo $usuarios['nombre'] ?>
                    <span class="badge bg-dark rounded-pill">
                        <?php echo $usuarios['activos'] == 1 ? 'Activo' : 'Inactivo' ?>
                    </span>
                </li>
            <?php } ?>
        </ul>

        <!-- Styles -->
        <style>
            #chartdiv {
                width: 100%;
                max-width: 100%;
                height: 500px;
            }
        </style>
    </div>
</div>

<div class="row" hidden>
    <div class="col-12 col-lg-3">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0"><strong> Gráfico </strong><i> Estadístico Usuarios </i></h6>
                    </div>
                </div>
                <div class="chart-container" id="donut-container">
                    <div id="donutUsuarios" style="height: 150px;"></div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($data['usuario'] as $usuarios) { ?>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        <?php echo $usuarios['nombre'] ?>
                        <span class="badge bg-dark rounded-pill">
                            <?php echo $usuarios['activos'] == 1 ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </li>
                <?php } ?>
            </ul>

        </div>
    </div>

    <div class="col-12 col-lg-3">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0"><strong> Gráfico </strong><i> Estadístico Transportistas </i></h6>
                    </div>
                </div>
                <div class="chart-container" id="donut-container">
                    <div id="donutTransportistas" style="height: 150px;"></div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($data['transportistas'] as $transportista) { ?>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        <?php echo $transportista['nombre'] ?>
                        <span class="badge bg-dark rounded-pill">
                            <?php echo $transportista['activos'] == 1 ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </li>
                <?php } ?>
            </ul>

        </div>
    </div>

    <div class="col-12 col-lg-3">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0"><strong> Gráfico </strong><i> Estadístico Proveedores </i></h6>
                    </div>
                </div>
                <div class="chart-container" id="donut-container">
                    <div id="donutProveedores" style="height: 150px;"></div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($data['proveedor'] as $proveedores) { ?>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        <?php echo $proveedores['nombre'] ?>
                        <span class="badge bg-dark rounded-pill">
                            <?php echo $proveedores['activos'] == 1 ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </li>
                <?php } ?>
            </ul>

        </div>
    </div>

    <div class="col-12 col-lg-3">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0"><strong> Gráfico </strong><i> Estadístico Productos </i></h6>
                    </div>
                </div>
                <div class="chart-container" id="donut-container">
                    <div id="donutProductos" style="height: 150px;"></div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($data['producto'] as $productos) { ?>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        <?php echo $productos['descripcion'] ?> <span class="badge bg-dark rounded-pill"><?php echo $productos['cantidad'] ?></span>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card radius-10">
            <div class="card-body">
                <div class="form-control d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">TASA DE PRESICIÓN DE INVENTARIO</h6>
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

    <!-- Gráfico IRS -->
    <div class="col-12 col-lg-6">
        <div class="card radius-10">
            <div class="card-body">
                <div class="form-control d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">ÍNDICE DE ROTACIÓN DE STOCK</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                    </div>
                </div>
                <div class="form-control hart-container-2 mt-2">
                    <canvas id="barChartIRS"></canvas>
                </div>
                <div style="padding-top: 15px;">
                    <div class="pagination">
                        <button class="form-control" type="button" id="prevPageIRS">Anterior</button>
                        <button class="form-control" type="button" id="nextPageIRS">Siguiente</button>
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
                        <h6 class="mb-0">LISTADO DE PRODUCTOS</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                    </div>
                </div>
                <div class="form-control hart-container-2 mt-2">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover nowrap" id="tblProductosHome" style="width: 100%;">
                            <thead style="max-width:500px">
                                <!-- <p class="card-title text-start"><b>Precio de Compra y Venta son Referenciales</b> </p> -->
                                <tr>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <!-- <th>P. Compra</th> -->
                                    <!-- <th>P. Venta</th> -->
                                    <th>Stock</th>
                                    <th>Medida</th>
                                    <th>Categoria</th>
                                    <th>Proveedor</th>
                                    <th>Ubicación</th>
                                    <!-- <th>Foto</th> -->
                                    <!-- <th></th> -->
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

</div>
<!--end row-->

<?php include_once 'views/templates/footer.php'; ?>