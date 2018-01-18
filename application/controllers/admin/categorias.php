<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("America/New_York");

class Categorias extends CI_Controller {

    private $Header      =  null;

    private $Essential   =  null;

    private $Login       =  null;

    private $Categorias  =  null;
    
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


    public function nova_categoria() {

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
        $data['header']['inc']   =   $this->Header->getIncludes( array( 0, 1 ) );

        //Get file js
        $data['footer']['js']    =   $this->Header->getJs( array( 8, 2, 3, 6, 19 ) );

        //Header url
        $data['header']['url']   =   base_url();

        //Body url
        $data['body']['url']     =   base_url();

        //
        $data['body']['id']      =   '';

        //Footer url
        $data['footer']['url']   =   base_url();

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/categorias/nova_categoria', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }


    public function editarCategoria( $id ) {

        $data  =  array();

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 11, 9 );

        $js    =  array( 0, 1, 4, 5, 10, 11, 12, 15, 16, 17 );

        $this->Categorias  =  new objects\Categorias;

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
        $data['footer']['js']    =   $this->Header->getJs( array( 8, 2, 3, 6, 19 ) );

        //Header url
        $data['header']['url']   =   base_url();

        //Body url
        $data['body']['url']     =   base_url();

        //Body data
        $data['body']['id']      =   $id;

        //Footer url
        $data['footer']['url']   =   base_url();

        $data['body']['cat']     =   array();

        if( is_numeric( $id ) ) {

            $this->Categorias->idCategoria  =   $id;

            //Body data
            $data['body']['cat']     =   $this->Categorias->getCategorias( true );
            
        }

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/categorias/nova_categoria', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }


    public function visualizar_categorias() {

        $data  =  array();

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 11, 9 );

        $js    =  array( 0, 1, 4, 5, 10, 11, 12, 15, 16, 17 );

        $this->Categorias  =  new objects\Categorias;

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
        $data['header']['inc']   =   $this->Header->getIncludes( array( 0, 1, 3 ) );

        //Get file js
        $data['footer']['js']    =   $this->Header->getJs( array( 8, 2, 3, 6, 19 ) );

        //Header url
        $data['header']['url']   =   base_url();

        //Body data
        $data['body']['cat']     =   $this->Categorias->getCategorias();

        //Body url
        $data['body']['url']     =   base_url();

        //Footer url
        $data['footer']['url']   =   base_url();

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/categorias/visualizar_categorias', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }


    public function visualizar_tagsubcategorias() {

        $data  =  array();

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 11, 9 );

        $js    =  array( 0, 1, 4, 5, 10, 11, 12, 15, 16, 17 );

        $this->Categorias  =  new objects\Categorias;

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
        $data['footer']['js']    =   $this->Header->getJs( array( 8, 2, 3, 6, 19 ) );

        //Header url
        $data['header']['url']   =   base_url();

        //Body data
        $data['body']['cattag']  =   $this->Categorias->getTagsCategorias();

        //Body url
        $data['body']['url']     =   base_url();

        //Footer url
        $data['footer']['url']   =   base_url();

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/categorias/visualizar_tagsubcategorias', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }


    public function nova_subcategoria() {

        $data  =  array();        

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 11, 9 );

        $js    =  array( 0, 1, 4, 5, 10, 11, 12, 15, 16, 17 );

        $this->Categorias  =  new objects\Categorias;

        //Define data info to header
        $data['header']    =  array();

        //Define data info to body
        $data['body']      =  array();

        //Define data info to footer
        $data['footer']    =  array();

        //Get file css
        $data['header']['css']   =   $this->Header->getCss( $css );

        //Get file js
        $data['header']['js']    =   $this->Header->getJs( $js );

        //Get file inc
        $data['header']['inc']   =   $this->Header->getIncludes( array( 0, 1 ) );

        //Get file js
        $data['footer']['js']    =   $this->Header->getJs( array( 8, 2, 3, 6, 19 ) );

        //Header url
        $data['header']['url']   =   base_url();

        //Body url
        $data['body']['url']     =   base_url();

        $data['body']['id']      =   '';

        //Body categorias
        $data['body']['cat']     =   $this->Categorias->getCategoriasSelect();

        //Footer url
        $data['footer']['url']   =   base_url();

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/categorias/nova_subcategoria', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }


    public function nova_tag_categoria() {

        $data  =  array();        

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 11, 9 );

        $js    =  array( 0, 1, 4, 5, 10, 11, 12, 15, 16, 17 );

        $this->Categorias  =  new objects\Categorias;

        //Define data info to header
        $data['header']    =  array();

        //Define data info to body
        $data['body']      =  array();

        //Define data info to footer
        $data['footer']    =  array();

        //Get file css
        $data['header']['css']   =   $this->Header->getCss( $css );

        //Get file js
        $data['header']['js']    =   $this->Header->getJs( $js );

        //Get file inc
        $data['header']['inc']   =   $this->Header->getIncludes( array( 0, 1 ) );

        //Get file js
        $data['footer']['js']    =   $this->Header->getJs( array( 8, 2, 3, 6, 19 ) );

        //Header url
        $data['header']['url']   =   base_url();

        //Body url
        $data['body']['url']     =   base_url();

        $data['body']['id']      =   '';

        //Body categorias
        $data['body']['categorias']     =   $this->Categorias->getCategoriasSelect();

        //Footer url
        $data['footer']['url']   =   base_url();

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/categorias/nova_tag_subcategoria', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }


    public function editarTagCategoria( $id = '' ) {

        $data  =  array();        

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 11, 9 );

        $js    =  array( 0, 1, 4, 5, 10, 11, 12, 15, 16, 17 );

        $this->Categorias  =  new objects\Categorias;

        //Define data info to header
        $data['header']    =  array();

        //Define data info to body
        $data['body']      =  array();

        //Define data info to footer
        $data['footer']    =  array();

        //Get file css
        $data['header']['css']       =   $this->Header->getCss( $css );

        //Get file js
        $data['header']['js']        =   $this->Header->getJs( $js );

        //Get file inc
        $data['header']['inc']       =   $this->Header->getIncludes( array( 0, 1 ) );

        //Get file js
        $data['footer']['js']        =   $this->Header->getJs( array( 8, 2, 3, 6, 19 ) );

        //Header url
        $data['header']['url']       =   base_url();

        //Body url
        $data['body']['url']         =   base_url();
        

        //Body categorias
        $data['body']['categorias']  =  $this->Categorias->getCategoriasSelect();

        //Footer url
        $data['footer']['url']       =  base_url();
 
        if( is_numeric( $id ) ) {

            $data['body']['id']   =   $id;

            $data['body']['tag']  =   $this->Categorias->getTagsCategorias( true, $id );

        }

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/categorias/nova_tag_subcategoria', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }


    public function editarSubCategoria( $id ) {

        $data  =  array();        

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 11, 9 );

        $js    =  array( 0, 1, 4, 5, 10, 11, 12, 15, 16, 17 );

        $this->Categorias  =  new objects\Categorias;

        //Define data info to header
        $data['header']    =  array();

        //Define data info to body
        $data['body']      =  array();

        //Define data info to footer
        $data['footer']    =  array();

        //Get file css
        $data['header']['css']   =   $this->Header->getCss( $css );

        //Get file js
        $data['header']['js']    =   $this->Header->getJs( $js );

        //Get file inc
        $data['header']['inc']   =   $this->Header->getIncludes( array( 0, 1 ) );

        //Get file js
        $data['footer']['js']    =   $this->Header->getJs( array( 8, 2, 3, 6, 19 ) );

        //Header url
        $data['header']['url']   =   base_url();

        //Body url
        $data['body']['url']     =   base_url();

        //Body categorias
        $data['body']['cat']     =   $this->Categorias->getCategoriasSelect();

        //Body categorias
        $data['body']['id']      =   $id;

        //Footer url
        $data['footer']['url']   =   base_url();

        //Body categorias
        $data['body']['subcat']  =   array();

        if( is_numeric( $id )) {

            $this->Categorias->idSubCategoria  =  $id;

            //Body categorias
            $data['body']['subcat']  =   $this->Categorias->getSubCategorias( true );

        }

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/categorias/nova_subcategoria', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }

    public function visualizar_subcategorias() {

        $data  =  array();        

        $css   =  array( 0, 1, 2, 3, 4, 5, 6, 11, 9 );

        $js    =  array( 0, 1, 4, 5, 10, 11, 12, 15, 16, 17 );

        $this->Categorias  =  new objects\Categorias;

        //Define data info to header
        $data['header']    =  array();

        //Define data info to body
        $data['body']      =  array();

        //Define data info to footer
        $data['footer']    =  array();

        //Get file css
        $data['header']['css']   =   $this->Header->getCss( $css );

        //Get file js
        $data['header']['js']    =   $this->Header->getJs( $js );

        //Get file inc
        $data['header']['inc']   =   $this->Header->getIncludes( array( 0, 1 ) );

        //Get file js
        $data['footer']['js']    =   $this->Header->getJs( array( 8, 2, 3, 6, 19 ) );

        //Header url
        $data['header']['url']   =   base_url();

        //Body url
        $data['body']['url']     =   base_url();

        //Body url
        $data['body']['subcat']  =   $this->Categorias->getSubCategorias();

        //Footer url
        $data['footer']['url']   =   base_url();

        //Load views
        $this->parser->parse('admin/default/header', $data['header'] );

        $this->parser->parse('admin/categorias/visualizar_subcategorias', $data['body'] );

        $this->parser->parse('admin/default/footer', $data['footer'] );

    }

}    















