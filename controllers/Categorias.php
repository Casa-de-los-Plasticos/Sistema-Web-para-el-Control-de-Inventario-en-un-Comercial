<?php
class Categorias extends Controller
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
        $data['title'] = 'Categorias';
        $data['script'] = 'categorias.js';
        $this->views->getView('categorias', 'index', $data);
    }
    public function listar()
    {
        $data = $this->model->getCategorias(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
                <button class="btn btn-info" type="button" onclick="editarCategoria(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="eliminarCategoria(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        if (isset($_POST['nombre'])) {
            $categoria = strClean($_POST['nombre']);
            $id = strClean($_POST['id']);
            if (empty($categoria)) {
                $res = array('msg' => 'EL NOMBRE ES OBLIGATORIO...', 'type' => 'warning');
            } else {
                if ($id == '') {
                    $verificar = $this->model->getValidar('categoria', $categoria, 'registrar', 0);
                    if (empty($verificar)) {
                        $data = $this->model->registrar($categoria);
                        if ($data > 0) {
                            $res = array('msg' => 'CATEGORIA REGISTRADO...', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR AL REGISTRAR...', 'type' => 'error');
                        }
                    } else {
                        $res = array('msg' => 'LA CATEGORIA YA EXISTE EN LA BD...', 'type' => 'warning');
                    }
                } else {
                    $verificar = $this->model->getValidar('categoria', $categoria, 'actualizar', $id);
                    if (empty($verificar)) {
                        $data = $this->model->actualizar($categoria, $id);
                        if ($data > 0) {
                            $res = array('msg' => 'CATEGORIA MODIFICADO...', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR AL MODIFICAR...', 'type' => 'error');
                        }
                    } else {
                        $res = array('msg' => 'LA CATEGORIA YA EXISTE EN LA BD...', 'type' => 'warning');
                    }
                }
            }
        }
        echo json_encode($res);
        die();
    }

    public function eliminar($idCategoria)
    {
        if (isset($_GET) && is_numeric($idCategoria)) {
            $data = $this->model->eliminar(0, $idCategoria);
            if ($data == 1) {
                $res = array('msg' => 'CATEGORIA DADO DE BAJA...', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL ELIMINAR...', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'error');
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
        $data = $this->model->getCategorias(0);
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
                $res = array('msg' => 'CATEGORIA RESTAURADO...', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL RESTURAR...', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
}
