<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("America/New_York");

class Minha_conta extends CI_Controller{

    private $Header      =  null;

    private $Produtos    =  null;

    private $Categorias  =  null;

    private $Menus       =  null;

    private $Login       =  null;

    private $Usuarios    =  null;

    private $xmlParser   =  null;


    /**
     * Método inicializa a classe
     *
     * @param  NULL
     * @return VOID
     * @access PUBLIC
     **/
    public function __construct() {

        parent::__construct();        

        //Instacia a classe Essential do package Security
        $this->Essential   =   new security\Essentials;

        //Instacia a classe Essential do package Security
        $this->Header      =   new data\Header( base_url() );

        $this->Produtos    =   new objects\Produtos;

        $this->Categorias  =   new objects\Categorias;

        $this->Menus       =   new objects\Menus;

        $this->Login       =   new sessions\Login;

        $this->Correios    =   null;

        $segmento          =   substr( trim( $this->uri->slash_segment( 3 ) ), 0, -1 );

        $response          =   $this->Login->checkLogin();

        if( $segmento != 'login' && $segmento != 'cadastrar' ) {
            !$response ? redirect( 'minha/conta/login' ) : null;
        }else if( $segmento == 'login' || $segmento == 'cadastrar' ) {
            $response ? redirect( 'minha/conta/inicio' ) : null;
        }

    }


    /**
     * Método realiza a saída e destroi todos os dados de sessão
     *
     * @param  NULL
     * @return VOID
     * @access PUBLIC
     **/
    public function sair() {

        $this->Login->logOut();

        redirect( 'minha/conta/login' );

    }


    /**
     * Método abre a página de login e realiza as configurações necessárias para tudo funcionar perfeitamente nesta página
     *
     * @param  NULL
     * @return VOID
     * @access PUBLIC
     **/
    public function login() {

        $data  =  array();

        $js    =  array( 0, 1, 2, 3, 4, 5, 6, 9, 10, 11, 12, 22  );

        $css   =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body 
        $data['body']    =  array();

        //Define data info to footer
        $data['footer']  =  array();
        
        $data['header']['url']  =   base_url();
        
        $data['header']['catss']        =   $this->Menus->getCategorias();

        $data['header']['css']  =   $this->Header->getCss( $css );

        $data['header']['js']   =   $this->Header->getJs( $js );

        $data['header']['inc']  =   $this->Header->getIncludes( array( 1 ) );

        $data['header']['page'] =   'login';

        $data['body']["url"]    =   base_url();

        $data['footer']["url"]  =   base_url();

        $data['footer']['js']   =   $this->Header->getJs( array( 7, 18, 21, 17 ) );

        $this->parser->parse("minhaconta/default/header", $data['header']);

        $this->parser->parse('minhaconta/login/login', $data['body']);

        $this->parser->parse('minhaconta/default/footer', $data['footer']);

    }


    /**
     * Método abre a página de cadastro de usuário
     *
     * @param  NULL
     * @return VOID
     * @access PUBLIC
     **/
    public function cadastrar() {

        $data  =  array();

        $js    =  array( 0, 1, 2, 3, 4, 5, 6, 9, 10, 11, 12, 22, 24 );

        $css   =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body
        $data['body']    =  array();

        //Define data info to footer
        $data['footer']  =  array();
        
        $data['header']['url']  =   base_url();

        $data['header']['catss']        =   $this->Menus->getCategorias();

        $data['header']['css']  =   $this->Header->getCss( $css );

        $data['header']['js']   =   $this->Header->getJs( $js );

        $data['header']['inc']  =   $this->Header->getIncludes( array( 1 ) );

        $data['body']["url"]    =   base_url();

        $data['footer']["url"]  =   base_url();

        $data['footer']['js']   =   $this->Header->getJs( array( 7, 18, 21, 17, 18 ) );

        $this->parser->parse("minhaconta/default/header", $data['header']);

        $this->parser->parse('minhaconta/cadastrar/cadastrar', $data['body']);

        $this->parser->parse('minhaconta/default/footer', $data['footer']);

    }


    /**
     * Método abre a página de inicio do minha conta
     *
     * @param  NULL
     * @return VOID
     * @access PUBLIC
     **/
    public function inicio() {

        $data  =  array();

        $js    =  array( 0, 1, 2, 3, 4, 5, 6, 9, 10, 11, 12, 22, 24  );

        $css   =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body
        $data['body']    =  array();

        //Define data info to footer
        $data['footer']  =  array();
        
        $data['header']['url']   =   base_url();

        $data['header']['catss']        =   $this->Menus->getCategorias();

        $data['header']['css']   =   $this->Header->getCss( $css );

        $data['header']['js']    =   $this->Header->getJs( $js );

        $data['header']['inc']   =   $this->Header->getIncludes( array( 1 ) );

        $data['body']["url"]     =   base_url();

        $data['footer']["url"]   =   base_url();

        $data['footer']['js']    =   $this->Header->getJs( array( 7, 18, 21, 23, 17 ) );

        $this->parser->parse("minhaconta/default/header", $data['header']);

        $this->parser->parse('minhaconta/home/inicio', $data['body']);

        $this->parser->parse('minhaconta/default/footer', $data['footer']);

    }


    /**
     * Método abre a página que mostra todos os dados do cliente para que ele possa editar
     *
     * @param  NULL
     * @return VOID
     * @access PUBLIC
     **/
    public function meusdados() {

        //Inicializa o array que conterá todos os dados
        $data  =  array();

        //Instancia a classe de usuários
        $this->Usuarios              =   new objects\Usuarios();

        //Seta o ID do usuário na classe Usuários
        $this->Usuarios->idUsuario   =   $this->Login->getIdUser();

        //Declara os arquivos JS que serão usados na página
        $js              =  array( 0, 1, 2, 3, 4, 5, 6, 9, 10, 11, 12, 22, 24  );

        //Declara os arquivos CSS que serão usados na página
        $css             =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body
        $data['body']    =  array();

        //Define data info to footer
        $data['footer']  =  array();
        
        $data['header']['url']   =   base_url();

        $data['header']['css']   =   $this->Header->getCss( $css );

        $data['header']['js']    =   $this->Header->getJs( $js );

        $data['header']['catss']        =   $this->Menus->getCategorias();

        $data['header']['inc']   =   $this->Header->getIncludes( array( 1 ) );

        $data['body']            =   $this->Usuarios->getAllDataUser();

        $data['body']["url"]     =   base_url();        

        $data['footer']["url"]   =   base_url();

        $data['footer']['js']    =   $this->Header->getJs( array( 7, 18, 21, 23, 17 ) );

        $this->parser->parse("minhaconta/default/header", $data['header']);

        $this->parser->parse('minhaconta/meusdados/editar', $data['body']);

        $this->parser->parse('minhaconta/default/footer', $data['footer']);

    }


    /**
     * Método abre a página que mostra todas as compras do usuário
     *
     * @param  NULL
     * @return VOID
     * @access PUBLIC
     **/
    public function compras() {

        //Inicializa o array que conterá todos os dados
        $data  =  array();

        //Instancia a classe de usuários
        $this->Usuarios              =   new objects\Usuarios();

        //Seta o ID do usuário na classe Usuários
        $this->Usuarios->idUsuario   =   $this->Login->getIdUser();

        //Declara os arquivos JS que serão usados na página
        $js              =  array( 0, 1, 2, 3, 4, 5, 6, 9, 10, 11, 12, 22, 24  );

        //Declara os arquivos CSS que serão usados na página
        $css             =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body
        $data['body']    =  array();

        //Define data info to footer
        $data['footer']  =  array();
        
        $data['header']['url']   =   base_url();

        $data['header']['css']   =   $this->Header->getCss( $css );

        $data['header']['js']    =   $this->Header->getJs( $js );

        $data['header']['catss']        =   $this->Menus->getCategorias();

        $data['header']['inc']   =   $this->Header->getIncludes( array( 1 ) );

        $data['body']            =   $this->Usuarios->getAllDataUser();

        $data['body']["url"]     =   base_url();        

        $data['footer']["url"]   =   base_url();

        $data['footer']['js']    =   $this->Header->getJs( array( 7, 18, 21, 23, 17 ) );

        $this->parser->parse("minhaconta/default/header", $data['header']);

        $this->parser->parse('minhaconta/compras/compras', $data['body']);

        $this->parser->parse('minhaconta/default/footer', $data['footer']);

    }


    /**
     * Método abre a página que mostra os enderecos do cliente
     *
     * @param  NULL
     * @return VOID
     * @access PUBLIC
     **/
    public function meusenderecos() {

        //Inicializa o array que conterá todos os dados
        $data  =  array();

        //Instancia a classe de usuários
        $this->Usuarios              =   new objects\Usuarios();

        //Seta o ID do usuário na classe Usuários
        $this->Usuarios->idUsuario   =   $this->Login->getIdUser();

        //Declara os arquivos JS que serão usados na página
        $js              =  array( 0, 1, 2, 3, 4, 5, 6, 9, 10, 11, 12, 22, 24 );

        //Declara os arquivos CSS que serão usados na página
        $css             =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body
        $data['body']    =  array();

        //Define data info to footer
        $data['footer']  =  array();
        
        $data['header']['url']     =   base_url();

        $data['header']['css']     =   $this->Header->getCss( $css );

        $data['header']['catss']        =   $this->Menus->getCategorias();

        $data['header']['js']      =   $this->Header->getJs( $js );

        $data['header']['inc']     =   $this->Header->getIncludes( array( 1, 8 ) );

        $data['body']["endereco"]  =   $this->Usuarios->getAllEndereco();

        $data['body']["url"]       =   base_url();        

        $data['footer']["url"]     =   base_url();

        $data['footer']['js']      =   $this->Header->getJs( array( 7, 18, 21, 23, 17 ) );

        $this->parser->parse("minhaconta/default/header", $data['header']);

        $this->parser->parse('minhaconta/meusdados/enderecos', $data['body']);

        $this->parser->parse('minhaconta/default/footer', $data['footer']);

    }


    /**
     * Método abre a página que lista os detalhes da venda do usuário
     *
     * @param  INT $ref   -   Referência da compra
     * @return VOID
     * @access PUBLIC
     **/
    public function detalhes_compra( $ref = '' ) {

        $data  =  array();

        $js    =  array( 0, 1, 2, 3, 4, 5, 6, 9, 10, 11, 12, 22, 24  );

        $css   =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body
        $data['body']    =  array();

        //Define data info to footer
        $data['footer']  =  array();
        
        $data['header']['url']       =  base_url();

        $data['header']['css']       =  $this->Header->getCss( $css );

        $data['header']['catss']        =   $this->Menus->getCategorias();

        $data['header']['js']        =  $this->Header->getJs( $js );

        $data['header']['inc']       =  $this->Header->getIncludes( array( 1 ) );

        $data['body']["url"]         =  base_url();

        $data['body']["referencia"]  =  $ref;

        $data['footer']["url"]       =  base_url();

        $data['footer']['js']        =  $this->Header->getJs( array( 7, 18, 21, 23 ) );

        $this->parser->parse("minhaconta/default/header", $data['header']);

        $this->parser->parse('minhaconta/compras/detalhes_compra', $data['body']);

        $this->parser->parse('minhaconta/default/footer', $data['footer']);

    }

}






