<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

class Compras extends Controller
{
    private $id_usuario, $caja;
    public function __construct()
    {
        parent::__construct();
        require_once 'controllers/Cajas.php';
        $this->caja = new Cajas();
        if (empty($_SESSION['id_usuario'])) {
            header('Location: ' . BASE_URL);
            exit();
        }
        $this->id_usuario = $_SESSION['id_usuario'];
    }
    public function index()
    {
        $data['title'] = 'Compras';
        $data['script'] = 'compras.js';
        $data['busqueda'] = 'busqueda.js';
        $data['carrito'] = 'posCompra';
        $this->views->getView('compras', 'index', $data);
    }
    public function registrarCompra()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);
        $array['productos'] = array();
        $total = 0;
        if (!empty($datos['productos'])) {
            $indice = $datos['serie'];
            $numberSerie = $this->generate_numbers($indice, 1, 8);
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $serie = $numberSerie[0];
            $idproveedor = $datos['idProveedor'];
            if (empty($idproveedor)) {
                $res = array('msg' => 'EL PROVEEDOR ES OBLIGATORIO...', 'type' => 'warning');
            } else if (empty($serie)) {
                $res = array('msg' => 'LA SERIE ES OBLIGATORIO...', 'type' => 'warning');
            } else {
                $saldo = $this->caja->getDatos();
                foreach ($datos['productos'] as $producto) {
                    $result = $this->model->getProducto($producto['id']);
                    $data['id'] = $result['id'];
                    $data['nombre'] = $result['descripcion'];
                    // $data['precio'] = $result['precio_compra']; 
                    $data['cantidad'] = $producto['cantidad'];
                    $subTotal = $producto['cantidad'];
                    // $subTotal = $result['precio_compra'] * $producto['cantidad'];
                    // array_push($array['productos'], $data); esto es el original
                    $datosProductos = ($data['nombre']); // sin array
                    $cantidad = ($data['cantidad']); // sin array
                    $total += $subTotal;
                }
                if ($saldo['saldo'] >= $total) {
                    // $datosProductos = json_encode($array['productos']);
                    $compra = $this->model->registrarCompra($datosProductos, $cantidad, $total, $fecha, $hora, $serie, $idproveedor, $this->id_usuario);
                    if ($compra > 0) {
                        foreach ($datos['productos'] as $producto) {
                            $result = $this->model->getProducto($producto['id']);
                            //actualizar stock
                            $nuevaCantidad = $result['cantidad'] + $producto['cantidad'];
                            $this->model->actualizarStock($nuevaCantidad, $result['id']);

                            $movimento = 'Ingreso N°: ' . $compra;
                            $this->model->registrarMovimiento($movimento, 'Entrada', $producto['cantidad'], $nuevaCantidad, $producto['id'], $this->id_usuario);
                        }
                        $res = array('msg' => 'COMPRA GENERADA...', 'type' => 'success', 'idCompra' => $compra);
                    } else {
                        $res = array('msg' => 'ERROR AL CREAR COMPRA...', 'type' => 'error');
                    }
                } else {
                    $res = array('msg' => 'SALDO DISPONIBLE: ' . MONEDA . $saldo['saldo'] . ' ...', 'type' => 'warning');
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
        $idCompra = $array[1];

        $data['title'] = 'Reporte';
        $data['empresa'] = $this->model->getEmpresa();
        $data['compra'] = $this->model->getCompra($idCompra);
        if (empty($data['compra'])) {
            echo 'Pagina no Encontrada...';
            exit;
        }
        $this->views->getView('compras', $tipo, $data);
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->set('isJavascriptEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);

        if ($tipo == 'ticked') {
            $dompdf->setPaper(array(0, 0, 222, 841), 'portrait');
        } else {
            $dompdf->setPaper('A4', 'vertical');
        }

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('ticked.pdf', array('Attachment' => false));
    }

    // <a class="btn" style="background: #000; color: #fff;" href="#" onclick="verReporte(' . $data[$i]['id'] . ')"><i class="fas fa-print"></i></a>
    // <a class="btn" style="background: #000; color: #fff;" href="#" onclick="verReporte(' . $data[$i]['id'] . ')"><i class="fas fa-print"></i></a>

    public function listar()
    {
        $data = $this->model->getCompras();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-warning" href="#" onclick="anularCompra(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></a>
                <button class="btn btn-info" type="button" onclick="modificarIngreso(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button> 
                
                
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

    public function anular($idCompra)
    {
        if (isset($_GET) && is_numeric($idCompra)) {
            $data = $this->model->anular($idCompra);
            if ($data == 1) {
                $resultCompra = $this->model->getCompra($idCompra);
                $compraProducto = json_decode($resultCompra['productos'], true);
                foreach ($compraProducto as $producto) {
                    $result = $this->model->getProducto($producto['id']);
                    $nuevaCantidad = $result['cantidad'] - $producto['cantidad'];
                    $this->model->actualizarStock($nuevaCantidad, $producto['id']);
                    // MOVIMIENTOS
                    $movimento = 'Devolución de Compra N°: ' . $idCompra;
                    $this->model->registrarMovimiento($movimento, 'Salida', $producto['cantidad'], $nuevaCantidad, $producto['id'], $this->id_usuario);
                }
                $res = array('msg' => 'COMPRA ANULADO...', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL ANULAR...', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'error');
        }
        echo json_encode($res);
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

    // COMPROBAR SALDO EN LA CAJA
    public function getDatos()
    {
        $consultaVenta = $this->model->getVentas('total', $this->id_usuario);
        $ventas = ($consultaVenta['total'] != null) ? $consultaVenta['total'] : 0;

        $consultaDescuento = $this->model->getVentas('descuento', $this->id_usuario);
        $descuento = ($consultaDescuento['total'] != null) ? $consultaDescuento['total'] : 0;

        $consultaApartados = $this->model->getApartados($this->id_usuario);
        $apartados = ($consultaApartados['total'] != null) ? $consultaApartados['total'] : 0;

        $consultaCreditos = $this->model->getAbonos($this->id_usuario);
        $creditos = ($consultaCreditos['total'] != null) ? $consultaCreditos['total'] : 0;

        $consultaCompras = $this->model->getCompras($this->id_usuario);
        $compras = ($consultaCompras['total'] != null) ? $consultaCompras['total'] : 0;

        $consultaGastos = $this->model->getTotalGastos($this->id_usuario);
        $gastos = ($consultaGastos['total'] != null) ? $consultaGastos['total'] : 0;

        $montoInicial = $this->model->getCaja($this->id_usuario);

        $data['egresos'] = $compras + $gastos;
        $data['ingresos'] = ($ventas + $apartados + $creditos) - $descuento;
        $data['montoInicial'] = (!empty($montoInicial['monto_inicial'])) ? $montoInicial['monto_inicial'] : 0;
        $data['gastos'] = $gastos;
        $data['saldo'] = ($data['ingresos'] + $data['montoInicial'] - $data['egresos']);

        $data['egresosDecimal'] = number_format($data['egresos'], 2);
        $data['ingresosDecimal'] = number_format($data['ingresos'], 2);
        $data['inicialDecimal'] = number_format($data['montoInicial'], 2);
        $data['gastosDecimal'] = number_format($data['gastos'], 2);
        $data['saldoDecimal'] = number_format($data['saldo'], 2);

        return $data;
    }
}
