<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendas extends CI_Controller {

    private $Header     =  null;

    private $Essential  =  null;

    private $Login      =  null;

    private $Menus      =  null;

    private $Vendas     =  null;
    
	public function __construct() {
            
        parent::__construct();        

        //Instacia a classe Essential do package Security
        $this->Essential  =   new security\Essentials;

        //Instacia a classe Essential do package Security
        $this->Header     =   new data\Header_admin( base_url() );

        //Instancia a classe login
        $this->Login      =   new sessions\Login;

        //Instancia a classe Menus
        $this->Menus      =   new objects\Menus;   

        //Instancia a classe Vendas
        $this->Vendas     =   new objects\Vendas; 

        //Load data admin
        $this->Login->loadDataAdmin();

        //Redireciona o usuário para login caso sua sessão tenha expirado ou não exista
        if( !$this->Login->checkSessionAdmin() ) redirect( base_url( 'admin/login' ) );
         
    }


    public function index() {

        $data  =  array();

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 11, 9 );

        $js    =  array( 0, 1, 4, 5, 10, 11, 12, 15, 16, 17 );

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
        $data['header']['inc']   =   $this->Header->getIncludes( array( 0, 1, 8, 9, 10 ) );

        //Get file js
        $data['footer']['js']    =   $this->Header->getJs( array( 8, 2, 3, 6, 23 ) );

        //Header url
        $data['header']['url']   =   base_url();

        //Body url
        $data['body']['url']     =   base_url();

        //
        $data['body']['menus']   =   $this->Menus->getMenus();

        $data['body']['vendas']  =   $this->Vendas->getVendas();

        //Footer url
        $data['footer']['url']   =   base_url();

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/vendas/index', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }


}