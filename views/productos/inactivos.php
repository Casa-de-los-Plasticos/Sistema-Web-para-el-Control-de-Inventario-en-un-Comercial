<?php include_once 'views/templates/header.php'; ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title text-center">Productos Inactivos</h5>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover nowrap" id="tblProductos" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>P. Compra</th>
                        <th>P. Venta</th>
                        <th>Stock</th>
                        <th>Medida</th>
                        <th>Categoria</th>
                        <th>Proveedor</th>
                        <th>Ubicación</th>
                        <th>Foto</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once 'views/templates/footer.php'; ?>