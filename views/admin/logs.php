<?php include_once 'views/templates/header.php'; ?>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div></div>
            <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" id="btnLimpiar"><i class="fas fa-trash text-danger"></i> Limpiar Datos</a>
                    </li>
                </ul>
            </div>
        </div>
        <h5 class="card-title text-center">Datos de Acceso</h5>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle nowrap" id="tblLogs" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Ip</th>
                        <th>Detalle</th>
                        <th>Fecha</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once 'views/templates/footer.php'; ?>