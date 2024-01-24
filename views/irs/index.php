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
 
                        <div class="col-md-5">
                            <label for="descripcion">Nombre del Producto <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-box"></i></span>
                                <input class="form-control" type="text" name="descripcion" id="descripcion" placeholder="Descripción del Producto" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="fecha_inicio">Fecha Inicio <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                                <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio" placeholder="Código">
                            </div>
                            <span id="errorFehcaInicio" class="text-danger"></span>
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_fin">Fecha Fin <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                                <input class="form-control" type="date" name="fecha_fin" id="fecha_fin" placeholder="Código">
                            </div>
                            <span id="errorFechaFinal" class="text-danger"></span>
                        </div>
                        <div class="col-md-3 text-center">
                            <label for=""></label>
                            <br>
                            <button class="btn btn-primary" type="button" id="btnNuevo"><span><i class="fas fa-eye"></i></span> Mostrar</button>
                            <button class="btn btn-warning" type="submit" id="btnAccion"><span><i class="fas fa-trash"></i></span> Limpiar</button>
                        </div>
                    </div>
                </form>
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
            <div class="tab-pane fade p-3" id="nav-graficos" role="tabpanel" aria-labelledby="nav-graficos-tab" tabindex="0">
                <div class="row">

                    <!-- apartado prueba - PRE TEST -->
                    <div class="col-12 col-lg-12">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="form-control d-flex justify-content-between align-items-center">
                                    <div class="">
                                        <h6 class="mb-0">ÍNDICE DE ROTACIÓN DE STOCK - PRE TEST</h6>
                                    </div>
                                    <div class="form-group">
                                        <label for="groupSelect" style="display: inline-block;">Seleccionado:</label>
                                        <select id="groupSelect" onchange="showChart()" style="display: inline-block; padding: 6px 12px; font-size: 16px; font-weight: 400; color: #212529; background-color: #fff; border: 1px solid #ced4da; border-radius: 4px; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;">
                                            <?php
                                            $dbHost = 'localhost';
                                            $dbUser = 'root';
                                            $dbPassword = '';
                                            $dbName = 'almacent';

                                            $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

                                            if ($conn->connect_error) {
                                                die("Conexión fallida: " . $conn->connect_error);
                                            }

                                            $sql = "SELECT descripcion, resultado FROM irs WHERE fecha = '2023-07-08'"; // Reemplaza "tu_tabla" por el nombre real de tu tabla
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

                                <div class="form-control hart-container-2 mt-2">
                                    <script src="<?php echo BASE_URL; ?>assets/plugins/chartjs/js/Chart.min.js"></script>

                                    <div id="chartContainer">
                                        <?php
                                        foreach ($groupedData as $key => $group) {
                                            echo "<canvas id='chart$key' style='display: none;'></canvas>";
                                        }
                                        ?>
                                    </div>

                                    <script>
                                        var data = <?php echo json_encode($groupedData); ?>;

                                        function showChart() {
                                            var selectedGroup = document.getElementById("groupSelect").value;

                                            // Oculta todas las gráficas
                                            var charts = document.querySelectorAll("canvas");
                                            charts.forEach(function(chart) {
                                                chart.style.display = "none";
                                            });

                                            // Muestra la gráfica del grupo seleccionado
                                            var selectedChart = document.getElementById("chart" + selectedGroup);
                                            selectedChart.style.display = "block";

                                            // Crea o actualiza la gráfica del grupo seleccionado
                                            createChart(selectedGroup);
                                        }

                                        function createChart(group) {
                                            var ctx = document.getElementById("chart" + group).getContext("2d");
                                            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
                                            gradientStroke1.addColorStop(0, "#fc4a1a");
                                            gradientStroke1.addColorStop(1, "#f7b733");

                                            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
                                            gradientStroke2.addColorStop(0, "#4776e6");
                                            gradientStroke2.addColorStop(1, "#8e54e9");

                                            var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
                                            gradientStroke3.addColorStop(0, "#ee0979");
                                            gradientStroke3.addColorStop(1, "#ff6a00");

                                            var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
                                            gradientStroke4.addColorStop(0, "#42e695");
                                            gradientStroke4.addColorStop(1, "#3bb2b8");

                                            var gradientVino = ctx.createLinearGradient(0, 0, 0, 300);
                                            gradientVino.addColorStop(0, "#42e695"); // Un tono de naranja claro
                                            gradientVino.addColorStop(1, "#3bb2b8"); // Un tono de salmón claro

                                            var gradientStroke = ctx.createLinearGradient(0, 0, 0, 300);
                                            gradientStroke.addColorStop(0, "#2196F3");
                                            gradientStroke.addColorStop(1, "#0D47A1");


                                            new Chart(ctx, {
                                                type: "horizontalBar", // Tipo de gráfico "bar" para barras verticales
                                                data: {
                                                    labels: data[group].map(function(item) {
                                                        return item[0];
                                                    }),
                                                    datasets: [{
                                                        label: "Cantidad",
                                                        data: data[group].map(function(item) {
                                                            return item[1];
                                                        }),
                                                        borderColor: gradientStroke,
                                                        backgroundColor: gradientStroke,
                                                        hoverBackgroundColor: gradientStroke,
                                                        borderWidth: 1
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        x: {
                                                            beginAtZero: true
                                                        }
                                                    },
                                                    plugins: {
                                                        customCanvasBackgroundColor: {
                                                            color: 'lightGreen',
                                                        }
                                                    }
                                                }
                                            });
                                        }
                                        // Muestra la gráfica del grupo seleccionado al cargar la página
                                        showChart();
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- apartado prueba - POST TEST -->
                    <div class="col-12 col-lg-12">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="form-control d-flex justify-content-between align-items-center">
                                    <div class="">
                                        <h6 class="mb-0">ÍNDICE DE ROTACIÓN DE STOCK - POST TEST</h6>
                                    </div>
                                    <div class="form-group">
                                        <label for="groupSelectPostTest" style="display: inline-block;">Seleccionado:</label>
                                        <select id="groupSelectPostTest" onchange="showChartPostTest()" style="display: inline-block; padding: 6px 12px; font-size: 16px; font-weight: 400; color: #212529; background-color: #fff; border: 1px solid #ced4da; border-radius: 4px; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;">
                                            <?php
                                            $dbHost = 'localhost';
                                            $dbUser = 'root';
                                            $dbPassword = '';
                                            $dbName = 'almacent';

                                            $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

                                            if ($conn->connect_error) {
                                                die("Conexión fallida: " . $conn->connect_error);
                                            }

                                            $sql = "SELECT descripcion, resultado FROM irs WHERE fecha = '2023-09-19'";
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
                                <div class="form-control hart-container-2 mt-2">
                                    <script src="<?php echo BASE_URL; ?>assets/plugins/chartjs/js/Chart.min.js"></script>

                                    <div id="chartContainerPostTest">
                                        <?php
                                        foreach ($groupedData as $key => $group) {
                                            echo "<canvas id='chartPostTest$key'  style='display: none;'></canvas>";
                                        }
                                        ?>
                                    </div>

                                    <script>
                                        var dataPostTest = <?php echo json_encode($groupedData); ?>;

                                        function showChartPostTest() {
                                            var selectedGroup = document.getElementById("groupSelectPostTest").value;

                                            // Oculta todas las gráficas
                                            var charts = document.querySelectorAll("canvas[id^='chartPostTest']");
                                            charts.forEach(function(chart) {
                                                chart.style.display = "none";
                                            });

                                            // Muestra la gráfica del grupo seleccionado
                                            var selectedChart = document.getElementById("chartPostTest" + selectedGroup);
                                            selectedChart.style.display = "block";

                                            // Crea o actualiza la gráfica del grupo seleccionado
                                            createChartPostTest(selectedGroup);
                                        }

                                        function createChartPostTest(group) {
                                            var ctx = document.getElementById("chartPostTest" + group).getContext("2d");
                                            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
                                            gradientStroke1.addColorStop(0, "#fc4a1a");
                                            gradientStroke1.addColorStop(1, "#f7b733");

                                            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
                                            gradientStroke2.addColorStop(0, "#4776e6");
                                            gradientStroke2.addColorStop(1, "#8e54e9");

                                            var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
                                            gradientStroke3.addColorStop(0, "#ee0979");
                                            gradientStroke3.addColorStop(1, "#ff6a00");

                                            var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
                                            gradientStroke4.addColorStop(0, "#42e695");
                                            gradientStroke4.addColorStop(1, "#3bb2b8");

                                            var gradientVino = ctx.createLinearGradient(0, 0, 0, 300);
                                            gradientVino.addColorStop(0, "#0D0D0D"); // Un tono de naranja claro
                                            gradientVino.addColorStop(1, "#1FAA7F"); // Un tono de salmón claro
                                            new Chart(ctx, {
                                                type: "horizontalBar",
                                                data: {
                                                    labels: dataPostTest[group].map(function(item) {
                                                        return item[0];
                                                    }),
                                                    datasets: [{
                                                        label: "Cantidad",
                                                        data: dataPostTest[group].map(function(item) {
                                                            return item[1];
                                                        }),

                                                        borderColor: gradientStroke4,
                                                        backgroundColor: gradientStroke4,
                                                        hoverBackgroundColor: gradientStroke4,
                                                        borderWidth: 1
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        x: {
                                                            beginAtZero: true
                                                        }
                                                    }
                                                }
                                            });
                                        }
                                        // Muestra la gráfica del grupo seleccionado al cargar la página
                                        showChartPostTest();
                                    </script>
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
                            <label for="descripcionProducto">Buscar Por Descripción del Producto</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input class="form-control" type="text" name="descripcionProducto" id="descripcionProducto" placeholder="Buscar Por Descripción del Producto">
                            </div>
                            <span class="text-danger fw-bold mb-2" id="errorDescripcionProducto"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_inicial">Fecha Inicio <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                                <input class="form-control" type="date" name="fecha_inicial" id="fecha_inicial" placeholder="Código">
                            </div>
                            <span id="errorFechaInicio" class="text-danger"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_final">Fecha Fin <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                                <input class="form-control" type="date" name="fecha_final" id="fecha_final" placeholder="Código">
                            </div>
                            <span id="errorFechaFin" class="text-danger"></span>
                        </div>

                        <div class="col-md-2">
                            <label for="SumaTotalSalidas">Suma de Salidas<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <input class="form-control" type="text" name="SumaTotalSalidas" id="SumaTotalSalidas" placeholder="STS" readonly>
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
                                <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1 fa-spin"></i></span>
                                <input class="form-control" type="text" name="cantidadInicialNuevo" id="cantidadInicialNuevo" placeholder="Cantidad Inicial">
                            </div>
                            <span id="errorcantidadInicialNuevo" class="text-danger"></span>
                        </div>

                        <div class="col-md-4">
                            <label for="cantidadFinalNuevo"> Cantidad Final <span class="text-danger">*</span> (<a href="#" class="text-danger" style="font-weight: bold;">Stock de Viernes</a> )</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1 fa-spin"></i></span>
                                <input class="form-control" type="text" name="cantidadFinalNuevo" id="cantidadFinalNuevo" placeholder="Stock Actual">
                            </div>
                            <span id="errorcantidadFinalNuevo" class="text-danger"></span>
                        </div>

                        <div class="col-md-2">
                            <label for="cantidadMediaNuevo">Cantidad Media <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1 fa-spin"></i></span>
                                <input class="form-control" type="text" name="cantidadMediaNuevo" id="cantidadMediaNuevo" placeholder="Cantidad Media de Stock" readonly>
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
                                <span class="input-group-text"><i class="fa-solid fa-location-crosshairs fa-fade"></i></span>
                                <input class="form-control" type="text" name="irsNuevo" id="irsNuevo" placeholder="IRS" readonly>
                            </div>
                        </div>

                        <div class="col-md-8 text-end">
                            <label>&nbsp;</label>
                            <div>
                                <button class="btn btn-danger rounded-pill" type="button" id="btnCalcularIrs">Calcular</button>
                                <button class="btn btn-warning rounded-pill" type="button" id="btnLimpiar">Limpiar</button>
                                <button class="btn btn-primary rounded-pill" type="submit" id="btnGuardar">Registrar</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <!-- <div class="tab-pane fade p-3" id="nav-lunes" role="tabpanel" aria-labelledby="nav-lunes-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-users"></i> Stock de Lunes</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle nowrap" id="tblLunes" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
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
                                <th>ID</th>
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
            </div> -->
        </div>
    </div>
</div>

<?php include_once 'views/templates/footer.php'; ?>