<?php
class IrsModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getIrs()
    {
        $sql = "SELECT * FROM irs";
        return $this->selectAll($sql);
    }
    
    // public function getLunes()
    // {
    //     $sql = "SELECT * FROM historial_cantidad WHERE DAYOFWEEK(fecha) = 2"; 
    //     return $this->selectAll($sql);
    // }
    
    // public function getViernes()
    // {
    //     $sql = "SELECT * FROM historial_cantidad WHERE DAYOFWEEK(fecha) = 6"; 
    //     return $this->selectAll($sql);
    // }

    public function registrar($descripcionProducto, $fecha_inicial, $fecha_final, $irsNuevo)
    {
        $sql = "INSERT INTO irs (descripcion, fecha_inicio, fecha_fin, resultado, fecha, hora) VALUES (?,?,?,?,CURDATE(),CURTIME())";
        $array = array($descripcionProducto, $fecha_inicial, $fecha_final, $irsNuevo);
        return $this->insertar($sql, $array);
    }

    public function buscarPorDescripcion($valor)
    {
        $sql = "SELECT id, descripcion FROM productos WHERE descripcion LIKE '%".$valor."%' AND estado = 1 LIMIT 10";
        return $this->selectAll($sql);
    }
    
    public function calcularSalida($descripcion, $fechaInicial, $fechaFinal)
    { 
        $sql = "SELECT SUM(cantidad) FROM ventas WHERE productos = '$descripcion' AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
        return $this->selectAll($sql);
    }

    public function buscarPorNombre($valor)
    {
        $sql = "SELECT id, codigo, descripcion FROM productos WHERE codigo LIKE '%".$valor."%' AND estado = 1 LIMIT 10";
        return $this->selectAll($sql);
    }
}
?>


