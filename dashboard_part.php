<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" >

    <title>Dashboard</title>
</head>
<body>
<div class="container">
    <aside>
        <div class="menu-top">
            <div class="logo">
                <img src="img/logo.jpg">
                <h2>CTCP</h2>
            </div>
        </div>
        <div class="menu" id="menu">
            <scan>
                <span class="material-symbols-outlined swipe_left">swipe_left</span>
                <h3>Participante</h3>
            </scan>
            <div class="Perfil" data-item="item1">
                <span class="material-symbols-outlined person">person</span>
                <h3>Perfil</h3>
            </div>
            <div class="Criar_Cards" data-item="item2">
                <span class="material-symbols-outlined add_card">add_card</span>
                <h3>Criar_Cards</h3>
            </div>
            <div class="Meus_Cards" data-item="item3">
                <span class="material-symbols-outlined credit_card">credit_card</span>
                <h3>Meus_Cards</h3>
            </div>
            <div class="Configuracao" data-item="item4">
                <span class="material-symbols-outlined settings">settings</span>
                <h3>Configuração</h3>
            </div>
            <div class="Report" data-item="item5">
                <span class="material-symbols-outlined flag">flag</span>
                <h3>Reports</h3>
            </div>
            <div class="Logout" data-item="item6">
                <span class="material-symbols-outlined logout">logout</span>
                <h3>Logout</h3>
            </div>
        </div>
    </aside>
    <main>
        <div class="container-main">
            <div class="header">
                <span class="material-symbols-outlined">account_circle</span>
                <h2><?php include("dashboard_part_control.php");
                    echo $_SESSION['usuario']
                    ?>
                </h2>
                <div><?php include("dashboard_admin_control.php");
                    echo $_SESSION['tempo']
                    ?>
                </div>
            </div>
            <?php include("dashboard_part_control.php");?>
        </div>
    </main>
</div>
<script src="js/dashboard_organ.js"></script>
</body>
</html>