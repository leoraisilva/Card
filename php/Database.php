<?php
    class Database {
        private PDO $dbase;

        function __construct(PDO $dbase){
            $this->dbase = $dbase;
        }
        /* acesso ao valor do BD */

        public function login_entrada_admin (string $usuario, string $senha): bool{
            $sql = 'SELECT usuario, senha FROM administrador WHERE usuario=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            $dados = $preparo->fetchAll();
            foreach ($dados as $dado)
            if($dado[0] == $usuario){
                if ($dado[1] == $senha) return true;
            }
            return false;
        }

        public function login_entrada_organ (string $usuario, string $senha): bool{
            $sql = 'SELECT usuario, senha FROM organizador WHERE usuario=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            $dados = $preparo->fetchAll();
            foreach ($dados as $dado)
                if($dado[0] == $usuario){
                    if ($dado[1] == $senha) return true;
                }
            return false;
        }

        public function login_entrada_part (string $usuario, string $senha): bool{
            $sql = 'SELECT usuario, senha FROM participante WHERE usuario=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            $dados = $preparo->fetchAll();
            foreach ($dados as $dado)
                if($dado[0] == $usuario){
                    if ($dado[1] == $senha) return true;
                }
            return false;
        }

        public function login_entrada_visit (string $usuario, string $senha): bool{
            $sql = 'SELECT usuario, senha FROM visitante WHERE usuario=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            $dados = $preparo->fetchAll();
            foreach ($dados as $dado)
                if($dado[0] == $usuario){
                    if ($dado[1] == $senha) return true;
                }
            return false;
        }

        public function valorAdministrador(string $usuario, string $senha): array {
            $sql = 'SELECT * FROM administrador WHERE usuario=? AND senha=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario, $senha]);
            return $preparo->fetchAll();

        }

        public function valorOrganizador(string $usuario, string $senha): array {
            $sql = 'SELECT * FROM organizador WHERE usuario=? AND senha=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario, $senha]);
            return $preparo->fetchAll();

        }
        public function valorParticipante(string $usuario, string $senha): array {
            $sql = 'SELECT * FROM participante WHERE usuario=? AND senha=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario, $senha]);
            return $preparo->fetchAll();

        }
        public function valorVisitante(string $usuario, string $senha): array {
            $sql = 'SELECT * FROM visitante WHERE usuario=? AND senha=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario, $senha]);
            return $preparo->fetchAll();

        }

        /*localizar o valor do ID*/

        public function local_participante_ID(string $usuario): int{
            $sql = 'SELECT id_visit FROM participante WHERE usuario=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            return $preparo->fetchColumn();
        }
        public function local_visitante_ID(string $usuario): int{
            $sql = 'SELECT id_part FROM visitante WHERE usuario=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            return $preparo->fetchColumn();
        }
        public function local_organizador_ID(string $usuario): int{
            $sql = 'SELECT id_organ FROM organizador WHERE usuario=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            return $preparo->fetchColumn();
        }

        /* acessar a senha */

        public function acesso_senha_organizador(int $id): string{
            $sql = 'SELECT senha FROM organizador WHERE id_organ=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id]);
            return $preparo->fetchColumn();
        }

        public function acesso_senha_participante(int $id): string{
            $sql = 'SELECT senha FROM participante WHERE id_visit=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id]);
            return $preparo->fetchColumn();
        }

        public function acesso_senha_visitante(int $id): string{
            $sql = 'SELECT senha FROM visitante WHERE id_part=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id]);
            return $preparo->fetchColumn();
        }

        /* alterar valor BD */

        public function alterar_part_valor(string $value, string $usuario, string $nome, string $senha, string $tell, string $email, string $cidade): void{
            $id = $this->local_participante_ID($value);
            $sql = 'UPDATE participante SET nome=:nome, usuario=:usuario, tell=:tell, email=:email, cidade=:cidade, senha=:senha WHERE id_visit=:id';
            $preparo =  $this->dbase->prepare($sql);
            $preparo->bindParam(':id', $id, PDO::PARAM_INT);
            $preparo->bindParam(':nome', $nome, PDO::PARAM_STR);
            $preparo->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $preparo->bindParam(':tell', $tell, PDO::PARAM_STR);
            $preparo->bindParam(':email', $email, PDO::PARAM_STR);
            $preparo->bindParam(':cidade', $cidade, PDO::PARAM_STR);
            $preparo->bindParam(':senha', $senha, PDO::PARAM_STR);
            $preparo->execute();
        }

        public function alterar_organ_valor(string $value, string $usuario, string $nome, string $senha, string $tell, string $email, string $cidade, string $categoria): void{
            $id = $this->local_organizador_ID($value);
            $sql = 'UPDATE organizador SET nome=:nome, usuario=:usuario, tell=:tell, email=:email, cidade=:cidade, senha=:senha, categoria=:categoria WHERE id_organ=:id';
            $preparo =  $this->dbase->prepare($sql);
            $preparo->bindParam(':id', $id, PDO::PARAM_INT);
            $preparo->bindParam(':nome', $nome, PDO::PARAM_STR);
            $preparo->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $preparo->bindParam(':tell', $tell, PDO::PARAM_STR);
            $preparo->bindParam(':email', $email, PDO::PARAM_STR);
            $preparo->bindParam(':cidade', $cidade, PDO::PARAM_STR);
            $preparo->bindParam(':senha', $senha, PDO::PARAM_STR);
            $preparo->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $preparo->execute();
        }

        public function alterar_visit_valor(string $value, string $usuario, string $nome, string $senha, string $tell, string $email, string $cidade, string $escolaridade, string $nome_escola): void{
            $id = $this->local_visitante_ID($value);
            $sql = 'UPDATE visitante SET nome=:nome, usuario=:usuario, tell=:tell, email=:email, cidade=:cidade, senha=:senha, escolaridade=:escolaridade, nome_escola= :nome_escola WHERE id_part=:id';
            $preparo =  $this->dbase->prepare($sql);
            $preparo->bindParam(':id', $id, PDO::PARAM_INT);
            $preparo->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $preparo->bindParam(':nome', $nome, PDO::PARAM_STR);
            $preparo->bindParam(':tell', $tell, PDO::PARAM_STR);
            $preparo->bindParam(':email', $email, PDO::PARAM_STR);
            $preparo->bindParam(':cidade', $cidade, PDO::PARAM_STR);
            $preparo->bindParam(':senha', $senha, PDO::PARAM_STR);
            $preparo->bindParam(':escolaridade', $escolaridade, PDO::PARAM_STR);
            $preparo->bindParam(':nome_escola', $nome_escola, PDO::PARAM_STR);
            $preparo->execute();
        }

        /* Deletar conta */

        public function deletar_conta_organ(int $id): void {
            $sql = 'DELETE FROM organizador WHERE id_organ=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id]);
        }

        public function deletar_conta_visit(int $id): void {
            $sql = 'DELETE FROM visitante WHERE id_part=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id]);
        }

        public function deletar_conta_part(int $id): void {
            $sql = 'DELETE FROM participante WHERE id_visit=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id]);
        }

        /*puxando o valor de usuario/email */

        public function valor_organ_usercard(): array {
            $sql = 'SELECT usuario, email FROM organizador';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute();
            return $preparo->fetchAll();
        }

        public function valor_part_usercard(): array {
            $sql = 'SELECT usuario, email FROM participante';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute();
            return $preparo->fetchAll();
        }

        public function valor_visit_usercard(): array {
            $sql = 'SELECT usuario, email FROM visitante';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute();
            return $preparo->fetchAll();
        }
        /* buscar total de id*/

        public function valor_organ_id(): int {
            $sql = 'SELECT COUNT(*) FROM organizador';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute();
            return $preparo->fetchColumn();
        }

        public function valor_part_id(): int {
            $sql = 'SELECT COUNT(*) FROM participante';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute();
            return $preparo->fetchColumn();
        }

        public function valor_visit_id(): int {
            $sql = 'SELECT COUNT(*) FROM visitante';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute();
            return $preparo->fetchColumn();
        }
        /* valor existe */

        public function existe_valor_organ(int $n): bool{
            $id = $this->valor_organ_id() + $n;
            $sql = 'SELECT COUNT(*) FROM organizador WHERE id_organ=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id]);
            $value = $preparo->fetchColumn();
            if($value === 0){return true;}
            else return false;
        }

        public function existe_valor_part(int $n): bool{
            $id = $this->valor_part_id() + $n;
            $sql = 'SELECT COUNT(*) FROM participante WHERE id_visit=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id]);
            $value = $preparo->fetchColumn();
            if($value === 0){return true;}
            else return false;
        }

        public function existe_valor_visit(int $n): bool{
            $id = $this->valor_visit_id() + $n;
            $sql = 'SELECT COUNT(*) FROM visitante WHERE id_part=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id]);
            $value = $preparo->fetchColumn();
            if($value === 0){return true;}
            else return false;
        }
        /* inserir valor */

        public function cadastrar_visitante(string $nome, string $user, string $pass, string $tell, string $email, string $cidade): void{

            $sql = 'INSERT INTO visitante (nome, usuario, tell, email, cidade, senha, escolaridade, nome_escola) VALUES (:nome, :usuario, :tell, :email, :cidade, :senha, :escolaridade, :nome_escola);';
            $escolaridade = '';
            $nome_escola = '';
            $preparo = $this->dbase->prepare($sql);

            $preparo->bindParam(':nome', $nome, PDO::PARAM_STR);
            $preparo->bindParam(':usuario', $user, PDO::PARAM_STR);
            $preparo->bindParam(':tell', $tell, PDO::PARAM_STR);
            $preparo->bindParam(':email', $email, PDO::PARAM_STR);
            $preparo->bindParam(':cidade', $cidade, PDO::PARAM_STR);
            $preparo->bindParam(':senha', $pass, PDO::PARAM_STR);
            $preparo->bindParam(':escolaridade', $escolaridade, PDO::PARAM_STR);
            $preparo->bindParam(':nome_escola', $nome_escola, PDO::PARAM_STR);
            $preparo->execute();
        }

        public function cadastrar_participante(string $nome, string $user, string $pass, string $tell, string $email, string $cidade): void{

            $sql = 'INSERT INTO participante (nome, usuario, tell, email, cidade, senha) VALUES (:nome, :usuario, :tell, :email, :cidade, :senha);';

            $preparo = $this->dbase->prepare($sql);

            $preparo->bindParam(':nome', $nome, PDO::PARAM_STR);
            $preparo->bindParam(':usuario', $user, PDO::PARAM_STR);
            $preparo->bindParam(':tell', $tell, PDO::PARAM_STR);
            $preparo->bindParam(':email', $email, PDO::PARAM_STR);
            $preparo->bindParam(':cidade', $cidade, PDO::PARAM_STR);
            $preparo->bindParam(':senha', $pass, PDO::PARAM_STR);
            $preparo->execute();
        }

        public function cadastrar_organizador(string $nome, string $user, string $pass, string $tell, string $email, string $cidade, string $categoria): void{
            $id_organ = $this->valor_organ_id() + 1;
            while ($this->existe_valor_organ($id_organ)) $id_organ++;
            $sql = 'INSERT INTO organizador (id_organ, nome, usuario, tell, email, cidade, senha, categoria) VALUES (:id_organ, :nome, :usuario, :tell, :email, :cidade, :senha, :categoria);';

            $preparo = $this->dbase->prepare($sql);

            $preparo->bindParam(':id_organ', $id_organ, PDO::PARAM_INT);
            $preparo->bindParam(':nome', $nome, PDO::PARAM_STR);
            $preparo->bindParam(':usuario', $user, PDO::PARAM_STR);
            $preparo->bindParam(':tell', $tell, PDO::PARAM_STR);
            $preparo->bindParam(':email', $email, PDO::PARAM_STR);
            $preparo->bindParam(':cidade', $cidade, PDO::PARAM_STR);
            $preparo->bindParam(':senha', $pass, PDO::PARAM_STR);
            $preparo->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $preparo->execute();
        }

        /* puxando o valor do vcard */

        public function valor_tras_vcard(int $id_tras): array {
            $sql = 'SELECT * FROM tras_vcard WHERE id_tras=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id_tras]);
            return $preparo->fetchAll();

        }

        public function valor_frente_vcard(int $id_frente): array {
            $sql = 'SELECT * FROM frente_vcard WHERE id_frente=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id_frente]);
            return $preparo->fetchAll();
        }

        public function cadastrando_frente_vcard(int $id_frente, string $identifica, string $titulo, string $conteudo, string $imagem, string $url_qrcode): void{
            $sql = 'INSERT INTO frente_vcard (id_frente, identifica ,titulo, conteudo, url_img, qrcode) VALUES (:id_frente, :identifica, :titulo, :conteudo, :url_img, :url_qrcode);';
            $preparo = $this->dbase->prepare($sql);
            $preparo->bindParam(':id_frente', $id_frente, PDO::PARAM_INT);
            $preparo->bindParam(':identifica', $identifica, PDO::PARAM_STR);
            $preparo->bindParam(':conteudo', $conteudo, PDO::PARAM_STR);
            $preparo->bindParam(':url_img', $imagem, PDO::PARAM_STR);
            $preparo->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $preparo->bindParam(':url_qrcode', $url_qrcode, PDO::PARAM_STR);
            $preparo->execute();
        }

        public function cadastrando_tras_vcard(int $id_tras, string $identifica, string $proprietario, string $informacao_contato, int $visualizacao, string $data_publicacao, string $categoria):void {
            $sql = 'INSERT INTO tras_vcard (id_tras , identifica, proprietario, informacao_contato, visualizacao, data_publicacao, categoria) VALUES (:id_tras, :identifica, :proprietario, :informacao_contato, :visualizacao, :data_publicacao, :categoria);';
            $preparo = $this->dbase->prepare($sql);
            $preparo->bindParam(':id_tras', $id_tras, PDO::PARAM_INT);
            $preparo->bindParam(':identifica', $identifica, PDO::PARAM_STR);
            $preparo->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $preparo->bindParam(':proprietario', $proprietario, PDO::PARAM_STR);
            $preparo->bindParam(':informacao_contato', $informacao_contato, PDO::PARAM_STR);
            $preparo->bindParam(':data_publicacao', $data_publicacao, PDO::PARAM_STR);
            $preparo->bindParam(':visualizacao', $visualizacao, PDO::PARAM_INT);
            $preparo->execute();
        }

        public function totalID_vcard(): int{
            $sql = 'SELECT COUNT(*) FROM frente_vcard;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute();
            return $preparo->fetchColumn();
        }
        public function existe_valor_vcard(int $id): bool{
            $sql = 'SELECT COUNT(*) FROM frente_vcard WHERE id_frente=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id]);
            $value = $preparo->fetchColumn();
            if($value == 0 )return false;
            else return true;
        }

        public function proprietario_vcard (string $usuario): array {
            $sql = 'SELECT id_tras FROM tras_vcard WHERE proprietario=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            return $preparo->fetchAll();
        }

        public function proprietario_quantidade (string $usuario): int {
            $sql = 'SELECT COUNT(*) FROM tras_vcard WHERE proprietario=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            return $preparo->fetchColumn();
        }

        public function alterando_frente_vcard (int $id, string $conteudo): void{
            $sql = 'UPDATE frente_vcard SET conteudo=:conteudo WHERE id_frente=:id;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->bindParam(':id', $id, PDO::PARAM_INT);
            $preparo->bindParam(':conteudo', $conteudo, PDO::PARAM_STR);
            $preparo->execute();
        }

        public function alterando_tras_vcard (int $id, string $categoria, int $view, string $info_contato): void {
            $sql = 'UPDATE tras_vcard SET categoria=:categoria, visualizacao=:visualizacao, informacao_contato=:informacao_contato WHERE id_tras=:id_tras;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->bindParam(':id_tras', $id, PDO::PARAM_INT);
            $preparo->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $preparo->bindParam(':visualizacao', $view, PDO::PARAM_INT);
            $preparo->bindParam(':informacao_contato', $info_contato, PDO::PARAM_STR);
            $preparo->execute();
        }


        /* gerenciar / report */


        public function gerenciar_id(): int {
            $sql = 'SELECT COUNT(*) FROM gerenciar;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute();
            return $preparo->fetchColumn();
        }

        public function existe_gerenciar(int $id): bool{
            $sql = 'SELECT COUNT(*) FROM gerenciar WHERE id_report=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id]);
            if($preparo->fetchColumn() == 0) return true;
            return false;
        }


        public function cadastrar_report(string $usuario, string $motivo, string $descricao, string $acao): void {
            $id = $this->gerenciar_id() + 1;
            while (!$this->existe_gerenciar($id)) $id++;
            $sql = 'INSERT INTO gerenciar (id_report, usuario, motivo, descricao, acao) VALUES (:id_report, :usuario, :motivo, :descricao, :acao);';
            $preparo = $this->dbase->prepare($sql);
            $preparo->bindParam(':id_report', $id, PDO::PARAM_INT);
            $preparo->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $preparo->bindParam(':motivo', $motivo, PDO::PARAM_STR);
            $preparo->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $preparo->bindParam(':acao', $acao, PDO::PARAM_STR);
            $preparo->execute();
        }

        public function valor_gerenciar (int $id): array{
            $sql = 'SELECT * FROM gerenciar WHERE id_report=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id]);
            return $preparo->fetchAll();
        }

        /* Favorito */

        public function favorito_id(): int {
            $sql = 'SELECT COUNT(*) FROM favorito;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute();
            return $preparo->fetchColumn();
        }

        public function existe_favorito(int $id): bool{
            $sql = 'SELECT COUNT(*) FROM favorito WHERE id=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$id]);
            if($preparo->fetchColumn() == 0) return true;
            return false;
        }

        public function favoritar (int $id_card, string $usuario): void {
            $id = $this->favorito_id() + 1;
            while (!$this->existe_favorito($id)) $id++;
            $sql = 'INSERT INTO favorito (id, id_card, usuario) VALUES (:id, :id_card, :usuario)';
            $preparo = $this->dbase->prepare($sql);
            $preparo->bindParam(':id', $id, PDO::PARAM_INT);
            $preparo->bindParam(':id_card', $id_card, PDO::PARAM_INT);
            $preparo->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $preparo->execute();
        }

        public function favorito (string $usuario): array{
            $sql = 'SELECT id_card FROM favorito WHERE usuario=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            return $preparo->fetchAll();
        }

        /* Rede Social */

        public function cadastrar_redesocial (string $facebook, string $twitter, string $instagram, string $linkedin, string $tiktok, string $reddit, string $twitch, string $telegram, string $whatsapp, string $usuario): void {
            $sql = 'INSERT INTO redesocial (facebook, twitter, twitch, instagram, reddit, linkedin, tiktok, telegram, whatsapp, usuario) VALUES (:facebook, :twitter, :twitch, :instagram, :reddit, :linkedin, :tiktok, :telegram, :whatsapp, :usuario);';
            $preparo = $this->dbase->prepare($sql);
            $preparo->bindParam(':facebook', $facebook, PDO::PARAM_STR);
            $preparo->bindParam(':twitter', $twitter, PDO::PARAM_STR);
            $preparo->bindParam(':twitch', $twitch, PDO::PARAM_STR);
            $preparo->bindParam(':instagram', $instagram, PDO::PARAM_STR);
            $preparo->bindParam(':reddit', $reddit, PDO::PARAM_STR);
            $preparo->bindParam(':linkedin', $linkedin, PDO::PARAM_STR);
            $preparo->bindParam(':tiktok', $tiktok, PDO::PARAM_STR);
            $preparo->bindParam(':telegram', $telegram, PDO::PARAM_STR);
            $preparo->bindParam(':whatsapp', $whatsapp, PDO::PARAM_STR);
            $preparo->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $preparo->execute();
        }

        public function valor_redesocial (string $usuario): array {
            $sql = 'SELECT * FROM redesocial WHERE usuario=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            return $preparo->fetchAll();
        }

        public function cadastrar_visit_valor_user(string $usuario): bool{
            $sql = 'SELECT usuario FROM visitante WHERE usuario=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            if($preparo->fetchColumn() == '') return false;
            return true;
        }

        public function cadastrar_organ_valor_user(string $usuario): bool{
            $sql = 'SELECT usuario FROM organizador WHERE usuario=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            if($preparo->fetchColumn() == '') return false;
            return true;
        }

        public function cadastrar_part_valor_user(string $usuario): bool{
            $sql = 'SELECT usuario FROM participante WHERE usuario=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            if($preparo->fetchColumn() == '') return false;
            return true;
        }

        public function cadastrar_admin_valor_user(string $usuario): bool{
            $sql = 'SELECT usuario FROM administrador WHERE usuario=?';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$usuario]);
            if($preparo->fetchColumn() == '') return false;
            return true;
        }

        /* Pesquisa o card */

        public function pesquisa_titulo (string $titulo): array{
            $sql = 'SELECT id_frente FROM frente_vcard WHERE titulo=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$titulo]);
            return $preparo->fetchAll();
        }

        public function pesquisa_proprietario (string $proprietario): array{
            $sql = 'SELECT id_tras FROM tras_vcard WHERE proprietario=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$proprietario]);
            return $preparo->fetchAll();
        }

        public function pesquisa_categoria (string $categoria): array{
            $sql = 'SELECT id_tras FROM tras_vcard WHERE categoria=?;';
            $preparo = $this->dbase->prepare($sql);
            $preparo->execute([$categoria]);
            return $preparo->fetchAll();
        }

    }

