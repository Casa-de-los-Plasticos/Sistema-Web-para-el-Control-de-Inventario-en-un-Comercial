<?php
class ConsolidadoModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getTpi()
    {
        // $fechaInicio = $_POST["fecha_inicio"];
        // $fechaFin = $_POST["fecha_fin"];
        // $sql = "SELECT * FROM consolidado_tpi WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin'";
        $sql = "SELECT * FROM consolidado_tpi";
        return $this->selectAll($sql);
    }

    public function registrar($codigo, $descripcion, $fecha_inicio, $fecha_fin, $resultado)
    {
        $sql = "INSERT INTO consolidado_tpi (codigo, descripcion, fecha_inicio, fecha_fin, resultado, fecha, hora) VALUES (?,?,?,?,?,CURDATE(),CURTIME())";
        $array = array($codigo, $descripcion, $fecha_inicio, $fecha_fin, $resultado);
        return $this->insertar($sql, $array);
    }
    public function getValidar($campo, $valor, $accion, $id)
    {
        if ($accion == 'registrar' && $id == 0) {
            $sql = "SELECT id FROM categorias WHERE $campo = '$valor'";
        } else {
            $sql = "SELECT id FROM categorias WHERE $campo = '$valor' AND id != $id";
        }
        return $this->select($sql);
    }

    public function eliminar($estado, $idCategoria)
    {
        $sql = "UPDATE categorias SET estado = ? WHERE id = ?";
        $array = array($estado, $idCategoria);
        return $this->save($sql, $array);
    }
    public function editar($idCategoria)
    {
        $sql = "SELECT * FROM categorias WHERE id = $idCategoria";
        return $this->select($sql);
    }

    public function actualizar($categoria, $id)
    {
        $sql = "UPDATE categorias SET categoria = ? WHERE id = ?";
        $array = array($categoria, $id);
        return $this->save($sql, $array);
    }

    public function buscarPorCodigo($codigo, $fechaInicial, $fechaFinal)
    {
        $sql = "SELECT ROUND(AVG(resultado),2) AS resultados FROM tpi WHERE codigo = '$codigo' AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
        return $this->selectAll($sql);
    }


    public function buscarCodigo($valor)
    {
        $sql = "SELECT id, codigo, descripcion FROM productos WHERE codigo LIKE '%" . $valor . "%' AND estado = 1 LIMIT 10";
        return $this->selectAll($sql);
    }

    // public function buscarPorDescripcion($valor)
    // {
    //     // $sql = "SELECT id, descripcion FROM productos WHERE descripcion LIKE '%".$valor."%' AND estado = 1 LIMIT 10";
    //     $sql = "SELECT id, descripcion FROM consolidado_tpi WHERE descripcion LIKE '%" . $valor . "%' AND estado = 1 LIMIT 10";
    //     return $this->selectAll($sql);
    // }

    public function topProductos($cantidad, $offset)
    {
        $sql = "SELECT descripcion, resultado FROM consolidado_tpi WHERE fecha = '2023-07-08' LIMIT $cantidad OFFSET $offset";
        return $this->selectAll($sql);
    }
    public function topProductosPost($cantidad, $offset)
    {
        $sql = "SELECT descripcion, resultado FROM consolidado_tpi WHERE fecha = '2023-09-13' LIMIT $cantidad OFFSET $offset";
        return $this->selectAll($sql);
    }

    public function filtrar($descripcion, $fechaInicio, $fechaFin)
    {
        $sql = "SELECT * FROM consolidado_tpi WHERE 1";

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

    public function totalTpi($table, $desde, $hasta)
    {
        $sql = "SELECT * FROM $table WHERE fecha BETWEEN '$desde' AND '$hasta' AND estado = 1";
        return $this->select($sql);
    }
}
