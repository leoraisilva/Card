<?php
    class Configuracao {

        private string $user;
        private string $pass;
        private string $nome;
        private string $email;
        private string $tell;
        private string $cidade;
        private string $escolaridade;
        private string $nome_escola;
        private string $categoria;

    private Usuario $usuario;
    private Visitante $visitante;
    private Organizador $organizador;

    function __construct(Usuario $usuario, Visitante $visitante, Organizador $organizador){
        $this->usuario = $usuario;
        $this->organizador = $organizador;
        $this->visitante = $visitante;
        $this->user = "Usuario";
        $this->pass = "Senha";
        $this->nome = "Nome";
        $this->email = "E-mail";
        $this->tell = "Tell";
        $this->cidade = "Cidade";
        $this->escolaridade = "Escolaridade";
        $this->nome_escola = "Escola";
        $this->categoria = "Categoria";

    }

        public function setUsuario(Usuario $usuario): void{ $this->usuario = $usuario; }
        public function setVisitante (Visitante $visitante): void { $this->visitante = $visitante; }

        public function setOrganizador (Organizador $organizador): void { $this->organizador = $organizador; }

        public function getNome():string { return '<h3>' . $this->nome . ': </h3>'; }

        public function getNomeAlterar():string { return '<input type="text" name="' . $this->nome . '" value="' . $this->usuario->getNome() . '">'; }

        public function getUser():string { return '<h3>' . $this->user . ': </h3>'; }

        public function getUserAlterar():string { return '<input type="text" name="' . $this->user . '" value="' . $this->usuario->getUsuario() . '">'; }

        public function getPass():string { return '<h3>' . $this->pass . ': </h3>'; }

        public function getPassAlterar():string { return '<input type="password" name="'. $this->pass .'" >'; }

        public function getEmail():string { return '<h3>' . $this->email . ': </h3>'; }

        public function getEmailAlterar():string { return '<input type="text" name="' . $this->email . '" value="' . $this->usuario->getEmail() . '">'; }

        public function getTell():string { return '<h3>' . $this->tell . ': </h3>'; }

        public function getTellAlterar():string { return '<input type="text" name="' . $this->tell . '" value="' . $this->usuario->getTell() . '">'; }

        public function getCidade():string { return '<h3>' . $this->cidade . ': </h3>'; }

        public function getCidadeAlterar():string { return '<input type="text" name="' . $this->cidade . '" value="' . $this->usuario->getCidade() . '">'; }

        public function getCategoria():string { return '<h3>' . $this->categoria . ': </h3>'; }

        public function getCategoriaAlterar():string { return '<input type="text" name="' . $this->categoria . '" value="' . $this->organizador->getCategoria() . '">'; }

        public function getEscolaridade():string { return '<h3>' . $this->escolaridade . ': </h3>'; }

        public function getEscolaridadeAlterar():string { return '<input type="text" name="' . $this->escolaridade . '" value="' . $this->visitante->getEscolaridade() . '">'; }

        public function getNomeEscola():string { return '<h3>' . $this->nome_escola . ': </h3>'; }

        public function getNomeEscolaAlterar():string { return '<input type="text" name="' . $this->nome_escola . '" value="' . $this->visitante->getNomeEscola() . '">'; }

        public function card_nome():string {
        $entrada = '<div class="value-configuracao">';
        $conteudo = $this->getNome() . $this->getNomeAlterar();
        $saida = '</div>';
        return $entrada . $conteudo . $saida;
    }

        public function card_user():string {
            $entrada = '<div class="value-configuracao">';
            $conteudo = $this->getUser() . $this->getUserAlterar();
            $saida = '</div>';
            return $entrada . $conteudo . $saida;
        }

        public function card_pass():string {
            $entrada = '<div class="value-configuracao">';
            $conteudo = $this->getPass() . $this->getPassAlterar();
            $saida = '</div>';
            return $entrada . $conteudo . $saida;
        }

        public function card_email():string {
            $entrada = '<div class="value-configuracao">';
            $conteudo = $this->getEmail() . $this->getEmailAlterar();
            $saida = '</div>';
            return $entrada . $conteudo . $saida;
        }

        public function card_tell():string {
            $entrada = '<div class="value-configuracao">';
            $conteudo = $this->getTell() . $this->getTellAlterar();
            $saida = '</div>';
            return $entrada . $conteudo . $saida;
        }

        public function card_cidade():string {
            $entrada = '<div class="value-configuracao">';
            $conteudo = $this->getCidade() . $this->getCidadeAlterar();
            $saida = '</div>';
            return $entrada . $conteudo . $saida;
        }

        public function card_categoria():string {
            $entrada = '<div class="value-configuracao">';
            $conteudo = $this->getCategoria() . $this->getCategoriaAlterar();
            $saida = '</div>';
            return $entrada . $conteudo . $saida;
        }

        public function card_escolaridade():string {
            $entrada = '<div class="value-configuracao">';
            $conteudo = $this->getEscolaridade() . $this->getEscolaridadeAlterar();
            $saida = '</div>';
            return $entrada . $conteudo . $saida;
        }

        public function card_nome_escola():string {
            $entrada = '<div class="value-configuracao">';
            $conteudo = $this->getNomeEscola() . $this->getNomeEscolaAlterar();
            $saida = '</div>';
            return $entrada . $conteudo . $saida;
        }

        public function usuario_alter_card():string {
            return $this->card_nome() . $this->card_user() . $this->card_pass() . $this->card_email() . $this->card_tell() . $this->card_cidade();
        }

        public function organizador_alter_card():string {
            return $this->usuario_alter_card() . $this->card_categoria();
        }

        public function visitante_alter_card():string {
            return $this->usuario_alter_card() . $this->card_escolaridade() . $this->card_nome_escola();
        }

        public function Configuracao(string $url_user, string $tipo): string{
            $entrada_um = '<div><div class="content-configuracao">';
            $entrada_dois = '<div class="main-configuracao"><form action="'. $url_user .'" method="POST">';
            $button = '<div class="value-submit"><input class="btn" type="submit" value="Alterar"></div>';
            $saida_dois = '</form></div>';
            $saida_um = '</div></div>';

            if($tipo == "Organizador"){
                $conteudo = $this->organizador_alter_card();
            }
            else if($tipo == "Visitante"){
                $conteudo = $this->visitante_alter_card();
            }
            else if($tipo == "Participante"){
                $conteudo = $this->usuario_alter_card();
            }

            return $entrada_um . $entrada_dois . $conteudo . $button . $saida_dois . $saida_um;
        }

}

?>