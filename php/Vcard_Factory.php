<?php

class Vcard_Factory {
    private Vcard $vcard;
    private Vcard_Frente $frente;

    public function __construct(Vcard $vcard, Vcard_Frente $frente){
        $this->vcard = $vcard;
        $this->frente = $frente;
    }

    public function getFrente(): Vcard_Frente {
        return $this->frente;
    }

    public function getVcard(): Vcard {
        return $this->vcard;
    }

    public function inicio_card(): string {
        return '<div class="user"><a href="vcard_view.php?card='. $this->vcard->getIdVcard() .'" ><span class="material-symbols-outlined">credit_card_gear</span></a><h2>' . $this->vcard->getIdVcard() . '</h2></div>';
    }

    public function titulo_card(): string {
        return '<div class="motivo"><h4>' . $this->frente->getTitulo() . '</h4></div>';
    }

    public function card_vcard():string {
        $inicio = '<div class="report_card_content">';
        $conteudo = $this->inicio_card() . $this->titulo_card() ;
        $fim =  '</div>' ;
        return $inicio . $conteudo . $fim;
    }

    public function inicio_Mycard(string $url): string {
        return '<div class="user"> <a href="'. $url .'" > <span class="material-symbols-outlined">settings</span> </a> <h2> ' . $this->getVcard()->getIdVcard() . ' </h2> </div>';
    }

    public function qrcode_Mycard (): string {
        return '<div class="user"><a href=" vcard_qrcode.php?card='. $this->vcard->getIdVcard() . '" target="_blank"><span class="material-symbols-outlined">qr_code_2</span></a><h2> QR Code </h2></div>';
    }

    public function MyCard(string $url): string {
        $inicio = '<div class="report_card_content">';
        $conteudo = $this->inicio_Mycard($url) . $this->titulo_card() . $this->qrcode_Mycard();
        $final = '</div>';
        return $inicio . $conteudo . $final;
    }


}
