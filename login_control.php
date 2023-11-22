<?php
    session_start();

    $Model = "Model";
    spl_autoload_register(function($Model){
    include "php/" . $Model . ".php";
    });

    $pdo = new PDO("mysql:dbname=conta; host=127.0.0.1", 'root', '');
    $model = new Model($pdo);

    /* Solicitação de usuario */

        $socitacao_usuario = $_POST['socitacao_usuario'] ?? '';

        $socitacao_email = $_POST['socitacao_email'] ?? '';

        $socitacao_motivo = $_POST['socitacao_motivo'] ?? '';

    /* Cadastro de usuario */

        $nome_cadastrar = $_POST['nome_cadastro'] ?? '';

        $user_cadastrar = $_POST['user_cadastro'] ?? '';

        $pass_cadastrar = $_POST['pass_cadastro'] ?? '';

        $tell_cadastrar = $_POST['tell_cadastro'] ?? '';

        $email_cadastrar = $_POST['email_cadastro'] ?? '';

        $cidade_cadastrar = $_POST['cidade_cadastro'] ?? '';

        $painel = $_GET['value'] ?? '';



    if($painel === 'cadastrar'){
        if(!$model->getDatabase()->cadastrar_organ_valor_user($user_cadastrar)) {
            if (!$model->getDatabase()->cadastrar_part_valor_user($user_cadastrar)) {
                if (!$model->getDatabase()->cadastrar_admin_valor_user($user_cadastrar)) {
                    if (isset($nome_cadastrar) || isset($user_cadastrar) || isset($pass_cadastrar) || isset($tell_cadastrar) || isset($email_cadastrar) || isset($cidade_cadastrar)) {
                        $model->getDatabase()->cadastrar_visitante($nome_cadastrar, $user_cadastrar, $pass_cadastrar, $tell_cadastrar, $email_cadastrar, $cidade_cadastrar);
                        header('location: login.php?cadastrado');
                    }
                }else {
                    header('location: login.php?erro_cadastro');
                }
            } else {
                header('location: login.php?erro_cadastro');
            }
        } else {
            header('location: login.php?erro_cadastro');
        }
    }

    else if($painel === 'solicitacao'){
        if (isset($socitacao_usuario) || isset($socitacao_email) || isset($socitacao_motivo)){
            $acao = 'solicitacao_' . $model->getData()->getData()->format('dm');
            $cadastro_descricao = $socitacao_usuario . ': ' . $socitacao_email;
            $model->getDatabase()->cadastrar_report($socitacao_usuario, $socitacao_motivo, $cadastro_descricao, $acao);
            header('location: login.php?solicitacao_efetuado');
        }
    }

    /* Login */

    $_SESSION['usuario'] = $_POST['usuario'] ?? '';

    $_SESSION['senha'] = $_POST['senha'] ?? '';

    $_SESSION['tempo'] = $model->getData()->FormatoData();



    $model->valorBD($_SESSION['usuario'], $_SESSION['senha']);

        if($model->getFlag()){
            $_SESSION['flag'] = true;
            if($model->getTipo() === "Administrador"){
                header("Location: dashboard_admin.php");
            }
            else if($model->getTipo() === "Organizador"){
                header("Location: dashboard_organ.php");
            }
            else if($model->getTipo() === "Visitante"){
                header("Location: dashboard_user.php");
            }
            else if($model->getTipo() === "Participante"){
                header("Location: dashboard_part.php");
            }
        }
        else {
            echo "<form action=login.php?erro=0 method=post><input type=submit name=limparPost value='Login/Senha incorreta'></form>";
            exit;
            if(isset($_POST['limparPost'])){
                header("location:".$_SERVER['PHP_SELF']);
            }
        }
        


        
?>
