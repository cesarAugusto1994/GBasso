<?php 

namespace parser {

    use parser\Xml;

    use SimpleXMLElement;

    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

    /**
    *  Essa classe realiza chamadas usando o método CURL
    *
    **/
    class Xml {

        private $Xml   =  null;
            
        public function __construct( $dataXml = '' ) {

            $this->Xml   =  $dataXml;

        }

        public function __set( $property, $value ) {

            if( property_exists($this, $property) ) {

                $this->$property  =   $value;

            }

        }

        public function isXml() {
            $doc  =  @simplexml_load_string( $this->Xml );
            return !$doc ? false : true;
        }

        /**
        * Método convert os dados XML para array
        *
        * @param  XML OBJECT $xmlObject  -  Objeto XML para ser convertido
        * @param  ARRAY      $out        -  Array, mas esse parametro não é passado
        * @return ARRAY 
        */
        public function xml2array(SimpleXMLElement $xmlObject ){

            $array = array();

            foreach ($xmlObject as $name => $element) {
                ($node = & $array[$name])
                    && (1 === count($node) ? $node = array($node) : 1)
                    && $node = & $node[];

                $node = $element->count() ? $this->xml2array($element) : trim($element);
            }

            return $array;

        }


        /**
        * Método chama o método que converte um objeto XML para array
        *
        * @param  NULL
        * @return ARRAY 
        */
        public function toArray(){

            $this->Xml   =  new SimpleXMLElement( $this->Xml );

            return $this->xml2array( $this->Xml );

        }

    }

}    