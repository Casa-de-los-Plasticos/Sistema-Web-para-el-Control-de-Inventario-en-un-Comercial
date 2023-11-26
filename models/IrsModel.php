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
    
    public function getLunes()
    {
        $sql = "SELECT * FROM historial_cantidad WHERE DAYOFWEEK(fecha) = 2"; 
        return $this->selectAll($sql);
    }
    
    public function getViernes()
    {
        $sql = "SELECT * FROM historial_cantidad WHERE DAYOFWEEK(fecha) = 6"; 
        return $this->selectAll($sql);
    }

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
        $sql = "SELECT SUM(cantidad) AS ventas FROM ventas WHERE productos = '$descripcion' AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
        return $this->selectAll($sql);
    }

    public function topProductos($cantidad, $offset)
    {
        $sql = "SELECT descripcion, resultado FROM irs WHERE fecha = '2023-07-08' LIMIT $cantidad OFFSET $offset";
        return $this->selectAll($sql);
    }
    public function topProductosPost($cantidad, $offset)
    {
       $sql = "SELECT descripcion, resultado FROM irs WHERE fecha = '2023-09-19' LIMIT $cantidad OFFSET $offset";
        return $this->selectAll($sql);
    }

    public function filtrar($productos, $fechaInicio, $fechaFin)
    {
        $sql = "SELECT * FROM irs WHERE 1";

        // Aplicar filtros si se proporcionan
        $filtros = array();

        if (!empty($productos)) {
            $filtros[] = "descripcion LIKE '%$productos%'";
        }
        if (!empty($fechaInicio)) {
            $filtros[] = "fecha >= '$fechaInicio'";
        }
        if (!empty($fechaFin)) {
            $filtros[] = "fecha <= '$fechaFin'";
        }

        if (!empty($filtros)) {
            $sql .= " AND " . implode(" AND ", $filtros);
        }

        return $this->selectAll($sql);
    }
}
