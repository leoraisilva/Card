<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/vcard.css">

    <title>vcard</title>
</head>
<body>
<div class="container">
    <div class="vcard_qrcode">
        <div class="titulo_qrcode">
            <?php include 'vcard_qrcode_control.php';
            echo $_SESSION['titulo'];
            ?>
        </div>
        <div class="content_qrcode">
            <?php include 'vcard_qrcode_control.php';
            echo $_SESSION['qrcode'];
            ?>
        </div>

    </div>
</div>
</body>
</html>