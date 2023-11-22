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
                <span class="material-symbols-outlined">shield_person</span>
                    <h3>Administrar</h3>
                </scan>
                <div class="Organizador" data-item="item1">
                    <span class="material-symbols-outlined move_up">move_up</span>
                    <h3>Organizador</h3>
                </div>
                <div class="Participante" data-item="item2">
                    <span class="material-symbols-outlined swipe_left">swipe_left</span>
                    <h3>Participante</h3>
                </div>
                <div class="Visitante" data-item="item3">
                    <span class="material-symbols-outlined dashboard">dashboard</span>
                    <h3>Visitante</h3>
                </div>
                <div class="Reports" data-item="item4">
                    <span class="material-symbols-outlined flag">flag</span>
                    <h3>Reports</h3>
                </div>
                <div class="AccountAdd" data-item="item5">
                    <span class="material-symbols-outlined person_add">person_add</span>
                    <h3>Cadastrar</h3>
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
                    <h2><?php include("dashboard_admin_control.php");
                        echo $_SESSION['usuario']
                        ?>
                    </h2>
                    <div><?php include("dashboard_admin_control.php");
                        echo $_SESSION['tempo']
                        ?>
                    </div>
                </div> 
                <?php include("dashboard_admin_control.php"); ?>
            </div>
        </main>
    </div>
    <script src="js/dashboard_admin.js"></script>
</body>
</html>