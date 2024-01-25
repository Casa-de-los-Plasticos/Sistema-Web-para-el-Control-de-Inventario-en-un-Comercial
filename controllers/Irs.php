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
        $data['irs'] = 'irsconso.js';
        $this->views->getView('irs', 'index', $data);
    }
    public function listar()
    {
        $data = $this->model->getIrs();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listarLunes()
    {
        $data = $this->model->getLunes();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listarViernes()
    {
        $data = $this->model->getViernes();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function registrar()
    {
        if (isset($_POST['nombre'])) {
            $nombre = strClean($_POST['nombre']);
            $fecha_inicio = strClean($_POST['fecha_inicial']);
            $fecha_fin = strClean($_POST['fecha_final']);
            $resultado = strClean($_POST['irsNuevo']);
            // $id = strClean($_POST['id']);
            if (empty($nombre)) {
                $res = array('msg' => 'LA DESCRIPCIÓN DEL PRODUCTO ES OBLIGATORIO...', 'type' => 'warning');
            } else {
                // if ($id == '') {
                    $data = $this->model->registrar($nombre, $fecha_inicio, $fecha_fin, $resultado);
                    if ($data > 0) {
                        $res = array('msg' => 'IRS REGISTRADO...', 'type' => 'success');
                    } else {
                        $res = array('msg' => 'ERROR AL REGISTRAR...', 'type' => 'error');
                    }
                // } else {
                    // $data = $this->model->actualizar($nombre, $fecha_inicio, $fecha_fin, $resultado, $id);
                    // if ($data > 0) {
                    //     $res = array('msg' => 'IRS MODIFICADO...', 'type' => 'success');
                    // } else {
                    //     $res = array('msg' => 'ERROR AL MODIFICAR...', 'type' => 'error');
                    // }
                // }
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
            $descripcion = $_POST['nombre'];
            $fechaInicial = $_POST['fecha_inicial'];
            $fechaFinal = $_POST['fecha_final'];
            // $data = $this->model->calcularSalida($valor);
            $data = $this->model->calcularSalida($descripcion, $fechaInicial, $fechaFinal);
            echo json_encode($data[0], JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function topProductos()
    {
        $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
        $elementosPorPagina = 15;
        $offset = ($pagina - 1) * $elementosPorPagina;

        $data = $this->model->topProductos($elementosPorPagina, $offset);
        echo json_encode($data);
        die();
    }

    public function topProductosPost()
    {
        $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
        $elementosPorPagina = 15;

        $offset = ($pagina - 1) * $elementosPorPagina;

        $data = $this->model->topProductosPost($elementosPorPagina, $offset);
        echo json_encode($data);
        die();
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
            $result['label'] = $row['descripcion'];
            // $result['descripcion'] = $row['descripcion'];
            // $result['direccion'] = $row['direccion'];
            array_push($array, $result);
        }
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function filtrar()
    {
        // Obtener los datos del filtro
        $descripcion = $_POST['descripcion'];
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];

        // Filtrar en el modelo
        $data = $this->model->filtrar($descripcion, $fechaInicio, $fechaFin);

        // Enviar los resultados como JSON
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
