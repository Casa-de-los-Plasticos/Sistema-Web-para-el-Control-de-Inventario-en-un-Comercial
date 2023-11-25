<?php include_once 'views/templates/header.php'; ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title text-center">Usuarios Inactivos</h5>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover nowrap" id="tblUsuarios" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Rol</th>
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