<?php
class CajasModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function abrirCaja($monto, $fecha_apertura, $id_usuario)
    {
        $sql = "INSERT INTO cajas (monto_inicial, fecha_apertura, id_usuario) VALUES (?,?,?)";
        $array = array($monto, $fecha_apertura, $id_usuario);
        return $this->insertar($sql, $array);
    }
    public function getCaja($id_usuario)
    {
        $sql = "SELECT * FROM cajas WHERE estado = 1 AND id_usuario = $id_usuario";
        return $this->select($sql);
    }
    public function getCajas()
    {
        $sql = "SELECT c.*, u.nombre FROM cajas c INNER JOIN usuarios u ON c.id_usuario = u.id";
        return $this->selectAll($sql);
    }
    public function registraGasto($monto, $descripcion, $destino, $id_usuario)
    {
        $sql = "INSERT INTO gastos (monto, descripcion, foto, id_usuario) VALUES (?,?,?,?)";
        $array = array($monto, $descripcion, $destino, $id_usuario);   
        return $this->insertar($sql, $array);             
    }
    public function getGastos()
    {
        $sql = "SELECT * FROM gastos";
        return $this->selectAll($sql);
    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        return $this->select($sql);
    }
    // MOVIMIENTOS
    public function getVentas($campo, $id_usuario)
    {
        $sql = "SELECT SUM($campo) AS total FROM ventas WHERE metodo = 'CONTADO' AND estado = 1 AND apertura = 1 AND id_usuario = $id_usuario";
        return $this->select($sql);
    }
    public function getApartados($id_usuario)
    {
        $sql = "SELECT SUM(d.monto) AS total FROM detalle_apartado d INNER JOIN apartados a ON d.id_apartado = a.id WHERE d.apertura = 1 AND a.id_usuario = $id_usuario";
        return $this->select($sql);
    }
    public function getAbonos($id_usuario)
    {
        $sql = "SELECT SUM(a.abono) AS total FROM abonos a INNER JOIN creditos c ON a.id_credito = c.id INNER JOIN ventas v ON c.id_venta = v.id WHERE a.apertura = 1 AND v.id_usuario = $id_usuario";
        return $this->select($sql);
    }
    public function getCompras($id_usuario)
    {
        $sql = "SELECT SUM(total) AS total FROM compras WHERE estado = 1 AND apertura = 1 AND id_usuario = $id_usuario";
        return $this->select($sql);
    }
    public function getTotalGastos($id_usuario)
    {
        $sql = "SELECT SUM(monto) AS total FROM gastos WHERE apertura = 1 AND id_usuario = $id_usuario";
        return $this->select($sql);
    }

    public function getTotalVentas($id_usuario)
    {
        $sql = "SELECT COUNT(*) AS total FROM ventas WHERE apertura = 1 AND id_usuario = $id_usuario";
        return $this->select($sql);
    }

    // CERRAR CAJA
    public function cerrarCaja($fecha_cierre, $montoFinal, $totalVentas, $egresos, $gastos, $id_usuario)
    {
        $sql = "UPDATE cajas SET fecha_cierre=?, monto_final=?, total_ventas=?, egresos=?, gastos=? , estado = ? WHERE estado = ? AND id_usuario = ?";
        $array = array($fecha_cierre, $montoFinal, $totalVentas, $egresos, $gastos, 0, 1, $id_usuario);
        return $this->save($sql, $array);
    }
    public function actualizarApertura($table, $id_usuario)
    {
        $sql = "UPDATE $table SET apertura = ? WHERE id_usuario = ?";
        $array = array(0, $id_usuario);
        return $this->save($sql, $array);
    }
    public function getHistorialCajas($idCaja)
    {
        $sql = "SELECT * FROM cajas WHERE id = $idCaja";
        return $this->select($sql);
    }
}
?>