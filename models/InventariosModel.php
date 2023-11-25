<?php
class InventariosModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getMovimientos($id_usuario)
    {
        $sql = "SELECT i.*, p.descripcion FROM inventario i INNER JOIN productos p ON i.id_producto = p.id WHERE i.id_usuario = $id_usuario";
        return $this->selectAll($sql);
    }
    public function getMovimientosMes($anio, $mes, $id_usuario)
    {
        $sql = "SELECT i.*, p.descripcion FROM inventario i INNER JOIN productos p ON i.id_producto = p.id WHERE MONTH(i.fecha) = $mes AND YEAR(i.fecha) = $anio AND i.id_usuario = $id_usuario";
        return $this->selectAll($sql);
    }

    public function getProducto($idProducto)
    {
        $sql = "SELECT * FROM productos WHERE id = $idProducto";
        return $this->select($sql);
    }

    public function procesarAjuste($cantidad, $idProducto)
    {
        $sql = "UPDATE productos SET cantidad = ? WHERE id = ?";
        $array = array($cantidad, $idProducto);
        return $this->save($sql, $array);
    }

    // MOVIMIENTO
    public function registrarMovimiento($movimento, $accion, $cantidad, $stockActual, $idProducto, $id_usuario)
    {
        $sql = "INSERT INTO inventario (movimiento, accion, cantidad, stock_actual, id_producto, id_usuario) VALUES (?,?,?,?,?,?)";
        $array = array($movimento, $accion, $cantidad, $stockActual, $idProducto, $id_usuario);
        return $this->insertar($sql, $array);
    }

    public function getKardex($idProducto, $id_usuario)
    {
        $sql = "SELECT i.accion, i.cantidad, i.stock_actual, i.fecha, p.descripcion FROM inventario i INNER JOIN productos p ON i.id_producto = p.id WHERE i.id_producto = $idProducto AND i.id_usuario = $id_usuario";
        return $this->selectAll($sql);
    }

    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        return $this->select($sql);
    }
}

?> 