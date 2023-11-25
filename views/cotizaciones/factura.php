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
                    <span class="factura">Cotización</span>
                    <p>N°: <strong><?php echo $data['cotizacion']['id']; ?></strong></p>
                    <p>Fecha: <?php echo $data['cotizacion']['fecha']; ?></p>
                    <p>Hora: <?php echo $data['cotizacion']['hora']; ?></p>
                </div>
            </td>
        </tr>
    </table>


    <h5 class="title">Datos del Cliente</h5>
    <table id="container-info">
        <tr>
            <td>
                <strong><?php echo $data['cotizacion']['identidad'] ?>: </strong>
                <p><?php echo $data['cotizacion']['num_identidad'] ?></p>
            </td>
            <td>
                <strong>Nombre: </strong>
                <p><?php echo $data['cotizacion']['nombre'] ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Teléfono: </strong>
                <p><?php echo $data['cotizacion']['telefono'] ?></p>
            </td>
            <td>
                <strong>Dirección: </strong>
                <p><?php echo $data['cotizacion']['direccion'] ?></p>
            </td>
        </tr>
    </table>
    <h5 class="title">Detalle de los Productos</h5>
    <table id="container-producto">
        <thead>
            <tr>
                <th>Cant</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $productos = json_decode($data['cotizacion']['productos'], true);

            foreach ($productos as $producto) { ?>
                <tr>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo number_format($producto['precio'], 2); ?></td>
                    <td><?php echo number_format($producto['cantidad'] * $producto['precio'], 2); ?></td>
                </tr>
            <?php } ?>
            <tr class="total">
                <td class="text-right" colspan="3">Descuento</td>
                <td class="text-right"><?php echo number_format($data['cotizacion']['descuento'], 2); ?></td>
            </tr>
            <tr class="total">
                <td class="text-right" colspan="3">Total con Descuento</td>
                <td class="text-right"><?php echo number_format($data['cotizacion']['total'] - $data['cotizacion']['descuento'], 2); ?></td>
            </tr>
            <tr class="total">
                <td class="text-right" colspan="3">Total sin Descuento</td>
                <td class="text-right"><?php echo number_format($data['cotizacion']['total'], 2); ?></td>
            </tr>
        </tbody>
    </table>
    <div class="mensaje">
        <h4>Validez: <?php echo $data['cotizacion']['validez'] ?></h4>
        <h4>Metodo: <?php echo $data['cotizacion']['metodo'] ?></h4>
        <?php echo $data['empresa']['mensaje']; ?>
    </div>

</body>

</html>