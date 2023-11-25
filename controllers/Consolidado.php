<?php
class Consolidado extends Controller
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
        $data['title'] = 'CONSOLIDADO';
        $data['consolidado'] = 'consolidado.js';
        $data['script'] = 'conso.js';
        // $data['top'] = $this->model->topTpi(50);
        $this->views->getView('consolidado', 'index', $data);
    }
    public function listar()
    {
        $data = $this->model->getTpi();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $codigo = strClean($_POST['codigo']);
        $descripcion = strClean($_POST['descripcion']);
        $fecha_inicio = strClean($_POST['fecha_inicial']);
        $fecha_fin = strClean($_POST['fecha_final']);
        $resultado = strClean($_POST['tpi']);
        $id = strClean($_POST['id']);
        if (empty($codigo)) {
            $res = array('msg' => 'EL CÓDIGO ES OBLIGATORIO...', 'type' => 'warning');
        } else {
            if ($id == '') {
                $data = $this->model->registrar($codigo, $descripcion, $fecha_inicio, $fecha_fin, $resultado);
                if ($data > 0) {
                    $res = array('msg' => 'TPI CONSOLIDADO REGISTRADO...', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL REGISTRAR...', 'type' => 'error');
                }
            } else {
                $data = $this->model->actualizar($codigo, $descripcion, $fecha_inicio, $fecha_fin, $resultado, $id);
                if ($data > 0) {
                    $res = array('msg' => 'TPI CONSOLIDADO MODIFICADO...', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL MODIFICAR...', 'type' => 'error');
                }
            }
        }
        echo json_encode($res);
        die();
    }


    public function buscar()
    {
        $array = array();
        $codigo = $_GET['term'];
        $data = $this->model->buscarPorCodigo($codigo);
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

    public function buscarCodigo()
    {
        $array = array();
        $valor = $_GET['term'];
        $data = $this->model->buscarCodigo($valor);
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
    // FASE PRUEBA
    function consultar()
    {
        if (isset($_POST['submit'])) {
            $codigo = $_POST['codigoProducto'];
            $fechaInicial = $_POST['fecha_inicial'];
            $fechaFinal = $_POST['fecha_final'];
            $data = $this->model->buscarPorCodigo($codigo, $fechaInicial, $fechaFinal);
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

    // MÉTODO PARA BUSCAR PRODUCTO EN LA PESTAÑA INDICADOR - NUEVO
    // public function buscarNombre()
    // {
    //     $array = array();
    //     $valor = $_GET['term'];
    //     $data = $this->model->buscarPorDescripcion($valor);
    //     foreach ($data as $row) {
    //         $result['id'] = $row['id'];
    //         $result['label'] = $row['descripcion'];
    //         // $result['label'] = $row['descripcion'] . ' →→→→ (' . date('d/m/Y', strtotime($row['fecha'])) . ') '; 
    //         array_push($array, $result);
    //     }
    //     echo json_encode($array, JSON_UNESCAPED_UNICODE);
    //     die();
    // }

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
