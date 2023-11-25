<?php
class Almacen extends Controller
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
        $data['title'] = 'Almacén';
        $data['script'] = 'almacen.js';
        $this->views->getView('almacen', 'index', $data);
    }

    public function listar()
    {
        $data = $this->model->getAlmacen(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="eliminarAlmacen(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            <button class="btn btn-info" type="button" onclick="editarAlmacen(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $codigo = strClean($_POST['codigo']); 
        $descripcion = strClean($_POST['descripcion']);
        $cantidad = strClean($_POST['cantidad']);
        $razon = strClean($_POST['razon']);
        $id = strClean($_POST['id']);
        if (empty($codigo)) {
            $res = array('msg' => 'EL CÓDIGO DEL PRODUCTO ES OBLIGATORIO...', 'type' => 'warning');
        } else if (empty($descripcion)) {
            $res = array('msg' => 'LA DESCRIPCIÓN DEL PRODUCTO ES OBLIGATORIO...', 'type' => 'warning');
        } else {
            if ($id == '') {

                $data = $this->model->registrar($codigo, $descripcion, $cantidad, $razon);
                if ($data > 0) {
                    $res = array('msg' => 'STOCK FÍSICO REGISTRADO...', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL REGISTRAR...', 'type' => 'error');
                }
            } else {
                $data = $this->model->actualizar($codigo, $descripcion, $cantidad, $razon, $id);
                if ($data == 1) {
                    $res = array('msg' => 'STOCK FÍSICO  MODIFICADO...', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL MODIFICAR...', 'type' => 'error');
                }
            }
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
            // $result['direccion'] = $row['direccion'];
            array_push($array, $result);
        }
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }
}
