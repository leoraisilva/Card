<?php
    class Data {
        private DateTime $data;

        public function __construct(DateTime $data){
            $this->data = $data;
        }


        public function mes(string $mes): string{
            switch ($mes){
                case '01' :$mes = 'Janeiro';
                    break;
                case '02' :$mes = 'Fevereiro';
                    break;
                case '03' :$mes = 'Marco';
                    break;
                case '04' :$mes = 'Abril';
                    break;
                case '05' :$mes = 'Maio';
                    break;
                case '06' :$mes = 'Junho';
                    break;
                case '07' :$mes = 'Julho';
                    break;
                case '08' :$mes = 'Agosto';
                    break;
                case '09' :$mes = 'Setembro';
                    break;
                case '10' :$mes = 'Outubro';
                    break;
                case '11' :$mes = 'Novembro';
                    break;
                case '12' :$mes = 'Dezembro';
                    break;
            }
            return $mes;
        }

        public function getData(): DateTime {
            return $this->data;
        }
        public function setData(DateTime $data): void {
            $this->data = $data;
        }

        public function FormatoData(): string {
            $valor = $this->data->format('d-m-Y');
            $dados = array(substr($valor, 0, 2), substr($valor, 3 , 2), substr($valor, 6, 4));
            $dados[1] = $this->mes($dados[1]);
            return $dados[0] . ' de ' . $dados[1] . ' de ' . $dados[2];
        }
    }

?> 