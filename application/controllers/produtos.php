<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("America/New_York");

class Produtos extends CI_Controller{

    private $Header    =  null;

    private $Produtos  =  null;

    private $Menus     =  null;

    private $Carrinho  =  null;

    private $Usuarios  =  null;

    private $Login     =  null;
    
	public function __construct() {        		
        
        parent::__construct();        

        //Instacia a classe Essential do package Security
        $this->Essential  =   new security\Essentials;

        //Instacia header para manipular arquivos css e js do sistema
        $this->Header     =   new data\Header( base_url() );

        //Instancia a classe de produtos
        $this->Produtos   =   new objects\Produtos;

        //
        $this->Menus      =   new objects\Menus;
         
    }


    /**
    * Método exibe os detalhes de um determinado produto
    *
    * @param  INT $id  -  ID do produto que está sendo consultado
    * @return null
    * @access PUBLIC
    */
    public function index( $id = '' ) {

        $data  =  array();

        //Define data info to header
        $data['header']            =   array();

        //Define data info to body
        $data['body']              =   array();

        //Define data info to footer
        $data['footer']            =   array();

        //Declara o array que vai levar todas as imagens
        $data['body']['images']    =   array();

        //Verifica o ID do produto é um número inteiro
        $response   =   $this->Essential->onlyNumber( $id ) ? true : false;

        if( $response ) {

            //Atribui o ID do produto
            $this->Produtos->idProduto   =  $id;

            $js    =  array( 0, 1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14 );

            $css   =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

            $fJs   =  array( 18, 15, 17, 18 );

            $data['header']['url']          =   base_url();

            $data['header']['css']          =   $this->Header->getCss( $css );

            $data['header']['js']           =   $this->Header->getJs( $js );

            $data['header']['inc']          =   '';

            $data['header']['menus']        =   $this->Menus->getMenusToHome();

            $data['header']['catss']        =   $this->Menus->getCategorias();

            $data['header']['inc']          =   $this->Header->getIncludes( array( 1 ) );

            $data['header']['pesq']  =   "";

            $data['body']['images']         =   $this->Produtos->getAllImages();

            $data['body']['imageDefault']   =   $this->Produtos->getImageDefaultDiretory();

            $data['body']['produto']        =   $this->Produtos->getNameProduto();

            $data['body']['info']           =   $this->Produtos->getInfoProdutoView();

            //var_dump( $data['body']['info'] ); exit;

            $data['body']["url"]            =   base_url();

            $data['body']["id"]             =   $id;

            $data['footer']["url"]          =   base_url();

            $data['footer']['js']           =   $this->Header->getJs( $fJs );
            
            $this->parser->parse("default/header", $data['header']);

            $this->parser->parse('produto', $data['body']);

            $this->parser->parse('default/footer', $data['footer']);

        }else {

            echo "Produto inválido";

        }

    }


    /**
    * Visualiza o carrinho
    *
    * @param  NULL
    * @return null
    * @access PUBLIC
    */
    public function carrinho() {

        $data  =  array();

        $this->Carrinho            =   new sessions\Carrinho;

        $this->Usuarios            =   new objects\Usuarios;

        $this->Login               =   new sessions\Login(2);

        $this->Usuarios->idUsuario =   $this->Login->getIdUser();

        $nome   =   $this->Usuarios->getFullName();

        if( is_bool( $nome ) ) {

            $nome  =  'Visitante';

        }else {

            $bName  =   explode(' ', $nome);

            if( count( $bName ) >= 2 ) {

                $nome   =   $bName[0] . ' ' . $bName[1];

            }else {

                $nome   =   $bName[0];

            }

        }

        //Define data info to header
        $data['header']            =   array();

        //Define data info to body
        $data['body']              =   array();

        //Define data info to footer
        $data['footer']            =   array();

        //Declara o array que vai levar todas as imagens
        $data['body']['images']    =   array();

        $js    =  array( 0, 1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14, 20, 22 );

        $css   =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        $fJs   =  array( 18, 15, 17, 19 );

        $produtos                       =   $this->Carrinho->getProdutos();

        $produtos                       =   $this->Produtos->getProdutosByCart( $produtos );

        $total                          =   $this->Carrinho->getTotal();

        $data['header']['url']          =   base_url();

        $data['header']['css']          =   $this->Header->getCss( $css );

        $data['header']['catss']        =   $this->Menus->getCategorias();

        $data['header']['js']           =   $this->Header->getJs( $js );

        $data['header']['inc']          =   '';

        $data['header']['pesq']  =   "";

        $data['header']['menus']        =   $this->Menus->getMenusToHome(); 

        $data['header']['inc']          =   $this->Header->getIncludes( array( 1, 7 ) );

        $data['header']['nome']         =   $nome;        

        $data['header']['total']        =   number_format( $total, 2, ',', '.' );

        $data['body']['totalS']         =   $total;

        $data['body']['images']         =   $this->Produtos->getAllImages();

        $data['body']['imageDefault']   =   $this->Produtos->getImageDefaultDiretory();

        $data['body']['carrinho']       =   $produtos;

        $data['body']['total']          =   number_format( $this->Carrinho->getTotal(), 2, ',', '.');

        $data['body']['info']           =   $this->Produtos->getInfoProdutoView();

        $data['body']["url"]            =   base_url();

        $data['footer']["url"]          =   base_url();

        $data['footer']['js']           =   $this->Header->getJs( $fJs );
        
        $this->parser->parse("default/header", $data['header']);

        $this->parser->parse('carrinho', $data['body']);

        $this->parser->parse('default/footer', $data['footer']);

    }

}    