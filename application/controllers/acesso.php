<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("America/New_York");

class Acesso extends CI_Controller{

    private $Header      =  null;

    private $Produtos    =  null;

    private $Categorias  =  null;

    private $Menus       =  null;

    private $Login       =  null;

    private $Usuarios    =  null;

    private $xmlParser   =  null;

    private $email       = null;


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

        $this->Usuarios   =   new objects\Usuarios;
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

        $email = $this->input->post( 'email' );

        if(!$this->Usuarios->emailExists($email)) {
            redirect('http://www.grupobasso.com.br/minha/conta/cadastrar');
        }

        //Define data info to header
        $data['header']  =  array();

        //Define data info to body
        $data['body']    =  array();

        //Define data info to footer
        $data['footer']  =  array();

        $data['header']['url']  =   base_url();

        $data['header']['pesq']  =   "";

        $data['header']['catss']  =   array();

        $data['header']['css']  =   $this->Header->getCss( $css );

        $data['header']['js']   =   $this->Header->getJs( $js );

        $data['header']['inc']  =   $this->Header->getIncludes( array( 1 ) );

        $data['header']['page'] =   'login';

        $data['header']['mostrar_categorias'] = false;

        $data['header']['logado']         =   $this->Login->checkLogin() ? true :  false;

        $data['body']["url"]    =   base_url();

        $data['body']["email"] = $email;

        $data['footer']["url"]  =   base_url();

        $data['footer']['js']   =   $this->Header->getJs( array( 7, 18, 21, 17 ) );

        $this->parser->parse("default/header", $data['header']);

        $this->parser->parse('login', $data['body']);

        $this->parser->parse('default/footer', $data['footer']);

    }

}
