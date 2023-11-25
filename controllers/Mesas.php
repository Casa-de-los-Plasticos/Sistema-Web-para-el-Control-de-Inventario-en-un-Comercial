<?php
class Mesas extends Controller
{
    private $id_usuario;
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['id_usuario'])) {
            header('Location: ' . BASE_URL);
            exit();
        }
        $this->id_usuario = $_SESSION['id_usuario'];
    }
    public function index()
    {
        $data['title'] = 'Mesas';
        $data['script'] = 'mesas.js';
        $this->views->getView('mesas', 'index', $data);
    }
    public function listar()
    {
        $data = $this->model->getMesas(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="eliminarMesa(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            <button class="btn btn-info" type="button" onclick="editarMesa(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        // print_r($_POST);
        if (isset($_POST['tiempo'])) {
            $id_mesa = strClean($_POST['id']);
            $tiempo = strClean($_POST['tiempo']);
            $monto = strClean($_POST['monto']);
            $idCliente = strClean($_POST['idCliente']);
            $cliente = strClean($_POST['buscarCliente']);
            $fecha = strClean($_POST['fecha']);
            $fecha = date('Y-m-d h:i:s A');
            $mesa = strClean($_POST['mesa']);
            // $json = file_get_contents('php://input');
            // $datos = json_decode($json, true);
            if (empty($idCliente)) {
                $res = array('msg' => 'EL CLIENTE ES REQUERIDO...', 'type' => 'warning');
            } else if (empty($tiempo)) {
                $res = array('msg' => 'EL TIEMPO ES REQUERIDO...', 'type' => 'warning');
            } else if (empty($monto)) {
                $res = array('msg' => 'EL MONTO ES REQUERIDO...', 'type' => 'warning');
            } else {
                if ($id_mesa == '') {
                    $verificar = $this->model->getValidar('mesa', $mesa, 'registrar', 0);
                    if (empty($verificar)) {
                        
                        $data = $this->model->registrar($tiempo, $monto, $cliente, $fecha, $mesa, $idCliente, $this->id_usuario);
                        if ($data > 0) {
                            $res = array('msg' => 'MESA SEPARADO CON ÉXITO...', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR AL SEPARAR LA MESA...', 'type' => 'error');
                        }
                    } else {
                        $res = array('msg' => 'LA MESA YA EXISTE EN LA BD...', 'type' => 'warning');
                    }
                } else {
                    $verificar = $this->model->getValidar('mesa', $mesa, 'actualizar', $id_mesa);
                    if (empty($verificar)) {
                        $data = $this->model->actualizar($tiempo, $monto, $cliente, $fecha, $mesa, $idCliente, $this->id_usuario, $id_mesa);
                        if ($data > 0) {
                            $res = array('msg' => 'MESA MODIFICADO...', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR AL MODIFICAR LA MESA...', 'type' => 'error');
                        }
                    } else {
                        $res = array('msg' => 'LA MESA YA SE ENCUENTRA ESTABLECIDO EN LA BD...', 'type' => 'warning');
                    }
                }
            }
        }
        echo json_encode($res);
        die();
    }

    public function eliminar($idMesa)
    {
        if (isset($_GET) && is_numeric($idMesa)) {
            $data = $this->model->eliminar(0, $idMesa);
            if ($data > 0) {
                $res = array('msg' => 'MESA DADO DE BAJA...', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL ELIMINAR...', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar($idMesa)
    {
        $data = $this->model->editar($idMesa);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function inactivos()
    {
        $data['title'] = 'Mesas  Inactivos';
        $data['script'] = 'mesas-inactivos.js';
        $this->views->getView('mesas', 'inactivos', $data);
    }

    public function listarInactivos()
    {
        $data = $this->model->getMesas(0);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-success" type="button" onclick="restaurarMesas(' . $data[$i]['id'] . ')"><i class="fas fa-check-circle"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function restaurar($idMesa)
    {
        if (isset($_GET) && is_numeric($idMesa)) {
            $data = $this->model->eliminar(1, $idMesa);
            if ($data > 0) {
                $res = array('msg' => 'MESA RESTAURADO...', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL RESTUARAR...', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
    //buscar clientes para la venta
    public function buscar()
    {
        $array = array();
        $valor = $_GET['term'];
        $data = $this->model->buscarPorNombre($valor);
        foreach ($data as $row) {
            $result['id'] = $row['id'] - $row['nombre'];
            // $result['label'] = $row['nombre'];
            $result['telefono'] = $row['telefono'];
            $result['direccion'] = $row['direccion'];
            array_push($array, $result);
        }
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function verDatos($idApartado)
    {
        $data = $this->model->getApartado($idApartado);
        echo json_encode($data);
        die();
    }
}
