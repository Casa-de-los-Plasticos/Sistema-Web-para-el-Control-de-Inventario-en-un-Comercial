<?php
class Medidas extends Controller{
    public function __construct() {
        parent::__construct();
        session_start();
        if (empty($_SESSION['id_usuario'])) {
            header('Location: ' . BASE_URL);
            exit();
        }
    }
    public function index()
    {
        $data['title'] = 'Medidas';
        $data['script'] = 'medidas.js';
        $this->views->getView('medidas', 'index', $data);
    }
    public function listar()
    {
        $data = $this->model->getMedidas(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="eliminarMedida(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            <button class="btn btn-info" type="button" onclick="editarMedida(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $nombre = strClean($_POST['nombre']);
        $nombre_corto = strClean($_POST['nombre_corto']);
        $id = strClean($_POST['id']);
        if (empty($nombre)) {
            $res = array('msg' => 'EL NOMBRE ES OBLIGATORIO...', 'type' => 'warning');
        } else if (empty($nombre_corto)) {
            $res = array('msg' => 'EL NOMBRE CORTO ES OBLIGATORIO...', 'type' => 'warning');
        } else {
            if ($id == '') {
                $verificar = $this->model->getValidar('medida', $nombre, 'registrar', 0);
                if (empty($verificar)) {
                    $data = $this->model->registrar($nombre, $nombre_corto);
                    if ($data > 0) {
                        $res = array('msg' => 'MEDIDA REGISTRADO...', 'type' => 'success');
                    } else {
                        $res = array('msg' => 'ERROR AL REGISTRAR...', 'type' => 'error');
                    }
                } else {
                    $res = array('msg' => 'LA MEDIDA YA EXISTE EN LA BD...', 'type' => 'warning');
                }
            } else {
                $verificar = $this->model->getValidar('medida', $nombre, 'actualizar', $id);
                if (empty($verificar)) {
                    $data = $this->model->actualizar($nombre, $nombre_corto, $id);
                    if ($data == 1) {
                        $res = array('msg' => 'MEDIDA MODIFICADO...', 'type' => 'success');
                    } else {
                        $res = array('msg' => 'ERROR AL MODIFICAR...', 'type' => 'error');
                    }
                } else {
                    $res = array('msg' => 'LA MEDIDA YA EXISTE EN LA BD...', 'type' => 'warning');
                }
            }
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar($idMedida)
    {
        if (isset($_GET)) {
            if (is_numeric($idMedida)) {
                $data = $this->model->eliminar(0, $idMedida);
                if ($data == 1) {
                    $res = array('msg' => 'MEDIDA DADO DE BAJA...', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL ELIMINAR...', 'type' => 'error');
                }
            } else {
                $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($idMedida)
    {
        $data = $this->model->editar($idMedida);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function inactivos()
    {
        $data['title'] = 'Medidas Inactivos';
        $data['script'] = 'medidas-inactivos.js';
        $this->views->getView('medidas', 'inactivos', $data);
    }
    public function listarInactivos()
    {
        $data = $this->model->getMedidas(0);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-success" type="button" onclick="restaurarMedida(' . $data[$i]['id'] . ')"><i class="fas fa-check-circle"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function restaurar($idMedida)
    {
        if (isset($_GET)) {
            if (is_numeric($idMedida)) {
                $data = $this->model->eliminar(1, $idMedida);
                if ($data == 1) {
                    $res = array('msg' => 'MEDIDA RESTAURADO...', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL RESTAURAR...', 'type' => 'error');
                }
            } else {
                $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>