<?php include_once 'views/templates/header.php'; ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title text-center">Stock en Almacén Inactivos</h5>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover nowrap" id="tblAlmacen" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Razón</th>
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
</div>

<?php include_once 'views/templates/footer.php'; ?>