<?php
    class Usuario {

        private string $nome;
        private string $usuario;
        private string $senha;
        private string $email;
        private string $tell;
        private string $cidade;

        function __construct(string $nome, string $usuario, string $senha, string $email, string $tell, string $cidade){
            $this->nome = $nome;
            $this->usuario = $usuario;
            $this->senha = $senha;
            $this->email = $email;
            $this->tell = $tell;
            $this->cidade = $cidade;
        }

        public function getCidade():string {return $this->cidade; }
        public function setCidade(string $cidade): void {$this->cidade = $cidade;}
        public function getNome(): string { return $this->nome; }
        public function setNome(string $nome): void { $this->nome = $nome; }
        public function getUsuario(): string { return $this->usuario; }
        public function setUsuario(string $usuario): void { $this->usuario = $usuario; }
        public function getSenha(): string { return $this->senha; }
        public function setSenha(string $senha): void { $this->senha = $senha; }
        public function getEmail(): string { return $this->email; }
        public function setEmail(string $email): void { $this->email = $email; }
        public function getTell(): string { return $this->tell; }
        public function setTell(string $tell): void { $this->tell = $tell; }
    }