<?php
    $Vcard = 'php/Vcard';
    $Configuracao = 'php/Configuracao';
    $UserFactory = 'php/UserFactory';
    $Database = 'php/Database';
    $Usuario = 'php/Usuario';
    $Perfil = 'php/Perfil';
    $Report = 'php/Report';
    $Organizador = 'php/Organizador';
    $Visitante = 'php/Visitante';
    $Data = 'php/Data';
    $Vcard_Factory = 'php/Vcard_Factory';

    spl_autoload_register(function($Vcard_Factory){
        include $Vcard_Factory . ".php";
    });

    spl_autoload_register(function($Data){
        include $Data . ".php";
    });

    spl_autoload_register(function($Configuracao){
        include $Configuracao . ".php";
    });

    spl_autoload_register(function($Report){
        include $Report . ".php";
    });

    spl_autoload_register(function($UserFactory){
        include $UserFactory . ".php";
    });

    spl_autoload_register(function($Perfil){
    include $Perfil . ".php";
    });

    spl_autoload_register(function($Database){
    include $Database . ".php";
    });

    spl_autoload_register(function($Usuario){
        include $Usuario . ".php";
    });

    spl_autoload_register(function($Organizador){
        include $Organizador . ".php";
    });

    spl_autoload_register(function($Visitante){
        include $Visitante . ".php";
    });

    spl_autoload_register(function($Vcard){
        include $Vcard . ".php";
    });

    spl_autoload_register(function($Vcard_tras){
        include $Vcard_tras . ".php";
    });

    spl_autoload_register(function($Vcard_Frente){
        include $Vcard_Frente . ".php";
    });

    spl_autoload_register(function($UserFactory){
        include $UserFactory . ".php";
    });

    class Model{

        private Configuracao $configuracao;
        private Perfil $perfil;
        private Report $report;
        private Model $model;
        private Database $dbase;
        private Usuario $usuario;
        private bool $entrar;
        private string $tipo;
        private Visitante $visitante;
        private Organizador $organizador;
        private Data $data;
        private Vcard $vcard;
        private Vcard_Frente $vcard_Frente;
        private Vcard_Tras $vcard_Tras;
        private UserFactory $userFactory;
        private Vcard_Factory $vcard_Factory;
        
        function __construct(PDO $pdo){
            $this->dbase = new Database($pdo);
            $this->usuario = new Usuario('', '', '', '', '', '');
            $this->organizador = new Organizador($this->usuario, 0, '', '');
            $this->visitante = new Visitante($this->usuario, 0, '', '');
            $this->perfil = new Perfil($this->usuario, $this->visitante, $this->organizador);
            $this->report = new Report('', '', '', '');
            $this->entrar = false;
            $this->tipo = '';
            $this->configuracao = new Configuracao($this->usuario, $this->visitante, $this->organizador);
            $this->data = new Data(new DateTime());
            $this->vcard_Frente = new Vcard_Frente('', '', '', '');
            $this->vcard_Tras = new Vcard_Tras($this->organizador, '', 0);
            $this->vcard = new Vcard(0, $this->vcard_Tras, $this->vcard_Frente);
            $this->userFactory = new UserFactory('', '', '');
            $this->vcard_Factory = new Vcard_Factory($this->vcard, $this->vcard_Frente);
        }

        public function getConfiguracao(): Configuracao{
            return $this->configuracao;
        }

        public function getOrganizador(): Organizador{
            return $this->organizador;
        }

        public function getVisitante(): Visitante{
            return $this->visitante;
        }

        public function getReport(): Report{
            return $this->report;
        }


        public function getPerfil(): Perfil{
            return $this->perfil;
        }

        public function getUsuario(): Usuario{
            return $this->usuario;
        }

        public function getDatabase(): Database{
            return $this->dbase;
        }

        public function getFlag(): bool{
            return $this->entrar;
        }

        public function setFlag(bool $valor): void {
            $this->entrar = $valor;
        }

        public function getTipo(): string{
            return $this->tipo;
        }
        public function setTipo(string $tipo): void{
            $this->tipo = $tipo;
        }

        public function getData(): Data {
            return $this->data;
        }

        public function getVcard(): Vcard {
            return $this->vcard;
        }

        public function getVcardFrente(): Vcard_Frente {
            return $this->vcard_Frente;
        }

        public function getVcardTras(): Vcard_Tras {
            return $this->vcard_Tras;
        }

        public function getUserFactory(): UserFactory {
            return $this->userFactory;
        }

        public function getVcardFactory(): Vcard_Factory {
            return $this->vcard_Factory;
        }


        public function extracted($value): void
        {
            $this->getUsuario()->setNome($value[1]);
            $this->getUsuario()->setUsuario($value[2]);
            $this->getUsuario()->setTell($value[3]);
            $this->getUsuario()->setEmail($value[4]);
            $this->getUsuario()->setCidade($value[5]);
            $this->getUsuario()->setSenha($value[6]);
        }

        public function valorBD($usuario, $senha): void{
            if($this->getDatabase()->login_entrada_admin($usuario, $senha)){
                $arr = $this->dbase->valorAdministrador($usuario, $senha);
                foreach ($arr as $value) {
                    $this->entrar = true;
                    $this->tipo = 'Administrador';
                }
            }
            else if ($this->getDatabase()->login_entrada_organ($usuario, $senha)){
                $arr = $this->dbase->valorOrganizador($usuario, $senha);
                foreach ($arr as $value){
                    $this->extracted($value);
                    $this->organizador->setId($value[0]);
                    $this->organizador->setCategoria($value[7]);
                    $this->entrar = true;
                    $this->tipo = 'Organizador';
                }
            }
            else if($this->getDatabase()->login_entrada_visit($usuario, $senha)){
                $arr = $this->dbase->valorVisitante($usuario, $senha);
                foreach ($arr as $value){
                    $this->extracted($value);
                    $this->visitante->setId($value[0]);
                    $this->visitante->setEscolaridade($value[7]);
                    $this->visitante->setNomeEscola($value[8]);
                    $this->entrar = true;
                    $this->tipo = 'Visitante';
                }
            }
            else if ($this->getDatabase()->login_entrada_part($usuario, $senha)){
                $arr = $this->dbase->valorParticipante($usuario, $senha);
                foreach ($arr as $value){
                    $this->extracted($value);
                    $this->entrar = true;
                    $this->tipo = 'Participante';
                }
            }

        }

        public function vcard_dados(int $id_card){
            $valor_frente = $this->dbase->valor_frente_vcard($id_card);
            $this->vcard->setIdVcard($id_card);
            foreach ($valor_frente as $dados_frente) {
                $this->vcard_Frente->setTitulo($dados_frente[2]);
            }

        }

    }
