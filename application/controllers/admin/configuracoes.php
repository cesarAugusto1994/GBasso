<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuracoes extends CI_Controller {

    private $Header     =  null;

    private $Essential  =  null;

    private $Login      =  null;

    private $Config     =  null;

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

        $this->Config  =   new objects\Configuracoes();

        $css   =  array( 0, 1, 2, 4, 6, 11, 9 );

        $js    =  array( 0, 1, 10, 11, 12 );

        $url   =  base_url();

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body 
        $data['body']    =  array();

        //Define data info to footer
        $data['footer']  =  array();

        //Get file css
        $data['header']['css']   =   $this->Header->getCss( $css );

        //Get file js
        $data['header']['js']    =   $this->Header->getJs( $js );

        //Get file inc
        $data['header']['inc']   =   $this->Header->getIncludes( array( 0, 1, 7 ) );

        //Get file js
        $data['footer']['js']    =   $this->Header->getJs( array( 2, 6, 8, 14, 22 ) );

        //Url to header
        $data['header']['url']   =   $url;

        //Url to body
        $data['body']['url']     =   $url;

        //get configurações
        $data['body']['confs']   =   $this->Config->getConfigs();

        $data['body']['cepOrigem']   =   $this->Config->getCepOrigem();

        //Url to footer
        $data['footer']['url']   =   $url;

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/configuracoes/config', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }

}    