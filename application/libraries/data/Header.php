<?php 

namespace data {

    use data\Header;

    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

    /**
    * Class has content all data default to header
    *
    * @package    Default
    * @subpackage Header
    */
    class Header {

        //Attribute has content all files css to system
        private $css    =   array(
                                    0   =>  'bootstrap.css', 
                                    1   =>  'animate.min.css',
                                    2   =>  'font-awesome.css',
                                    3   =>  'font-awesome.min.css',
                                    4   =>  'main.css',
                                    5   =>  'prettyPhoto.css',
                                    6   =>  'responsive.css',
                                    7   =>  'bootstrap-select.css',
                                    8   =>  'megadropdown.css',
                                    9   =>  'slick.css',
                                    10  =>  'fancybox.css',
                                    11  =>  'default.css',
                                    12  =>  'menu.css'
                                );

        //Attribute has content all files css to system
        private $js     =   array(
                                    0   =>  'jquery.js',
                                    1   =>  'bootstrap.min.js',
                                    2   =>  'jquery.prettyPhoto.js',
                                    3   =>  'html5shiv.js',
                                    4   =>  'main.js',
                                    5   =>  'jquery.isotope.min.js',
                                    6   =>  'wow.min.js',
                                    7   =>  'respond.min.js',
                                    8   =>  'home.js',
                                    9   =>  'bootstrap-select.js',
                                    10  =>  'menu-aim.js',
                                    11  =>  'modernizr.js',
                                    12  =>  'slick.js',
                                    13  =>  'fancybox.js',
                                    14  =>  'elevatezoom.js',
                                    15  =>  'produto.js',
                                    16  =>  'ttmenu.js',
                                    17  =>  'carrinho.js',
                                    18  =>  'default.js',
                                    19  =>  'pagseguro.js',
                                    20  =>  'prototype.js',
                                    21  =>  'login.js',
                                    22  =>  'jquery-form.js',
                                    23  =>  'minha_conta.js',
                                    24  =>  'jquery-mask.min1.13.3.js'
                                );

        //Attribute has content all files to incorpore in system
        private $inc    =   array(
                                  0  =>  'admin/modais/modal_login.php',
                                  1  =>  'admin/modais/modal_alert.php',
                                  2  =>  'admin/modais/modal_alert_confirm.php',
                                  3  =>  'admin/modais/modal_config_menu.php',
                                  4  =>  'admin/modais/modal_cadmenu.php',
                                  5  =>  'admin/modais/modal_cadsubmenu.php',
                                  6  =>  'admin/modais/modal_caditemmenu.php',
                                  7  =>  'admin/modais/pagseguro_checkout_transparent.php',
                                  8  =>  'admin/modais/modal_endereco.php'
                                );

        //Attribute has content a base url of system
        private $baseUrl    =   '';
        

        /**
        * Method construct, nothing more
        * 
        * @param  null
        * @access PUBLIC
        * @return void      
        */        
        public function __construct( $url ) {

            $this->baseUrl  =  $url;

        }


        /**
        * Method return content array css with base in another array with content the index of array css to return
        *
        * @param  ARRAY INT  $files  -  Array with indices to return data of array $css
        * @access PUBLIC
        * @return void             
        */
        public function getCss( $files = array() ) {

            //Set Path to files css
            $pathCss    =   $this->baseUrl . 'assets/css/';

            //String with tag html css here
            $css        =   '';

            //Init tag css
            $headerCss  =   "<link rel='stylesheet' type='text/css'";

            //Qtd to get data of array $css
            $files        =   count($files) == 0 ? $this->css : $files;

            //get data
            for( $i = 0; $i < count( $files ); $i++ ){

                //Get data
                $css   .=    $headerCss . " href='" . $pathCss . $this->css[$files[$i]] . "' /> \n";

            }

            //Return data
            return $css;

        }


        /**
        * Method return content array js with base in another array with content the index of array js to return
        *
        * @param  ARRAY INT  $files  -  Array with indices to return data of array $js
        * @access PUBLIC
        * @return void             
        */
        public function getJs( $files = array() ){

            //Set Path to files js
            $pathJs       =   $this->baseUrl . 'assets/js/';

            //String with tag html js here
            $js           =   '';
            
            //Init tag js
            $headerJs     =   "<script type='text/javascript'";

            //Qtd to get data of array $js
            $files        =   count($files) == 0 ? $this->js : $files;

            //Get data
            for( $i = 0; $i < count( $files ); $i++ ){

                //Get data
                $js   .=    $headerJs . " src='" . $pathJs . $this->js[$files[$i]] . "'></script> \n";

            }

            //Return data
            return $js;

        }   


        /**
        * Method return content array inc with base in another array with content the index of array inc to return
        *
        * @param  ARRAY INT  $files  -  Array with indices to return data of array $inc
        * @access PUBLIC
        * @return void             
        */
        public function getIncludes( $files = array() ) {

            //Path not public to views
            $path     =   APPPATH . 'views/';   

            //Content to return
            $content  =   '';

            //Get data
            for( $i = 0; $i < count( $files ); $i++ ){

                //get data
                $content  .=  file_get_contents( $path . $this->inc[$files[$i]] );

            }

            //Return data
            return $content;

        }

    }

}    