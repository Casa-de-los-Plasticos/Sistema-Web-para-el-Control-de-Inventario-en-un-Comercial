<?php
class CotizacionesModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getProducto($idProducto)
    {
        $sql = "SELECT * FROM productos WHERE id = $idProducto";
        return $this->select($sql);
    }
    public function registrarCotizacion($productos, $total, $fecha, $hora, $metodo, $validez, $descuento, $idCliente)
    {
        $sql = "INSERT INTO cotizaciones (productos, total, fecha, hora, metodo, validez, descuento, id_cliente) VALUES (?,?,?,?,?,?,?,?)";
        $array = array($productos, $total, $fecha, $hora, $metodo, $validez, $descuento, $idCliente);
        return $this->insertar($sql, $array);
    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        return $this->select($sql);
    }
    public function getCotizacion($idCotizacion)
    {
        $sql = "SELECT ct.*, cl.identidad, cl.num_identidad, cl.nombre, cl.telefono, cl.direccion FROM cotizaciones ct INNER JOIN clientes cl ON ct.id_cliente = cl.id WHERE ct.id = $idCotizacion";
        return $this->select($sql);
    }

    public function getCotizaciones()
    {
        $sql = "SELECT ct.*, cl.nombre FROM cotizaciones ct INNER JOIN clientes cl ON ct.id_cliente = cl.id";
        return $this->selectAll($sql);
    }
}

?>