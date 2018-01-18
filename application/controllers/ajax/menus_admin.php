<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus_admin extends CI_Controller {

    private $Header     =  null;

    private $Essential  =  null;

    private $Login      =  null;

    private $Menus      =  null;

    private $Files      =  null;

    private $General    =  null;
    
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

        //Login expirou por algum motivo, um código de erro difernete será enviado e a popup de login será chamada
        if( !$this->Login->checkSessionAdmin() ) $this->Essential->setMessage( 'Faça login novamente', 103 );

    }



    /**
    * Método grava menus em banco de dados
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function cadastrarMenu() {

        $this->Menus   =     new objects\Menus;

        //Recebe os dados via POST
        $nome     =    $this->Essential->sqlInjection( $this->input->post( 'nome' ) );

        $link     =    $this->Essential->sqlInjection( $this->input->post( 'link' ) );

        $desc     =    $this->Essential->sqlInjection( $this->input->post( 'descricao' ) );

        $ordem    =    $this->Essential->sqlInjection( $this->input->post( 'ordem' ) );

        $status   =    $this->Essential->sqlInjection( $this->input->post( 'status' ) );

        $idMenu   =    $this->input->post( 'idMenu' );

        $update   =    false;

        if( trim( $idMenu ) != '' ) {

            if( !is_numeric( $idMenu ) ) $this->Essential->setMessage( 'ID do menu inválido', 102 );

            $this->Menus->idMenu  =  $idMenu;

            $update  =  true;

        }

        //Valida o nome do menu
        $this->Essential->verify( $nome, 'Digite o nome do menu', 'empty' );

        !$this->Essential->onlyNumber( $ordem ) ? $this->Essential->setMessage( 'Ordem deve ser um número inteiro', 102 ) : null;

        $ordem < 0 ? $this->Essential->setMessage( 'Ordem deve ser maior que 0', 102 ) : null;

        !$this->Essential->onlyNumber( $status ) ? $this->Essential->setMessage( 'Status inválido', 102 ) : null;

        $this->Menus->gravarMenus( $nome, $link, $desc, $ordem, $status, $update );

        $this->Essential->setMessage( 'Menu cadastrado com sucesso', 100 );

    }


    /**
    * Método grava sub menus em banco de dados
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function cadastrarSubMenu() {

        $this->Menus   =     new objects\Menus;

        //Recebe os dados via POST

        $idMenu      =    $this->Essential->sqlInjection( $this->input->post( 'menu' ) );

        $nome        =    $this->Essential->sqlInjection( $this->input->post( 'nome' ) );

        $link        =    $this->Essential->sqlInjection( $this->input->post( 'link' ) );        

        $ordem       =    $this->Essential->sqlInjection( $this->input->post( 'ordem' ) );

        $status      =    $this->Essential->sqlInjection( $this->input->post( 'status' ) );

        $idSubMenu   =    $this->input->post( 'idSubMenu' );

        $update      =    false;

        if( trim( $idSubMenu ) != '' ) {

            if( !is_numeric( $idSubMenu ) ) $this->Essential->setMessage( 'ID do sub menu inválido', 102 );

            $this->Menus->idSubMenu  =  $idSubMenu;

            $update  =  true;

        }

        //Valida o nome do menu

        !$this->Essential->onlyNumber( $idMenu ) ? $this->Essential->setMessage( 'Selecione um menu válido', 102 ) : null;

        $this->Essential->verify( $nome, 'Digite o nome do menu', 'empty' );

        !$this->Essential->onlyNumber( $ordem ) ? $this->Essential->setMessage( 'Ordem deve ser um número inteiro', 102 ) : null;

        $ordem < 0 ? $this->Essential->setMessage( 'Ordem deve ser maior que 0', 102 ) : null;

        !$this->Essential->onlyNumber( $status ) ? $this->Essential->setMessage( 'Status inválido', 102 ) : null;

        $this->Menus->idMenu  =  $idMenu;

        $this->Menus->gravarSubMenus( $nome, $link, $ordem, $status, $update );

        $this->Essential->setMessage( 'Sub Menu cadastrado com sucesso', 100 );

    }


    /**
    * Método grava sub menus em banco de dados
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function cadastrarItemMenu() {

        $this->Menus   =     new objects\Menus;

        //Recebe os dados via POST

        $idMenu      =    $this->Essential->sqlInjection( $this->input->post( 'submenu' ) );

        $nome        =    $this->Essential->sqlInjection( $this->input->post( 'nome' ) );

        $link        =    $this->Essential->sqlInjection( $this->input->post( 'link' ) );        

        $ordem       =    $this->Essential->sqlInjection( $this->input->post( 'ordem' ) );

        $status      =    $this->Essential->sqlInjection( $this->input->post( 'status' ) );

        $idItem      =    $this->input->post( 'idItemMenu' );

        $update      =    false;

        if( trim( $idItem ) != '' ) {

            if( !is_numeric( $idItem ) ) $this->Essential->setMessage( 'ID do sub menu inválido', 102 );

            $this->Menus->idItem  =  $idItem;

            $update  =  true;

        }

        //Valida o nome do menu

        !$this->Essential->onlyNumber( $idMenu ) ? $this->Essential->setMessage( 'Selecione um sub menu válido', 102 ) : null;

        $this->Essential->verify( $nome, 'Digite o nome do menu', 'empty' );

        !$this->Essential->onlyNumber( $ordem ) ? $this->Essential->setMessage( 'Ordem deve ser um número inteiro', 102 ) : null;

        $ordem < 0 ? $this->Essential->setMessage( 'Ordem deve ser maior que 0', 102 ) : null;

        !$this->Essential->onlyNumber( $status ) ? $this->Essential->setMessage( 'Status inválido', 102 ) : null;

        $this->Menus->idSubMenu  =  $idMenu;

        $this->Menus->gravarItemMenus( $nome, $link, $ordem, $status, $update );

        $this->Essential->setMessage( 'Item de Menu cadastrado com sucesso', 100 );

    }

    /**
    * Método deleta menus
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function deletarMenus() {

        $this->Menus   =   new objects\Menus;

        $qtd                =   $this->Essential->sqlInjection( $this->input->post( 'qtd' ) );

        if( is_numeric( $qtd ) && $qtd > 0 ) {

            $idMenus    =   array();

            for( $i = 0; $i < $qtd; $i++ ) {

                $id   =   $this->input->post( 'id' . $i );

                if( !is_numeric( $id ) ) {

                    $this->Essential->setMessage( 'Menu ' . ( $i + 1 ) . ' inválido', 102 );

                }else {

                    $idMenus[$i]  =  $id;

                }

            }

            for( $i = 0; $i < $qtd; $i++ ) {

                $this->Menus->idMenu  =  $idMenus[$i];

                $this->Menus->deletarMenus();

            }

            $this->Essential->setMessage( 'Menus(s) deletado(s) com sucesso', 100 );

        }else {

            $this->Essential->setMessage( 'Selecione uma ou mais menus', 102 );

        }

    }


    /**
    * Método deleta sub menus
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function deletarSubMenus() {

        $this->Menus   =   new objects\Menus;

        $qtd                =   $this->Essential->sqlInjection( $this->input->post( 'qtd' ) );

        if( is_numeric( $qtd ) && $qtd > 0 ) {

            $idMenus    =   array();

            for( $i = 0; $i < $qtd; $i++ ) {

                $id   =   $this->input->post( 'id' . $i );

                if( !is_numeric( $id ) ) {

                    $this->Essential->setMessage( 'Sub Menu ' . ( $i + 1 ) . ' inválido', 102 );

                }else {

                    $idMenus[$i]  =  $id;

                }

            }

            for( $i = 0; $i < $qtd; $i++ ) {

                $this->Menus->idSubMenu  =  $idMenus[$i];

                $this->Menus->deletarSubMenus();

            }

            $this->Essential->setMessage( 'Sub Menus(s) deletado(s) com sucesso', 100 );

        }else {

            $this->Essential->setMessage( 'Selecione uma ou mais sub menus', 102 );

        }

    }


    /**
    * Método deleta sub menus
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function deletarItemMenus() {

        $this->Menus   =   new objects\Menus;

        $qtd                =   $this->Essential->sqlInjection( $this->input->post( 'qtd' ) );

        if( is_numeric( $qtd ) && $qtd > 0 ) {

            $idMenus    =   array();

            for( $i = 0; $i < $qtd; $i++ ) {

                $id   =   $this->input->post( 'id' . $i );

                if( !is_numeric( $id ) ) {

                    $this->Essential->setMessage( 'Item de  Menu ' . ( $i + 1 ) . ' inválido', 102 );

                }else {

                    $idMenus[$i]  =  $id;

                }

            }

            for( $i = 0; $i < $qtd; $i++ ) {

                $this->Menus->idItem  =  $idMenus[$i];

                $this->Menus->deletarItemMenus();

            }

            $this->Essential->setMessage( 'Itens de Menus(s) deletado(s) com sucesso', 100 );

        }else {

            $this->Essential->setMessage( 'Selecione uma ou mais sub menus', 102 );

        }

    }

}    

















