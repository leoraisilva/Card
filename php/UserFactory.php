<?php
    class UserFactory{
        private string $usuario;
        private string $email;

        private string $tipo;

        public function __construct(string $usuario, string $email, string $tipo){
            $this->usuario = $usuario;
            $this->email = $email;
            $this->tipo = $tipo;
        }

        public function getUsuario(): string {
            return $this->usuario;
        }

        public function getEmail(): string {
            return $this->email;
        }
        public function getTipo(): string {
            return $this->tipo;
        }

        public function setUsuario(string $usuario): void {
            $this->usuario = $usuario;
        }

        public function setEmail(string $email): void {
            $this->email = $email;
        }

        public function setTipo(string $tipo): void {
            $this->tipo = $tipo;
        }
        public function acesso_usuario_participante(): string {
            return '<h2>'. $this->usuario . '</h2>';
        }

        public function acesso_email_participante(): string {
            return '<h4>'. $this->email . '</h4>';
        }

        public function card_user(): string {
            $inicio = '<div class="content_admin"><div class="dados_admin"><span class="material-symbols-outlined">account_circle</span>';
            $conteudo = $this->acesso_usuario_participante() . $this->acesso_email_participante();
            $final = '<a href="dashboard_admin.php?opcao=Editar&conta='. $this->usuario .'&tabela='. $this->tipo .'" >
                      <span class="material-symbols-outlined">edit</span></a>
                      <a href="dashboard_admin.php?opcao=Delete&conta='. $this->usuario .'&tabela='. $this->tipo .'" >
                      <span class="material-symbols-outlined">cancel</span></a>
                      </div></div>';
            return $inicio . $conteudo . $final;
        }


    }
