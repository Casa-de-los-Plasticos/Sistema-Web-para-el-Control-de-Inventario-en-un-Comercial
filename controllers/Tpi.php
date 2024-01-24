<?php
class Tpi extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['id_usuario'])) {
            header('Location: ' . BASE_URL);
            exit();
        }
    }
    public function index()
    {
        $data['title'] = 'TPI';
        $data['script'] = 'tpi.js';
        $this->views->getView('tpi', 'index', $data);
    }
    public function listar()
    {
        $data = $this->model->getTpi(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
                <button class="btn btn-info" type="button" onclick="editarTpi(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="eliminarTpi(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $codigo = strClean($_POST['codigo']);
        $descripcion = strClean($_POST['descripcion']);
        $tpi = strClean($_POST['tpi']);
        $cantidad = strClean($_POST['cantidad']);
        $id = strClean($_POST['id']);
        if (empty($cantidad)) {
            $res = array('msg' => 'LA CANTIDAD ES OBLIGATORIO...', 'type' => 'warning');
        } else {
            if ($id == '') {
                $data = $this->model->registrar($codigo, $descripcion, $tpi, $cantidad);
                if ($data > 0) {
                    $res = array('msg' => 'TPI REGISTRADO...', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL REGISTRAR...', 'type' => 'error');
                }
            } else {
                $data = $this->model->actualizar($codigo, $descripcion, $tpi, $cantidad, $id);
                if ($data > 0) {
                    $res = array('msg' => 'TPI MODIFICADO...', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL MODIFICAR...', 'type' => 'error');
                }
            }
        }
        echo json_encode($res);
        die();
    }

    public function eliminar($idTpi)
    {
        if (isset($_GET) && is_numeric($idTpi)) {
            $data = $this->model->eliminar(0, $idTpi);
            if ($data == 1) {
                $res = array('msg' => 'TPI DADO DE BAJA', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL ELIMINAR', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar($idCategoria)
    {
        $data = $this->model->editar($idCategoria);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function inactivos()
    {
        $data['title'] = 'Categorias Inactivos';
        $data['script'] = 'categorias-inactivos.js';
        $this->views->getView('categorias', 'inactivos', $data);
    }

    public function listarInactivos()
    {
        $data = $this->model->getTpi(0);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-success" type="button" onclick="restaurarCategoria(' . $data[$i]['id'] . ')"><i class="fas fa-check-circle"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function restaurar($idCategoria)
    {
        if (isset($_GET) && is_numeric($idCategoria)) {
            $data = $this->model->eliminar(1, $idCategoria);
            if ($data == 1) {
                $res = array('msg' => 'CATEGORIA RESTAURADO', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL RESTURAR', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function buscar()
    {
        $array = array();
        $valor = $_GET['term'];
        $data = $this->model->buscarPorCodigo($valor);
        foreach ($data as $row) {
            $result['id'] = $row['id'];
            $result['label'] = $row['codigo'];
            $result['descripcion'] = $row['descripcion'];
            $result['cantidad'] = $row['cantidad'];
            array_push($array, $result);
        }
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }
}
