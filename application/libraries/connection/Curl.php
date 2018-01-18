<?php 

namespace connection {

    use connection\Curl;

    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

    /**
     *  Essa classe realiza chamadas usando o método CURL
     *
     **/
    class Curl {

        private $url   =  null;

        private $curl  =  null;        
            
        public function __construct( $url ) {

            $this->url   =  $url;

            $this->curl  =  curl_init();

        }


        public function setUrl( $url ) {

            $this->url  =  $url;

        }


        public function initCurl() {

            $this->curl  =  curl_init();

        }


        /**
         * Método processa os dados que serão enviados na URL
         *
         * @param  ARRAY $data  -  Array com os dados que serão enviados
         * @return VOID 
         */
        public function urlify( $data = array() ) {

            $post  =  '';

            //url-ify the data for the POST
            foreach($data as $key => $value) {
                $post .= $key . '=' . $value . '&';
            }

            //Remove o & do final da string
            rtrim($post, '&');

            return $post;

        }


        /**
         * Método seta os parametros para o método curl
         *
         * @param  STRING $option  -  Opção que será usada como parametro no método curl_setopt
         * @param  STRING $data    -  Dados que serão setados no método curl_setopt
         * @return VOID 
         */
        public function setOpt( $option, $data ) {

            switch ( $option ) {
                case 'CURLOPT_URL':
                    curl_setopt( $this->curl, CURLOPT_URL, $data );
                break;
                case 'CURLOPT_SSL_VERIFYPEER':
                    curl_setopt( $this->curl, CURLOPT_SSL_VERIFYPEER, $data );
                break;
                case 'CURLOPT_POST':
                    curl_setopt( $this->curl, CURLOPT_POST, count($data) );
                break;
                case 'CURLOPT_POSTFIELDS':
                    curl_setopt( $this->curl, CURLOPT_POSTFIELDS, $data );
                break;
                case 'CURLOPT_RETURNTRANSFER':
                    curl_setopt( $this->curl, CURLOPT_RETURNTRANSFER, $data );
                break;     
                case 'CURLOPT_USERAGENT':
                    curl_setopt( $this->curl, CURLOPT_USERAGENT, $data );
                break;   
            }

        }


        /**
         * Método seta o cabeçalho header com o tipo de codificação ISO 8859
         *
         * @param  NULL        
         * @return VOID
         * @access PUBLIC
         */
        public function setOptXMLISO8859() {

            curl_setopt( $this->curl, CURLOPT_HTTPHEADER, 'Content-type: text/xml; charset=ISO-8859-1' );

        }


        /**
         * Método realiza a chamada curl
         *
         * @param  null
         * @return VOID 
         */
        public function execute() {

            //get data
            $result  =  curl_exec( $this->curl );

            //Fecha a chamada
            curl_close( $this->curl );

            $this->curl  =  null;

            //Retorna os dados da chamada
            return $result;

        }


        /**
         * Método executa uma chamada CURL e obtem o buffer e o retorna
         *
         * @param  NULL
         * @return STRING
         * @access PUBLIC
         */
        public function execGetBuffer() {

            ob_start();

            curl_exec( $this->curl );

            $response = ob_get_contents();

            //Fecha a chamada
            curl_close( $this->curl );

            ob_end_clean();

            return $response;

        }
          

    }

}    







