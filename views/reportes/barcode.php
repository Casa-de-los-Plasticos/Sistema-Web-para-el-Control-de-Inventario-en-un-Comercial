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
    <?php foreach ($data['productos'] as $img) { ?>
        <div class="text-center">
            <img src="<?php echo BASE_URL . 'assets/images/barcode/' . $img['id'] . '.png'; ?>">
            <p><?php echo $img['codigo']; ?></p>
        </div>
    <?php } ?>
</body>

</html>