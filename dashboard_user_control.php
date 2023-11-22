<?php
    /* Iniciar a sessão */

        $Model = "Model";
        spl_autoload_register(function($Model){
            include "php/" . $Model . ".php";
        });

        if(!isset($_SESSION)){
            session_start();
        }

        if(!isset($_SESSION['usuario']) || !$_SESSION['flag']){
            header('location: login.php?erro=1');
        }

        $pdo = new PDO("mysql:dbname=conta; host=127.0.0.1", 'root', '');
        $model = new Model($pdo);
        $model->valorBD($_SESSION['usuario'], $_SESSION['senha']);

    /* Pesquisa */

        $valor_pesquisa = $_POST['valor_pesquisa'] ?? '';

        $pesquisa = $_POST['pesquisa'] ?? '';

    /* Cadastrar report */

        $cadastro_motivo = $_POST['motivo'] ?? '';

        $cadastro_descricao = $_POST['descricao'] ?? '';

    /* alterar dados do usuario */

        $novo_nome = $_POST['Nome'] ?? '';

        $novo_username = $_POST['Usuario'] ?? '';

        $novo_password = $_POST['Senha'] ?? '';

        $novo_email = $_POST['E-mail'] ?? '';

        $novo_tell = $_POST['Tell'] ?? '';

        $novo_cidade = $_POST['Cidade'] ?? '';

        $novo_escolaridade = $_POST['Escolaridade'] ?? '';

        $novo_escola = $_POST['Escola'] ?? '';

    /* Menu */

        $id_vcard =$_GET['vcard'] ?? '';

        $painel = $_GET['opcao'] ?? '';

        if($painel === 'Perfil'){
            echo $model->getPerfil()->Perfil($model->getTipo());
        }

        else if($painel === 'Cards'){
            echo '<div class="container_search">
                        <div class="content_search">
                            <h2>Pesquisa o Card</h2>
                            <div class="layout_search">
                                <form action="dashboard_user.php?opcao=resultado_pesquisa" method="post">
                                    <input type="text" name="valor_pesquisa">
                                    <select name="pesquisa">
                                        <option>Titulo</option>
                                        <option>Proprietario</option>
                                        <option>Categoria</option>
                                    </select>
                                    <input class="bnt_search" type="submit" value="Pesquisar">
                                </form>
                            </div>
                        </div>
                    </div>';
        }

        else if($painel === 'resultado_pesquisa'){
            echo '<div><div class="report_card_container">';
            $total = 0;
            $value = array();
            if($pesquisa === 'Titulo') {
                $total = count($model->getDatabase()->pesquisa_titulo($valor_pesquisa));
                $value = $model->getDatabase()->pesquisa_titulo($valor_pesquisa);
            }

            else if($pesquisa === 'Proprietario') {
                $total = count($model->getDatabase()->pesquisa_proprietario($valor_pesquisa));
                $value = $model->getDatabase()->pesquisa_proprietario($valor_pesquisa);
            }

            else if($pesquisa === 'Categoria') {
                $total = count($model->getDatabase()->pesquisa_categoria($valor_pesquisa));
                $value = $model->getDatabase()->pesquisa_categoria($valor_pesquisa);
            }

            for ($i = 0; $i < $total; $i++) {
                foreach ($value[$i] as $dado[$i]){
                    $model->vcard_dados($dado[$i]);
                }
                echo $model->getVcardFactory()->card_vcard();
            }

            echo '</div></div>';
        }

        else if($painel === 'Favorito'){
            echo '<div><div class="report_card_container">';
            $id_favorito = $model->getDatabase()->favorito($_SESSION['usuario']);
            foreach ($id_favorito as $id_card){
                $model->vcard_dados($id_card[0]);
                echo $model->getVcardFactory()->card_vcard();
            }
            echo '</div></div>';
        }

        else if($painel === 'Configuracao'){
            $url = 'dashboard_user.php?opcao=Alterar';
            echo $model->getConfiguracao()->Configuracao($url, $model->getTipo());
        }

        else if($painel === 'Report'){
            echo '<div><div class="container_report">
                    <div class="content_report">
                        <form action="dashboard_user.php?opcao=cadastra_report" method="post">
                            <h2>Report</h2>
                            <label>Motivo</label>
                            <input type="text" name="motivo">
                            <label>Descrição</label>
                            <textarea maxlength="250" name="descricao"></textarea>
                            <input class="btn" type="submit" value="Enviar">
                        </form>
                    </div>
                </div></div>';
        }


        else if($painel === 'Logout'){
            if(session_status() === PHP_SESSION_ACTIVE) session_destroy();
        }

        else if($painel === 'Alterar'){
            if(isset($novo_username) || isset($novo_nome) || isset($novo_password) || isset($novo_tell) || isset($novo_email) || isset($novo_cidade) || isset($novo_escolaridade) || isset($novo_escola)) {
                $model->getDatabase()->alterar_visit_valor($_SESSION['usuario'], $novo_username, $novo_nome, $novo_password, $novo_tell, $novo_email, $novo_cidade, $novo_escolaridade, $novo_escola);
                header("location: login.php?user_alterado");
            }
        }

        else if($painel === 'cadastra_report') {
            if (isset($cadastro_motivo) || isset($cadastro_descricao)){
                $acao = 'report_' . '_' . $_SESSION['usuario'] . "_" . $model->getData()->getData()->format('dm');
                try {
                    $model->getDatabase()->cadastrar_report($_SESSION['usuario'], $cadastro_motivo, $cadastro_descricao, $acao);
                } catch (PDOException $e){
                    $e->getMessage();
                }

                header('location: dashboard_organ.php?report_efetuado');
            }
        }

        else if($painel === 'verificar'){
            try {
                $model->getDatabase()->favoritar($id_vcard, $_SESSION['usuario']);
            } catch (PDOException $e){
                $e->getMessage();
            }

        }

        else if($painel === 'favoritar'){
            if(isset($_SESSION['usuario']) || $_SESSION['flag']){
                header('location: dashboard_user.php?opcao=verificar&vcard='. $id_vcard);
            }
        }

    ?>