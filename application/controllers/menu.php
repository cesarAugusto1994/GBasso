<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("America/New_York");

class Menu extends CI_Controller{

    private $Header     =  null;

    private $Essential  =  null;

    private $Produtos   =  null;

    private $Menus      =  null;

    private $Categorias      =  null;
    
	public function __construct() {        		

        parent::__construct();        

        //Instacia a classe Essential do package Security
        $this->Essential  =   new security\Essentials;

        //Instacia a classe Essential do package Security
        $this->Header     =   new data\Header( base_url() );

        //Instacia a classe Essential do package Security
        $this->Produtos   =   new objects\Produtos;

        //Instacia a classe Essential do package Security
        $this->Menus      =   new objects\Menus;

        //Instacia a classe Essential do package Security
        $this->Categorias =   new objects\Categorias;

    }


    public function index() {           

        $qtdUri  =  count( $this->uri->segment_array() );

        $id      =  substr( $this->uri->slash_segment( $qtdUri ), 0, -1);

        $uri     =  array();

        $i       =  0;

        foreach ($this->uri->segment_array() as $key => $value ) {
                
            if( !is_numeric( $value ) ) {

                $uri[ $i ]  =  $this->Essential->sqlInjection( $value );

                $i++;

            }

        }

        if( !is_numeric( $id ) ) $id  =  0;

        switch ( $qtdUri ) {
            case 2:
                $this->Produtos->setWhere( "CAT.cat_id = '$id'" );
            break;
            
            case 3:
                $this->Produtos->setWhere( "SUBCAT.subcat_id = '$id'" );
            break;

            default :
                $this->Produtos->setWhere( "( CAT.cat_id = '$id' OR SUBCAT.subcat_id = '$id')" );
            break;
        }

        $data  =  array();

        $js    =  array( 0, 1, 2, 3, 4, 5, 6, 9, 10, 11, 12 );

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body 
        $data['body']    =  array();

        //Define data info to footer
        $data['footer']  =  array();
        
        $data['header']['url']           =   base_url();

        $data['header']['css']           =   $this->Header->getCss( $css );

        $data['header']['js']            =   $this->Header->getJs( $js );

        $data['header']['inc']           =   '';//$this->Header->getIncludes( );

        $data['body']["url"]             =   base_url();

        $data['header']['categorias']    =   $this->Categorias->getCategoriasToHome();

        $data['header']['menus']         =   $this->Menus->getMenusToHome();

        $data['body']['produtos']        =   $this->Produtos->buscarProdutos();

        $data['body']['broadcrumb']      =   $this->Categorias->getBroadCrumbs( $uri );

        $this->Categorias->reset();

        $this->Categorias->setWhere( "cat_status = 1" );

        $data['body']['categorias']      =   $this->Categorias->getCategorias();

        $data['footer']["url"]           =   base_url();

        $data['footer']['js']            =   $this->Header->getJs( array( 8, 7, 17 ) );

        $this->parser->parse("default/header", $data['header']);

        $this->parser->parse('resultado_busca', $data['body']);

        $this->parser->parse('default/footer', $data['footer']);

    }


}