<?php
class CreditosModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getCreditos()
    {
        $sql = "SELECT cr.*, cl.nombre FROM creditos cr INNER JOIN ventas v ON cr.id_venta = v.id INNER JOIN clientes cl ON v.id_cliente = cl.id";
        return $this->selectAll($sql);
    }
    public function getAbono($idCredito)
    {
        $sql = "SELECT SUM(abono) AS total FROM abonos WHERE id_credito = $idCredito";
        return $this->select($sql);
    }

    public function buscarPorNombre($valor)
    {
        $sql = "SELECT cr.*, cl.nombre, cl.telefono, cl.direccion FROM creditos cr INNER JOIN ventas v ON cr.id_venta = v.id INNER JOIN clientes cl ON v.id_cliente = cl.id WHERE cl.nombre LIKE '%".$valor."%' AND cr.estado = 1 LIMIT 10";
        return $this->selectAll($sql);
    }

    public function registrarAbono($monto, $idCredito, $id_usuario)
    {
        $sql = "INSERT INTO abonos (abono, id_credito, id_usuario) VALUES (?,?,?)";
        $array = array($monto, $idCredito, $id_usuario);
        return $this->insertar($sql, $array);
    }
    public function getCredito($idCredito)
    {
        $sql = "SELECT cr.*, v.productos, cl.identidad, cl.num_identidad, cl.nombre, cl.telefono, cl.direccion FROM creditos cr INNER JOIN ventas v ON cr.id_venta = v.id INNER JOIN clientes cl ON v.id_cliente = cl.id WHERE cr.id = $idCredito";
        return $this->select($sql);
    }

    public function actualizarCredito($estado, $idCredito)
    {
        $sql = "UPDATE creditos SET estado = ? WHERE id = ?";
        $array = array($estado, $idCredito);
        return $this->save($sql, $array);
    }

    public function getAbonos($idCredito)
    {
        $sql = "SELECT * FROM abonos WHERE id_credito = $idCredito";
        return $this->selectAll($sql);
    }

    public function getHistorialAbonos()
    {
        $sql = "SELECT * FROM abonos";
        return $this->selectAll($sql);
    }

    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        return $this->select($sql);
    }
}

?>