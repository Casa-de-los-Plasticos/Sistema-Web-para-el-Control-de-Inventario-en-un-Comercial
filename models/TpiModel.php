<?php
class TpiModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getTpi()
    {
        $sql = "SELECT * FROM tpi";
        return $this->selectAll($sql);
    }
    public function registrar($codigo, $descripcion, $tpi, $cantidad)
    {
        $sql = "INSERT INTO tpi (codigo, descripcion, resultado, cantidad, fecha, hora) VALUES (?,?,?,?,CURDATE(),CURTIME())";
        $array = array($codigo, $descripcion, $tpi, $cantidad);
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

    // public function buscarPorCodigo($valor)
    // {
    //     $sql = "SELECT id, codigo, descripcion, cantidad FROM stock_fisico WHERE codigo LIKE '%".$valor."%' AND estado = 1 LIMIT 10";
    //     return $this->selectAll($sql);
    // }
    
    public function buscarPorCodigo($valor)
    {
        $sql = "SELECT id, codigo, descripcion, cantidad FROM productos WHERE codigo LIKE '%".$valor."%' AND estado = 1 LIMIT 10";
        return $this->selectAll($sql);
    }
}

?>