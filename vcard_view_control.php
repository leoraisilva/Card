<?php
    $Model = "Model";
    spl_autoload_register(function($Model){
        include "php/" . $Model . ".php";
    });

    if(!isset($_SESSION)){
        session_start();
    }

    $pdo = new PDO("mysql:dbname=conta; host=127.0.0.1", 'root', '');
    $model = new Model($pdo);

    $_SESSION['vcard'] = $_GET['card'] ?? '';

    $value_frente = $model->getDatabase()->valor_frente_vcard($_SESSION['vcard']);
    foreach ($value_frente as $frente){
        $model->getVcardFrente()->setConteudo($frente[3]);
        $model->getVcardFrente()->setImg($frente[4]);
        $model->getVcardFrente()->setTitulo($frente[2]);
        $model->getVcardFrente()->setUrlQrcode($frente[5]);
    }
    $value_tras = $model->getDatabase()->valor_tras_vcard($_SESSION['vcard']);
    foreach ($value_tras as $tras){
        $var = $model->getDatabase()->valorOrganizador($tras[2], $model->getDatabase()->acesso_senha_organizador($model->getDatabase()->local_organizador_ID($tras[2])));
        foreach ($var as $org){
            $usuario =  new Usuario($org[1], $org[2], $org[6], $org[4], $org[3], $org[5]);
            $organizador = new Organizador($usuario, $org[0], $org[7]);
            $model->getVcardTras()->setOrganizador($organizador);
        }
        $model->getVcardTras()->setDate($tras[5]);
        $model->getVcardTras()->setVisualizacao($tras[4]);
    }

    $_SESSION['frente'] = $model->getVcard()->card_frente();
    $redes_sociais = $model->getDatabase()->valor_redesocial($model->getVcardTras()->getOrganizador()->getUsuario());
    $redes = array();
    if(count($redes_sociais) == 0){
        $_SESSION['tras'] = $model->getVcard()->card_tras($redes, '', '', '', '', '', '', '', '', '');
    }
    else {
        foreach ($redes_sociais as $rede) {
            if ($rede[1] !== '') $redes[] = 'facebook';
            if ($rede[2] !== '') $redes[] = 'twitter';
            if ($rede[3] !== '') $redes[] = 'twitch';
            if ($rede[4] !== '') $redes[] = 'instagram';
            if ($rede[5] !== '') $redes[] = 'reddit';
            if ($rede[6] !== '') $redes[] = 'linkedin';
            if ($rede[7] !== '') $redes[] = 'tiktok';
            if ($rede[8] !== '') $redes[] = 'telegram';
            if ($rede[9] !== '') $redes[] = 'whatsapp';
            $_SESSION['tras'] = $model->getVcard()->card_tras($redes, $rede[1], $rede[2], $rede[3], $rede[4], $rede[5], $rede[6], $rede[7], $rede[8], $rede[9]);
        }
    }
