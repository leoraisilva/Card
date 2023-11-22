<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/vcard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>vcard</title>
</head>
<body>
    <div class="container">
        <div class="vcard">
            <div>
                <?php include 'vcard_view_control.php';
                    echo $_SESSION['frente'];
                ?>
            </div>
            <div>
                <?php include 'vcard_view_control.php';
                    echo $_SESSION['tras'];
                ?>
            </div>
        </div>
        <div class="favoritar">
            <a href="dashboard_user.php?opcao=favoritar&vcard=<?php include 'vcard_view_control.php';echo $_SESSION['vcard'];?>"><i class='bx bx-heart fav'></i></a>
        </div>
    </div>

</body>
</html>