<?php 

namespace objects;

use objects\Menus;

use db;

if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

date_default_timezone_set('America/Sao_Paulo');

class Menus extends db\Querys  {

    public $idMenu        =  null;

    public $idSubMenu     =  null;

    public $idItem        =  null;

    public function __contruct() { }

    /**
    * Método grava um novo menu em banco de dados
    *
    * @param  STRING  $nome       -  NOme do menu
    * @param  STRING  $link       -  Link do menu
    * @param  STRING  $descricao  -  Descrição do menu
    * @param  INT     $status     -  Flag para determinar se o menu aparece
    * @param  BOOL    $update     -  Condição de update do menus
    *
    * @return VOID
    * @access PUBLIC
    */
    public function gravarMenus( $nome, $link = '', $descricao = '', $ordem = '', $status = '', $update = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar       =   array(

            "men_nome"        =>   $nome,

            "men_link"        =>   $link,
 
            "men_descricao"   =>   $descricao,

            "men_ordem"       =>   $ordem,

            "men_status"      =>   $status,

            "men_cadastro"    =>   date( 'Y-m-d H:i:s' )

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        if( $gravar['men_link'] == '/' )
            $gravar['men_link'] = '';

        $this->table =  'menus';

        if( !$update ) {
            
            $this->insert( $gravar );

        }else {

            unset( $gravar['men_cadastro'] );

            //Seta a condição da lista
            $this->setWhere( "men_id = '$this->idMenu'" );

            //Atualiza
            $this->update( $gravar );

        }

    }


    /**
    * Método grava um novo menu em banco de dados
    *
    * @param  STRING  $nome       -  Nome do sub menu
    * @param  STRING  $link       -  Link do sub menu
    * @param  INT     $status     -  Flag para determinar se o menu aparece
    * @param  BOOL    $update     -  Condição de update do menus
    *
    * @return VOID
    * @access PUBLIC
    */
    public function gravarSubMenus( $nome, $link = '', $ordem = '', $status = '', $update = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar       =   array(
  
            "men_id"             =>   $this->idMenu,

            "submen_nome"        =>   $nome,

            "submen_link"        =>   $link,

            "submen_ordem"       =>   $ordem,

            "submen_status"      =>   $status,

            "submen_cadastro"    =>   date( 'Y-m-d H:i:s' )

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table =  'submenus';

        if( !$update ) {
            
            $this->insert( $gravar );

        }else {

            unset( $gravar['submen_cadastro'] );

            //Seta a condição da lista
            $this->setWhere( "submen_id = '$this->idSubMenu'" );

            //Atualiza
            $this->update( $gravar );

        }

    }


    /**
    * Método grava um novo item de menu
    *
    * @param  STRING  $nome       -  Nome do sub menu
    * @param  STRING  $link       -  Link do sub menu
    * @param  INT     $status     -  Flag para determinar se o menu aparece
    * @param  BOOL    $update     -  Condição de update do menus
    *
    * @return VOID
    * @access PUBLIC
    */
    public function gravarItemMenus( $nome, $link = '', $ordem = '', $status = '', $update = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar       =   array(
  
            "submen_id"          =>   $this->idSubMenu,

            "itmsubmen_nome"        =>   $nome,

            "itmsubmen_link"        =>   $link,

            "itmsubmen_ordem"       =>   $ordem,

            "itmsubmen_status"      =>   $status,

            "itmsubmen_cadastro"    =>   date( 'Y-m-d H:i:s' )

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table =  'submenus_item';

        if( !$update ) {
            
            $this->insert( $gravar );

        }else {

            unset( $gravar['itmsubmen_cadastro'] );

            //Seta a condição da lista
            $this->setWhere( "itmsubmen_id = '$this->idItem'" );

            //Atualiza
            $this->update( $gravar );

        }

    }


    /**
    * Método obtem todos os menus do banco de dados
    *
    * @param  BOOL  $active  -  Condição de busca somente dos menus ativos
    * @param  BOOL  $byMenu  -  Condição de busca por ID de menu
    * @return VOID
    * @access PUBLIC
    */
    public function getMenus( $active = false, $byMenu = false ) {

        //Reset all attr of Querys class
        $this->reset();

        $this->setField( 'men_id, men_nome, men_link, men_descricao, men_ordem, men_status' );

        $byMenu ? $this->setWhere( "men_id = '$this->idMenu'" ) : null;

        $active ? $this->setWhere( "men_status = '1'" ) : null;

        $this->setClausula( 'ORDER BY men_id DESC' );

        $this->table  =  'menus';

        $data         =  array();

        $result       =  array();

        $data         =  $this->get();

        if( count( $data ) > 0 ) {

            $i  = 0;

            foreach ($data as $key ) {

                $result[$i][ 'value' ]   =  $key->men_id;

                $result[$i][ 'name' ]    =  $key->men_nome;

                $result[$i][ 'link' ]    =  $key->men_link;

                $result[$i][ 'desc' ]    =  $key->men_descricao;

                $result[$i][ 'ordem' ]   =  $key->men_ordem;

                $result[$i][ 'status' ]  =  $key->men_status == 1 ? 'Ativo' : 'Inativo';

                $i++;

            }

        }

        return $result;

    }


    /**
    * Método obtem todos os menus do banco de dados
    *
    * @param  BOOL  $active  -  Condição de busca somente dos menus ativos
    * @param  BOOL  $byMenu  -  Condição de busca por ID de menu
    * @return VOID
    * @access PUBLIC
    */
    public function getMenusToHome() {

        //Reset all attr of Querys class
        $this->reset();

        $this->setField( 'men_id, men_nome, men_link, men_descricao, men_ordem, men_status' );

        $this->setWhere( "men_status = '1'" );

        $this->setClausula( 'ORDER BY men_ordem' );

        $this->table  =  'menus';

        $data         =  array();

        $result       =  array();

        $data         =  $this->get();

        if( count( $data ) > 0 ) {

            $i  = 0;

            foreach ($data as $key ) {

                $this->idMenu              =  $key->men_id;

                $result[$i][ 'value' ]     =  $this->idMenu;

                $result[$i][ 'name' ]      =  $key->men_nome;

                $result[$i][ 'link' ]      =  $key->men_link;

                $result[$i][ 'subMenus' ]  =  $this->getSubMenus( true, true );

                $i++;

            }

        }

        return $result;

    }


    /**
    * Método obtem todos os submenus do banco de dados
    *
    * @param  BOOL  $active  -  Condição de busca somente dos menus ativos
    * @param  BOOL  $getItem -  Condição de busca dos itens de sub menu
    * @return VOID
    * @access PUBLIC
    */
    public function getSubMenus( $active = false, $getItem = false ) {

        //Reset all attr of Querys class
        $this->reset();

        $this->setField( 'submen_id, submen_nome, submen_link, submen_ordem, submen_status, men_nome' );

        $this->setJoin( 'INNER JOIN menus AS MEN ON MEN.men_id = SUBMEN.men_id' );

        is_numeric( $this->idSubMenu ) ? $this->setWhere( "submen_id = '$this->idSubMenu'" ) : null;

        is_numeric( $this->idMenu ) ? $this->setWhere( "MEN.men_id = '$this->idMenu'" ) : null;

        if( $active ) {

            $this->setWhere( "submen_status = '1'" );

            $this->setClausula( 'ORDER BY submen_ordem DESC' );

        }else {

            $this->setClausula( 'ORDER BY submen_id DESC' );

        }        

        $this->table  =  'submenus AS SUBMEN';

        $data         =  array();

        $result       =  array();

        $data         =  $this->get();

        if( count( $data ) > 0 ) {

            $i  = 0;

            foreach ($data as $key ) {

                $result[$i][ 'value' ]   =  $key->submen_id;

                $result[$i][ 'name' ]    =  $key->submen_nome;

                $result[$i][ 'link' ]    =  $key->submen_link;

                if( !$getItem ) {

                    $result[$i][ 'menu' ]    =  $key->men_nome;

                    $result[$i][ 'ordem' ]   =  $key->submen_ordem;

                    $result[$i][ 'status' ]  =  $key->submen_status == 1 ? 'Ativo' : 'Inativo';

                }else {

                    $this->idSubMenu       =   $key->submen_id;

                    $result[$i][ 'item' ]  =   $this->getItemMenus( true );

                }

                $this->idSubMenu  =  '';

                $i++;

            }

        }

        return $result;

    }


    /**
    * Método obtem todos os itens de menu do banco de dados
    *
    * @param  BOOL  $active  -  Condição de busca somente dos menus ativos
    * @return VOID
    * @access PUBLIC
    */
    public function getItemMenus( $active = false ) {

        //Reset all attr of Querys class
        $this->reset();

        $this->setField( 'itmsubmen_id, itmsubmen_nome, itmsubmen_link, itmsubmen_ordem, itmsubmen_status, submen_nome' );

        $this->setJoin( 'INNER JOIN submenus AS SUBMEN ON SUBMEN.submen_id = ITMMEN.submen_id' );

        is_numeric( $this->idItem ) ? $this->setWhere( "itmsubmen_id = '$this->idItem'" ) : null;

        is_numeric( $this->idSubMenu ) ? $this->setWhere( "SUBMEN.submen_id = '$this->idSubMenu'" ) : null;

        if( $active ) {

            $this->setWhere( "itmsubmen_status = '1'" );

            $this->setClausula( 'ORDER BY itmsubmen_ordem' );

        }else {

            $this->setClausula( 'ORDER BY itmsubmen_id DESC' );

        }

        $this->table  =  'submenus_item AS ITMMEN';

        $data         =  array();

        $result       =  array();

        $data         =  $this->get();

        if( count( $data ) > 0 ) {

            $i  = 0;

            foreach ($data as $key ) {

                $result[$i][ 'value' ]   =  $key->itmsubmen_id;

                $result[$i][ 'name' ]    =  $key->itmsubmen_nome;

                $result[$i][ 'link' ]    =  $key->itmsubmen_link;

                $result[$i][ 'submenu' ] =  $key->submen_nome;

                $result[$i][ 'ordem' ]   =  $key->itmsubmen_ordem;

                $result[$i][ 'status' ]  =  $key->itmsubmen_status == 1 ? 'Ativo' : 'Inativo';

                $i++;

            }

        }

        return $result;

    }


    /**
    * Método deleta menus
    *
    * @param  none
    * @return array json
    * @access PUBLIC
    */
    public function deletarMenus() {

        $this->reset();

        $this->setWhere( "men_id = '$this->idMenu'" );

        $this->table   =   'menus';

        $this->delete();

    }


    /**
    * Método deleta menus
    *
    * @param  none
    * @return array json
    * @access PUBLIC
    */
    public function deletarSubMenus() {

        $this->reset();

        $this->setWhere( "submen_id = '$this->idSubMenu'" );

        $this->table   =   'submenus';

        $this->delete();

    }


    /**
    * Método deleta item de menus
    *
    * @param  none
    * @return array json
    * @access PUBLIC
    */
    public function deletarItemMenus() {

        $this->reset();

        $this->setWhere( "itmsubmen_id = '$this->idItem'" );

        $this->table   =   'submenus_item';

        $this->delete();

    }


    public function getCategorias(){
        $this->reset();

        $this->setField( 'cat_id, cat_nome' );

        $this->table = 'categorias';
        
        $data  =  $this->get();

        $response  = array();

        if( count( $data ) > 0 ) {
            $i = 0;
            foreach( $data as $key ) {
                $response[$i]['value']  =   $key->cat_id;
                $response[$i]['name']   =   $key->cat_nome;
                $i++;
            }
        }

        return $response;

    }

}







