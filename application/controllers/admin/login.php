<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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

        //Redireciona o usuário caso ele tente acessar a página de login com sessão ativa
        if( $this->Login->checkSessionAdmin() ) redirect( base_url( 'admin' ) );

    }


    public function index() {           

        $data  =  array();        

        $css   =  array( 0, 1, 2, 6, 9 );

        $js    =  array( 0, 1, 2, 10 );

        //Define data info to header
        $data['header']          =   array();

        //Define data info to body 
        $data['body']            =   array();

        //Define data info to footer
        $data['footer']          =   array();

        //Get file css
        $data['header']['css']   =   $this->Header->getCss( $css );

        //Get file js
        $data['header']['js']    =   $this->Header->getJs( $js );

        //Get url
        $data['header']['url']   =   base_url();

        //Get url
        $data['body']['url']     =   base_url();

        //Get file js
        $data['footer']['js']    =   $this->Header->getJs( array( 2, 8, 14 ) );

        //get url
        $data['footer']['url']   =   base_url();

        //Load views
        $this->parser->parse('admin/login/header', $data['header'] );

        $this->parser->parse('admin/login/index', $data['body'] );

        $this->parser->parse('admin/login/footer', $data['footer'] );

    }


}    