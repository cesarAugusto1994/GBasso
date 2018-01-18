<?php 

namespace objects;

use objects\Banners;

use db;

if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

date_default_timezone_set('America/Sao_Paulo');

class Banners extends db\Querys  {

    public $idLocal   =  null;

    public $idBanner  =  null;

    public function __contruct() { }


    /**
    * Método grava ou atualiza um título de lista
    * @param  INT    $idLocal    -  ID do local do banner
    * @param  STRING $descricao  -  Descrição do banner
    * @param  STRING $imagem     -  local da imagem
    * @param  STRING $link       -  Link para uma detemrinada página
    * @param  INT    $ordem      -  Ordem do banner
    * @param  INT    $status     -  Status do banner
    * @param  BOOL   $update     -  Condição para atualizar o banner
    * @return VOID
    * @access PUBLIC
    */
    public function gravar( $idLocal, $descricao, $imagem, $link, $ordem, $status, $update = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar   =   array(

            "banloc_id"      =>  $idLocal,

            "ban_descricao"  =>  $descricao,

            "ban_imagem"     =>  $imagem,

            "ban_link"       =>  $link,

            "ban_ordem"      =>  $ordem,

            "ban_status"     =>  $status,

            "ban_cadastro"   =>  date( 'Y-m-d H:i:s' )

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table   =  'banners';

        if( !$update ) {
            
            $this->insert( $gravar );

        }else {

            unset( $gravar['ban_cadastro'] );

            //Seta a condição da lista
            $this->setWhere( "ban_id = '$this->idBanner'" );

            //Atualiza
            $this->update( $gravar );

        }

    }


    /**
    * Método obtem todas as imagens de um banner
    * @param  none
    * @return array
    * @access PUBLIC
    */
    public function getImagens() {

        $this->reset();

        $this->table  =  'banners';

        $this->setField( 'ban_id, ban_imagem, ban_ordem' );

        $this->setWhere( "banloc_id = '$this->idLocal'" );

        $this->setClausula( "ORDER BY ban_ordem" );

        $data     =   $this->get();

        $result   =   array();

        if( count( $data ) > 0 ) {

            $i  = 0;

            foreach ($data as $key ) {

                $result[$i]            =   array();
                
                $result[$i]['value']   =   $key->ban_id;

                $result[$i]['imagem']  =   $key->ban_imagem;

                $result[$i]['ordem']   =   $key->ban_ordem;

                $i++;

            }

        }

        return $result;

    }


    /**
    * Método obtem todos os locais de banners
    * @param  none
    * @return array
    * @access PUBLIC
    */
    public function getBannersLocais() {

        $this->reset();

        $this->table  =  'banner_local';

        $this->setField( 'banloc_id, banloc_descricao' );

        $data     =   $this->get();

        $result   =   array();

        if( count( $data ) > 0 ) {

            $i  = 0;

            foreach ($data as $key ) {

                $result[$i]            =   array();
                
                $result[$i]['value']   =   $key->banloc_id;

                $result[$i]['local']   =   $key->banloc_descricao;

                $i++;

            }

        }

        return $result;

    }


    /**
    * Método obtem todas as imagens de um banner
    * @param  none
    * @return VOID
    * @access PUBLIC
    */
    public function deletarBanners() {

        $this->reset();

        trim( $this->idBanner ) != '' ? $this->setWhere( "ban_id = '$this->idBanner'" ) : null;

        trim( $this->idLocal )  != '' ? $this->setWhere( "banloc_id = '$this->idLocal'" ) : null;

        $this->table  =  'banners';

        $this->delete();

    }


    /**
    * Verifica se um banner existe
    * @param  none
    * @return VOID
    * @access PUBLIC
    */
    public function bannerExists() {

        $this->reset();

        $this->setField( 'ban_id' );

        $this->setWhere( "ban_id = '$this->idBanner'" );

        $this->table  =  'banners';

        return $this->searchRecord();

    }

}







