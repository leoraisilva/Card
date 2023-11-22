<?php
include_once ('./vendor/autoload.php');
class Vcard {
    private int $id_vcard;
    private Vcard_Frente $frente;
    private Vcard_Tras $tras;

    public function __construct(int $id_vcard, Vcard_Tras $tras, Vcard_Frente $frente){
        $this->id_vcard = $id_vcard;
        $this->frente = $frente;
        $this->tras = $tras;
    }

    public function getFrente(): Vcard_Frente {
        return $this->frente;
    }
    public function getTras(): Vcard_Tras {
        return $this->tras;
    }
    public function getIdVcard(): int {
        return $this->id_vcard;
    }

    public function setIdVcard(int $id_vcard): void{
        $this->id_vcard = $id_vcard;
    }


    public function getTitulo_card(): string{
        return '<h2>' . $this->frente->getTitulo() . '<h2>';
    }

    public function getConteudo_card(): string{
        return '<h4>' . $this->frente->getConteudo() . '<h4>';
    }

    public function getImagem_card(): string{
        return '<img src="' . $this->frente->getImg() . '">';
    }

    public function getUrl_vcard(): string{
        return '<img src="' . (new \chillerlan\QRCode\QRCode())->render($this->frente->getUrlQrcode()) . '">';
    }



    public function card_frente(): string{
        $inicio = '<div class="frente"><div class="content_frente">';
        $conteudo = $this->getTitulo_card() . $this->getConteudo_card() . $this->getImagem_card() . $this->getUrl_vcard();
        $fim = '</div></div>';
        return $inicio . $conteudo . $fim;
    }


    public function getProprietario_card():string{
        return '<li> Proprietario: ' . $this->tras->getOrganizador()->getUsuario() . '</li>';
    }

    public function getCategoria_card(): string{
        return '<li> Categoria: ' . $this->tras->getOrganizador()->getCategoria() . '</li>';
    }

    public function getDate_card(): string{
        return '<li> Data de Publicação: ' . $this->tras->getDate() . '</li>';
    }

    public function getContato_card():string {
        return '<li> Tell para contato: ' . $this->tras->getOrganizador()->getTell() . '</li>';
    }

    public function getVisualizacao_card():string {
        return  '<li> View: ' . $this->tras->getVisualizacao() . '</li>';
    }

    public function  getRede_social_card(array $valor, string $facebook, string $twitter, string $twitch, string $intagram, string $linkedin, string $reddit, string $tiktok, string $telegram, string $whatsapp): string{
        $inicio = '<div class="redesocial">';

        $redesocial = [
            'facebook' => '<a href="https://fb.com/'. $facebook .'" class="fb"><i class="bx bxl-facebook-square"></i></a>',
            'twitter' => '<a href="" class="https://twitter.com/'. $twitter .'"><i class="bx bxl-twitter" ></i></a>',
            'twitch' => '<a href="https://twitch.tv/'. $twitch .'" class="tc"><i class="bx bxl-twitch" ></i></a>',
            'intagram' => '<a href="https://instagram.com/'. $intagram .'" class="ig"><i class="bx bxl-instagram" ></i></a>',
            'linkedin' => '<a href="https://linkedin.com/in/'. $linkedin .'" class="ln"><i class="bx bxl-linkedin-square" ></i></a>',
            'reddit' => '<a href="https://reddit.com/'. $reddit .'" class="rd"><i class="bx bxl-reddit" ></i></a>',
            'tiktok' => '<a href="https://tiktop.com/' .  $tiktok . '" class="ttk"><i class="bx bxl-tiktok" ></i></a>',
            'telegram' => '<a href="https://t.me/' . $telegram . '" class="tg"><i class="bx bxl-telegram" ></i></a>',
            'whatsapp' => '<a href="https://wa.me/' . $whatsapp . '" class="wp"><i class="bx bxl-whatsapp" ></i></a>',
        ];

        $rede_filtrada = array_intersect_key($redesocial, array_flip($valor));

        $fim = '</div>';
        return $inicio . implode('', $rede_filtrada) . $fim;
    }

    public function card_tras(array $redes, string $facebook, string $twitter, string $twitch, string $intagram, string $linkedin, string $reddit, string $tiktok, string $telegram, string $whatsapp): string {
        $inicio = '<div class="tras"><div class="content_tras"><ul>';
        $conteudo = $this->getProprietario_card() . $this->getCategoria_card() . $this->getDate_card() . $this->getContato_card() . $this->getVisualizacao_card() . $this->getRede_social_card($redes, $facebook, $twitter, $twitch, $intagram, $linkedin, $reddit, $tiktok, $telegram, $whatsapp);
        $fim = '</ul></div></div>';
        return $inicio . $conteudo . $fim;
    }
}