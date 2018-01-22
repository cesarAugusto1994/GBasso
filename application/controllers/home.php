<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("America/New_York");

class Home extends CI_Controller{

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

    }


    public function index() {           

        $data  =  array(); 

        $this->Banners    =   new objects\Banners; 

        $this->Login               =   new sessions\Login(2);

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

        $data['header']['inc']           =   $this->Header->getIncludes( array( 1 ) );

        $data['header']['catss']        =   $this->Menus->getCategorias();

        $data['header']['pesq']          =   "";

        $data['body']["url"]             =   base_url();

        $data['body']['dest']            =   $this->Produtos->getDestaques();

        $data['body']['ofertas']         =   $this->Produtos->getOfertasDia();

        $data['body']['maisVendidos']    =   $this->Produtos->getMaisVendidos();

        $data['body']['novosProdutos']   =   $this->Produtos->getNovosProdutos();

        $data['body']['maisProcurados']  =   $this->Produtos->getMaisProcurados();

        $data['header']['categorias']    =   $this->Categorias->getCategoriasToHome();

        $data['header']['menus']         =   $this->Menus->getMenusToHome();

        $data['header']['logado']         =   $this->Login->checkLogin() ? true :  false;

        $data['footer']["url"]           =   base_url();

        $data['footer']['js']            =   $this->Header->getJs( array( 8, 7, 17, 18 ) );

        $this->Banners->idLocal          =   1;

        $data['body']['banner1']         =   $this->Banners->getImagens();
        
        $this->Banners->idLocal          =   2;

        $data['body']['banner2']         =   $this->Banners->getImagens();

        $this->Banners->idLocal          =   3;

        $data['body']['banner3']         =   $this->Banners->getImagens();

        $this->Banners->idLocal          =   4;

        $data['body']['banner4']         =   $this->Banners->getImagens();

        $this->Banners->idLocal          =   5;

        $data['body']['banner5']         =   $this->Banners->getImagens();                

        $this->Banners->idLocal          =   6;

        $data['body']['banner6']         =   $this->Banners->getImagens();  

        $this->Banners->idLocal          =   7;

        $data['body']['banner7']         =   $this->Banners->getImagens();  

        $this->parser->parse("default/header", $data['header']);

        $this->parser->parse('index', $data['body']);

        $this->parser->parse('default/footer', $data['footer']);

    }


}    