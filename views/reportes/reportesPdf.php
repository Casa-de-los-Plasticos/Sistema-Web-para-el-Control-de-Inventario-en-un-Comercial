<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/factura.css'; ?>">
</head>

<body>
    <table id="datos-empresa">
        <tr>
            <td class="logo">
                <img src="<?php echo BASE_URL . 'assets/images/logo.png'; ?>" alt="">
            </td>
            <td class="info-empresa">
                <p><?php echo $data['empresa']['nombre']; ?></p>
                <p>Ruc: <?php echo $data['empresa']['ruc']; ?></p>
                <p>Teléfono: <?php echo $data['empresa']['telefono']; ?></p>
                <p>Dirección: <?php echo $data['empresa']['direccion']; ?></p>
            </td>
            <td class="info-compra">
                <div class="container-factura">
                    <span class="factura"><h3>Reporte</h3></span>
                    <p>Fecha y Hora <strong><?php echo date("d-m-Y H:i:s A"); ?></strong></p>
                </div>
            </td>
        </tr>
    </table>

    <h5 class="title">Detalle de los Productos</h5>
    <table id="container-producto">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Stock Actual</th>
                <th>Ventas</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($data['productos'] as $producto) { ?>
                <tr>
                    <td><?php echo $producto['descripcion']; ?></td>
                    <td><?php echo number_format($producto['precio_compra'], 2); ?></td>
                    <td><?php echo number_format($producto['precio_venta']); ?></td>
                    <td><?php echo number_format($producto['cantidad']); ?></td>
                    <td><?php echo $producto['ventas']; ?></td>                    
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="mensaje">
        <?php echo $data['empresa']['mensaje']; ?>
    </div>

</body>

</html>