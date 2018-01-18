<?php 

namespace objects;

use objects\Categorias;

use db;

if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

date_default_timezone_set('America/Sao_Paulo');

class Categorias extends db\Querys  {

    public $idCategoria     =  null;

    public $idSubCategoria  =  null;

    public function __contruct() {



    }
 

    /**
    * Método grava uma nova categoria em banco de dados
    *
    * @param  STRING  $nome       -  Nome da categoria a ser cadastrada
    * @param  STRING  $descricao  -  Descrição da categoria
    * @param  INT     $home       -  Flag para determinar se a categoria aparece na pagina inicial
    * @param  INT     $status     -  Status da categoria
    *
    * @return VOID
    * @access PUBLIC
    */
    public function gravarCategoria( $update = false, $nome, $descricao, $home, $status ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar       =   array(

            "cat_nome"        =>   $nome,

            "cat_descricao"   =>   $descricao,
 
            "cat_home"        =>   $home,

            "cat_status"      =>   $status,

            "cat_cadastro"    =>   date( 'Y-m-d H:i:s' ),

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table =  'categorias';

        if( !$update ) {
            
            $this->insert( $gravar );

        }else {

            unset( $gravar['cat_cadastro'] );

            //Seta a condição da lista
            $this->setWhere( "cat_id = '$this->idCategoria'" );

            //Atualiza
            $this->update( $gravar );

        }

    }



    /**
    * Método grava uma nova categoria em banco de dados
    *
    * @param  STRING  $nome  -  Nome da do item a ser cadastrado
    * @param  INT     $home  -  Flag para determinar se o item aparece na pagina inicial
    *
    * @return VOID
    * @access PUBLIC
    */
    public function gravarItemCategoria( $update = false, $idItmSubCat, $nome, $home ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar       =   array(

            "subcat_id"             =>   $this->idSubCategoria,

            "itmsubcat_nome"        =>   $nome,

            "itmsubcat_home"        =>   $home,

            "itmsubcat_cadastro"    =>   date( 'Y-m-d H:i:s' ),

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table =  'item_sub_categorias';

        if( !$update ) {
            
            $this->insert( $gravar );

        }else {

            unset( $gravar['itmsubcat_cadastro'] );

            //Seta a condição da lista
            $this->setWhere( "itmsubcat_id = '$idItmSubCat'" );

            //Atualiza
            $this->update( $gravar );

        }

    }


    /**
    * Método grava uma nova sub categoria em banco de dados
    *
    * @param  STRING  $nome       -  Nome da sub categoria a ser cadastrada
    * @param  INT     $home       -  Flag para determinar se a sub categoria aparece na pagina inicial
    * @param  INT     $status     -  Status da categorias
    *
    * @return VOID
    * @access PUBLIC
    */
    public function gravarSubCategoria( $update = false, $nome, $home, $ordem ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar       =   array(

            "cat_id"           =>   $this->idCategoria,

            "subcat_nome"      =>   $nome,

            "subcat_home"      =>   $home,

            "subcat_ordem"     =>   $ordem,

            "subcat_cadastro"  =>   date( 'Y-m-d H:i:s' )

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table =  'sub_categorias';

        if( !$update ) {
            
            $this->insert( $gravar );

        }else {

            //Seta a condição 2 
            $this->setWhere( "subcat_id = '$this->idSubCategoria'" );

            //Atualiza
            $this->update( $gravar );

        }

    }



    /**
    * Método obtem todos as categorias do sistema para que sejam adicionadas num select
    *
    * @param  none
    * @return array json
    * @access PUBLIC
    */
    public function getTagsCategorias( $byTag = false, $id = '' ) {

        $this->reset();

        $this->setField( 'itmsubcat_id, CAT.cat_id, cat_nome, SUBCAT.subcat_id, subcat_nome, itmsubcat_nome, itmsubcat_home' );

        $this->setJoin( "INNER JOIN sub_categorias AS SUBCAT ON SUBCAT.subcat_id = ITMSUB.subcat_id" );

        $this->setJoin( "INNER JOIN categorias AS CAT ON CAT.cat_id = SUBCAT.cat_id" );

        ( $byTag ) ? $this->setWhere( "itmsubcat_id = '$id'" ) : null;

        $this->table  =   'item_sub_categorias AS ITMSUB';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ( $data as $cat ) {
                    
                $result[$i]['value']     =   $cat->itmsubcat_id;

                $result[$i]['cat']       =   $cat->cat_nome;

                $result[$i]['idCat']     =   $cat->cat_id;

                $result[$i]['subcat']    =   $cat->subcat_nome;

                $result[$i]['idSubcat']  =   $cat->subcat_id;

                $result[$i]['nome']      =   $cat->itmsubcat_nome;

                $result[$i]['home']      =   $cat->itmsubcat_home;

                $i++;

            }

        }

        return $result;

    }



    /**
    * 
    *
    * @param  none
    * @return array json
    * @access PUBLIC
    */
    public function getConfigMenuCategoria() {

        $this->reset();

        $this->setField( 'SUBCAT.subcat_id, subcat_nome, subcat_ordem' );

        $this->setJoin( "INNER JOIN sub_categorias AS SUBCAT ON SUBCAT.subcat_id = ITMSUB.subcat_id" );

        $this->setJoin( "INNER JOIN categorias AS CAT ON CAT.cat_id = SUBCAT.cat_id" );

        $this->setWhere( "CAT.cat_id = '$this->idCategoria'" );

        $this->setWhere( 'cat_home = 1' );

        $this->setWhere( 'cat_status = 1' );

        $this->setWhere( 'subcat_home = 1' );        

        $this->setWhere( 'itmsubcat_home = 1' );

        $this->table  =   'item_sub_categorias AS ITMSUB';

        $data         =   $this->get();

        //echo $this->query; exit;

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ( $data as $cat ) {
                    
                $result[$i]['value']   =   $cat->subcat_id;

                $result[$i]['subcat']  =   $cat->subcat_nome;

                $result[$i]['ordem']   =   $cat->subcat_ordem;

                $i++;

            }

        }

        return $result;

    }




    /**
    * Método obtem todos as categorias do sistema para que sejam adicionadas num select
    *
    * @param  none
    * @return array json
    * @access PUBLIC
    */
    public function getCategoriasSelect() {

        $this->setField( 'cat_id, cat_nome' );

        $this->table  =   'categorias';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ( $data as $cat ) {
                    
                $result[$i]['value']   =   $cat->cat_id;

                $result[$i]['text']    =   $cat->cat_nome;

                $i++;

            }

        }

        return $result;

    }


    /**
    * Método obtem todos as categorias para serem adicionadas na home page
    *
    * @param  none
    * @return array json
    * @access PUBLIC
    */
    public function getCategoriasToHome() {

        $this->setField( 'cat_id, cat_nome, cat_descricao' );

        $this->table  =   'categorias';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ( $data as $cat ) {

                $this->idCategoria     =   $cat->cat_id;

                $result[$i]['value']   =   $cat->cat_id;

                $result[$i]['text']    =   $cat->cat_nome;

                $result[$i]['desc']    =   $cat->cat_descricao;

                $result[$i]['subcat']  =   $this->getSubCategoriaToHome();

                $i++;

            }

        }

        $this->reset();

        return $result;

    }



    public function getSubCategoriaToHome() {

        $this->reset();

        $this->setField( 'SUBCAT.subcat_id, subcat_nome' );

        $this->setJoin( "INNER JOIN item_sub_categorias AS ITMCAT ON ITMCAT.subcat_id = SUBCAT.subcat_id" );

        $this->setJoin( "INNER JOIN categorias AS CAT ON CAT.cat_id = SUBCAT.cat_id" );

        $this->setWhere( "CAT.cat_id = '$this->idCategoria'" );

        $this->setWhere( 'cat_home = 1' );

        $this->setWhere( 'cat_status = 1' );

        $this->setWhere( 'subcat_home = 1' );        

        $this->setWhere( 'itmsubcat_home = 1' );

        $this->setWhere( 'subcat_home = 1' );

        $this->setClausula( 'GROUP BY SUBCAT.subcat_id' );

        $this->table  =   'sub_categorias AS SUBCAT';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ( $data as $cat ) {

                $this->idSubCategoria     =   $cat->subcat_id;

                $result[$i]['value']      =   $cat->subcat_id;

                $result[$i]['nome']       =   $cat->subcat_nome;

                $result[$i]['tags']       =   $this->getTagsToHome();

                $i++;

            }

        }

        return $result;

    }


    public function getTagsToHome() {

        $this->reset();

        $this->setField( 'ITMCAT.itmsubcat_id, itmsubcat_nome' );

        $this->setJoin( "INNER JOIN sub_categorias AS SUBCAT ON SUBCAT.subcat_id = ITMCAT.subcat_id" );

        $this->setWhere( "SUBCAT.subcat_id = '$this->idSubCategoria'" );

        $this->setWhere( 'itmsubcat_home = 1' );

        $this->setClausula( 'GROUP BY ITMCAT.itmsubcat_id' );

        $this->setClausula( 'ORDER BY itmsubcat_nome' );

        $this->table  =   'item_sub_categorias AS ITMCAT';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ( $data as $cat ) {

                $result[$i]['value']  =   $cat->itmsubcat_id;

                $result[$i]['nome']   =   $cat->itmsubcat_nome;

                $i++;

            }

        }

        return $result;

    }


    /**
    * Método obtem todos as categorias do sistema para que sejam exibidas numa tabela
    *
    * @param  none
    * @return array json
    * @access PUBLIC
    */
    public function getCategorias( $byCat = false ) {

        $this->setField( 'cat_id, cat_nome, cat_descricao, cat_home, cat_status' );

        $this->setClausula( 'ORDER BY cat_id DESC' );

        if( $byCat ) {

            $this->setWhere( "cat_id = '$this->idCategoria'" );

        }

        $this->table  =   'categorias';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ( $data as $cat ) {

                $result[$i]['value']      =   $cat->cat_id;

                $result[$i]['nome']       =   $cat->cat_nome;

                $result[$i]['descricao']  =   $cat->cat_descricao;

                $result[$i]['home']       =   $cat->cat_home == 1 ? 'Exibido' : 'Não exibido';

                $result[$i]['status']     =   $cat->cat_status == 1 ? 'Ativo' : 'Inativo';

                $result[$i]['fHome']      =   $cat->cat_home;

                $result[$i]['fStatus']    =   $cat->cat_status;

                $i++;

            }

        }

        $this->reset();

        return $result;

    }


    /**
    * Método deleta categorias
    *
    * @param  none
    * @return array json
    * @access PUBLIC
    */
    public function deletarCategorias() {

        $this->reset();

        $this->setWhere( "cat_id = '$this->idCategoria'" );

        $this->table   =   'categorias';

        $this->delete();

    }


    /**
    * Método deleta categorias
    *
    * @param  none
    * @return array json
    * @access PUBLIC
    */
    public function deletarTagsCategorias( $idtag ) {

        $this->reset();

        $this->setWhere( "itmsubcat_id = '$idtag'" );

        $this->table   =   'item_sub_categorias';

        $this->delete();

    }



    /**
    * Método obtem todos as categorias do sistema para que sejam exibidas numa tabela
    *
    * @param  none
    * @return array json
    * @access PUBLIC
    */
    public function getSubCategorias( $bySubCat = false ) {

        $this->reset();

        $this->setField( 'subcat_id, SUBCAT.cat_id, cat_nome, subcat_nome, subcat_home' );

        $this->setJoin( 'INNER JOIN categorias AS CAT ON CAT.cat_id = SUBCAT.cat_id' );

        $this->setClausula( 'ORDER BY subcat_id DESC' );

        $this->table  =   'sub_categorias AS SUBCAT';

        if( $bySubCat ) $this->setWhere( "subcat_id = '$this->idSubCategoria'" );

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ( $data as $cat ) {

                $result[$i]['value']   =   $cat->subcat_id;

                $result[$i]['vCat']    =   $cat->cat_id;

                $result[$i]['cat']     =   $cat->cat_nome;

                $result[$i]['nome']    =   $cat->subcat_nome;

                $result[$i]['home']    =   $cat->subcat_home;

                $i++;

            }

        }

        return $result;

    }


    /**
    * Método deleta Sub Categorias
    *
    * @param  none
    * @return array json
    * @access PUBLIC
    */
    public function deletarSubCategorias() {

        $this->reset();

        $this->setWhere( "subcat_id = '$this->idSubCategoria'" );

        $this->table   =   'sub_categorias';

        $this->delete();

    }


    /**
    * Método verifica se uma categoria existe
    *
    * @param  none
    * @return string
    * @access PUBLIC
    */
    public function tagCategoriaExists( $idTag ) {

        $this->reset();

        $this->setField( 'itmsubcat_id' );

        $this->setWhere( "itmsubcat_id = '$idTag'" );

        $this->table  =   'item_sub_categorias';

        return $this->searchRecord();

    }


    /**
    * Método verifica se uma categoria existe
    *
    * @param  none
    * @return string
    * @access PUBLIC
    */
    public function categoriaExists() {

        $this->reset();

        $this->setField( 'cat_id' );

        $this->setWhere( "cat_id = '$this->idCategoria'" );

        $this->table  =   'categorias';

        return $this->searchRecord();

    }


    /**
    * Método verifica se uma Sub Categoria existe
    *
    * @param  none
    * @return string
    * @access PUBLIC
    */
    public function subCategoriaExists( $byCat = false ) {

        $this->reset();

        $this->setField( 'cat_id' );

        $this->setWhere( "subcat_id = '$this->idSubCategoria'" );

        ( $byCat ) ? $this->setWhere( "cat_id = '$this->idCategoria'" ) : null;

        $this->table  =   'sub_categorias';

        return $this->searchRecord();

    }


    /**
    * Método gera broadcrumb usando categorias
    *
    * @param  none
    * @return string
    * @access PUBLIC
    */
    public function getBroadCrumbs( $uri ) {

        $this->reset();

        $result   =   array();

        $url      =   '';

        $i        =   0;

        foreach ($uri as $key => $value ) {
                
            $this->reset();

            if( $i == 0 ) {

                $this->table   =  'categorias';

                $this->setField( 'cat_id' );

                $this->setWhere( "cat_nome = '$value'" );

            }else if( $i == 1 ) {

                $this->table   =  'sub_categorias';

                $this->setField( 'subcat_id' );

                $this->setWhere( "subcat_nome = '$value'" );

            }

            $id    =   $this->getRecord();

            if( is_numeric( $id ) ) { 

                $url          .=   '/' . $value;

                $result[ $i ]['link']  =   base_url() . $url . '/' . $id;

                $result[ $i ]['name']  =   ucwords( mb_strtolower( $value, 'UTF-8' ) );

                $i++;

            }

        }

        return $result;

    }

}







