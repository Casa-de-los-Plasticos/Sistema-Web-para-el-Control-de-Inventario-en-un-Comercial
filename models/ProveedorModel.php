<?php
class ProveedorModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getProveedores($estado)
    {
        $sql = "SELECT * FROM proveedor WHERE estado = $estado";
        return $this->selectAll($sql);
    }

    public function registrar($ruc, $nombre, $telefono, $correo, $direccion)
    {
        $sql = "INSERT INTO proveedor (ruc, nombre, telefono, correo, direccion) VALUES (?,?,?,?,?)";
        $array = array($ruc, $nombre, $telefono, $correo, $direccion);
        return $this->insertar($sql, $array);
    }
    public function getValidar($campo, $valor, $accion, $id)
    {
        if ($accion == 'registrar' && $id == 0) {
            $sql = "SELECT id FROM proveedor WHERE $campo = '$valor'";
        }else{
            $sql = "SELECT id FROM proveedor WHERE $campo = '$valor' AND id != $id";
        }
        return $this->select($sql);
    }
    public function eliminar($estado, $idProveedor)
    {
        $sql = "UPDATE proveedor SET estado = ? WHERE id = ?";
        $array = array($estado, $idProveedor);
        return $this->save($sql, $array);
    }
    public function editar($idProveedor)
    {
        $sql = "SELECT * FROM proveedor WHERE id = $idProveedor";
        return $this->select($sql);
    }
    public function actualizar($ruc, $nombre, $telefono, $correo, $direccion, $id)
    {
        $sql = "UPDATE proveedor SET ruc=?, nombre=?, telefono=?, correo=?, direccion=? WHERE id=?";
        $array = array($ruc, $nombre, $telefono, $correo, $direccion, $id);
        return $this->save($sql, $array);
    }

    public function buscarPorNombre($valor)
    {
        $sql = "SELECT id, nombre, telefono, direccion FROM proveedor WHERE nombre LIKE '%".$valor."%' AND estado = 1 LIMIT 10";
        return $this->selectAll($sql);
    }
}
