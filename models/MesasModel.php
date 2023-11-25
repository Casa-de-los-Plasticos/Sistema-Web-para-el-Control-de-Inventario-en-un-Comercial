<?php
class MesasModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getMesas($estado)
    {
        $sql = "SELECT * FROM mesas WHERE estado = $estado";
        return $this->selectAll($sql);
    }

    public function registrar($tiempo, $monto, $cliente, $fecha, $mesa, $idCliente, $id_usuario)
    {
        $sql = "INSERT INTO mesas (tiempo, monto, cliente, fecha, mesa, id_cliente, id_usuario) VALUES (?,?,?,?,?,?,?)";
        $array = array($tiempo, $monto, $cliente, $fecha, $mesa, $idCliente, $id_usuario);
        return $this->insertar($sql, $array);
    }

    public function getValidar($campo, $valor, $accion, $id)
    {
        if ($accion == 'registrar' && $id == 0) {
            $sql = "SELECT id FROM mesas WHERE $campo = '$valor'";
        }else{
            $sql = "SELECT id FROM mesas WHERE $campo = '$valor' AND id != $id";
        }
        return $this->select($sql);
    }

    public function eliminar($estado, $idMesa)
    {
        $sql = "UPDATE mesas SET estado = ? WHERE id = ?";
        $array = array($estado, $idMesa);
        return $this->save($sql, $array);
    }

    public function editar($idMesa)
    {
        $sql = "SELECT m.id, m.tiempo, m.monto, m.fecha, m.mesa, m.id_usuario, c.nombre, c.telefono, c.direccion FROM mesas m INNER JOIN clientes c ON m.id_cliente = c.id WHERE m.id = $idMesa";
        return $this->select($sql);
    }

    public function actualizar($tiempo, $monto, $cliente, $fecha, $mesa, $idCliente, $id_usuario, $id)
    {
        $sql = "UPDATE mesas SET tiempo=?, monto=?, cliente=?, fecha=?, mesa=?, id_cliente=?, id_usuario=? WHERE id=?";
        $array = array($tiempo, $monto, $cliente, $fecha, $mesa, $idCliente, $id_usuario, $id);
        return $this->save($sql, $array);
    }
    
    public function getApartado($idApartado)
    {
        $sql = "SELECT ap.*, cl.identidad, cl.num_identidad, cl.nombre, cl.telefono, cl.direccion FROM apartados ap INNER JOIN clientes cl ON ap.id_cliente = cl.id WHERE ap.id = $idApartado";
        return $this->select($sql);
    }// LO QUE SE ESTÁ HACIENDO USO PARA LLAMAR DATOS DEL CLIENTE
}

?>