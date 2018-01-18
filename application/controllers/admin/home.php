<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("America/New_York");

class Home extends CI_Controller {

    private $Header     =  null;

    private $Essential  =  null;

    private $Login      =  null;
    
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


    public function index() {           

        $data  =  array();        

        $css   =  array( 0, 1, 2, 3, 4, 5, 6 );

        $js    =  array( 0, 1, 4, 5 );

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body 
        $data['body']    =  array();

        //Define data info to footer
        $data['footer']  =  array();

        //Get file css
        $data['header']['css']   =   $this->Header->getCss( $css );

        $data['header']['inc']   =   ''; //$this->Header->getIncludes( array() );

        //Get file js
        $data['header']['js']    =   $this->Header->getJs( $js );

        //Get file js
        $data['footer']['js']    =   $this->Header->getJs( array( 2, 3, 6, 7, 8 ) );


        $data['header']['url']   =   base_url();

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/home/index', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }


}    