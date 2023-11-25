<?php
class CategoriasModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getCategorias($estado)
    {
        $sql = "SELECT * FROM categorias WHERE estado = $estado";
        return $this->selectAll($sql);
    }
    public function registrar($categoria)
    {
        $sql = "INSERT INTO categorias (categoria) VALUES (?)";
        $array = array($categoria);
        return $this->insertar($sql, $array);
    }
    public function getValidar($campo, $valor, $accion, $id)
    {
        if ($accion == 'registrar' && $id == 0) {
            $sql = "SELECT id FROM categorias WHERE $campo = '$valor'";
        }else{
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
}

?>