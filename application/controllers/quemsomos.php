<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quemsomos extends CI_Controller{

    private $Header      =  null;

    private $Produtos    =  null;

    private $Categorias  =  null;

    private $Menus       =  null;

    private $Banners     =  null;
    
	public function __construct() {
        
        parent::__construct();      

        //Instacia a classe Essential do package Security
        $this->Essential   =   new security\Essentials;

        //Instacia a classe Essential do package Security
        $this->Header      =   new data\Header( base_url() );

        $this->Produtos    =   new objects\Produtos;

        $this->Categorias  =   new objects\Categorias;

        $this->Menus       =   new objects\Menus;

        $this->Login       =   new sessions\Login(2);

    }


    public function index() {           

        $data  =  array(); 



        $this->Banners    =   new objects\Banners; 

        $js    =  array( 0, 1, 2, 3, 4, 5, 6, 9, 10, 11, 12 );

        $css   =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body 
        $data['body']    =  array();

        //Define data info to footer
        $data['footer']  =  array();
        
        $data['header']['url']           =   base_url();

        $data['header']['css']           =   $this->Header->getCss( $css );

        $data['header']['js']            =   $this->Header->getJs( $js );

        $data['header']['catss']        =   $this->Menus->getCategorias();

        $data['header']['pesq']          =   "";

        $data['header']['inc']           =   '';//$this->Header->getIncludes( );

        $data['header']['logado']         =   $this->Login->checkLogin() ? true :  false;

        $data['body']["url"]             =   base_url();      

        $data['header']['categorias']    =   $this->Categorias->getCategoriasToHome();

        $data['header']['menus']         =   $this->Menus->getMenusToHome();

        $data['footer']["url"]           =   base_url();

        $data['footer']['js']            =   $this->Header->getJs( array( 8, 7, 17, 18 ) );

        $this->Banners->idLocal          =   1;

        $this->parser->parse("default/header", $data['header']);

        $this->parser->parse('quemsomos', $data['body']);

        $this->parser->parse('default/footer', $data['footer']);
    }


}    