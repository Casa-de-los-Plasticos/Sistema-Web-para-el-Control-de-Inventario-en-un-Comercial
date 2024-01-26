<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Productos extends Controller
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
        $data['title'] = 'Productos';
        $data['script'] = 'productos.js';
        $data['medidas'] = $this->model->getDatos('medidas');
        $data['categorias'] = $this->model->getDatos('categorias');
        $data['proveedor'] = $this->model->getDatos('proveedor');
        $this->views->getView('productos', 'index', $data);
    }
    public function listar()
    {
        $data = $this->model->getProductos(1);
        for ($i = 0; $i < count($data); $i++) {
            $foto = ($data[$i]['foto'] == null) ? 'assets/images/productos/default.png' :  $data[$i]['foto'];
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="' . $foto . '" alt="" width="50">';
            $data[$i]['acciones'] = '<div><button class="btn btn-danger" type="button" onclick="eliminarProducto(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button><button class="btn btn-info" type="button" onclick="editarProducto(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button></div';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function registrar()
    {
        if (isset($_POST['codigo']) && isset($_POST['nombre'])) {
            $id = strClean($_POST['id']);
            $codigo = strClean($_POST['codigo']);
            $nombre = strClean($_POST['nombre']);
            // $precio_compra = strClean($_POST['precio_compra']);
            // $precio_venta = strClean($_POST['precio_venta']);
            $cantidad = strClean($_POST['cantidad']);
            $id_medida = strClean($_POST['id_medida']);
            $id_categoria = strClean($_POST['id_categoria']);
            $id_proveedor = strClean($_POST['id_proveedor']);
            $ubicacion = strClean($_POST['ubicacion']);
            $fotoActual = strClean($_POST['foto_actual']);
            $foto = $_FILES['foto'];
            $name = $foto['name'];
            $tmp = $foto['tmp_name'];
            $destino = null;
            if (!empty($name)) {
                $fecha = date('YmdHis');
                $destino = 'assets/images/productos/' . $fecha . '.jpg';
            } else if (!empty($fotoActual) && empty($name)) {
                $destino = $fotoActual;
            }
            if (empty($codigo)) {
                $res = array('msg' => 'EL CÓDIGO ES OBLIGATORIO...', 'type' => 'warning');
            } else if (empty($nombre)) {
                $res = array('msg' => 'EL NOMBRE ES OBLIGATORIO...', 'type' => 'warning');
            } 
            // else if (empty($precio_compra)) {
            //     $res = array('msg' => 'EL PRECIO COMPRA ES OBLIGATORIO...', 'type' => 'warning');
            // } else if (empty($precio_venta)) {
            //     $res = array('msg' => 'EL PRECIO VENTA ES OBLIGATORIO...', 'type' => 'warning');
            // } 
            else if (empty($id_medida)) {
                $res = array('msg' => 'LA MEDIDA ES OBLIGATORIO...', 'type' => 'warning');
            } else if (empty($id_categoria)) {
                $res = array('msg' => 'LA CATEGORIA ES OBLIGATORIO...', 'type' => 'warning');
            } else if (empty($id_proveedor)) {
                $res = array('msg' => 'EL PROVEEDOR ES OBLIGATORIO...', 'type' => 'warning');
            } else if (empty($ubicacion)) {
                $res = array('msg' => 'LA UBICACIÓN ES OBLIGATORIO...', 'type' => 'warning');
            } else {
                if ($id == '') {
                    $verificar = $this->model->getValidar('codigo', $codigo, 'registrar', 0);
                    if (empty($verificar)) {

                        $data = $this->model->registrar($codigo, $nombre, $cantidad, $id_medida, $id_categoria, $id_proveedor, $ubicacion, $destino);
                        if ($data > 0) {
                            if (!empty($name)) {
                                move_uploaded_file($tmp, $destino);
                            }
                            $res = array('msg' => 'PRODUCTO REGISTRADO...', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR AL REGISTRAR...', 'type' => 'error');
                        }
                    } else {
                        $res = array('msg' => 'EL CÓDIGO DEBE SER ÚNICO...', 'type' => 'warning');
                    }
                } else {
                    $verificar = $this->model->getValidar('codigo', $codigo, 'actualizar', $id);
                    if (empty($verificar)) {

                        $data = $this->model->actualizar($codigo, $nombre, $cantidad, $id_medida, $id_categoria, $id_proveedor, $ubicacion, $destino, $id);
                        if ($data > 0) {
                            if (!empty($name)) {
                                move_uploaded_file($tmp, $destino);
                            }
                            $res = array('msg' => 'PRODUCTO MODIFICADO...', 'type' => 'success');
                        } else {
                            $res = array('msg' => 'ERROR AL MODIFICAR...', 'type' => 'error');
                        }
                    } else {
                        $res = array('msg' => 'EL CÓDIGO DEBE SER ÚNICO...', 'type' => 'warning');
                    }
                }
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'error');
        }
        echo json_encode($res);
        die();
    }
    public function eliminar($idProducto)
    {
        if (isset($_GET) && is_numeric($idProducto)) {
            $data = $this->model->eliminar(0, $idProducto);
            if ($data == 1) {
                $res = array('msg' => 'PRODUCTO DADO DE BAJA...', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL ELIMINAR...', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'warning');
        }
        echo json_encode($res);
        die();
    }

    public function editar($idProducto)
    {
        $data = $this->model->editar($idProducto);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function inactivos()
    {
        $data['title'] = 'Productos Inactivos';
        $data['script'] = 'productos-inactivos.js';
        $this->views->getView('productos', 'inactivos', $data);
    }

    public function listarInactivos()
    {
       $data = $this->model->getProductos(0);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="' . $data[$i]['foto'] . '" alt="" width="100">';
            $data[$i]['acciones'] = '<div><button class="btn btn-success" type="button" onclick="restaurarProducto(' . $data[$i]['id'] . ')"><i class="fas fa-check-circle"></i></button></div';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function restaurar($idProducto)
    {
        if (isset($_GET) && is_numeric($idProducto)) {
            $data = $this->model->eliminar(1, $idProducto);
            if ($data == 1) {
                $res = array('msg' => 'PRODUCTO RESTAURADO...', 'type' => 'success');
            } else {
                $res = array('msg' => 'ERROR AL RESTAURAR...', 'type' => 'error');
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO...', 'type' => 'warning');
        }
        echo json_encode($res);
        die();
    }

    //buscar Productos por codigo
    public function buscarPorCodigo($valor)
    {
        $array = array('estado' => false, 'datos' => '');
        $data = $this->model->buscarPorCodigo($valor);
        if (!empty($data)) {
            $array['estado'] = true;
            $array['datos'] = $data;
        }        
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }
    //buscar Productos por nombre
    public function buscarPorNombre()
    {
        $array = array();
        $valor = $_GET['term'];
        $data = $this->model->buscarPorNombre($valor);
        foreach ($data as $row) {
            $result['id'] = $row['id'];
            $result['label'] = $row['descripcion'];
            $result['stock'] = $row['cantidad'];
            // $result['precio_venta'] = $row['precio_venta'];
            // $result['precio_compra'] = $row['precio_compra'];
            array_push($array, $result);
        }
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }

    //mostrar productos desde localStorage
    public function mostrarDatos()
    {
        $json = file_get_contents('php://input');
        $datos = json_decode($json, true);
        $array['productos'] = array();
        $totalCompra = 0;
        $totalVenta = 0;
        if (!empty($datos)) {
            foreach ($datos as $producto) {
                $result = $this->model->editar($producto['id']);
                $data['id'] = $result['id'];
                $data['nombre'] = $result['descripcion'];
                $data['precio_compra'] = number_format((empty($producto['precio'])) ? 0 : $producto['precio'], 2, '.', '');
                $data['precio_venta'] = number_format((empty($producto['precio'])) ? 0 : $producto['precio'], 2, '.', '');
                $data['cantidad'] = $producto['cantidad'];
                $subTotalCompra = $data['precio_compra'] * $producto['cantidad'];
                $subTotalVenta = $data['precio_venta'] * $producto['cantidad'];
                $data['subTotalCompra'] = number_format($subTotalCompra, 2);
                $data['subTotalVenta'] = number_format($subTotalVenta, 2);
                array_push($array['productos'], $data);
                $totalCompra += $subTotalCompra;
                $totalVenta += $subTotalVenta;
            }
        }
        $array['totalCompra'] = number_format($totalCompra, 2);
        $array['totalVenta'] = number_format($totalVenta, 2);
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reporteExcel()
    {
        $spreadsheet = new Spreadsheet();
        
        $spreadsheet->getProperties()
            ->setCreator($_SESSION['nombre_usuario'])
            ->setTitle("Listado de Productos");

        $spreadsheet->setActiveSheetIndex(0);

        $hojaActiva = $spreadsheet->getActiveSheet();
        $hojaActiva->getColumnDimension('A')->setWidth(50);
        $hojaActiva->getColumnDimension('B')->setWidth(10);
        $hojaActiva->getColumnDimension('C')->setWidth(20);
        // $hojaActiva->getColumnDimension('D')->setWidth(20);
        // $hojaActiva->getColumnDimension('E')->setWidth(30);

        $spreadsheet->getActiveSheet()->getStyle('A1:C1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('008cff');

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')
            ->getFont()->getColor()->setARGB(Color::COLOR_WHITE);

        $hojaActiva->setCellValue('A1', 'PRODUCTO');
        $hojaActiva->setCellValue('B1', 'CANTIDAD');
        // $hojaActiva->setCellValue('C1', 'Precio Compra');
        // $hojaActiva->setCellValue('D1', 'Precio Venta');
        $hojaActiva->setCellValue('C1', 'CATEGORIA');

        $fila = 2;
        $productos = $this->model->getProductos(1);
        foreach ($productos as $producto) {
            $hojaActiva->setCellValue('A' . $fila, $producto['descripcion']);
            $hojaActiva->setCellValue('B' . $fila, $producto['cantidad']);
            // $hojaActiva->setCellValue('C' . $fila, $producto['precio_compra']);
            // $hojaActiva->setCellValue('D' . $fila, $producto['precio_venta']);
            $hojaActiva->setCellValue('C' . $fila, $producto['categoria']);
            $fila++;
        }

        //Generar archivo Excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="productos.xlsx"');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function reportePdf()
    {
        ob_start();
        $data['title'] = 'Listado de Productos';
        $data['empresa'] = $this->model->getEmpresa();
        $data['productos'] = $this->model->getProductos(1);
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

    public function generarBarcode()
    {
        //$redColor = [255, 0, 0];
        $data['productos'] = $this->model->getProductos(1);
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $ruta = 'assets/images/barcode/';
        foreach ($data['productos'] as $producto) {
            file_put_contents($ruta . $producto['id']. '.png', $generator->getBarcode($producto['codigo'], $generator::TYPE_CODE_128, 3, 50));
        }
        ob_start();
        $data['title'] = 'Barcode';
        $this->views->getView('reportes', 'barcode', $data);
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
