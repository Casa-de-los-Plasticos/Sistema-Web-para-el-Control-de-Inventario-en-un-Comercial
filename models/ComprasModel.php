<?php
class ComprasModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getProducto($idProducto)
    {
        $sql = "SELECT * FROM productos WHERE id = $idProducto";
        return $this->select($sql);
    }
    public function registrarCompra($productos, $cantidad, $total, $fecha, $hora, $serie, $idproveedor, $idusuario)
    {
        $sql = "INSERT INTO compras (productos, cantidad, total, fecha, hora, serie, id_proveedor, id_usuario) VALUES (?,?,?,?,?,?,?,?)";
        $array = array($productos, $cantidad, $total, $fecha, $hora, $serie, $idproveedor, $idusuario);
        return $this->insertar($sql, $array);
    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        return $this->select($sql);
    }
    public function getCompra($idCompra)
    {
        $sql = "SELECT c.*, p.ruc, p.nombre, p.telefono, p.direccion FROM compras c INNER JOIN proveedor p ON c.id_proveedor = p.id WHERE c.id = $idCompra";
        return $this->select($sql);
    }
    //actualizar stock}
    public function actualizarStock($cantidad, $idProducto)
    {
        $sql = "UPDATE productos SET cantidad = ? WHERE id = ?";
        $array = array($cantidad, $idProducto);
        return $this->save($sql, $array);
    }

    public function getCompras()
    {
        $sql = "SELECT c.*, p.nombre AS nombre FROM compras c INNER JOIN proveedor p ON c.id_proveedor = p.id";
        // $sql = "SELECT v.*, c.nombre AS nombre FROM ventas v INNER JOIN clientes c ON v.id_cliente = c.id";
        return $this->selectAll($sql);
    }

    public function anular($idCompra)
    {
        $sql = "UPDATE compras SET estado = ? WHERE id = ?";
        $array = array(0, $idCompra);
        return $this->save($sql, $array);
    }
    // MOVIMIENTO
    public function registrarMovimiento($movimento, $accion, $cantidad, $stockActual, $idProducto, $id_usuario)
    {
        $sql = "INSERT INTO inventario (movimiento, accion, cantidad, stock_actual, id_producto, id_usuario) VALUES (?,?,?,?,?,?)";
        $array = array($movimento, $accion, $cantidad, $stockActual, $idProducto, $id_usuario);
        return $this->insertar($sql, $array);
    }
    // INICIO EVALUACIÓN
    public function editar($idCompra)
    {
        $sql = "SELECT c.*, p.nombre AS nombre FROM compras c INNER JOIN proveedor p ON c.id_proveedor = p.id WHERE c.id = $idCompra";
        // $sql = "SELECT * FROM ventas WHERE id = $idVenta";
        return $this->select($sql);
    }
    // FIN EVALUACIÓN
}
?>