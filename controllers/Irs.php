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
        $data['irs'] = 'irs.js';
        $data['script'] = 'irsconso.js';
        $this->views->getView('irs', 'index', $data);
    }
    public function listar()
    {
        $data = $this->model->getIrs();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
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

    // MÉTODO PARA BUSCAR PRODUCTO EN LA PESTAÑA INDICADOR - NUEVO
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

    public function filtrar()
    {
        // Obtener los datos del filtro
        $productos = $_POST['productos'];
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];

        // Filtrar en el modelo
        $data = $this->model->filtrar($productos, $fechaInicio, $fechaFin);

        // Enviar los resultados como JSON
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
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
}
