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
                    <span class="factura">Movimientos</span>
                    <?php if ($data['actual']) { ?>
                        <p>Actual</p>
                        <p><?php echo $_SESSION['nombre_usuario']; ?></p>
                    <?php } else { ?>
                        <p>N°: <strong><?php echo $data['idCaja']; ?></strong></p>
                    <?php } ?>
                </div>
            </td>
        </tr>
    </table>
    <table id="container-producto">
        <thead>
            <tr>
                <th class="text-center">Monto Inicial</th>
                <th class="text-center">Ingresos</th>
                <th class="text-center">Egresos</th>
                <th class="text-center">Gastos</th>
                <th class="text-center">Saldo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center" align="center"><?php echo $data['movimientos']['inicialDecimal']; ?></td>
                <td class="text-center" align="center"><?php echo $data['movimientos']['ingresosDecimal']; ?></td>
                <td class="text-center" align="center"><?php echo $data['movimientos']['egresosDecimal']; ?></td>
                <td class="text-center" align="center"><?php echo $data['movimientos']['gastosDecimal']; ?></td>
                <td class="text-center" align="center"><?php echo $data['movimientos']['saldoDecimal']; ?></td>
            </tr>
        </tbody>
    </table>
    <div class="mensaje">
        <?php echo $data['empresa']['mensaje']; ?>
    </div>

</body>

</html>