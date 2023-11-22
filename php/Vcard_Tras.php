<?php

class Vcard_Tras{
    private Organizador $organizador;
    private string $date;
    private int $visualizacao;
    private string $url_page;

    public function __construct(Organizador $organizador, string $date, int $visualizacao){
        $this->organizador = $organizador;
        $this->date = $date;
        $this->visualizacao = $visualizacao;
    }

    public function getOrganizador(): Organizador { return $this->organizador; }
    public function getDate(): string { return $this->date; }
    public function getVisualizacao(): int { return $this->visualizacao; }

    public function setDate(string $date): void { $this->date = $date; }
    public function setOrganizador(Organizador $organizador): void { $this->organizador = $organizador; }
    public function setVisualizacao(int $visualizacao): void { $this->visualizacao = $visualizacao; }
}