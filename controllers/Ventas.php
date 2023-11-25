<?php
require 'vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

use Dompdf\Dompdf;

class Ventas extends Controller
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
        $data['title'] = 'Ventas';
        $data['script'] = 'ventas.js';
        $data['busqueda'] = 'busqueda.js';
        $data['carrito'] = 'posVenta';
        $resultSerie = $this->model->getSerie();
        $serie = ($resultSerie['total'] == null) ? 1 : $resultSerie['total'] + 1;
        $data['serie'] = $this->generate_numbers($serie, 1, 8);
        $this->views->getView('ventas', 'index', $data);
    }

    public function registrarVenta()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);
        $array['productos'] = array();
        $total = 0;
        if (!empty($datos['productos'])) {
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $metodo = $datos['metodo'];

            $resultSerie = $this->model->getSerie();
            $numSerie = ($resultSerie['total'] == null) ? 1 : $resultSerie['total'] + 1;

            $serie = $this->generate_numbers($numSerie, 1, 8);
            $descuento = (!empty($datos['descuento'])) ? $datos['descuento'] : 0;
            $idCliente = $datos['idCliente'];
            if (empty($idCliente)) {
                $res = array('msg' => 'EL CLIENTE ES OBLIGATORIO...', 'type' => 'warning');
            } else if (empty($metodo)) {
                $res = array('msg' => 'EL METODO ES OBLIGATORIO...', 'type' => 'warning');
            } else {
                $VerificarCaja = $this->model->getCaja($this->id_usuario);
                if (empty($VerificarCaja['monto_inicial'])) {
                    $res = array('msg' => 'LA CAJA SE ENCUENTRA CERRADA...', 'type' => 'warning');
                } else {
                    foreach ($datos['productos'] as $producto) {
                        $result = $this->model->getProducto($producto['id']);
                        $data['id'] = $result['id'];
                        $data['nombre'] = $result['descripcion'];
                        $data['precio'] = $producto['precio'];
                        $data['cantidad'] = $producto['cantidad'];
                        $subTotal = $producto['precio'] * $producto['cantidad'];
                        // array_push($array['productos'], $data); esto es el original
                        $datosProductos = ($data['nombre']); // sin array
                        $cantidad = ($data['cantidad']); // sin array
                        $total += $subTotal;
                    }
                    // $datosProductos = json_encode($array['productos']); esto es el original
                    // $datosProductos = json_encode($result['descripcion']); esto es igual pero sale con comillas
                    $venta = $this->model->registrarVenta($datosProductos, $cantidad, $total, $fecha, $hora, $metodo, $descuento, $serie[0], $idCliente, $this->id_usuario);
                    if ($venta > 0) {
                        foreach ($datos['productos'] as $producto) {
                            $result = $this->model->getProducto($producto['id']);
                            //actualizar stock
                            $nuevaCantidad = $result['cantidad'] - $producto['cantidad'];
                            $totalVentas = $result['ventas'] + $producto['cantidad'];
                            $this->model->actualizarStock($nuevaCantidad, $totalVentas, $result['id']);

                            $movimento = 'Pedido N°: ' . $venta;
                            $cantidad = $producto['cantidad'];
                            $this->model->registrarMovimiento($movimento, 'Salida',  $cantidad, $nuevaCantidad, $producto['id'], $this->id_usuario);
                        }
                        if ($metodo == 'CREDITO') {
                            $monto = $total - $descuento;
                            $this->model->registrarCredito($monto, $fecha, $hora, $venta);
                        }
                        if ($datos['impresion']) {
                            $this->impresionDirecta($venta);
                        }
                        $res = array('msg' => 'PEDIDO GENERADO...', 'type' => 'success', 'idVenta' => $venta);
                    } else {
                        $res = array('msg' => 'ERROR AL GENERAR PEDIDO...', 'type' => 'error');
                    }
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
        $idVenta = $array[1];

        $data['title'] = 'Reporte';
        $data['empresa'] = $this->model->getEmpresa();
        $data['venta'] = $this->model->getVenta($idVenta);
        if (empty($data['venta'])) {
            echo 'Pagina no Encontrada';
            exit;
        }
        $this->views->getView('ventas', $tipo, $data);
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->set('isJavascriptEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);

        if ($tipo == 'ticked') {
            $dompdf->setPaper(array(0, 0, 222, 841), 'portrait');
            // $dompdf->setPaper(array(0, 0, 130, 841), 'portrait');
        } else {
            $dompdf->setPaper('A4', 'vertical');
        }

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('reporte.pdf', array('Attachment' => false));
    }
    // <a class="btn" style="background: #000; color: white;" href="#" onclick="verReporte(' . $data[$i]['id'] . ')"><i class="fas fa-print"></i></a>
    // <a class="btn" style="background: #000; color: white;" href="#" onclick="verReporte(' . $data[$i]['id'] . ')"><i class="fas fa-print"></i></a>

    public function listar()
    {
        $data = $this->model->getVentas();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-warning" href="#" onclick="anularVenta(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></a>
                <button class="btn btn-info" type="button" onclick="modificarSalida(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button> 
                </div>';
            } else {
                $data[$i]['acciones'] = '<div>
                <span class="badge" style="background: #000; color: white;">Anulado</span>
                
                </div>';
            }
        }
        echo json_encode($data);
        die();
    }
// INICIO DE EVALUACION
    public function editar($idVenta)
    {
        $data = $this->model->editar($idVenta);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
// FIN DE EVALUACION

    public function anular($idVenta)
    {
        if (isset($_GET) && is_numeric($idVenta)) {
            $data = $this->model->anular($idVenta);
            if ($data == 1) {
                $resultVenta = $this->model->getVenta($idVenta);
                $ventaProducto = json_decode($resultVenta['productos'], true);
                foreach ($ventaProducto as $producto) {
                    $result = $this->model->getProducto($producto['id']);
                    $nuevaCantidad = $result['cantidad'] + $producto['cantidad'];
                    $totalVentas = $result['ventas'] - $producto['cantidad'];
                    $this->model->actualizarStock($nuevaCantidad, $totalVentas, $producto['id']);
                    // MOVIMIENTOS
                    $movimento = 'Devolución de Venta N°: ' . $idVenta;
                    $this->model->registrarMovimiento($movimento, 'Entrada', $producto['cantidad'], $nuevaCantidad, $producto['id'], $this->id_usuario);
                }
                if ($resultVenta['metodo'] == 'CREDITO') {
                    $this->model->anularCredito($idVenta);
                }
                $res = array('msg' => 'VENTA ANULADA...', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL ANULAR...', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'error');
        }
        echo json_encode($res);
        die();
    }

    public function impresionDirecta($idVenta)
    {
        $empresa = $this->model->getEmpresa();
        $venta = $this->model->getVenta($idVenta);
        $nombre_impresora = "POS-58-Series";
        $connector = new WindowsPrintConnector($nombre_impresora);
        $printer = new Printer($connector);

        # Vamos a alinear al centro lo próximo que imprimamos
        $printer->setJustification(Printer::JUSTIFY_CENTER);

        /*
            Intentaremos cargar e imprimir
            el logo
        */
        try {
            $logo = EscposImage::load("assets/images/logo-icon.png", false);
            $printer->bitImage($logo);
        } catch (Exception $e) {/*No hacemos nada si hay error*/
        }

        /*
            Ahora vamos a imprimir un encabezado
        */

        $printer->text($empresa['nombre'] . "\n");
        $printer->text('RUC: ' . $empresa['ruc'] . "\n");
        $printer->text('Telefono: ' . $empresa['telefono'] . "\n");
        $printer->text('Dirección: ' . $empresa['direccion'] . "\n");
        #La fecha también
        $printer->text(date("Y-m-d H:i:s") . "\n\n");

        #Datos del cliente
        $printer->text('Datos del Cliente' . "\n");
        $printer->text('--------------------' . "\n");
        /*Alinear a la izquierda para la cantidad y el nombre*/
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text($venta['identidad'] . ': ' . $venta['num_identidad'] . "\n");
        $printer->text('Nombre: ' . $venta['nombre'] . "\n");
        $printer->text('Telefono: ' . $venta['telefono'] . "\n");
        $printer->text('Dirección: ' . $venta['direccion'] . "\n\n");

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text('Detalles del Producto' . "\n");
        $printer->text('--------------------' . "\n");
        $productos = json_decode($venta['productos'], true);
        foreach ($productos as $producto) {
            /*Alinear a la izquierda para la cantidad y el nombre*/
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text($producto['cantidad'] . "x" . $producto['nombre'] . "\n");

            /*Y a la derecha para el importe*/
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->text(MONEDA . number_format($producto['precio'], 2) . "\n");
        }

        /*
            Terminamos de imprimir
            los productos, ahora va el total
        */
        $printer->text("--------\n");
        $printer->text("Descuento: " . MONEDA . number_format($venta['descuento'], 2) . "\n");
        $printer->text("--------\n");
        $printer->text("TOTAL: " . MONEDA . number_format($venta['total'] - $venta['descuento'], 2) . "\n\n");


        /*
            Podemos poner también un pie de página
        */
        $printer->text($empresa['mensaje']);



        /*Alimentamos el papel 3 veces*/
        $printer->feed(3);

        /*
            Cortamos el papel. Si nuestra impresora
            no tiene soporte para ello, no generará
            ningún error
        */
        $printer->cut();

        /*
            Por medio de la impresora mandamos un pulso.
            Esto es útil cuando la tenemos conectada
            por ejemplo a un cajón
        */
        $printer->pulse();

        /*
            Para imprimir realmente, tenemos que "cerrar"
            la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
        */
        $printer->close();
    }

    public function verificarStock($idProducto)
    {
        $data = $this->model->getProducto($idProducto);
        echo json_encode($data);
        die();
    }

    function generate_numbers($start, $count, $digits)
    {
        $result = array();
        for ($n = $start; $n < $start + $count; $n++) {
            $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
        }
        return $result;
    }
}
