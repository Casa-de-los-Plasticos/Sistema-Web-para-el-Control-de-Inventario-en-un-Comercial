<?php
class MedidasModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getMedidas($estado)
    {
        $sql = "SELECT * FROM medidas WHERE estado = $estado";
        return $this->selectAll($sql);
    }
    public function registrar($nombre, $nombre_corto)
    {
        $sql = "INSERT INTO medidas (medida, nombre_corto) VALUES (?,?)";
        $array = array($nombre, $nombre_corto);
        return $this->insertar($sql, $array);
    }
    public function getValidar($campo, $valor, $accion, $id)
    {
        if ($accion == 'registrar' && $id == 0) {
            $sql = "SELECT id FROM medidas WHERE $campo = '$valor'";
        }else{
            $sql = "SELECT id FROM medidas WHERE $campo = '$valor' AND id != $id";
        }
        return $this->select($sql);
    }
    public function eliminar($estado, $idMedida)
    {
        $sql = "UPDATE medidas SET estado = ? WHERE id = ?";
        $array = array($estado, $idMedida);
        return $this->save($sql, $array);
    }

    public function editar($idMedida)
    {
        $sql = "SELECT * FROM medidas WHERE id = $idMedida";
        return $this->select($sql);
    }

    public function actualizar($nombre, $nombre_corto, $id)
    {
        $sql = "UPDATE medidas SET medida=?, nombre_corto=? WHERE id=?";
        $array = array($nombre, $nombre_corto, $id);
        return $this->save($sql, $array);
    }
}
?>