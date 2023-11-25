<?php
class ApartadosModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getProducto($idProducto)
    {
        $sql = "SELECT * FROM productos WHERE id = $idProducto";
        return $this->select($sql);
    }
    public function registrarApartado($productos, $fecha_create, $fecha_apartado, $fecha_retiro, $abono, $total, $color, $idCliente, $id_usuario)
    {
        $sql = "INSERT INTO apartados (productos, fecha_create, fecha_apartado, fecha_retiro, abono, total, color, id_cliente, id_usuario) VALUES (?,?,?,?,?,?,?,?,?)";
        $array = array($productos, $fecha_create, $fecha_apartado, $fecha_retiro, $abono, $total, $color, $idCliente, $id_usuario);
        return $this->insertar($sql, $array);
    }

    public function registrarDetalle($monto, $idApartado, $id_usuario)
    {
        $sql = "INSERT INTO detalle_apartado (monto, id_apartado, id_usuario) VALUES (?,?,?)";
        $array = array($monto, $idApartado, $id_usuario);
        return $this->insertar($sql, $array);
    }

    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        return $this->select($sql);
    }
    public function getApartado($idApartado)
    {
        $sql = "SELECT ap.*, cl.identidad, cl.num_identidad, cl.nombre, cl.telefono, cl.direccion FROM apartados ap INNER JOIN clientes cl ON ap.id_cliente = cl.id WHERE ap.id = $idApartado";
        return $this->select($sql);
    }

    public function getApartados()
    {
        $sql = "SELECT ap.*, cl.nombre FROM apartados ap INNER JOIN clientes cl ON ap.id_cliente = cl.id";
        return $this->selectAll($sql);
    }

    public function procesarEntrega($abono, $estado, $idApartado)
    {
        $sql = "UPDATE apartados SET abono = ?, estado = ? WHERE id = ?";
        $array = array($abono, $estado, $idApartado);
        return $this->save($sql, $array);
    }
    // ACTUALIZAR DETALLE APARTADO
    public function actualizarDetalle($abono, $idApartado)
    {
        $sql = "UPDATE detalle_apartado SET monto = ? WHERE id_apartado = ?";
        $array = array($abono, $idApartado);
        return $this->save($sql, $array);
    }
    // MOVIMIENTO
    public function registrarMovimiento($movimento, $accion, $cantidad, $stockActual, $idProducto, $id_usuario)
    {
        $sql = "INSERT INTO inventario (movimiento, accion, cantidad, stock_actual, id_producto, id_usuario) VALUES (?,?,?,?,?,?)";
        $array = array($movimento, $accion, $cantidad, $stockActual, $idProducto, $id_usuario);
        return $this->insertar($sql, $array);
    }

    //actualizar stock}
    public function actualizarStock($cantidad, $ventas, $idProducto)
    {
        $sql = "UPDATE productos SET cantidad = ?, ventas = ? WHERE id = ?";
        $array = array($cantidad, $ventas, $idProducto);
        return $this->save($sql, $array);
    }
    
}

?>