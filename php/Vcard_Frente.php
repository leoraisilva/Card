<?php

class Vcard_Frente{
    private string $conteudo;
    private string $img;
    private string $titulo;
    private string $url_qrcode;

    public function __construct(string $titulo, string $conteudo, string $img, string $url_qrcode) {
        $this->conteudo = $conteudo;
        $this->img = $img;
        $this->titulo = $titulo;
        $this->url_qrcode = $url_qrcode;
    }

    public function getConteudo(): string { return $this->conteudo; }
    public function getImg(): string { return $this->img; }
    public function getTitulo(): string {  return $this->titulo; }
    public function getUrlQrcode(): string { return $this->url_qrcode; }
    public function setConteudo(string $conteudo): void { $this->conteudo = $conteudo; }
    public function setImg(string $img): void { $this->img = $img; }
    public function setTitulo(string $titulo): void { $this->titulo = $titulo; }
    public function setUrlQrcode(string $url_qrcode): void { $this->url_qrcode = $url_qrcode; }

}
