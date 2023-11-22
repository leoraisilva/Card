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
        $ip = '192.168.15.4';

    /* Cadastrar report */

        $cadastro_motivo = $_POST['motivo'] ?? '';

        $cadastro_descricao = $_POST['descricao'] ?? '';

    /* cadastro das redes sociais */

        $facebook = $_POST['facebook'] ?? '';

        $instagram = $_POST['instagram'] ?? '';

        $twitter = $_POST['twitter'] ?? '';

        $linkedin = $_POST['linkedin'] ?? '';

        $reddit = $_POST['reddit'] ?? '';

        $tiktok = $_POST['tiktok'] ?? '';

        $twitch = $_POST['twitch'] ?? '';

        $telegram = $_POST['telegram'] ?? '';

        $whatsapp = $_POST['whatsapp'] ?? '';

    /* cadastro de vcard */

        $titulo_vcard = $_POST['titulo_vcard'] ?? '';

        $conteudo_vcard = $_POST['conteudo_vcard'] ?? '';

        $urls_img = $_POST['urls_img'] ?? '';

        $proprietario_vcard = $_POST['proprietario_vcard'] ?? '';

        $categoria_vcard = $_POST['categoria_vcard'] ?? '';

        $data_publicacao = $_POST['data_publicacao'] ?? '';

        $view_vcard = $_POST['view_vcard'] ?? '';

        $informacao_contato = $_POST['informacao_contato'] ?? '';

    /* alterar vcard */

        $conteudo_alterar_vcard = $_POST['conteudo_alterar_vcard'] ?? '';

        $categoria_alterar_vcard = $_POST['categoria_alterar_vcard'] ?? '';

        $view_alterar_vcard = $_POST['view_alterar_vcard'] ?? '';

        $informacao_alterar_contato = $_POST['informacao_alterar_contato'] ?? '';

    /* alterar dados do usuario */

        $novo_nome = $_POST['Nome'] ?? '';

        $novo_username = $_POST['Usuario'] ?? '';

        $novo_password = $_POST['Senha'] ?? '';

        $novo_email = $_POST['E-mail'] ?? '';

        $novo_tell = $_POST['Tell'] ?? '';

        $novo_cidade = $_POST['Cidade'] ?? '';

        $novo_categoria = $_POST['Categoria'] ?? '';

    /* Cadastrar novo usuario Participante */

        $part_nome = $_POST['nome_part'] ?? '';

        $part_username = $_POST['user_part'] ?? '';

        $part_password = $_POST['pass_part'] ?? '';

        $part_email = $_POST['email_part'] ?? '';

        $part_tell = $_POST['tell_part'] ?? '';

        $part_cidade = $_POST['cidade_part'] ?? '';


    /* Menu */

        $informacao_contato_get = $_GET['informacao_contato'] ?? '';

        $data_publicacao_get = $_GET['data_publicacao'] ?? '';

        $categoria_vcard_get = $_GET['categoria_vcard'] ?? '';

        $proprietario_vcard_get = $_GET['proprietario_vcard'] ?? '';

        $identify = $_GET['identificador'] ?? '';

        $num_vcard = $_GET['num_vcard'] ?? '';

        $vcard_number = $_GET['vcard'] ?? '';;

        $painel = $_GET['opcao'] ?? '';


        if($painel === 'Perfil'){
            echo $model->getPerfil()->Perfil($model->getTipo());
        }

        else if($painel === 'Criar_Cards'){
            echo '<div>
    <div class="content_vcard">
        <form action="dashboard_organ.php?opcao=vcard_cadastrado_frente" method="post">
            <h2>Cadastrar Vcard</h2>
            <div class="cadastra_vcard">
                <div class="cadastra_frente">
                    <h2>Frente Vcard</h2>
                    <label>Titulo:</label>
                    <input type="text" name="titulo_vcard">
                    <label>Conteudo:</label>
                    <textarea name="conteudo_vcard" maxlength="300"></textarea>
                    <label>Imagem:</label>
                    <select name="urls_img">
                        <option></option>';
                        $dir = getcwd() . '/img';
                        $d = dir($dir);
                        while (($item = $d->read()) !== false){
                            if(strstr($item, '.') == '.jpg' || strstr($item, '.') == '.webp' || strstr($item, '.') == '.jepg' || strstr($item, '.') == '.png') {
                                echo '<option>' . $item . '</option>';
                            }
                        }
            echo '</select>
                </div>
                <div class="cadastra_tras">
                    <h2>Trás Vcard</h2>

                    <label>Proprietario:</label>
                    <input class="val" type="text" name="proprietario_vcard" value="'. $_SESSION['usuario']  .'">
                    
                    <label>Categoria:</label>
                    <input class="val" type="text" name="categoria_vcard" value="'. $model->getOrganizador()->getCategoria() .'">
                    
                    <label>Data Publicação:</label>
                    <input class="val" type="text" name="data_publicacao" value="'. $model->getData()->getData()->format('d-m-Y') .'">
                    
                    <label>Visualização:</label>
                    <label class="nope_alterer"> ' . 0 . '</label>
                    
                    <label>Informação para Contato:</label>
                    <input class="val" type="text" name="informacao_contato" value="'. $model->getOrganizador()->getTell() .'">
                    
                </div>

                <input type="submit" class="btn_vcard" value="Cadastrar">
            </div>
        </form>
    </div>
</div>';

        }

        else if($painel === 'Meus_Cards'){
            echo '<div><div class="report_card_container">';
            $id_mycards = $model->getDatabase()->proprietario_vcard($_SESSION['usuario']);
            foreach ($id_mycards as $id_card){
                $model->vcard_dados($id_card[0]);
                $url = 'dashboard_organ.php?opcao=Editar_card&vcard=' . $id_card[0];
                echo $model->getVcardFactory()->MyCard($url);
            }
            echo '</div></div>';
        }

        else if($painel === 'Rede_social'){
            echo '<div>
            <div class="cadastrar_part">
                <form action="dashboard_organ.php?opcao=add_rede_social" method="post">
                    <h2>Cadastro das Redes Sociais</h2>
                    <div class="cadastrar_content">
                        <label>Facebook:</label>
                        <input type="text" name="facebook">
                        <label>Twitter:</label>
                        <input type="text" name="twitter">
                        <label>Instagram:</label>
                        <input type="text" name="instagram">
                        <label>Linkedin:</label>
                        <input type="text" name="linkedin">
                        <label>Tik Tok:</label>
                        <input type="text" name="tiktok">
                        <label>Reddit:</label>
                        <input type="text" name="reddit">
                        <label>Twitch:</label>
                        <input type="text" name="twitch">
                        <label>Telegram:</label>
                        <input type="text" name="telegram">
                        <label>Whatsapp:</label>
                        <input type="text" name="whatsapp">
                        <input type="submit" class="btn_cadastrar" value="Cadastrar">
                    </div>
                </form>
            </div></div>';
        }

        else if($painel === 'Configuracao'){
            $url = 'dashboard_organ.php?opcao=Alterar';
            echo $model->getConfiguracao()->Configuracao($url, $model->getTipo());
        }

        else if($painel === 'Report'){
            echo '<div><div class="container_report">
                        <div class="content_report">
                            <form action="dashboard_organ.php?opcao=cadastra_report" method="post">
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

        else if($painel === 'ParticipanteAdd'){
            echo '<div>
            <div class="cadastrar_part">
                <form action="dashboard_organ.php?opcao=add_part_usuario" method="post">
                    <h2>Cadastrar Conta Participante</h2>
                    <div class="cadastrar_content">
                        <label>Nome:</label>
                        <input type="text" name="nome_part">
                        <label>Username:</label>
                        <input type="text" name="user_part">
                        <label>Password:</label>
                        <input type="password" name="pass_part">
                        <label>Email:</label>
                        <input type="email" name="email_part">
                        <label>Tell:</label>
                        <input type="text" name="tell_part">
                        <label>Cidade:</label>
                        <input type="text" name="cidade_part">
                        <input type="submit" class="btn_cadastrar" value="Cadastrar">
                    </div>
                </form>
            </div></div>';
        }

        else if($painel === 'Logout'){
            if(session_status() === PHP_SESSION_ACTIVE) session_destroy();
        }

        else if($painel === 'Alterar'){
            if(isset($novo_username) || isset($novo_nome) || isset($novo_password) || isset($novo_tell) || isset($novo_email) || isset($novo_cidade) || isset($novo_categoria)) {
                $model->getDatabase()->alterar_organ_valor($_SESSION['usuario'], $novo_username, $novo_nome, $novo_password, $novo_tell, $novo_email, $novo_cidade, $novo_categoria);
                header("location: login.php?user_alterado");
            }
        }

        else if($painel === 'add_part_usuario'){
            if(!$model->getDatabase()->cadastrar_visit_valor_user($part_username)) {
                if (!$model->getDatabase()->cadastrar_organ_valor_user($part_username)) {
                    if (!$model->getDatabase()->cadastrar_admin_valor_user($part_username)) {
                        if (isset($part_nome) || isset($part_username) || isset($part_password) || isset($part_tell) || isset($part_email) || isset($part_cidade)) {
                            try {
                                $model->getDatabase()->cadastrar_participante($part_nome, $part_username, $part_password, $part_tell, $part_email, $part_cidade);
                            } catch (PDOException $e) {
                                $e->getMessage();
                            }

                            header('location: dashboard_organ.php?cadastrado');
                        }
                    }else {
                        header('location: dashboard_organ.php?opcao=erro_cadastro');
                    }
                } else {
                    header('location: dashboard_organ.php?opcao=erro_cadastro');
                }
            } else {
                header('location: dashboard_organ.php?opcao=erro_cadastro');
            }
        }

        else if($painel === 'erro_cadastro') {
            echo 'Usuario já existe ';
        }

        else if($painel === 'vcard_cadastrado_frente') {
            /* Adicionar a frente && tras */
            if (isset($titulo_vcard) || isset($conteudo_vcard) || isset($urls_img)) {
                $urls_img = 'img/' . $urls_img;
                $identificador = $_SESSION['usuario'] . '_' . $model->getDatabase()->proprietario_quantidade($_SESSION['usuario']);
                $id_vcard = $model->getDatabase()->totalID_vcard() + 1;
                while ($model->getDatabase()->existe_valor_vcard($id_vcard)) $id_vcard ++;
                $url_vcard = 'https://'. $ip .'/vcard_view.php?card='. $id_vcard;
                try {
                    $model->getDatabase()->cadastrando_frente_vcard($id_vcard, $identificador, $titulo_vcard, $conteudo_vcard, $urls_img, $url_vcard);
                } catch (PDOException $e){
                    $e->getMessage();
                }
                header('location: dashboard_organ.php?opcao=vcard_cadastrado_tras&num_vcard='. $id_vcard .'&identificador='. $identificador . '&proprietario_vcard=' . $proprietario_vcard . '&categoria_vcard=' . $categoria_vcard . '&data_publicacao=' . $data_publicacao . '&informacao_contato=' . $informacao_contato);
            }
        }

        else if($painel === 'vcard_cadastrado_tras') {
            /* Adicionar a frente && tras */
            if (isset($proprietario_vcard) || isset($categoria_vcard) || isset($data_publicacao) || isset($view_vcard) || isset($informacao_contato)) {
                try {
                    $id =intval($num_vcard) - 1;
                    $model->getDatabase()->cadastrando_tras_vcard($id, $identify, $proprietario_vcard_get, $informacao_contato_get, 0, $data_publicacao_get, $categoria_vcard_get);
                } catch (PDOException $e){
                    $e->getMessage();
                }
                header('location: dashboard_organ.php?vcard_cadastrado');
            }
        }

        else if($painel === 'cadastra_report') {
            if (isset($cadastro_motivo) || isset($cadastro_descricao)){
                $acao = 'report_' . '_' . $_SESSION['usuario'] . "_" . $model->getData()->getData()->format('dm');
                $model->getDatabase()->cadastrar_report($_SESSION['usuario'], $cadastro_motivo, $cadastro_descricao, $acao);
                header('location: dashboard_organ.php?report_efetuado');
            }
        }

        else if($painel === 'Editar_card'){
            $value_frente = $model->getDatabase()->valor_frente_vcard(intval($vcard_number));
            foreach ($value_frente as $frente) {

                echo '<div>
            <div class="content_vcard">
                <form action="dashboard_organ.php?opcao=alterar_vcard&vcard='. $vcard_number .'" method="post">
                    <h2>Alterar Vcard</h2>
                    <div class="cadastra_vcard">
                        <div class="cadastra_frente">
                            <h2>Frente Vcard</h2>
                            <label>Titulo:</label>
                            <label class="nope_alterer">' . $frente[2] . '</label>
                            
                            <label>Conteudo:</label>
                            <textarea maxlength="250" name="conteudo_alterar_vcard">'. $frente[3] .'</textarea>
                            
                            <label>Imagem:</label>
                            <label class="nope_alterer">' . $frente[4] . '</label>
                        </div>';
            }
            $value_tras = $model->getDatabase()->valor_tras_vcard(intval($vcard_number));
                foreach ($value_tras as $tras) {

                    echo '<div class="cadastra_tras">
                            <h2>Trás Vcard</h2>
        
                            <label>Proprietario:</label>
                            <label class="nope_alterer"> ' . $tras[2] . '</label>
                            
                            <label>Categoria:</label>
                            <input class="val" type="text" name="categoria_alterar_vcard" value="' . $tras[6] . '">
                            
                            <label>Data Publicação:</label>
                            <label class="nope_alterer">' . $tras[5] . '</label>
                            
                            <label>Visualização:</label>
                            <input class="val" type="text" name="view_alterar_vcard" value="' . $tras[4] . '">
                            
                            <label>Informação para Contato:</label>
                            <input class="val" type="text" name="informacao_alterar_contato" value="' . $tras[3] . '">
                            
                        </div>
            
                            <input type="submit" class="btn_vcard" value="Alterar">
                        </div>
                    </form>
                </div>
            </div>';
                }
        }

        else if($painel === 'alterar_vcard') {
            if (isset($conteudo_alterar_vcard)){
                $model->getDatabase()->alterando_frente_vcard($vcard_number, $conteudo_alterar_vcard);
            }
            if (isset($categoria_alterar_vcard) || isset($view_alterar_vcard) || isset($informacao_alterar_contato)){
                $model->getDatabase()->alterando_tras_vcard($vcard_number, $categoria_alterar_vcard, intval($view_alterar_vcard), $informacao_alterar_contato);
            }
            header('location: dashboard_organ.php?alterado');
        }

        else if($painel === 'add_rede_social'){
            if (isset($facebook) || isset($twitter) || isset($twitch) || isset($instagram) || isset($reddit) || isset($tiktok) || isset($linkedin) || isset($telegram) || isset($whatsapp)){
                try {
                    $model->getDatabase()->cadastrar_redesocial($facebook, $twitter, $instagram, $linkedin, $tiktok, $reddit, $twitch, $telegram, $whatsapp, $_SESSION['usuario']);
                } catch (PDOException $e){
                    $e->getMessage();
                }

            }
            header('location: dashboard_organ.php?redes_cadastrada');
        }

    ?>
