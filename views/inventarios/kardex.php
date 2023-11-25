<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/factura.css'; ?>">
</head>

<body>
    <table id="datos-empresa">
        <tr>
            <td class="logo">
                <img src="<?php echo BASE_URL . 'assets/images/logo-icon.png'; ?>" alt="">
            </td>
            <td class="info-empresa">
                <p><?php echo $data['empresa']['nombre']; ?></p>
                <p>Ruc: <?php echo $data['empresa']['ruc']; ?></p>
                <p>Teléfono: <?php echo $data['empresa']['telefono']; ?></p>
                <p>Dirección: <?php echo $data['empresa']['direccion']; ?></p>
            </td>
            <td class="info-compra">
                <div class="container-factura">
                    <span class="factura">Entradas y Salidas</span>
                    <p>Fecha y Hora: <?php echo date('d-m-Y H:i:s'); ?></p>
                </div>
            </td>
        </tr>
    </table>

    <h5 class="title">Entradas y Salidas</h5>
    <table id="container-producto">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Entradas</th>
                <th>Salidas</th>
                <th>Fecha y Hora</th>
                <th>Stock Actual</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data['kardex'] as $kardex) { ?>
                <tr>
                    <td><?php echo $kardex['descripcion']; ?></td>
                    <td><?php echo $kardex['entrada']; ?></td>
                    <td><?php echo $kardex['salida']; ?></td>
                    <td><?php echo $kardex['fecha']; ?></td>
                    <td><?php echo $kardex['stock_actual']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="mensaje">
        <?php echo $data['empresa']['mensaje']; ?>
    </div>

</body>

</html>