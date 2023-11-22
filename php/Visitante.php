<?php

class Visitante extends Usuario{
    private string $escolaridade;
    private string $nome_escola;
    private int $id;
    private Usuario $usuario;

    public function __construct(Usuario $usuario, int $id, string $escolaridade, string $nome_escola) {
        parent::__construct($usuario->getNome(), $usuario->getUsuario(), $usuario->getSenha(), $usuario->getEmail(), $usuario->getTell(), $usuario->getCidade());
        $this->id = $id;
        $this->escolaridade = $escolaridade;
        $this->nome_escola =$nome_escola;
    }

    public function getId(): int{return $this->id; }
    public function setId(int $id): void{$this->id = $id;}
    public function getEscolaridade(): string{ return $this->escolaridade; }
    public function setEscolaridade(string $escolaridade): void { $this->escolaridade = $escolaridade; }
    public function getNomeEscola(): string { return $this->nome_escola; }
    public function setNomeEscola(string $nome_escola): void { $this->nome_escola = $nome_escola; }

}