<?php

class Perfil {

    private string $user;
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
        $this->visitante = $visitante;
        $this->organizador = $organizador;
        $this->user = "Usuario: ";
        $this->nome = "Nome: ";
        $this->email = "E-mail: ";
        $this->tell = "Tell: ";
        $this->cidade = "Cidade: ";
        $this->escolaridade = "Escolaridade: ";
        $this->nome_escola = "Nome Escola: ";
        $this->categoria = "Categoria: ";

    }
    public function getUsuario(): Usuario{return $this->usuario; }
    public function getOrganizador(): Organizador{ return $this->organizador; }
    public function getVisitante(): Visitante { return $this->visitante; }

    public function cardUser(): string {
        $entrada = '<div class="value-perfil">';
        $texto = '<h3>' . $this->user . '</h3><p>' . $this->getUsuario()->getUsuario() . '</p>';
        $saida = '</div>';
        return $entrada . $texto . $saida;
    }

    public function cardNome(): string {
        $entrada = '<div class="value-perfil">';
        $texto = '<h3>' . $this->nome  . '</h3><p>' . $this->getUsuario()->getNome() . '</p>';
        $saida = '</div>';
        return $entrada . $texto . $saida;
    }

    public function cardEmail(): string {
        $entrada = '<div class="value-perfil">';
        $texto = '<h3>' . $this->email  . '</h3><p>' . $this->getUsuario()->getEmail() . '</p>';
        $saida = '</div>';
        return $entrada . $texto . $saida;
    }

    public function cardTell(): string {
        $entrada = '<div class="value-perfil">';
        $texto = '<h3>' . $this->tell . '</h3><p>' . $this->getUsuario()->getTell() . '</p>';
        $saida = '</div>';
        return $entrada . $texto . $saida;
    }
    public function cardCidade(): string {
        $entrada = '<div class="value-perfil">';
        $texto = '<h3>' . $this->cidade . '</h3><p>' . $this->getUsuario()->getCidade() . '</p>';
        $saida = '</div>';
        return $entrada . $texto . $saida;
    }
    public function cardEscolaridade(): string {
        $entrada = '<div class="value-perfil">';
        $texto = '<h3>' . $this->escolaridade . '</h3><p>' . $this->getVisitante()->getEscolaridade() . '</p>';
        $saida = '</div>';
        return $entrada . $texto . $saida;
    }

    public function cardNomeEscola(): string {
        $entrada = '<div class="value-perfil">';
        $texto = '<h3>' . $this->nome_escola . '</h3><p>' . $this->getVisitante()->getNomeEscola() . '</p>';
        $saida = '</div>';
        return $entrada . $texto . $saida;
    }

    public function cardCategoria(): string {
        $entrada = '<div class="value-perfil">';
        $texto = '<h3>' . $this->categoria . '</h3><p>' . $this->getOrganizador()->getCategoria() . '</p>';
        $saida = '</div>';
        return $entrada . $texto . $saida;
    }

    public function usuario_alter_card(): string {
        return $this->cardNome() . $this->cardUser() . $this->cardEmail() . $this->cardTell() . $this->cardCidade();
    }

    public function visitante_alter_card(): string {
        return $this->usuario_alter_card() . $this->cardEscolaridade() . $this->cardNomeEscola();
    }


    public function organizador_alter_card(): string {
        return $this->usuario_alter_card() . $this->cardCategoria();
    }


    public function Perfil(string $tipo): string {
        $entrada_um = '<div><div class="content-perfil">';
        $entrada_dois = '<div class="main-perfil">';
        $saida_dois = '</div>';
        $saida_um = '</div></div>';

        if($tipo == "Organizador"){
            $conteudo = $this->organizador_alter_card();
        }
        else if($tipo == "Visitante"){
            $conteudo = $this->Visitante_alter_card();
        }
        else if($tipo == "Participante"){
            $conteudo = $this->usuario_alter_card();
        }

        return $entrada_um . $entrada_dois . $conteudo . $saida_dois . $saida_um;
    }
}
    