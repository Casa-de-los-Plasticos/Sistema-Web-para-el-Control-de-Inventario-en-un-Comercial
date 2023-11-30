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
                                    <h6 class="mb-0">TASA DE PRESICIÓN DE INVENTARIO - CONSOLIDADO - PRE TEST</h6>
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

                                        new Chart(ctx, {
                                            type: "horizontalBar", // Tipo de gráfico "bar" para barras verticales
                                            data: {
                                                labels: data[group].map(function(item) {
                                                    return item[0];
                                                }),
                                                datasets: [{
                                                    label: "Resultado",
                                                    data: data[group].map(function(item) {
                                                        return item[1];
                                                    }),
                                                    borderColor: gradientStroke1,
                                                    backgroundColor: gradientStroke1,
                                                    hoverBackgroundColor: gradientStroke1,
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
                                    <h6 class="mb-0">TASA DE PRESICIÓN DE INVENTARIO - CONSOLIDADO - POST TEST</h6>
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

                                        $sql = "SELECT descripcion, resultado FROM consolidado_tpi WHERE fecha = '2023-09-13'";
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

                                        var gradientStroke = ctx.createLinearGradient(0, 0, 0, 300);
                                        gradientStroke.addColorStop(0, "#8B0000");
                                        gradientStroke.addColorStop(1, "#E32636");
                                        new Chart(ctx, {
                                            type: "horizontalBar",
                                            data: {
                                                labels: dataPostTest[group].map(function(item) {
                                                    return item[0];
                                                }),
                                                datasets: [{
                                                    label: "Resultado",
                                                    data: dataPostTest[group].map(function(item) {
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
    </div>
</div>

<?php include_once 'views/templates/footer.php'; ?>