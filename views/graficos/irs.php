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
                <button class="nav-link active" id="nav-tpi-tab" data-bs-toggle="tab" data-bs-target="#nav-tpi" type="button" role="tab" aria-controls="nav-tpi" aria-selected="true">Gráfico TPI</button>
                <button class="nav-link" id="nav-irs-tab" data-bs-toggle="tab" data-bs-target="#nav-irs" type="button" role="tab" aria-controls="nav-irs" aria-selected="false">Gráfico IRS</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane show active fade p-3" id="nav-tpi" role="tabpanel" aria-labelledby="nav-tpi-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-users"></i> TPI </h5>
                <hr>
                <!-- apartado prueba - PRE TEST -->
                <div class="col-12 col-lg-12">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="form-control d-flex justify-content-between align-items-center">
                                <div class="">
                                    <h6 class="mb-0">TASA DE PRECISIÓN DE INVENTARIO - CONSOLIDADO - PRE TEST</h6>
                                </div>
                                <div class="form-group">
                                    <label for="groupSelectIRSPreTest" style="display: inline-block;">Seleccionado:</label>
                                    <select id="groupSelectIRSPreTest" onchange="showChartIRSPreTest()" style="display: inline-block; padding: 6px 12px; font-size: 16px; font-weight: 400; color: #212529; background-color: #fff; border: 1px solid #ced4da; border-radius: 4px; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;">
                                        <?php
                                        $dbHost = 'localhost';
                                        $dbUser = 'root';
                                        $dbPassword = '';
                                        $dbName = 'almacent';

                                        $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

                                        if ($conn->connect_error) {
                                            die("Conexión fallida: " . $conn->connect_error);
                                        }

                                        $sql = "SELECT descripcion, resultado FROM consolidado_tpi WHERE fecha = '2023-07-08'"; // Reemplaza "tu_tabla" por el nombre real de tu tabla
                                        $result = $conn->query($sql);

                                        $data = array();

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $data[] = array($row["descripcion"], $row["resultado"]);
                                            }
                                        }

                                        $groupedData = array_chunk($data, 15);

                                        foreach ($groupedData as $key => $group) {
                                            echo "<option value='$key'>GRUPO " . ($key + 1) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-control chart-container-2 mt-2">
                                <!-- Aquí puedes cargar tus gráficos para IRS - PRE TEST -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade p-3" id="nav-irs" role="tabpanel" aria-labelledby="nav-irs-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-users"></i> IRS </h5>
                <hr>
                <!-- apartado prueba - POST TEST -->
                <div class="col-12 col-lg-12">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="form-control d-flex justify-content-between align-items-center">
                                <div class="">
                                    <h6 class="mb-0">TASA DE PRECISIÓN DE INVENTARIO - CONSOLIDADO - POST TEST</h6>
                                </div>
                                <div class="form-group">
                                    <label for="groupSelectIRSPostTest" style="display: inline-block;">Seleccionado:</label>
                                    <select id="groupSelectIRSPostTest" onchange="showChartIRSPostTest()" style="display: inline-block; padding: 6px 12px; font-size: 16px; font-weight: 400; color: #212529; background-color: #fff; border: 1px solid #ced4da; border-radius: 4px; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;">
                                        <!-- Aquí puedes cargar las opciones específicas para IRS - POST TEST -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-control chart-container-2 mt-2">
                                <!-- Aquí puedes cargar tus gráficos para IRS - POST TEST -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/templates/footer.php'; ?>