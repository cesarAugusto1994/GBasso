<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("America/New_York");

class Locais extends CI_Controller {

    private $Header     =  null;

    private $Essential  =  null;

    private $Login      =  null;

    private $Produtos   =  null;
    
	public function __construct() {        		
            
        parent::__construct();          

        //Instacia a classe Essential do package Security
        $this->Essential  =   new security\Essentials;

        //Instacia a classe Essential do package Security
        $this->Header     =   new data\Header_admin( base_url() );

        //Instancia a classe login
        $this->Login      =   new sessions\Login;

        //Load data admin
        $this->Login->loadDataAdmin();

        //Redireciona o usuário para login caso sua sessão tenha expirado ou não exista
        if( !$this->Login->checkSessionAdmin() ) redirect( base_url( 'admin/login' ) );
         
    }


    public function visualizar() {

        $data  =  array();        

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 11, 9 );

        $js    =  array( 0, 1, 10, 11, 12, 15, 16, 17 );

        $this->Produtos   =   new objects\Produtos();

        $url   =  base_url();

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body
        $data['body']    =  array();

        //Define data info to footer
        $data['footer']  =  array();

        //Get file css
        $data['header']['css']     =   $this->Header->getCss( $css );

        //Get file js
        $data['header']['js']      =   $this->Header->getJs( $js );

        //Get file inc
        $data['header']['inc']     =   $this->Header->getIncludes( array( 0, 1, 12 ) );

        //Get file js
        $data['footer']['js']      =   $this->Header->getJs( array( 2, 6, 8, 14, 18 ) );

        //Url to header
        $data['header']['url']     =   $url;

        //Url to body
        $data['body']['url']       =   $url;

        //Obtem todos locais
        $data['body']['locais']    =   $this->Produtos->getLocais();

        //Url to footer
        $data['footer']['url']     =   $url;

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/locais/view_local', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }

}    