<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/ticked.css'; ?>">
</head>

<body>
    <img src="<?php echo BASE_URL . 'assets/images/logo-icon.png'; ?>" alt="">
    <div class="datos-empresa">
        <p><?php echo $data['empresa']['nombre']; ?></p>
        <p><?php echo $data['empresa']['telefono']; ?></p>
        <p><?php echo $data['empresa']['direccion']; ?></p>
    </div>
    <h5 class="title">Datos del Cliente</h5>
    <div class="datos-info">
        <p><strong><?php echo $data['venta']['identidad']; ?>: </strong> <?php echo $data['venta']['num_identidad']; ?></p>
        <p><strong>Nombre: </strong> <?php echo $data['venta']['nombre']; ?></p>
        <p><strong>Teléfono: </strong> <?php echo $data['venta']['telefono']; ?></p>
    </div>
    <h5 class="title">Detalle de los Productos</h5>
    <table>
        <thead>
            <tr>
                <th>Cant</th>
                <th>Descripción</th>
                <!-- <th>Precio</th> -->
                <!-- <th>SubTotal</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            $productos = json_decode($data['venta']['productos'], true);
            foreach ($productos as $producto) { ?>
                <tr>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                </tr>
            <?php } ?>
            
        </tbody>
    </table>
    <div class="mensaje">
        <h4><?php echo $data['venta']['metodo'] ?></h4>
        <?php echo $data['empresa']['mensaje']; ?>
        <?php if ($data['venta']['estado'] == 0) { ?>
            <h1>Venta Anulado</h1>
        <?php } ?>
    </div>

</body>

</html>