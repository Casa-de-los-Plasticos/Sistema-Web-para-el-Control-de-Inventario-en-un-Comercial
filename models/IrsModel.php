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
        $sql = "SELECT * FROM historial_cantidad WHERE DAYOFWEEK(fecha) = 2 ORDER BY fecha DESC, hora DESC";  
        return $this->selectAll($sql);
    }
    
    public function getViernes()
    {
        $sql = "SELECT * FROM historial_cantidad WHERE DAYOFWEEK(fecha) = 6 ORDER BY fecha DESC, hora DESC"; 
        return $this->selectAll($sql);
    }

    public function registrar($nombre, $fecha_inicio, $fecha_fin, $resultado)
    {
        $sql = "INSERT INTO irs (descripcion, fecha_inicio, fecha_fin, resultado, fecha, hora) VALUES (?,?,?,?,CURDATE(),CURTIME())";
        $array = array($nombre, $fecha_inicio, $fecha_fin, $resultado);
        return $this->insertar($sql, $array);
    }

    public function actualizar($categoria, $id)
    {
        $sql = "UPDATE categorias SET categoria = ? WHERE id = ?";
        $array = array($categoria, $id);
        return $this->save($sql, $array);
    }

    public function buscarPorDescripcion($valor)
    {
        $sql = "SELECT id, descripcion FROM productos WHERE descripcion LIKE '%".$valor."%' AND estado = 1 LIMIT 10";
        return $this->selectAll($sql);
    }
    
    public function calcularSalida($descripcion, $fechaInicial, $fechaFinal)
    { 
        $sql = "SELECT SUM(cantidad) AS total FROM ventas WHERE productos = '$descripcion' AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
        return $this->selectAll($sql);
    }

    public function buscarPorNombre($valor)
    {
        $sql = "SELECT id, descripcion FROM productos WHERE descripcion LIKE '%".$valor."%' AND estado = 1 LIMIT 10";
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

    public function filtrar($descripcion, $fechaInicio, $fechaFin)
    {
        $sql = "SELECT * FROM irs WHERE 1";

        // Aplicar filtros si se proporcionan
        $filtros = array();

        if (!empty($descripcion)) {
            $filtros[] = "descripcion LIKE '%$descripcion%'";
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
?>


