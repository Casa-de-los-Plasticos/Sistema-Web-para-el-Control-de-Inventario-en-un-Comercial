<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;
class Creditos extends Controller
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
        $data['script'] = 'creditos.js';
        $data['title'] = 'Administrar Creditos';
        $this->views->getView('creditos', 'index', $data);
    }
    public function listar()
    {
        $data = $this->model->getCreditos();
        for ($i = 0; $i < count($data); $i++) {
            $credito = $this->model->getCredito($data[$i]['id']);
            $result = $this->model->getAbono($data[$i]['id']);
            $abonado = ($result['total'] == null) ? 0 : $result['total'];
            $restante = $data[$i]['monto'] - $abonado;
            if ($restante < 1 && $credito['estado'] = 1) {
                $this->model->actualizarCredito(0, $data[$i]['id']);
            }
            $data[$i]['monto'] = number_format($data[$i]['monto'], 2);
            $data[$i]['abonado'] = number_format($abonado, 2);
            $data[$i]['restante'] = number_format($restante, 2);
            $data[$i]['venta'] = 'N°: ' . $data[$i]['id_venta'];
            $data[$i]['acciones'] = '<a class="btn" style="background: #000; color: white;" href="'.BASE_URL.'creditos/reporte/'.$data[$i]['id'].'" target="_blank"><i class="fas fa-print"></i></a>';
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge bg-warning"> PENDIENTE </span>';
            } else if ($data[$i]['estado'] == 2) {
                $data[$i]['estado'] = '<span class="badge bg-danger"> ANULADO </span>';

            } else {
                $data[$i]['estado'] = '<span class="badge bg-success"> COMPLETADO </span>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function buscar()
    {
        $array = array();
        $valor = strClean($_GET['term']);
        $data = $this->model->buscarPorNombre($valor);
        foreach ($data as $row) {
            $resultAbono = $this->model->getAbono($row['id']);
            $abonado = ($resultAbono['total'] == null) ? 0 : $resultAbono['total'];
            //calcular restante  (monto - abono)
            $restante = $row['monto'] - $abonado;
            $result['monto'] = $row['monto'];
            $result['abonado'] = $abonado;
            $result['restante'] = $restante;
            $result['fecha'] = $row['fecha'];
            $result['id'] = $row['id'];
            $result['label'] = $row['nombre'];
            $result['telefono'] = $row['telefono'];
            $result['direccion'] = $row['direccion'];
            array_push($array, $result);
        }
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrarAbono()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);
        if (!empty($datos)) {
            $idCredito = strClean($datos['idCredito']);
            $monto = strClean($datos['monto_abonar']);
            $data = $this->model->registrarAbono($monto, $idCredito, $this->id_usuario);
            if ($data > 0) {
                $res = array('msg' => 'ABONO REGISTRADO...', 'type' => 'success');
            }else{
            $res = array('msg' => 'ERROR AL REGISTRAR...', 'type' => 'error');
            }
        }else{
            $res = array('msg' => 'TODO LOS CAMPOS SON OBLIGATORIOS...', 'type' => 'warning');
        }
        echo json_encode($res);
        die();
    }

    public function reporte($idCredito)
    {
        ob_start();
        $data['title'] = 'Reporte';
        $data['empresa'] = $this->model->getEmpresa();
        $data['credito'] = $this->model->getCredito($idCredito);
        $data['abonos'] = $this->model->getAbonos($idCredito);
        if (empty($data['credito'])) {
            echo 'Pagina no Encontrada';
            exit;
        }
        $this->views->getView('creditos', 'reporte', $data);
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

    public function listarAbonos()
    {
        $data = $this->model->getHistorialAbonos();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['credito'] = 'N°: ' . $data[$i]['id_credito'];
        }
        echo json_encode($data);
        die();
    }
}
