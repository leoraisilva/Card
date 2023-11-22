<?php
    class Report {
        private string $username;
        private string $motivo;
        private string $descricao;
        private string $acao;

        function __construct(string $username, string $motivo, string $descricao, string $acao){
            $this->username = $username;
            $this->motivo = $motivo;
            $this->descricao = $descricao;
            $this->acao = $acao;
        }

        function getUsername(): string { return $this->username; }
        function setUsername($novo_username): void { $this->username = $novo_username; }
        function getMotivo(): string { return $this->motivo; }
        function setMotivo($novo_motivo): void { $this->motivo = $novo_motivo; }
        function getDescricao(): string { return $this->descricao; }
        function setDescricao($novo_descricao): void { $this->descricao = $novo_descricao; }
        public function getAcao(): string { return $this->acao; }
        public function setAcao(string $acao): void { $this->acao = $acao; }

        function user_const(): string {
            return '<div class="user"><span class="material-symbols-outlined">account_circle</span><h2>' . $this->username . '</h2></div>';
        }

        function motivo_const(): string {
            return '<div class="motivo"><h4>' . $this->motivo . '</h4></div>';
        }

        function descricao_const(): string {
            return '<div class="descricao"><h4>'. $this->descricao .'</h4></div>';
        }

        function card_report(): string {
            $entrada = '<div class="report_card_content">';
            $conteudo = $this->user_const() . $this->motivo_const() . $this->descricao_const();
            $saida = '</div>';
            return $entrada . $conteudo . $saida;
        }
    }