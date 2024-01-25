<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Admin extends Controller
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
    //reportes graficos
    public function index()
    {
        $data['title'] = 'Panel Administrativo';
        $data['script'] = 'index.js'; 
        $data['usuarios'] = $this->model->getTotales('usuarios');
        $data['clientes'] = $this->model->getTotales('clientes');
        $data['proveedores'] = $this->model->getTotales('proveedor');
        $data['productos'] = $this->model->getTotales('productos');
        // GRÁFICO MORRIS

        // ESTO ES PARA MOSTRAR LA DESCRIPCIÓN DE CADA DATA
        $data['usuario'] = $this->model->topUsuariosMorrisNombre(3);
        $data['transportistas'] = $this->model->topTransportistasMorrisNombre(3);
        $data['proveedor'] = $this->model->topProveedoresMorrisNombre(3);
        $data['producto'] = $this->model->topProductosMorris(3);

        $data['nuevos'] = $this->model->nuevosProductos(6);
        $this->views->getView('admin', 'home', $data);
    }
    public function listar()
    {
        $data = $this->model->getProductos(1);
        for ($i = 0; $i < count($data); $i++) {
            $foto = ($data[$i]['foto'] == null) ? 'assets/images/productos/default.png' :  $data[$i]['foto'];
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="' . $foto . '" alt="" width="50">'; 
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    //datos de la empres
    public function datos()
    {
        if ($_SESSION['rol'] == 2) {
            header('Location: ' . BASE_URL . 'admin/permisos/index');
            exit;
        }
        $data['title'] = 'Datos de la Empresa';
        $data['script'] = 'admin.js';
        $data['empresa'] = $this->model->getDatos();
        $this->views->getView('admin', 'index', $data);
    }
    //modificar datos
    public function modificar()
    {
        if ($_SESSION['rol'] == 2) {
            header('Location: ' . BASE_URL . 'admin/permisos/index');
            exit;
        }
        if (isset($_POST)) {
            $ruc = strClean($_POST['ruc']);
            $nombre = strClean($_POST['nombre']);
            $telefono = strClean($_POST['telefono']);
            $correo = strClean($_POST['correo']);
            $direccion = strClean($_POST['direccion']);
            $impuesto = strClean($_POST['impuesto']);
            $mensaje = strClean($_POST['mensaje']);
            $logo = $_FILES['foto'];
            
            $id = strClean($_POST['id']);
            if (empty($ruc)) {
                $res = array('msg' => 'EL RUC ES REQUERIDO...', 'type' => 'warning');
            } else if (empty($nombre)) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO...', 'type' => 'warning');
            } else if (empty($telefono)) {
                $res = array('msg' => 'EL TELEFONO ES REQUERIDO...', 'type' => 'warning');
            } else if (empty($correo)) {
                $res = array('msg' => 'EL CORREO ES REQUERIDO...', 'type' => 'warning');
            } else if (empty($direccion)) {
                $res = array('msg' => 'LA DIRECCION ES REQUERIDO...', 'type' => 'warning');
            } else {
                $data = $this->model->actualizar(
                    $ruc,
                    $nombre,
                    $telefono,
                    $correo,
                    $direccion,
                    $impuesto,
                    $mensaje,
                    $id
                );
                if ($data == 1) {
                    if (!empty($logo['name'])) {
                        $directorio = 'assets/images/logo.png';
                        move_uploaded_file($logo['tmp_name'], $directorio);
                    }
                    $res = array('msg' => 'DATOS MODIFICADO...', 'type' => 'success');
                } else {
                    $res = array('msg' => 'ERROR AL ACTUALIZAR...', 'type' => 'error');
                }
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    
    
    public function topUsuariosMorris()
    {
        $data = $this->model->topUsuariosMorris();
        echo json_encode($data);
        die();
    }
    
    public function topTransportistasMorris()
    {
        $data = $this->model->topTransportistasMorris();
        echo json_encode($data);
        die();
    }

    public function topProveedoresMorris()
    {
        $data = $this->model->topProveedoresMorris();
        echo json_encode($data);
        die();
    }
    
    public function topProductosMorris()
    {
        $data = $this->model->topProductosMorris(4);
        echo json_encode($data);
        die();
    }
    // public function topClientesMorrisNombre()
    // {
    //     $data = $this->model->topClientesMorrisNombre();
    //     echo json_encode($data);
    //     die();
    // }
    // public function topProveedoresMorrisNombre()
    // {
    //     $data = $this->model->topProveedoresMorrisNombre(6);
    //     echo json_encode($data);
    //     die();
    // }

    // INICIO REPORTE GRÁFICO TPI
    public function topProductos()
    {
        $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
        $elementosPorPagina = 10;
        $offset = ($pagina - 1) * $elementosPorPagina;

        $data = $this->model->topProductos($elementosPorPagina, $offset, '2023-07-08');
        echo json_encode($data);
        die();
    }

    public function topProductosPost()
    {
        $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
        $elementosPorPagina = 10;
        $offset = ($pagina - 1) * $elementosPorPagina;

        $data = $this->model->topProductos($elementosPorPagina, $offset, '2023-09-13');
        echo json_encode($data);
        die();
    }
    // FIN REPORTE GRÁFICO TPI
    // INICIO REPORTE GRÁFICO IRS
    
    public function topProductosIRS()
    {
        $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
        $elementosPorPagina = 10;
        $offset = ($pagina - 1) * $elementosPorPagina;

        $data = $this->model->topProductosIRS($elementosPorPagina, $offset, '2023-07-08');
        echo json_encode($data);
        die();
    }

    public function topProductosPostIRS()
    {
        $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
        $elementosPorPagina = 10;
        $offset = ($pagina - 1) * $elementosPorPagina;

        $data = $this->model->topProductosIRS($elementosPorPagina, $offset, '2023-09-19');
        echo json_encode($data);
        die();
    }
    // FIN REPORTE GRÁFICO TPI

    // INICIO REPORTE GRÁFICO PRODUCTOS
    // public function productos($cantidadProductos, $offsetProductos)
    // {
    //     $data = "SELECT codigo, descripcion, cantidad FROM productos LIMIT $cantidadProductos OFFSET $offsetProductos";
    //     return $this->selectAll($data);
    // }

    public function productos()
    {
        $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
        $elementosPorPagina = 15;

        $offset = ($pagina - 1) * $elementosPorPagina;

        $data = $this->model->productos($elementosPorPagina, $offset);
        echo json_encode($data);
        die();
    }

    //PDF - EXCEL de top productos
    public function topProductosPdf()
    {
        ob_start();
        $data['title'] = 'Top Productos';
        $data['empresa'] = $this->model->getEmpresa();
        $data['productos'] = $this->model->topProductos(20);

        $this->views->getView('reportes', 'reportesPdf', $data);
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->set('isJavascriptEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);

        // if ($tipo == 'ticked') {
        //     // $dompdf->setPaper(array(0, 0, 130, 841), 'portrait');
        //     $dompdf->setPaper(array(0, 0, 222, 841), 'portrait');
        // } else {
            
        // }
        $dompdf->setPaper('A4', 'vertical');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('reporte.pdf', array('Attachment' => false));
    }
    
    public function topProductosExcel()
    {
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator($_SESSION['nombre_usuario'])
            ->setTitle("Top Productos");

        $spreadsheet->setActiveSheetIndex(0);

        $hojaActiva = $spreadsheet->getActiveSheet();
        $hojaActiva->getColumnDimension('A')->setWidth(50);
        $hojaActiva->getColumnDimension('B')->setWidth(10);
        $hojaActiva->getColumnDimension('C')->setWidth(20);
        $hojaActiva->getColumnDimension('D')->setWidth(20);
        $hojaActiva->getColumnDimension('E')->setWidth(30);

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('008cff');

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')
            ->getFont()->getColor()->setARGB(Color::COLOR_WHITE);

        $hojaActiva->setCellValue('A1', 'Producto');
        $hojaActiva->setCellValue('B1', 'Cantidad');
        $hojaActiva->setCellValue('C1', 'Precio Compra');
        $hojaActiva->setCellValue('D1', 'Precio Venta');
        $hojaActiva->setCellValue('E1', 'Categoria');

        $fila = 2;
        $productos = $this->model->topProductos(20);
        foreach ($productos as $producto) {
            $hojaActiva->setCellValue('A' . $fila, $producto['descripcion']);
            $hojaActiva->setCellValue('B' . $fila, $producto['cantidad']);
            $hojaActiva->setCellValue('C' . $fila, $producto['precio_compra']);
            $hojaActiva->setCellValue('D' . $fila, $producto['precio_venta']);
            $hojaActiva->setCellValue('E' . $fila, $producto['categoria']);
            $fila++;
        }

        //Generar archivo Excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="topProductos.xlsx"');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    //PDF - EXCEL de stock minimo
    public function stockMinimoPdf()
    {
        ob_start();
        $data['title'] = 'Stock Mínimo';
        $data['empresa'] = $this->model->getEmpresa();
        $data['productos'] = $this->model->minimosProductosPDF();

        $this->views->getView('reportes', 'reportesPdf', $data);
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

    public function stockMinimoExcel()
    {
        $spreadsheet = new Spreadsheet();
        
        $spreadsheet->getProperties()
            ->setCreator($_SESSION['nombre_usuario'])
            ->setTitle("Productos con Stock Mínimo");

        $spreadsheet->setActiveSheetIndex(0);

        $hojaActiva = $spreadsheet->getActiveSheet();
        $hojaActiva->getColumnDimension('A')->setWidth(50);
        $hojaActiva->getColumnDimension('B')->setWidth(10);
        $hojaActiva->getColumnDimension('C')->setWidth(20);
        $hojaActiva->getColumnDimension('D')->setWidth(20);
        $hojaActiva->getColumnDimension('E')->setWidth(30);

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('008cff');

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')
            ->getFont()->getColor()->setARGB(Color::COLOR_WHITE);

        $hojaActiva->setCellValue('A1', 'Producto');
        $hojaActiva->setCellValue('B1', 'Cantidad');
        $hojaActiva->setCellValue('C1', 'Precio Compra');
        $hojaActiva->setCellValue('D1', 'Precio Venta');
        $hojaActiva->setCellValue('E1', 'Categoria');

        $fila = 2;
        $productos = $this->model->minimosProductosPDF();
        foreach ($productos as $producto) {
            $hojaActiva->setCellValue('A' . $fila, $producto['descripcion']);
            $hojaActiva->setCellValue('B' . $fila, $producto['cantidad']);
            $hojaActiva->setCellValue('C' . $fila, $producto['precio_compra']);
            $hojaActiva->setCellValue('D' . $fila, $producto['precio_venta']);
            $hojaActiva->setCellValue('E' . $fila, $producto['categoria']);
            $fila++;
        }

        //Generar archivo Excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="stockMinimo.xlsx"');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    //pdf - Excel de productos recientes
    public function recientesPdf()
    {
        ob_start();
        $data['title'] = 'Productos Recientes';
        $data['empresa'] = $this->model->getEmpresa();
        $data['productos'] = $this->model->nuevosProductos(1);
        $this->views->getView('reportes', 'reportesPdf', $data);
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

    public function recientesExcel()
    {
        $spreadsheet = new Spreadsheet();
        
        $spreadsheet->getProperties()
            ->setCreator($_SESSION['nombre_usuario'])
            ->setTitle("Productos Recientes");

        $spreadsheet->setActiveSheetIndex(0);

        $hojaActiva = $spreadsheet->getActiveSheet();
        $hojaActiva->getColumnDimension('A')->setWidth(50);
        $hojaActiva->getColumnDimension('B')->setWidth(10);
        $hojaActiva->getColumnDimension('C')->setWidth(20);
        $hojaActiva->getColumnDimension('D')->setWidth(20);
        $hojaActiva->getColumnDimension('E')->setWidth(30);

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('008cff');

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')
            ->getFont()->getColor()->setARGB(Color::COLOR_WHITE);

        $hojaActiva->setCellValue('A1', 'Producto');
        $hojaActiva->setCellValue('B1', 'Cantidad');
        $hojaActiva->setCellValue('C1', 'Precio Compra');
        $hojaActiva->setCellValue('D1', 'Precio Venta');
        $hojaActiva->setCellValue('E1', 'Categoria');

        $fila = 2;
        $productos = $this->model->nuevosProductos(20);
        foreach ($productos as $producto) {
            $hojaActiva->setCellValue('A' . $fila, $producto['descripcion']);
            $hojaActiva->setCellValue('B' . $fila, $producto['cantidad']);
            $hojaActiva->setCellValue('C' . $fila, $producto['precio_compra']);
            $hojaActiva->setCellValue('D' . $fila, $producto['precio_venta']);
            $hojaActiva->setCellValue('E' . $fila, $producto['categoria']);
            $fila++;
        }

        //Generar archivo Excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="productosRecientes.xlsx"');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    // LOGS DE ACCESO
    public function logs()
    {
        if ($_SESSION['rol'] == 2) {
            header('Location: ' . BASE_URL . 'admin/permisos/index');
            exit;
        }
        $data['title'] = 'Log de Acceso';
        $data['script'] = 'logs.js';
        $this->views->getView('admin', 'logs', $data);
    }

    public function listarLogs()
    {
        if ($_SESSION['rol'] == 2) {
            header('Location: ' . BASE_URL . 'admin/permisos/index');
            exit;
        }
        if ($_SESSION['rol'] == 2) {
            header('Location: ' . BASE_URL . 'admin/permisos');
            exit;
        }
        $data = $this->model->listarLogs();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function limpiarDatos()
    {
        if ($_SESSION['rol'] == 2) {
            header('Location: ' . BASE_URL . 'admin/permisos/index');
            exit;
        }
        if ($_SESSION['rol'] == 2) {
            header('Location: ' . BASE_URL . 'admin/permisos');
            exit;
        }
        $data = $this->model->limpiarDatos();
        if (empty($data)) {
            $res = array('msg' => 'DATOS LIMPIADO POR COMPLETO...', 'type' => 'success');
        }else{
            $res = array('msg' => 'ERROR AL ELIMINAR DATOS...', 'type' => 'error');
        }
        echo json_encode($res);
        die();
        
    }

    public function permisos()
    {
        $data['title'] = 'Permisos';
        $this->views->getView('admin', 'permisos', $data);
    }
}
