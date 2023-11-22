<?php

class Organizador extends Usuario{
    private string $categoria;
    private int $id;
    private Usuario $usuario;

    function __construct(Usuario $usuario, int $id, string $categoria) {
        parent::__construct($usuario->getNome(), $usuario->getUsuario(), $usuario->getSenha(), $usuario->getEmail(), $usuario->getTell(), $usuario->getCidade());
        $this->id = $id;
        $this->categoria = $categoria;
    }
    public function getId(): int { return $this->id; }
    public function getCategoria(): string{ return $this->categoria;}
    public function setId(int $id): void { $this->id = $id;}
    public function setCategoria(string $categoria): void { $this->categoria = $categoria; }

}