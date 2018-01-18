<?php 

namespace data {

    use data\Header_admin;

    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

    /**
    * Class has content all data default to header
    *
    * @package    Default
    * @subpackage Header
    */
    class Header_admin {

        //Attribute has content all files css to system
        private $css    =   array(
                                    0   =>  'bootstrap.min.css',
                                    1   =>  'bootstrap-theme.min.css',
                                    2   =>  'metisMenu.min.css',
                                    3   =>  'timeline.css',
                                    4   =>  'sb-admin-2.css',
                                    5   =>  'morris.css',
                                    6   =>  'font-awesome.min.css',
                                    7   =>  'mocha.css',
                                    8   =>  'bootstrap-social.css',
                                    9   =>  'default.css',
                                    10  =>  'animate.css',
                                    11  =>  'bootstrap-select.css',
                                );

        //Attribute has content all files css to system
        private $js     =   array(
                                    0   =>  'jquery.min.js',
                                    1   =>  'bootstrap.min.js',
                                    2   =>  'metisMenu.min.js',
                                    3   =>  'mocha.js',
                                    4   =>  'morris.min.js',
                                    5   =>  'raphael-min.js',
                                    6   =>  'default.js',
                                    7   =>  'morris-data.js',
                                    8   =>  'sb-admin-2.js',
                                    9   =>  'bootstrap-select.js',
                                    10  =>  'jquery-form.js',
                                    11  =>  'jquery-mask.min1.13.3.js',
                                    12  =>  'priceformat.js',
                                    13  =>  'prototype.js',
                                    14  =>  'login.js',
                                    15  =>  'bootstrap-select.js',
                                    16  =>  'bootstrap-filestyle.min.js',
                                    17  =>  'ckeditor/ckeditor.js',
                                    18  =>  'produtos.js',
                                    19  =>  'categorias.js',
                                    20  =>  'banners.js',
                                    21  =>  'menus.js',
                                    22  =>  'configuracoes.js',
                                    23  =>  'vendas.js'
                                );

        //Attribute has content all files to incorpore in system
        private $inc    =   array(
                                  0   =>  'admin/modais/modal_login.php',
                                  1   =>  'admin/modais/modal_alert.php',
                                  2   =>  'admin/modais/modal_alert_confirm.php',
                                  3   =>  'admin/modais/modal_config_menu.php',
                                  4   =>  'admin/modais/modal_cadmenu.php',
                                  5   =>  'admin/modais/modal_cadsubmenu.php',
                                  6   =>  'admin/modais/modal_caditemmenu.php',
                                  7   =>  'admin/modais/verificarFrete.php',
                                  8   =>  'admin/modais/rastreamento.php',
                                  9   =>  'admin/modais/inserirCodRastreamento.php',
                                  10  =>  'admin/modais/infoVendas.php',
                                  11  =>  'admin/modais/estoque.php',
                                  12  =>  'admin/modais/novoLocal.php'
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
            $pathCss    =   $this->baseUrl . 'assets/admin/css/';

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
            $pathJs       =   $this->baseUrl . 'assets/admin/js/';

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