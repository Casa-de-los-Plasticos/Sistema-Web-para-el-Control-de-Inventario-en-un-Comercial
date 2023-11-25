<?php include_once 'views/templates/header.php'; ?>
<?php
date_default_timezone_set('America/Lima');
$fechaActual = date('d/m/Y h:i:s A');
?>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div></div>
            <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo BASE_URL . 'mesas/inactivos'; ?>"><i class="fas fa-trash text-danger"></i> Inactivos</a>
                    </li>
                </ul>
            </div>
        </div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-mesas-tab" data-bs-toggle="tab" data-bs-target="#nav-mesas" type="button" role="tab" aria-controls="nav-mesas" aria-selected="true">Mesas</button>
                <button class="nav-link" id="nav-nuevo-tab" data-bs-toggle="tab" data-bs-target="#nav-nuevo" type="button" role="tab" aria-controls="nav-nuevo" aria-selected="false">Nuevo</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active mt-3" id="nav-mesas" role="tabpanel" aria-labelledby="nav-mesas-tab" tabindex="0">
                <h5 class="card-title text-center"><i class="fas fa-users"></i> Listado de Mesas</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle nowrap" id="tblMesas" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tiempo</th>
                                <th>Monto</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Mesa</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade p-3" id="nav-nuevo" role="tabpanel" aria-labelledby="nav-nuevo-tab" tabindex="0">
                <div class="row tex-center">
                    <div class="col-md-3 padre comprobarMesaUno">
                        <div class="row contenedor">
                            <div class="col-md-4">
                                <input id="hour" type="number" max="99" min="0" value="0" class="timec form-control">
                                <p id="hour-label" class="labelc">Horas</p>
                                <button id="start" class="btnc form-control btn-primary" type="button">Start</button>
                            </div>
                            <div class="col-md-4 p1">
                                <p id="p1" class="semicolon">:</p>
                                <input id="minute" type="number" max="60" min="0" value="0" class="timec form-control">
                                <p id="min-label" class="labelc">Minutos</p>
                                <button id="reset" class="btnc form-control btn-primary" type="button">Reset</button>
                            </div>
                            <div class="col-md-4 p2">
                                <p id="p2" class="semicolon">:</p>
                                <input id="sec" type="number" max="60" min="0" value="0" class="timec form-control">
                                <p id="sec-label" class="labelc">Segundos</p>
                                <button id="pause" class="btnc form-control btn-primary" type="button">Pause</button>
                            </div>
                        </div>
                        <button class="btn btn-dark btn-lg p-3" type="button" id="btnMesaUno"> 1 &nbsp; <img class="img-thumbnail" src="<?php echo BASE_URL . 'assets/images/mesas.png'; ?>" alt="LOGO_PNG" width="200"></button>
                        <audio id="timeout_audio" src="<?php echo BASE_URL . 'views/mesas/relaxed.mp3'; ?>" type="audio/mpeg" paused="true"></audio>
                    </div>
                    <div class="col-md-3 padre comprobarMesaDos">
                        <div class="row contenedor">
                            <div class="col-md-4">
                                <input id="hourDos" type="number" max="99" min="0" value="0" class="timec form-control">
                                <p id="hour-label" class="labelc">Horas</p>
                                <button id="startDos" class="btnc form-control btn-primary" type="button">Start</button>
                            </div>
                            <div class="col-md-4 p1">
                                <p id="p1" class="semicolon">:</p>
                                <input id="minuteDos" type="number" max="60" min="0" value="0" class="timec form-control">
                                <p id="min-label" class="labelc">Minutos</p>
                                <button id="resetDos" class="btnc form-control btn-primary" type="button">Reset</button>
                            </div>
                            <div class="col-md-4 p2">
                                <p id="p2" class="semicolon">:</p>
                                <input id="secDos" type="number" max="60" min="0" value="0" class="timec form-control">
                                <p id="sec-label" class="labelc">Segundos</p>
                                <button id="pauseDos" class="btnc form-control btn-primary" type="button">Pause</button>
                            </div>
                        </div>
                        <button class="btn btn-dark btn-lg p-3" type="button" id="btnMesaDos"> 2 &nbsp; <img class="img-thumbnail" src="<?php echo BASE_URL . 'assets/images/mesas.png'; ?>" alt="LOGO_PNG" width="200"></button>
                        <audio id="timeout_audioDos" src="<?php echo BASE_URL . 'views/mesas/minimal.mp3'; ?>" type="audio/mpeg" paused="true"></audio>
                    </div>
                    <div class="col-md-3 padre comprobarMesaTres">
                        <div class="row contenedor">
                            <div class="col-md-4">
                                <input id="hourTres" type="number" max="99" min="0" value="0" class="timec form-control">
                                <p id="hour-label" class="labelc">Horas</p>
                                <button id="startTres" class="btnc form-control btn-primary" type="button">Start</button>
                            </div>
                            <div class="col-md-4 p1">
                                <p id="p1" class="semicolon">:</p>
                                <input id="minuteTres" type="number" max="60" min="0" value="0" class="timec form-control">
                                <p id="min-label" class="labelc">Minutos</p>
                                <button id="resetTres" class="btnc form-control btn-primary" type="button">Reset</button>
                            </div>
                            <div class="col-md-4 p2">
                                <p id="p2" class="semicolon">:</p>
                                <input id="secTres" type="number" max="60" min="0" value="0" class="timec form-control">
                                <p id="sec-label" class="labelc">Segundos</p>
                                <button id="pauseTres" class="btnc form-control btn-primary" type="button">Pause</button>
                            </div>
                        </div>
                        <button class="btn btn-dark btn-lg p-3" type="button" id="btnMesaTres"> 3 &nbsp; <img class="img-thumbnail" src="<?php echo BASE_URL . 'assets/images/mesas.png'; ?>" alt="LOGO_PNG" width="200"></button>
                        <audio id="timeout_audioTres" src="<?php echo BASE_URL . 'views/mesas/motivational-corporate.mp3'; ?>" type="audio/mpeg" paused="true"></audio><br><br>
                    </div>
                    <div class="col-md-3 padre comprobarMesaCuatro">
                        <div class="row contenedor">
                            <div class="col-md-4">
                                <input id="hourCuatro" type="number" max="99" min="0" value="0" class="timec form-control">
                                <p id="hour-label" class="labelc">Horas</p>
                                <button id="startCuatro" class="btnc form-control btn-primary" type="button">Start</button>
                            </div>
                            <div class="col-md-4 p1">
                                <p id="p1" class="semicolon">:</p>
                                <input id="minuteCuatro" type="number" max="60" min="0" value="0" class="timec form-control">
                                <p id="min-label" class="labelc">Minutos</p>
                                <button id="resetCuatro" class="btnc form-control btn-primary" type="button">Reset</button>
                            </div>
                            <div class="col-md-4 p2">
                                <p id="p2" class="semicolon">:</p>
                                <input id="secCuatro" type="number" max="60" min="0" value="0" class="timec form-control">
                                <p id="sec-label" class="labelc">Segundos</p>
                                <button id="pauseCuatro" class="btnc form-control btn-primary" type="button">Pause</button>
                            </div>
                        </div>
                        <button class="btn btn-dark btn-lg p-3" type="button" id="btnMesaCuatro"> 4 &nbsp; <img class="img-thumbnail" src="<?php echo BASE_URL . 'assets/images/mesas.png'; ?>" alt="LOGO_PNG" width="200"></button>
                        <audio id="timeout_audioCuatro" src="<?php echo BASE_URL . 'views/mesas/tic-toc-suspenso.mp3'; ?>" type="audio/mpeg" paused="true"></audio>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modalMesaUno" class="modal fade hide" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <li class="d-flex justify-beetwen-start"><i class="fa-brands fa-golang" style="font-size: 20px;"></i> &nbsp;
                <h5 class="modal-title" id="mesaTitle"> Mesa Uno</h5> &nbsp;
                <i class="fa-brands fa-blackberry"></i></li>
                <button type="button" class="btn btn-outline-primary text-black border-0 fs-5 d-flex justify-content-end" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>
                <!-- <button class="fa-duotone fa-jet-fighter btn-close " data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>

            <form id="formulario">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <div>
                                <label>Buscar Cliente <span class="text-danger">*</span></label>
                                <div class="input-group mb-2">
                                    <input type="hidden" id="idCliente" name="idCliente">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input class="form-control" type="text" id="buscarCliente" placeholder="Buscar Cliente" name="buscarCliente">
                                </div>
                                <span class="text-danger fw-bold mb-2" id="errorCliente"></span>
                            </div>

                            <label>Telefono</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input class="form-control" type="text" id="telefonoCliente" placeholder="Telefono" disabled>
                            </div>

                            <ul class="list-group mb-2">
                                <label>Dirección</label>
                                <li class="list-group-item" id="direccionCliente" placeholder="Dirección"><i class="fas fa-home"></i></li>
                            </ul>
                            <span id="errorDireccion" class="text-danger"></span>

                            <div class="form-group mb-2">
                                <label for="mesa">Mesa <span class="text-danger">*</span></label>
                                <select id="mesa" class="form-control" name="mesa">
                                    <option value="">SELECCIONAR MESA</option>
                                    <option data-nit="MESA 1" value="MESA 1">MESA 1</option>
                                    <option data-nit="MESA 2" value="MESA 2">MESA 2</option>
                                    <option data-nit="MESA 3" value="MESA 3">MESA 3</option>
                                    <option data-nit="MESA 4" value="MESA 4">MESA 4</option>
                                </select>
                            </div>
                            <span class="text-danger fw-bold mb-2" id="errorTiempo"></span>
                        </div>

                        <div class="col-md-6">
                            <label>Vendedor</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input class="form-control" type="text" value="<?php echo $_SESSION['nombre_usuario']; ?>" placeholder="Vendedor" disabled>
                            </div>

                            <label>Monto <span class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fas fa-sharp fa-solid fa-sack-dollar"></i></span>
                                <input class="form-control" type="number" step="0.01" min="0.01" id="monto" placeholder="Monto" name="monto">
                            </div>
                            <span class="text-danger fw-bold mb-2" id="errorMonto"></span>

                            <div class="form-group mb-2">
                                <label for="tiempo">Tiempo <span class="text-danger">*</span></label>
                                <select id="tiempo" class="form-control" name="tiempo" onchange="selectNit(event)">
                                    <option value="">SELECCIONAR MESA</option>
                                    <option data-nit="3.00" value="30 MINUTOS">30 MINUTOS</option>
                                    <option data-nit="6.00" value="1 HORA">1 HORA</option>
                                    <option data-nit="12.00" value="1 HORA Y MEDIA">1 HORA Y MEDIA</option>
                                    <option data-nit="9.00" value="2 HORAS">2 HORAS</option>
                                    <option data-nit="12.00" value="2 HORAS Y MEDIA">2 HORAS Y MEDIA</option>
                                    <option data-nit="15.00" value="3 HORAS">3 HORAS</option>
                                    <option data-nit="18.00" value="3 HORAS Y MEDIA">3 HORAS Y MEDIA</option>
                                    <option data-nit="21.00" value="4 HORAS">4 HORAS</option>
                                    <option data-nit="24.00" value="4 HORAS Y MEDIA">4 HORAS Y MEDIA</option>
                                    <option data-nit="27.00" value="5 HORAS">5 HORAS</option>
                                    <option data-nit="30.00" value="5 HORAS Y MEDIA">5 HORAS Y MEDIA</option>
                                    <option data-nit="33.00" value="6 HORAS">6 HORAS</option>
                                    <option data-nit="36.00" value="6 HORAS Y MEDIA">6 HORAS Y MEDIA</option>
                                    <option data-nit="39.00" value="7 HORAS">7 HORAS</option>
                                    <option data-nit="42.00" value="7 HORAS Y MEDIA">7 HORAS Y MEDIA</option>
                                    <option data-nit="45.00" value="8 HORAS">8 HORAS</option>
                                    <option data-nit="48.00" value="8 HORAS Y MEDIA">8 HORAS Y MEDIA</option>
                                    <option data-nit="51.00" value="MESA TRES">9 HORAS</option>
                                    <option data-nit="54.00" value="MESA TRES">9 HORAS Y MEDIA</option>
                                    <option data-nit="57.00" value="MESA TRES">10 HORAS</option>
                                </select>
                            </div>
                            <span class="text-danger fw-bold mb-2" id="errorTiempo"></span>

                            <label>Fecha <span class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                <input type="datetime-local" class="form-control" id="fecha" name="fecha" step="1" min="2022-01-01 00:00:00" max="2022-31-12 12:59:59">
                            </div>
                            <span class="text-danger fw-bold mb-2" id="errorMonto"></span>
                            <!-- EL BOTON -->
                            <div class="d-grid">
                                <button class="btn btn-outline-primary" type="submit" id="btnAccion">Separar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .padre {
        height: auto;
        width: auto;
        text-align: center;
    }

    .contenedor {
        vertical-align: middle;
        height: 105px;
        width: 285px;
    }

    .labelc {
        margin: 0;
        justify-self: center;
        align-self: center;
        font-size: 15px;
    }

    .p1,
    .p2 {
        height: 40px;
        /* background-color: #EEE; */
        position: relative;
    }

    #p1,
    #p2 {
        position: absolute;
        left: 1.5%;
        top: 50%;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
    }
</style>

<?php include_once 'views/templates/footer.php'; ?>