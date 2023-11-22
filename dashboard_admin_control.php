<?php
    /* Iniciar a sessão */

        if (!isset($_SESSION)) {
            session_start();
        }

        $Model = "Model";
        spl_autoload_register(function ($Model) {
            include "php/" . $Model . ".php";
        });

        if (!isset($_SESSION['usuario']) || !$_SESSION['flag']) {
            header('location: login.php?erro=1');
        }

        $pdo = new PDO("mysql:dbname=conta; host=127.0.0.1", 'root', '');
        $model = new Model($pdo);
        $model->valorBD($_SESSION['usuario'], $_SESSION['senha']);

    /* alterar dados do usuario */

        $novo_nome = $_POST['Nome'] ?? '';

        $novo_username = $_POST['Usuario'] ?? '';

        $novo_password = $_POST['Senha'] ?? '';

        $novo_email = $_POST['E-mail'] ?? '';

        $novo_tell = $_POST['Tell'] ?? '';

        $novo_cidade = $_POST['Cidade'] ?? '';

        $novo_categoria = $_POST['Categoria'] ?? '';

        $novo_escolaridade = $_POST['Escolaridade'] ?? '';

        $novo_escola = $_POST['Escola'] ?? '';

    /* Cadastrar novo usuario Organizador */

        $organ_nome = $_POST['nome_organ'] ?? '';

        $organ_username = $_POST['user_organ'] ?? '';

        $organ_password = $_POST['pass_organ'] ?? '';

        $organ_email = $_POST['email_organ'] ?? '';

        $organ_tell = $_POST['tell_organ'] ?? '';

        $organ_cidade = $_POST['cidade_organ'] ?? '';

        $organ_categoria = $_POST['categoria_organ'] ?? '';

    /* Menu */

        $painel = $_GET['opcao'] ?? '';

        $conta = $_GET['conta'] ?? '';

        $tabela = $_GET['tabela'] ?? '';

        if($painel === 'Organizador'){
            echo '<div class="container_admin">';
            $organ = $model->getDatabase()->valor_organ_usercard();
            foreach ($organ as $dados_userfabril){
                for ($j = 0; $j < count($organ) / 2; $j += 2) {
                $model->getUserFactory()->setUsuario($dados_userfabril[0]);
                $model->getUserFactory()->setEmail($dados_userfabril[1]);
                $model->getUserFactory()->setTipo('Organizador');
                echo $model->getUserFactory()->card_user();
                }
            }
          echo '</div>';
        }

        if($painel === 'Participante'){
            echo '<div class="container_admin">';
            $part = $model->getDatabase()->valor_part_usercard();
            foreach ($part as $dados_userfabril) {
                for ($j = 0; $j < count($part) / 2; $j += 2) {
                    $model->getUserFactory()->setUsuario($dados_userfabril[0]);
                    $model->getUserFactory()->setEmail($dados_userfabril[1]);
                    $model->getUserFactory()->setTipo('Participante');
                    echo $model->getUserFactory()->card_user();
                }
            }
            echo '</div>';
        }

        if($painel === 'Visitante'){
            echo '<div class="container_admin">';
            $visit = $model->getDatabase()->valor_visit_usercard();
            foreach ($visit as $dados_userfabril){
                for ($j = 0; $j < count($visit) / 2; $j+=2) {
                    $model->getUserFactory()->setUsuario($dados_userfabril[0]);
                    $model->getUserFactory()->setEmail($dados_userfabril[1]);
                    $model->getUserFactory()->setTipo('Visitante');
                    echo $model->getUserFactory()->card_user();
                }
            }
            echo '</div>';
        }

         if($painel === 'Reports'){
             echo '<div><div class="report_card_container">';
             $value = $model->getDatabase()->gerenciar_id();
             for ($i = 1; $i <= $value; $i++) {
                 $dados = $model->getDatabase()->valor_gerenciar($i);
                 foreach ($dados as $dado_report){
                     $model->getReport()->setUsername($dado_report[1]);
                     $model->getReport()->setMotivo($dado_report[2]);
                     $model->getReport()->setDescricao($dado_report[3]);
                     $model->getReport()->setAcao($dado_report[4]);
                 }
                 echo $model->getReport()->card_report();
             }
             echo '</div></div>';
        }

        else if($painel === 'AccountAdd'){
                echo '<div>
            <div class="cadastrar_part">
                <form action="dashboard_admin.php?opcao=add_organ_usuario" method="post">
                    <h2>Cadastrar Conta Organizador</h2>
                    <div class="cadastrar_content">
                        <label>Nome:</label>
                        <input type="text" name="nome_organ">
                        <label>Username:</label>
                        <input type="text" name="user_organ">
                        <label>Password:</label>
                        <input type="password" name="pass_organ">
                        <label>Email:</label>
                        <input type="email" name="email_organ">
                        <label>Tell:</label>
                        <input type="text" name="tell_organ">
                        <label>Cidade:</label>
                        <input type="text" name="cidade_organ">
                        <label>Categoria:</label>
                        <input type="text" name="categoria_organ">
                        <input type="submit" class="btn_cadastrar" value="Cadastrar">
                    </div>
                </form>
            </div></div>';

        }

        else if($painel === 'Logout'){
            if(session_status() === PHP_SESSION_ACTIVE) session_destroy();
        }

        else if($painel === 'Delete'){
            if($tabela === 'Organizador'){
                $model->getDatabase()->deletar_conta_organ($model->getDatabase()->local_organizador_ID($conta));
                header('location: dashboard_admin.php?deletado');
            }
            else if($tabela === 'Participante'){
                $model->getDatabase()->deletar_conta_part($model->getDatabase()->local_participante_ID($conta));
                header('location: dashboard_admin.php?deletado');
            }
            else if($tabela === 'Visitante'){
                $model->getDatabase()->deletar_conta_visit($model->getDatabase()->local_visitante_ID($conta));
                header('location: dashboard_admin.php?deletado');
            }
        }

        else if($painel === 'Editar'){
            if($tabela === 'Organizador') {
                $model->valorBD($conta, $model->getDatabase()->acesso_senha_organizador($model->getDatabase()->local_organizador_ID($conta)), $tabela);
                $url = 'dashboard_admin.php?opcao=Alterar&conta='. $conta .'&tabela='. $tabela;
                echo $model->getConfiguracao()->Configuracao($url, $tabela);
            }
            else if($tabela === 'Participante') {
                $model->valorBD($conta, $model->getDatabase()->acesso_senha_participante($model->getDatabase()->local_participante_ID($conta)), $tabela);
                $url = 'dashboard_admin.php?opcao=Alterar&conta='. $conta .'&tabela='. $tabela;
                echo $model->getConfiguracao()->Configuracao($url, $tabela);
            }
            else if($tabela === 'Visitante') {
                $model->valorBD($conta, $model->getDatabase()->acesso_senha_visitante($model->getDatabase()->local_visitante_ID($conta)), $tabela);
                $url = 'dashboard_admin.php?opcao=Alterar&conta='. $conta .'&tabela='. $tabela;
                echo $model->getConfiguracao()->Configuracao($url, $tabela);
            }
        }

        else if($painel === 'Alterar'){
            if($tabela === 'Visitante') {
                if (isset($novo_username) || isset($novo_nome) || isset($novo_password) || isset($novo_tell) || isset($novo_email) || isset($novo_cidade) || isset($novo_escolaridade) || isset($novo_escola)) {
                    $model->getDatabase()->alterar_visit_valor($conta, $novo_username, $novo_nome, $novo_password, $novo_tell, $novo_email, $novo_cidade, $novo_escolaridade, $novo_escola);
                }
            }
            else if($tabela === 'Participante') {
                if(isset($novo_username) || isset($novo_nome) || isset($novo_password) || isset($novo_tell) || isset($novo_email) || isset($novo_cidade)) {
                    $model->getDatabase()->alterar_part_valor($conta, $novo_username, $novo_nome, $novo_password, $novo_tell, $novo_email, $novo_cidade);
                }
            }
            else if($tabela === 'Organizador') {
                if(isset($novo_username) || isset($novo_nome) || isset($novo_password) || isset($novo_tell) || isset($novo_email) || isset($novo_cidade) || isset($novo_categoria)) {
                    $model->getDatabase()->alterar_organ_valor($conta, $novo_username, $novo_nome, $novo_password, $novo_tell, $novo_email, $novo_cidade, $novo_categoria);
                }
            }
        }

        else if($painel === 'add_organ_usuario') {
            if(!$model->getDatabase()->cadastrar_visit_valor_user($organ_username)) {
                if (!$model->getDatabase()->cadastrar_part_valor_user($organ_username)) {
                    if(!$model->getDatabase()->cadastrar_admin_valor_user($organ_username)) {
                        if (isset($organ_nome) || isset($organ_username) || isset($organ_password) || isset($organ_tell) || isset($organ_email) || isset($organ_cidade) || isset($organ_categoria)) {

                            try {
                                $model->getDatabase()->cadastrar_organizador($organ_nome, $organ_username, $organ_password, $organ_tell, $organ_email, $organ_cidade, $organ_categoria);
                            } catch (PDOException $e) {
                                $e->getMessage();
                            }

                            header('location: dashboard_admin.php?cadastrado');
                        }
                    }
                    else{
                        header('location: dashboard_admin.php?opcao=erro_cadastro');
                    }
                }
                else{
                    header('location: dashboard_admin.php?opcao=erro_cadastro');
                }
            }
            else{
                header('location: dashboard_admin.php?opcao=erro_cadastro');
            }
        }

        else if($painel === 'erro_cadastro') {
            echo 'Usuario já existe ';
        }

    ?>