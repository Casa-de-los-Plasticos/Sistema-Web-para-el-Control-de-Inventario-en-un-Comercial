<?php
class AlmacenModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getAlmacen($estado)
    {
        $sql = "SELECT * FROM stock_fisico WHERE estado = $estado ORDER BY fecha DESC, hora DESC";
        return $this->selectAll($sql);
    }

    public function registrar($codigo, $descripcion, $cantidad, $razon)
    {
        $sql = "INSERT INTO stock_fisico (codigo, descripcion, cantidad, razon, fecha, hora) VALUES (?,?,?,?,CURDATE(),CURTIME())";
        $array = array($codigo, $descripcion, $cantidad, $razon);
        return $this->insertar($sql, $array);
    }
    public function getValidar($campo, $valor, $accion, $id)
    {
        if ($accion == 'registrar' && $id == 0) {
            $sql = "SELECT id FROM stock_fisico WHERE $campo = '$valor'";
        }else{
            $sql = "SELECT id FROM stock_fisico WHERE $campo = '$valor' AND id != $id";
        }
        return $this->select($sql);
    }

    public function eliminar($estado, $idAlmacen)
    {
        $sql = "UPDATE stock_fisico SET estado = ? WHERE id = ?";
        $array = array($estado, $idAlmacen);
        return $this->save($sql, $array);
    }

    public function editar($idMedida)
    {
        $sql = "SELECT * FROM medidas WHERE id = $idMedida";
        return $this->select($sql);
    }

    public function actualizar($codigo, $descripcion, $cantidad, $razon, $id)
    {
        $sql = "UPDATE stock_fisico SET codigo=?, descripcion=?, cantidad=?, razon=? WHERE id=?";
        $array = array($codigo, $descripcion, $cantidad, $razon, $id);
        return $this->save($sql, $array);
    }

    public function buscarPorCodigo($valor)
    {
        $sql = "SELECT id, codigo, descripcion FROM productos WHERE codigo LIKE '%".$valor."%' AND estado = 1 LIMIT 10";
        return $this->selectAll($sql);
    }
}


?>