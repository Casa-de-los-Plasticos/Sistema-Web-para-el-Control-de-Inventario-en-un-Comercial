<?php
class AdminModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getDatos()
    {
        $sql = "SELECT * FROM configuracion";
        return $this->select($sql);
    }

    public function getProductos($estado)
    {
        $sql = "SELECT p.*, m.medida, c.categoria, pr.nombre FROM productos p INNER JOIN medidas m ON p.id_medida = m.id INNER JOIN categorias c ON p.id_categoria = c.id INNER JOIN proveedor pr ON p.id_proveedor = pr.id WHERE p.estado = $estado";
        return $this->selectAll($sql);
    }

    public function actualizar(
        $ruc,
        $nombre,
        $telefono,
        $correo,
        $direccion,
        $impuesto,
        $mensaje,
        $id
    ) {
        $sql = "UPDATE configuracion SET ruc=?, nombre=?, telefono=?, correo=?,
        direccion=?, impuesto=?, mensaje=? WHERE id=?";
        $array = array(
            $ruc, $nombre, $telefono, $correo,
            $direccion, $impuesto, $mensaje, $id
        );
        return $this->save($sql, $array);
    }

    public function getTotales($table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE estado = 1";
        return $this->select($sql);
    }


    public function topUsuariosMorris()
    {
        $sql = "SELECT SUM(CASE WHEN estado = 1 THEN 1 ELSE 0 END) AS activos, SUM(CASE WHEN estado = 0 THEN 1 ELSE 0 END) AS inactivos FROM usuarios";
        return $this->selectAll($sql);
    }

    public function topTransportistasMorris()
    {
        $sql = "SELECT SUM(CASE WHEN estado = 1 THEN 1 ELSE 0 END) AS activos, SUM(CASE WHEN estado = 0 THEN 1 ELSE 0 END) AS inactivos FROM clientes";
        return $this->selectAll($sql);
    }

    public function topProveedoresMorris()
    {
        $sql = "SELECT SUM(CASE WHEN estado = 1 THEN 1 ELSE 0 END) AS activos, SUM(CASE WHEN estado = 0 THEN 1 ELSE 0 END) AS inactivos FROM proveedor";
        return $this->selectAll($sql);
    }

    public function topUsuariosMorrisNombre($cantidad)
    {
        $sql = "SELECT usuarios.nombre, SUM(CASE WHEN estado = 1 THEN 1 ELSE 0 END) AS activos, SUM(CASE WHEN estado = 0 THEN 1 ELSE 0 END) AS inactivos FROM usuarios GROUP BY usuarios.nombre ORDER BY usuarios.id ASC LIMIT $cantidad";
        return $this->selectAll($sql);
    }

    public function topTransportistasMorrisNombre($cantidad)
    {
        $sql = "SELECT clientes.nombre, SUM(CASE WHEN estado = 1 THEN 1 ELSE 0 END) AS activos, SUM(CASE WHEN estado = 0 THEN 1 ELSE 0 END) AS inactivos FROM clientes GROUP BY clientes.nombre ORDER BY clientes.id ASC LIMIT $cantidad";
        return $this->selectAll($sql);
    }

    public function topProveedoresMorrisNombre($cantidad)
    {
        $sql = "SELECT proveedor.nombre, SUM(CASE WHEN estado = 1 THEN 1 ELSE 0 END) AS activos, SUM(CASE WHEN estado = 0 THEN 1 ELSE 0 END) AS inactivos FROM proveedor GROUP BY proveedor.nombre ORDER BY proveedor.id ASC LIMIT $cantidad";
        return $this->selectAll($sql);
    }
    
    public function topProductosMorris($cantidad)
    {
        $sql = "SELECT * FROM productos ORDER BY id ASC LIMIT $cantidad";
        return $this->selectAll($sql);
    }
    
    // INICIO REPORTE GRÁFICO TPI
    public function topProductos($cantidad, $offset, $fecha)
    {
        $sql = "SELECT descripcion, resultado FROM consolidado_tpi WHERE fecha = '$fecha' LIMIT $cantidad OFFSET $offset";
        return $this->selectAll($sql);
    }
    // FIN REPORTE GRÁFICO TPI
    // INICIO REPORTE GRÁFICO TPI
    public function topProductosIRS($cantidad, $offset, $fecha)
    {
        $sql = "SELECT descripcion, resultado FROM irs WHERE fecha = '$fecha' LIMIT $cantidad OFFSET $offset";
        return $this->selectAll($sql);
    }
    // FIN REPORTE GRÁFICO IRS

    // INICIO REPORTE GRÁFICO PRODUTOS
    // public function productos()
    // {
    //     $paginaProductos = isset($_GET['paginaProductos']) ? intval($_GET['paginaProductos']) : 1;
    //     $elementosPorPaginaProductos = 10;
    //     $offsetProductos = ($paginaProductos - 1) * $elementosPorPaginaProductos;

    //     $data = $this->model->productos($elementosPorPaginaProductos, $offsetProductos);
    //     echo json_encode($data);
    //     die();
    // }

    public function productos($cantidad, $offset)
    {
        $sql = "SELECT codigo, descripcion, cantidad FROM productos LIMIT $cantidad OFFSET $offset";
        return $this->selectAll($sql);
    }

    public function nuevosProductos($cantidad)
    {
        $sql = "SELECT p.*, c.categoria FROM productos p INNER JOIN categorias c ON p.id_categoria = c.id ORDER BY p.id DESC LIMIT $cantidad";
        return $this->selectAll($sql);
    }

    public function calcularGastos($desde, $hasta, $id_usuario)
    {
        $sql = "SELECT SUM(IF(MONTH(fecha) = 1, monto, 0)) AS enero,
        SUM(IF(MONTH(fecha) = 2, monto, 0)) AS febrero,
        SUM(IF(MONTH(fecha) = 3, monto, 0)) AS marzo,
        SUM(IF(MONTH(fecha) = 4, monto, 0)) AS abril,
        SUM(IF(MONTH(fecha) = 5, monto, 0)) AS mayo,
        SUM(IF(MONTH(fecha) = 6, monto, 0)) AS junio,
        SUM(IF(MONTH(fecha) = 7, monto, 0)) AS julio,
        SUM(IF(MONTH(fecha) = 8, monto, 0)) AS agosto,
        SUM(IF(MONTH(fecha) = 9, monto, 0)) AS setiembre,
        SUM(IF(MONTH(fecha) = 10, monto, 0)) AS octubre,
        SUM(IF(MONTH(fecha) = 11, monto, 0)) AS noviembre,
        SUM(IF(MONTH(fecha) = 12, monto, 0)) AS diciembre
        FROM gastos WHERE fecha BETWEEN '$desde' AND '$hasta' AND id_usuario = $id_usuario";
        return $this->select($sql);
    }

    public function minimosProductos()
    {
        $sql = "SELECT descripcion, cantidad FROM productos WHERE cantidad < 15 LIMIT 4";
        return $this->selectAll($sql);
    }

    // REPORTE PDF
    public function minimosProductosPDF()
    {
        $sql = "SELECT p.*, c.categoria FROM productos p INNER JOIN categorias c ON p.id_categoria = c.id WHERE p.cantidad < 15";
        return $this->selectAll($sql);
    }

    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        return $this->select($sql);
    }

    public function listarLogs()
    {
        $sql = "SELECT * FROM acceso";
        return $this->selectAll($sql);
    }

    public function limpiarDatos()
    {
        $sql = "TRUNCATE acceso";
        return $this->select($sql);
    }
}
