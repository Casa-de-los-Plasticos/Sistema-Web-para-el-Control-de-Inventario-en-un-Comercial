<?php
class Irs extends Controller
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
        $data['title'] = 'IRS';
        $data['script'] = 'irs.js';
        // $data['script'] = 'irsconso.js';
        $this->views->getView('irs', 'index', $data);
    }
    public function listar()
    {
        $data = $this->model->getIrs();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    // public function listarLunes()
    // {
    //     $data = $this->model->getLunes();
    //     echo json_encode($data, JSON_UNESCAPED_UNICODE);
    //     die();
    // }

    // public function listarViernes()
    // {
    //     $data = $this->model->getViernes();
    //     echo json_encode($data, JSON_UNESCAPED_UNICODE);
    //     die();
    // }
    public function registrar()
    {
        if (isset($_POST['descripcionProducto'])) {
            $descripcionProducto = strClean($_POST['descripcionProducto']);
            $fecha_inicial = strClean($_POST['fecha_inicial']);
            $fecha_final = strClean($_POST['fecha_final']);
            $irsNuevo = strClean($_POST['irsNuevo']);
            $id = strClean($_POST['id']);
            if (empty($descripcionProducto)) {
                $res = array('msg' => 'LA DESCRIPCIÓN DEL PRODUCTO ES OBLIGATORIO...', 'type' => 'warning');
            } else {
                if ($id == '') {
                    $data = $this->model->registrar($descripcionProducto, $fecha_inicial, $fecha_final, $irsNuevo);
                    if ($data > 0) {
                        $res = array('msg' => 'IRS REGISTRADO...', 'type' => 'success');
                    } else {
                        $res = array('msg' => 'ERROR AL REGISTRAR...', 'type' => 'error');
                    }
                } else {
                    $data = $this->model->actualizar($descripcionProducto, $fecha_inicial, $fecha_final, $irsNuevo, $id);
                    if ($data > 0) {
                        $res = array('msg' => 'IRS MODIFICADO...', 'type' => 'success');
                    } else {
                        $res = array('msg' => 'ERROR AL MODIFICAR...', 'type' => 'error');
                    }
                }
            }
        }
        echo json_encode($res);
        die();
    }

    public function buscarNombre()
    {
        $array = array();
        $valor = $_GET['term'];
        $data = $this->model->buscarPorDescripcion($valor);
        foreach ($data as $row) {
            $result['id'] = $row['id'];
            $result['label'] = $row['descripcion'];
            array_push($array, $result);
        }
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    } 

    function consultar()
    {
        if (isset($_POST['submit'])) {
            $descripcion = $_POST['descripcionProducto'];
            $fechaInicial = $_POST['fecha_inicial'];
            $fechaFinal = $_POST['fecha_final'];
            // $data = $this->model->calcularSalida($valor);
            $data = $this->model->calcularSalida($descripcion, $fechaInicial, $fechaFinal);
            echo json_encode($data[0], JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    // ESTE APARTADO SE ESTÁ DESARROLLANDO HOY 02/11/2023
    //buscar Productos por nombre
    // public function buscarPorNombre()
    // {
    //     $array = array();
    //     $valor = $_GET['term'];
    //     $data = $this->model->buscarPorNombre($valor);
    //     foreach ($data as $row) {
    //         $result['id'] = $row['id'];
    //         $result['label'] = $row['descripcion'];
    //         // $result['stock'] = $row['cantidad'];
    //         // $result['precio_venta'] = $row['precio_venta'];
    //         // $result['precio_compra'] = $row['precio_compra'];
    //         array_push($array, $result);
    //     }
    //     echo json_encode($array, JSON_UNESCAPED_UNICODE);
    //     die();
    // }
    public function buscarPorNombre()
    {
        $array = array();
        $valor = $_GET['term'];
        $data = $this->model->buscarPorNombre($valor);
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
