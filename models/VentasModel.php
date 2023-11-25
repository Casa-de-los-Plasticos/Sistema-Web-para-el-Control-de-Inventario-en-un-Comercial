<?php
class VentasModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getProducto($idProducto)
    {
        $sql = "SELECT * FROM productos WHERE id = $idProducto";
        return $this->select($sql);
    }
    public function registrarVenta($productos, $cantidad, $total, $fecha, $hora, $metodo, $descuento, $serie, $idCliente, $idusuario)
    {
        $sql = "INSERT INTO ventas (productos, cantidad, total, fecha, hora, metodo, descuento, serie, id_cliente, id_usuario) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $array = array($productos, $cantidad, $total, $fecha, $hora, $metodo, $descuento, $serie, $idCliente, $idusuario);
        return $this->insertar($sql, $array);
    }
    public function actualizarStock($cantidad, $ventas, $idProducto)
    {
        $sql = "UPDATE productos SET cantidad = ?, ventas = ? WHERE id = ?";
        $array = array($cantidad, $ventas,  $idProducto);
        return $this->save($sql, $array);
    }
    public function registrarCredito($monto, $fecha, $hora, $idVenta)
    {
        $sql = "INSERT INTO creditos (monto, fecha, hora, id_venta) VALUES (?,?,?,?)";
        $array = array($monto, $fecha, $hora, $idVenta);
        return $this->insertar($sql, $array);
    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        return $this->select($sql);
    }

    public function getVenta($idVenta)
    {
        $sql = "SELECT v.*, c.identidad, c.num_identidad, c.nombre, c.telefono, c.direccion FROM ventas v INNER JOIN clientes c ON v.id_cliente = c.id WHERE v.id = $idVenta";
        return $this->select($sql);
    }

    public function getVentas()
    {
        // $sql = "SELECT v.*, c.nombre FROM ventas v INNER JOIN clientes c ON v.id_cliente = c.id";
        $sql = "SELECT v.*, c.nombre AS nombre FROM ventas v INNER JOIN clientes c ON v.id_cliente = c.id";
        return $this->selectAll($sql);
    }

    public function anular($idVenta)
    {
        $sql = "UPDATE ventas SET estado = ? WHERE id = ?";
        $array = array(0, $idVenta);
        return $this->save($sql, $array);
    }
    public function anularCredito($idVenta)
    {
        $sql = "UPDATE creditos SET estado = ? WHERE id_venta = ?";
        $array = array(2, $idVenta);
        return $this->save($sql, $array);
    }

    public function getSerie()
    {
        $sql = "SELECT MAX(id) AS total FROM ventas";
        return $this->select($sql);
    }

    // MOVIMIENTO
    public function registrarMovimiento($movimento, $accion, $cantidad, $stockActual, $idProducto, $id_usuario)
    {
        $sql = "INSERT INTO inventario (movimiento, accion, cantidad, stock_actual, id_producto, id_usuario) VALUES (?,?,?,?,?,?)";
        $array = array($movimento, $accion, $cantidad, $stockActual, $idProducto, $id_usuario);
        return $this->insertar($sql, $array);
    }

    public function getCaja($id_usuario)
    {
        $sql = "SELECT * FROM cajas WHERE estado = 1 AND id_usuario = $id_usuario";
        return $this->select($sql);
    }

    // INICIO EVALUACIÓN
    public function editar($idVenta)
    {
        $sql = "SELECT v.*, c.nombre AS nombre FROM ventas v INNER JOIN clientes c ON v.id_cliente = c.id WHERE v.id = $idVenta";
        // $sql = "SELECT * FROM ventas WHERE id = $idVenta";
        return $this->select($sql);
    }
    // FIN EVALUACIÓN
}

?>