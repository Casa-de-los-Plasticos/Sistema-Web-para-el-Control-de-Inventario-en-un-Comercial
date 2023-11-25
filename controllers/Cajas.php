<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;
class Cajas extends Controller
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
        $data['script'] = 'cajas.js';
        $data['title'] = 'Movimiento de Cajas';
        $data['caja'] = $this->model->getCaja($this->id_usuario);
        $this->views->getView('cajas', 'index', $data);
    }
    public function abrirCaja()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);
        if (empty($datos['monto'])) {
            $res = array('msg' => 'EL MONTO ES OBLIGATORIO...', 'type' => 'warning');
        } else {
            $verificar = $this->model->getCaja($this->id_usuario);
            if (empty($verificar)) {
                $fecha_apertura = date('Y-m-d');
                $monto = strClean($datos['monto']);
                $data = $this->model->abrirCaja($monto, $fecha_apertura, $this->id_usuario);
                if ($data > 0) {
                    $res = array('msg' => 'CAJA ABIERTA...', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL ABRIR LA CAJA...', 'type' => 'warning');
                }
            } else {
                $res = array('msg' => 'LA CAJA SE ENCUENTRA ABIERTA..', 'type' => 'warning');
            }
        }
        echo json_encode($res);
        die();
    }

    public function listar()
    {
        $data = $this->model->getCajas();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['accion'] = '<a href="'.BASE_URL.'cajas/historialRepote/'.$data[$i]['id'].'" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>';
        }
        echo json_encode($data);
        die();
    }

    public function registraGasto()
    {
        if (isset($_POST['monto']) && isset($_POST['descripcion'])) {
            if (empty($_POST['monto'])) {
                $res = array('msg' => 'EL MONTO ES OBLIGATORIO...', 'type' => 'warning');
            } else if (empty($_POST['descripcion'])) {
                $res = array('msg' => 'LA DESCRIPCIÓN ES OBLIGATORIO...', 'type' => 'warning');
            } else {
                $monto = strClean($_POST['monto']);
                $verificarMonto = $this->getDatos();
                $Ingresos = $verificarMonto['saldo'];
                if ($monto > $Ingresos) {
                    $res = array('msg' => 'NO HAY DINERO EN LA CAJA...' . $Ingresos, 'type' => 'error');
                } else {
                    $descripcion = strClean($_POST['descripcion']);
                    $foto = $_FILES['foto'];
                    $name = $foto['name'];
                    $tmp = $foto['tmp_name'];

                    $destino = null;
                    if (!empty($name)) {
                        $fecha = date('YmdHis');
                        $destino = 'assets/images/gastos/' . $fecha . '.jpg';
                    }
                    $data = $this->model->registraGasto($monto, $descripcion, $destino, $this->id_usuario);
                    if ($data > 0) {
                        if (!empty($name)) {
                            move_uploaded_file($tmp, $destino);
                        }
                        $res = array('msg' => 'GASTO REGISTRADO...', 'type' => 'success');
                    } else {
                        $res = array('msg' => 'ERROR AL REGISTRAR EL GASTO...', 'type' => 'error');
                    }
                }
            }
        }
        echo json_encode($res);
        die();
    }

    public function listargastos()
    {
        $data = $this->model->getGastos();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['foto'] = '<a href="' . BASE_URL . $data[$i]['foto'] . '" target="_blank"><img class="img-thumbnail" src="' . BASE_URL . $data[$i]['foto'] . '" widht="200"></a>';
        }
        echo json_encode($data);
        die();
    }
    public function movimientos()
    {
        $data = $this->getDatos();
        $data['moneda'] = MONEDA;
        echo json_encode($data);
        die();
    }
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

        $data['egresos'] = number_format($compras + $gastos, 2, '.', '');
        $data['ingresos'] = number_format(($ventas + $apartados + $creditos) - $descuento, 2, '.', '');
        $data['montoInicial'] = (!empty($montoInicial['monto_inicial'])) ? number_format($montoInicial['monto_inicial'], 2, '.', '') : 0;
        $data['gastos'] = number_format($gastos, 2, '.', '');
        $data['saldo'] = number_format(($data['ingresos'] + $data['montoInicial'] - $data['egresos']), 2, '.', '');

        $data['egresosDecimal'] = number_format($data['egresos'], 2);
        $data['ingresosDecimal'] = number_format($data['ingresos'], 2);
        $data['inicialDecimal'] = number_format($data['montoInicial'], 2);
        $data['gastosDecimal'] = number_format($data['gastos'], 2);
        $data['saldoDecimal'] = number_format($data['saldo'], 2);

        return $data;
    }
    public function reporte()
    {
        ob_start();

        $data['title'] = 'Reporte Actual';
        $data['actual'] = true;
        $data['empresa'] = $this->model->getEmpresa();
        $data['movimientos'] = $this->getDatos();
        $this->views->getView('cajas', 'reporte', $data);
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->set('isJavascriptEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'vertical');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('reporte.pdf', array('Attachment' => false));
    }

    public function cerrarCaja()
    {
        $data = $this->getDatos();
        $ventas = $this->model->getTotalVentas($this->id_usuario);
        $fecha_cierre = date('Y-m-d');
        $montoFinal = $data['ingresos'];
        $totalVentas = $ventas['total'];
        $egresos = $data['egresos'];
        $gastos = $data['gastos'];
        $result = $this->model->cerrarCaja($fecha_cierre, $montoFinal, $totalVentas, $egresos, $gastos, $this->id_usuario);
        if ($result == 1) {
            $this->model->actualizarApertura('compras', $this->id_usuario);
            $this->model->actualizarApertura('gastos', $this->id_usuario);
            $this->model->actualizarApertura('ventas', $this->id_usuario);
            $this->model->actualizarApertura('abonos', $this->id_usuario);
            $this->model->actualizarApertura('detalle_apartado', $this->id_usuario);
            $res = array('msg' => 'CAJA CERRADA...', 'type' => 'success');
        } else {
            $res = array('msg' => 'ERROR AL CERRAR LA CAJA...', 'type' => 'error');
        }
        echo json_encode($res);
        die();
    }

    public function historialRepote($idCaja)
    {
        ob_start();
        $data['title'] = 'Reporte: ' . $idCaja;
        $data['idCaja'] = $idCaja;
        $data['actual'] = false;
        $data['empresa'] = $this->model->getEmpresa();
        $datos = $this->model->getHistorialCajas($idCaja);
        $data['movimientos']['inicialDecimal'] = $datos['monto_inicial'];
        $data['movimientos']['ingresosDecimal'] = $datos['monto_final'];
        $data['movimientos']['egresosDecimal'] = $datos['egresos'];
        $data['movimientos']['gastosDecimal'] = $datos['gastos'];
        $data['movimientos']['saldoDecimal'] = number_format($datos['monto_final'] + $datos['monto_inicial'], 2);
        $this->views->getView('cajas', 'reporte', $data);
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->set('isJavascriptEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'vertical');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('reporte.pdf', array('Attachment' => false));
    }
}
