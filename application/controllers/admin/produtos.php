<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("America/New_York");

class Produtos extends CI_Controller {

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


    public function cadastrar() {

        $data  =  array();        

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 11, 9 );

        $js    =  array( 0, 1, 10, 11, 12, 15, 16, 17 );

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
        $data['footer']['js']    =   $this->Header->getJs( array( 2, 6, 8, 14, 18 ) );

        //Url to header
        $data['header']['url']   =   $url;

        //Url to body
        $data['body']['url']     =   $url;        

        //Url to footer
        $data['footer']['url']   =   $url;

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/produtos/cadastrar', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }


    public function editar( $id = '' ) {

        $data  =  array();        

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 11, 9 );

        $js    =  array( 0, 1, 10, 11, 12, 15, 16, 17 );

        $this->Produtos  =   new objects\Produtos;

        $url   =  base_url();

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body 
        $data['body']    =  array();

        //Define data info to footer
        $data['footer']  =  array();

        //Get file css
        $data['header']['css']      =   $this->Header->getCss( $css );

        //Get file js
        $data['header']['js']       =   $this->Header->getJs( $js );

        //Get file inc
        $data['header']['inc']      =   $this->Header->getIncludes( array( 0, 1 ) );

        //Get file js
        $data['footer']['js']       =   $this->Header->getJs( array( 2, 6, 8, 14, 18 ) );

        //Url to header
        $data['header']['url']      =   $url;

        //Url to body
        $data['body']['url']        =   $url;

        //Url to footer
        $data['footer']['url']      =   $url;

        if( is_numeric( $id ) ) {

            $this->Produtos->idProduto  =   $id;

            $data['body']['cat']        =   $this->Produtos->getCategoriaProdutos();

            $data['body']['info']       =   $this->Produtos->getProdutos( true );

            $data['body']['tags']       =   $this->Produtos->getDataLista();

            $data['body']['lista']      =   $this->Produtos->getListaTipos();

            //print_r( $data['body']['tags'] ); exit;

        }

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/produtos/editar_produto', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }


    public function visualizar() {

        $data  =  array();        

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 11, 9 );

        $js    =  array( 0, 1, 10, 11, 12, 15, 16, 17 );

        $this->Produtos  =   new objects\Produtos;

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
        $data['header']['inc']     =   $this->Header->getIncludes( array( 0, 1, 11 ) );

        //Get file js
        $data['footer']['js']      =   $this->Header->getJs( array( 2, 6, 8, 14, 18 ) );

        //Url to header
        $data['header']['url']     =   $url;

        //Url to body
        $data['body']['url']       =   $url;

        //Produtos
        $data['body']['produtos']  =   $this->Produtos->getProdutos();

        //Url to footer
        $data['footer']['url']     =   $url;

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/produtos/visualizar_produtos', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }


    public function images( $id = '' ) {

        $data  =  array();

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 11, 9 );

        $js    =  array( 0, 1, 10, 11, 12, 15, 16, 17 );

        $url   =  base_url();

        $this->Produtos  =   new objects\Produtos;

        $name            =   'Erro ao buscar nome do produto';   

        if( $this->Essential->onlyNumber( $id ) ) {

            $this->Produtos->idProduto  =  $id;

            $name  =  $this->Produtos->getNameProduto();

        }

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
        $data['header']['inc']   =   $this->Header->getIncludes( array( 0, 1 ) );

        //Get file js
        $data['footer']['js']    =   $this->Header->getJs( array( 2, 6, 14, 18 ) );

        //Url to header
        $data['header']['url']   =   $url;

        //Url to body
        $data['body']['url']     =   $url;

        //Obtem o nome do produto
        $data['body']['name']    =   $name;

        //ID do produto
        $data['body']['id']      =   $id;

        //Url to footer
        $data['footer']['url']   =   $url;

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/produtos/image_edit', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }


}    