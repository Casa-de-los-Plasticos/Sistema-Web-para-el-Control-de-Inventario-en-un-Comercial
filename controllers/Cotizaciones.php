<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;
class Cotizaciones extends Controller{
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
        $data['title'] = 'Cotizaciones';
        $data['script'] = 'cotizaciones.js';
        $data['busqueda'] = 'busqueda.js';
        $data['carrito'] = 'posCotizaciones';
        $this->views->getView('cotizaciones', 'index', $data);
    }
    public function registrarCotizacion()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);
        $array['productos'] = array();
        $total = 0;
        if (!empty($datos['productos'])) {
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $metodo = $datos['metodo'];
            $validez = $datos['validez'];
            $descuento = (!empty($datos['descuento'])) ? $datos['descuento'] : 0;
            $idCliente = $datos['idCliente'];
            if (empty($idCliente)) {
                $res = array('msg' => 'EL CLIENTE ES OBLIGATORIO...', 'type' => 'warning');
            } else if (empty($metodo)) {
                $res = array('msg' => 'EL METODO ES OBLIGATORIO...', 'type' => 'warning');
            } else if (empty($validez)) {
                $res = array('msg' => 'LA VALIDEZ ES OBLIGATORIO...', 'type' => 'warning');
            } else {
                foreach ($datos['productos'] as $producto) {
                    $result = $this->model->getProducto($producto['id']);
                    $data['id'] = $result['id'];
                    $data['nombre'] = $result['descripcion'];
                    $data['precio'] = $result['precio_venta'];
                    $data['cantidad'] = $producto['cantidad'];
                    $subTotal = $result['precio_venta'] * $producto['cantidad'];
                    array_push($array['productos'], $data);
                    $total += $subTotal;
                }
                $datosProductos = json_encode($array['productos']);
                $cotizacion = $this->model->registrarCotizacion($datosProductos, $total, $fecha, $hora, $metodo, $validez, $descuento, $idCliente);
                if ($cotizacion > 0) {
                    $res = array('msg' => 'COTIZACIÓN GENERADA...', 'type' => 'success', 'idCotizacion' => $cotizacion);
                } else {
                    $res = array('msg' => 'ERROR AL GENERAR LA COTIZACIÓN...', 'type' => 'error');
                }
            }
        } else {
            $res = array('msg' => 'CANASTA VACÍA...', 'type' => 'warning');
        }
        echo json_encode($res);
        die();
    }

    public function reporte($datos)
    {
        ob_start();
        $array = explode(',', $datos);
        $tipo = $array[0];
        $idCotizacion = $array[1];

        $data['title'] = 'Reporte';
        $data['empresa'] = $this->model->getEmpresa();
        $data['cotizacion'] = $this->model->getCotizacion($idCotizacion);
        if (empty($data['cotizacion'])) {
            echo 'Pagina no Encontrada';
            exit;
        }
        $this->views->getView('cotizaciones', $tipo, $data);
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->set('isJavascriptEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);

        if ($tipo == 'ticked') {
            // $dompdf->setPaper(array(0, 0, 130, 841), 'portrait');
            $dompdf->setPaper(array(0, 0, 222, 841), 'portrait');
        } else {
            $dompdf->setPaper('A4', 'vertical');
        }

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('reporte.pdf', array('Attachment' => false));
    }

    public function listar()
    {
        $data = $this->model->getCotizaciones();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['acciones'] = '<a class="btn" style="background: #000; color: white;" href="#" onclick="verReporte(' . $data[$i]['id'] . ')"><i class="fas fa-print"></i></a>';   
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>