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
                    <span class="factura">Credito</span>
                    <p>N°: <strong><?php echo $data['credito']['id']; ?></strong></p>
                    <p>Fecha: <?php echo $data['credito']['fecha']; ?></p>
                    <p>Hora: <?php echo $data['credito']['hora']; ?></p>
                </div>
            </td>
        </tr>
    </table>


    <h5 class="title">Datos del Cliente</h5>
    <table id="container-info">
        <tr>
            <td>
                <strong><?php echo $data['credito']['identidad'] ?>: </strong>
                <p><?php echo $data['credito']['num_identidad'] ?></p>
            </td>
            <td>
                <strong>Nombre: </strong>
                <p><?php echo $data['credito']['nombre'] ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Teléfono: </strong>
                <p><?php echo $data['credito']['telefono'] ?></p>
            </td>
            <td>
                <strong>Dirección: </strong>
                <p><?php echo $data['credito']['direccion'] ?></p>
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
            $productos = json_decode($data['credito']['productos'], true);

            foreach ($productos as $producto) { ?>
                <tr>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo number_format($producto['precio'], 2); ?></td>
                    <td><?php echo number_format($producto['cantidad'] * $producto['precio'], 2); ?></td>
                </tr>
            <?php } ?>
            <tr class="total">
                <td class="text-right" colspan="3">Monto</td>
                <td class="text-right"><?php echo number_format($data['credito']['monto'], 2); ?></td>
            </tr>
        </tbody>
    </table>

    <h5 class="title">Detalle de los Abonos</h5>
    <table id="container-producto">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Abono</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $abonado = 0;
            foreach ($data['abonos'] as $abono) {
                $abonado += $abono['abono'];
                ?>
                <tr>
                    <td class="text-center"><?php echo $abono['fecha']; ?></td>
                    <td class="text-center"><?php echo number_format($abono['abono'], 2); ?></td>
                </tr>
            <?php } ?>
            <tr class="total">
                <td class="text-right">Abonado</td>
                <td class="text-right"><?php echo number_format($abonado, 2); ?></td>
            </tr>
            <tr class="total">
                <td class="text-right">Restante</td>
                <td class="text-right"><?php echo number_format($data['credito']['monto'] -  $abonado, 2); ?></td>
            </tr>
        </tbody>
    </table>


    <div class="mensaje">
        <?php echo $data['empresa']['mensaje']; ?>
        <?php if ($data['credito']['estado'] == 0) { ?>
            <h1>CRÉDITO FINALIZADO</h1>
        <?php } else { ?>
            <h1>CRÉDITO PENDIENTE</h1>
        <?php } ?>
    </div>

</body>

</html>