<?php
    $Model = "Model";
    spl_autoload_register(function($Model){
        include "php/" . $Model . ".php";
    });

    include_once ('./vendor/autoload.php');

    if(!isset($_SESSION)){
        session_start();
    }

    $pdo = new PDO("mysql:dbname=conta; host=127.0.0.1", 'root', '');
    $model = new Model($pdo);

    $id_card = $_GET['card'] ?? '';

    $model->vcard_dados($id_card);

    $_SESSION['titulo'] = $model->getVcardFrente()->getTitulo();

    $var = $model->getDatabase()->valor_frente_vcard($id_card);
    foreach ($var as $url){
        $value = $url[5];
        $qrcode = (new \chillerlan\QRCode\QRCode())->render($value);
    }
    $_SESSION['qrcode'] = '<img src="' . $qrcode . '" >';



