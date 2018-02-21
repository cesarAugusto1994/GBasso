<?php 

namespace objects;

use objects\Produtos;

use db;

if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

date_default_timezone_set('America/Sao_Paulo');

class Produtos extends db\Querys  {

    public $idProduto  =  null;

    public function __contruct() { }


    /**
     *
     * @param  none
     * @return array json
     * @access PUBLIC
     */
    public function gravarLocal( $empresa, $endereco, $idLocal = '', $update = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar   =   array(

            "loc_empresa"   =>   $empresa,

            "loc_endereco"  =>   $endereco,

            "loc_cadastro"  =>   date( 'Y-m-d H:i:s' )

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table =  'locais';

        if( !$update ) {
            
            $this->insert( $gravar );

        }else {

            unset( $gravar['loc_cadastro'] );

            //Seta a condição da lista
            $this->setWhere( "loc_id = '$idLocal'" );

            //Atualiza
            $this->update( $gravar );

        }


    }


    /**
     * Método obtem toda a lista de opções do banco de dado
     *
     * @param  none
     * @return array json
     * @access PUBLIC
     */
    public function getListaTipos() {

        $this->reset();

    	$this->setField( 'tpopc_id, tpopc_nome' );

    	$this->table  =   'tipos_opcoes';

    	$data         =   $this->get();

    	$result       =   array();

    	if( count( $data ) > 0 ) {

    		$i  =  0;

    		foreach ($data as $lista) {
    				
    			$result[$i]['value']   =   $lista->tpopc_id;

    			$result[$i]['text']    =   $lista->tpopc_nome;

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
    public function getCategoriaProdutos() {

        $this->reset();

        $this->setField( 'CAT.cat_id, SUBCAT.subcat_id, cat_nome, subcat_nome' );

        $this->setJoin( 'INNER JOIN sub_categorias AS SUBCAT ON SUBCAT.cat_id = CAT.cat_id' );

        $this->setJoin( 'INNER JOIN produtos AS PROD ON PROD.subcat_id = SUBCAT.subcat_id' );

        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->table  =   'categorias AS CAT';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ($data as $lista) {
                    
                $result[$i]['cat']         =   $lista->cat_id;

                $result[$i]['catName']     =   $lista->cat_nome;

                $result[$i]['subcat']      =   $lista->subcat_id;

                $result[$i]['subCatName']  =   $lista->subcat_nome;

                $i++;

            }

        }

        return $result;

    }


    /**
     * Método obtem todos os títulos de lista do banco de dados
     *
     * @param  $idLista    -  ID da lista em que o titulo será pesquisado
     * @param  $text       -  Nome do titulo da lista
     * @return array json
     * @access PUBLIC
     */
    public function getListaTitulos( $idLista, $text ) {

    	//Seta os campos que desejo retornar
    	$this->setField( 'tpopctit_id, tpopctit_nome' );

    	//Seta a condição de busca pela lista selecionada
    	$this->setWhere( "tpopc_id = '$idLista'" );

    	//Seta a condição de busca pelo titulo 
    	$this->setWhere( "tpopctit_nome LIKE '%$text%'" );

    	//Seta a tabela de busca
    	$this->table  =   'tipos_opcoes_titulo';

    	//Realiza a busca
    	$data         =   $this->get();

    	//Seta o array que será retornado
    	$result       =   array();

    	if( count( $data ) > 0 ) {

    		$i  =  0;

    		foreach ($data as $lista) {
    				
    			$result[$i]['value']   =   $lista->tpopctit_id;

    			$result[$i]['text']    =   $lista->tpopctit_nome;

                $i++;

    		}

    	}

    	return $result;

    }



    /**
     * Método grava ou atualiza um título de lista
     *
     * @param  INT    $idLista    -  ID da lista em que o titulo será pesquisado
     * @param  INT    $idTitulo   -  ID da lista em que o titulo será pesquisado
     * @param  STRING $text       -  Nome do titulo da lista
     * @param  BOOL   $update     -  Condição para atualizar ou não os dados
     * @return array json
     * @access PUBLIC
     */
    public function gravarListaTitulo( $idLista, $idTitulo, $titulo, $update = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar       =   array(

            "tpopc_id"           =>   $idLista,

            "tpopctit_nome"      =>   $titulo,

            "tpopctit_cadastro"  =>   date( 'Y-m-d H:i:s' ),

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table =  'tipos_opcoes_titulo';

        if( !$update ) {
            
            $this->insert( $gravar );

        }else {

            unset( $gravar['tpopc_id'] );

            unset( $gravar['tpopctit_cadastro'] );

            //Seta a condição da lista
            $this->setWhere( "tpopc_id = '$idLista'" );

            //Seta a condição do titulo
            $this->setWhere( "tpopctit_id = '$idTitulo'" );

            //Atualiza
            $this->update( $gravar );

        }


    }



    /**
     * Obtem o ultimo ID da lista de titulos
     *
     * @param  INT $idLista - Id da lista que deseja buscar o ultimo titulo
     * @return array json
     * @access PUBLIC
    */
    public function getLastIDListaTitulos( $idLista ) {

        //Reset all attr of Querys class
        $this->reset();

        $this->setField( 'tpopctit_id' );

        $this->setWhere( "tpopc_id = '$idLista'" );

        $this->setClausula( 'ORDER BY tpopctit_id DESC LIMIT 1' );

        $this->table  =  'tipos_opcoes_titulo';

        return $this->getRecord();

    }



    /**
     * Método obtem todos as tags de lista do banco de dados
     *
     * @param  $idTitulo    -  ID do título
     * @param  $text        -  Nome da tag da lista
     * @return array json
     * @access PUBLIC
     */
    public function getListaTags( $idTitulo, $text ) {

        $this->reset();

        //Seta os campos que desejo retornar
        $this->setField( 'tpopctag_id, tpopctag_nome' );

        //Seta a condição de busca pela lista selecionada
        $this->setWhere( "tpopctit_id = '$idTitulo'" );

        //Seta a condição de busca pelo titulo 
        $this->setWhere( "tpopctag_nome LIKE '%$text%'" );

        //Seta a tabela de busca
        $this->table  =   'tipos_opcoes_tags';

        //Realiza a busca
        $data         =   $this->get();

        //Seta o array que será retornado
        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ($data as $lista) {
                    
                $result[$i]['value']   =   $lista->tpopctag_id;

                $result[$i]['text']    =   $lista->tpopctag_nome;

                $i++;

            }

        }

        return $result;

    }


    /**
     * Método grava ou atualiza um título de lista
     *
     * @param  INT    $idTitulo   -  ID do título
     * @param  INT    $idTag      -  ID das tags
     * @param  STRING $tag        -  Nome da tag da lista
     * @param  BOOL   $update     -  Condição para atualizar ou não os dados
     * @return array json
     * @access PUBLIC
     */
    public function gravarListaTag( $idTitulo, $idTag, $tag, $update = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar       =   array(

            "tpopctit_id"        =>   $idTitulo,

            "tpopctag_nome"      =>   $tag,

            "tpopctag_cadastro"  =>   date( 'Y-m-d H:i:s' ),

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table =  'tipos_opcoes_tags';

        if( !$update ) {
            
            $this->insert( $gravar );

        }else {

            unset( $gravar['tpopctit_id'] );

            unset( $gravar['tpopctag_cadastro'] );

            //Seta a condição da lista
            $this->setWhere( "tpopctit_id = '$idTitulo'" );

            //Seta a condição do titulo
            $this->setWhere( "tpopctit_id = '$idTag'" );

            //Atualiza
            $this->update( $gravar );

        }

    }


    /**
     * Obtem o ultimo ID da lista de tags
     *
     * @param  INT $idTitulo - Id do título que deseja buscar a ultima tag
     * @return array json
     * @access PUBLIC
     */
    public function getLastIDListaTags( $idTitulo ) {

        //Reset all attr of Querys class
        $this->reset();

        $this->setField( 'tpopctag_id' );

        $this->setWhere( "tpopctit_id = '$idTitulo'" );

        $this->setClausula( 'ORDER BY tpopctag_id DESC LIMIT 1' );

        $this->table  =  'tipos_opcoes_tags';

        return $this->getRecord();

    }



    /**
     * Obtem todas as categorias cadastradas no sistema
     *
     * @param  none
     * @return array json
     * @access PUBLIC
     */
    public function getCategorias() {

        //Reset all attr of Querys class
        $this->reset();

        $this->setField( 'cat_id, cat_nome' );

        $this->table  =   'categorias';

        $data         =   array();

        //Realiza a busca
        $data         =   $this->get();

        //Seta o array que será retornado
        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ($data as $lista) {
                    
                $result[$i]['value']   =   $lista->cat_id;

                $result[$i]['text']    =   $lista->cat_nome;

                $i++;

            }

        }

        return $result;

    }


    /**
     * Obtem todas as sub categorias cadastradas no sistema
     *
     * @param  INT $idCat   -    ID da categoria
     * @return array json
     * @access PUBLIC
     */
    public function getSubCategorias( $idCat ) {

        //Reset all attr of Querys class
        $this->reset();

        $this->setField( 'subcat_id, subcat_nome' );

        $this->setWhere( "cat_id = '$idCat'" );

        $this->table  =   'sub_categorias';

        $data         =   array();

        //Realiza a busca
        $data         =   $this->get();

        //Seta o array que será retornado
        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ($data as $lista) {
                    
                $result[$i]['value']   =   $lista->subcat_id;

                $result[$i]['text']    =   $lista->subcat_nome;

                $i++;

            }

        }

        return $result;

    }


    /**
     * Obtem todas as unidades de medida do sistema
     *
     * @return array json
     * @access PUBLIC
     */
    public function getUnidadeMedida() {

        //Reset all attr of Querys class
        $this->reset();

        $this->setField( 'undmed_id, undmed_descricao' );

        $this->table  =   'unidades_medida';

        $data         =   array();

        //Realiza a busca
        $data         =   $this->get();

        //Seta o array que será retornado
        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ($data as $lista) {
                    
                $result[$i]['value']   =   $lista->undmed_id;

                $result[$i]['text']    =   $lista->undmed_descricao;

                $i++;

            }

        }

        return $result;

    }


    /**
     * Método grava ou atualiza um título de lista
     * @param  INT    $subCat        -  SUB Categoria do produto
     * @param  INT    $undMed        -  Unidade de medida do produto
     * @param  STRING $nome          -  Nome do produto
     * @param  STRING $codigo        -  Código do produto
     * @param  INT    $valor         -  Valor do produto
     * @param  STRING $descricao     -  Descricao do produto
     * @param  STRING $descCompleta  -  Referencia completa do produto
     * @param  STRING $referencia    -  Referencia do produto
     * @param  INT    $peso          -  Peso do produto
     * @param  INT    $altura        -  Altura do produto
     * @param  INT    $largura       -  Largura do produto
     * @param  INT    $profundidade  -  Profundidade do produto
     * @param  STRING $ean           -  Código de barras
     * @param  INT    $status        -  Status do produto 0 => Inativo, 1 => Ativo
     * @param  INT    $idTitulo      -  ID do título
     * @param  INT    $idTag         -  ID das tags
     * @param  STRING $tag           -  Nome da tag da lista
     * @param  BOOL   $update        -  Condição para atualizar ou não os dados
     * @return array json
     * @access PUBLIC
     */
    public function gravarProdutos( $update = false, $subCat, $undMed, $nome, $codigo, $valor, $descricao, $descCompleta, $referencia, $peso, $altura, $largura, $profundidade, $ean, $status ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar   =   array(

            "subcat_id"            =>  $subCat,

            "undmed_id"            =>  $undMed,

            "prod_nome"            =>  $nome,

            "prod_codigo"          =>  $codigo,

            "prod_valor"           =>  $valor,

            "prod_descricao"       =>  $descricao,

            "prod_descricao_comp"  =>  $descCompleta,

            "prod_referencia"      =>  $referencia,

            "prod_peso"            =>  $peso,

            "prod_altura"          =>  $altura,

            "prod_largura"         =>  $largura,

            "prod_comprimento"     =>  $profundidade,

            "prod_ean"             =>  $ean,

            "prod_status"          =>  $status,

            "prod_cadastro"        =>  date( 'Y-m-d H:i:s' )

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table =  'produtos';

        if( !$update ) {
            
            $this->insert( $gravar );

        }else {

            unset( $gravar['prod_cadastro'] );

            //Seta a condição da lista
            $this->setWhere( "prod_id = '$this->idProduto'" );

            //Atualiza
            $this->update( $gravar );

        }

    }


    /**
     * Método grava ou atualiza o estoque
     * @param  INT    $qtd      -  Quantidade disponível em estoque
     * @param  INT    $qtdMin   -  Quantidade minima em estoque
     * @param  STRING $qtdMax   -  Quantidade máxima em estoque
     * @param  BOOL   $update   -  Condição para atualizar ou não os dados
     * @return VOID
     * @access PUBLIC
     */
    public function gravarEstoque( $qtd, $qtdMin, $qtdMax, $update = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar   =   array(

            "prod_id"     =>  $this->idProduto,

            "est_minimo"  =>  $qtdMin,

            "est_max"     =>  $qtdMax,

            "est_qtd"     =>  $qtd

        );

        //print_r( $gravar ); exit;

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table =  'estoque';

        if( !$update ) {

            $this->insert( $gravar );

        }else {

            unset( $gravar['prod_id'] );

            //Seta a condição da lista
            $this->setWhere( "prod_id = '$this->idProduto'" );

            //Atualiza
            $this->update( $gravar );

        }

    }


    /**
     * Método grava as imagens do produto
     * @param  INT    $idImg      -  ID da imagem
     * @param  INT    $diretorio  -  Diretorio da imagem
     * @param  INT    $status     -  Status da imagem 0 => Inativo, 1 => Ativo
     * @param  BOOL   $update     -  Condição para atualizar ou não os dados
     * @return array json
     * @access PUBLIC
     */
    public function gravarImagemProduto( $idImg, $diretorio, $status, $update = false ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar   =   array(

            "prod_id"             =>  $this->idProduto,

            "imgprod_diretorio"   =>  $diretorio,

            "imgprod_status"      =>  $status,

            "imgprod_cadastro"    =>  date( 'Y-m-d H:i:s' )

        );

        //Agora vamos remover os campos que são vazio
        foreach ($gravar as $key => $value ) {

            if( strlen( trim( $value ) ) == 0 ) {

                unset( $gravar[ $key ] );

            }

        }

        $this->table =  'imagens_produtos';

        if( !$update ) {
            
            $this->insert( $gravar );

        }else {

            unset( $gravar['prod_id'] );

            unset( $gravar['imgprod_cadastro'] );

            //Seta a condição 1
            $this->setWhere( "imgprod_id = '$idImg'" );

            //Seta a condição 2
            $this->setWhere( "prod_id = '$this->idProduto'" );

            //Atualiza
            $this->update( $gravar );

        }

    }



    /**
     * Método retorna o ID do produto cadastrado com base na referencia do mesmo
     *
     * @param  INT $ref  -  Referencia do produto
     * @return array json
     * @access PUBLIC
     */
    public function getIDProduto( $ref ) {

        //Reseta os campos de Querys
        $this->reset();

        //Seta um campo qualquer
        $this->setField( 'prod_id' );

        //Seta a condição de busca
        $this->setWhere( "prod_referencia = '$ref'" );

        //Seta a tabela
        $this->table =  'produtos';

        //realiza a consulta e retorna o ID do produto, caso tenha sido encontrado
        $this->idProduto  =  $this->getRecord();

    }   



    /**
     * Método verifica se a referencia do produto existe no banco de dados
     *
     * @param  INT $ref        -  Referencia do produto
     * @param  INT $byProduto  -  Condição de busca pelo produto
     * @return array json
     * @access PUBLIC
     */
    public function referenciaExist( $ref, $byProduto = false ) {

        $ref   =   mb_strtolower( $ref );

        //Reseta os campos de Querys
        $this->reset();

        //Seta um campo qualquer
        $this->setField( 'prod_id' );

        //Seta a condição de busca
        $this->setWhere( "LOWER( prod_referencia ) = '$ref'" );

        if( $byProduto ) $this->setWhere( "prod_id != '$this->idProduto'" );

        //Seta a tabela
        $this->table =  'produtos';

        //realiza a consulta e retorna os dados
        return $this->searchRecord();

    }   


    /**
     * Método deleta tags de um determinado produto
     * @param  none
     * @return VOID
     * @access PUBLIC
     */
    public function deletarTagsProdutos() {

        //Reset all attr of Querys class
        $this->reset();

        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->table =  'tipos_opcoes_tags_produtos_ass';

        $this->delete();

    }


    /**
     * Método deleta imagens de um produto
     * @param  INT $idImagem   -  ID da imagem que deseja deletar
     * @return VOID
     * @access PUBLIC
     */
    public function deletarImagem( $idImagem ) {

        //Reset all attr of Querys class
        $this->reset();

        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->setWhere( "imgprod_id = '$idImagem'" );

        $this->table =  'imagens_produtos';

        $this->delete();

    }


    /**
     * Método deleta produtos
     * @return VOID
     * @access PUBLIC
     */
    public function deletarProdutos() {

        //Reset all attr of Querys class
        $this->reset();

        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->table =  'produtos';

        $this->delete();

    }


    /**
     * Método grava tags relacionada oa produto
     * @param  INT   $idTag  -  ID da tag
     * @return array json
     * @access PUBLIC
     */
    public function gravarTagsProduto( $idTag ) {

        //Reset all attr of Querys class
        $this->reset();

        //Prepara os campos que serão gravados
        $gravar   =   array(

            "tpopctag_id"          =>  $idTag,

            "prod_id"              =>  $this->idProduto,

            "tagprodass_cadastro"  =>  date( 'Y-m-d H:i:s' )

        );

        $this->table =  'tipos_opcoes_tags_produtos_ass';

        $this->insert( $gravar );

    }


    /**
     * Método obtem toda as imagens de um determinado produto
     *
     * @param  none
     * @return array json
     * @access PUBLIC
     */
    public function getImages() {

        $this->reset();

        $this->setField( 'imgprod_id, imgprod_diretorio, imgprod_default' );

        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->table  =   'imagens_produtos';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ($data as $img) {
                    
                $result[$i]['id']        =   $img->imgprod_id;

                $result[$i]['default']   =   $img->imgprod_default;

                $result[$i]['url']       =   $img->imgprod_diretorio;

                $i++;

            }

        }

        return $result;

    }


    /**
     * Método obtem o nome do produto
     *
     * @param  none
     * @return string
     * @access PUBLIC
     */
    public function getNameProduto() {

        $this->reset();

        $this->setField( 'prod_nome' );

        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->table  =   'produtos';

        return $this->getRecord();

    }


    /**
     * Método verifica se um produto existe
     *
     * @param  none
     * @return string
     * @access PUBLIC
     */
    public function produtoExists() {

        $this->reset();

        $this->setField( 'prod_id' );

        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->table  =   'produtos';

        return $this->searchRecord();

    }


    /**
     * Método obtem a imagem padrão do produto
     *
     * @param  none
     * @return string
     * @access PUBLIC
     */
    public function getImageDefaultDiretory($id = null) {

        $produtctId = !empty($id) ? $id : $this->idProduto;

        $this->reset();

        $this->setField( 'imgprod_diretorio' );

        $this->setWhere( "prod_id = '$produtctId'" );

        $this->setWhere( "imgprod_default = 1" );

        $this->table  =   'imagens_produtos';

        return base_url() . $this->getRecord();

    }


    /**
     * Método verifica se uma determinada imagem existe
     *
     * @param  none
     * @return string
     * @access PUBLIC
     */
    public function imageExists( $idImg ) {

        $this->reset();

        $this->setField( 'imgprod_id' );

        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->setWhere( "imgprod_id = '$idImg'" );

        $this->table  =   'imagens_produtos';

        return $this->searchRecord();

    }


    /**
     * Método seta uma imagem como padrão no sistema
     *
     * @param  INT $idImg  -   ID da imagem padrão do sistema
     * @return string
     * @access PUBLIC
     */
    public function setImageDefault( $idImg ) {

        $this->reset();

        //Atualiza todos com 0 primeiro
        $this->table  =   'imagens_produtos';

        $gravar  =  array( 'imgprod_default' => 0 );

        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->update( $gravar );

        //Agora, atualiza somente 1 das imagens
        $gravar  =  array( 'imgprod_default' => 1 );

        $this->setWhere( "imgprod_id = '$idImg'" );

        $this->update( $gravar );

    }


    /**
     * Método obtem todas as imagens de um produto
     *
     * @param  none
     * @return array
     * @access PUBLIC
     */
    public function getAllImages() {

        $this->reset();

        $this->setField( 'imgprod_diretorio' );

        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->table  =   'imagens_produtos';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ($data as $img) {

                $result[$i]  =   base_url() . $img->imgprod_diretorio;

                $i++;

            }

        }

        return $result;

    }


    /**
     * Método obtem todas as informações necessárias para exibir o produto na página de detalhe no site
     *
     * @param  none
     * @return array
     * @access PUBLIC
     */
    public function getInfoProdutoView() {

        $this->reset();

        $this->setField( 'prod_id, prod_codigo, prod_valor, prod_descricao, prod_descricao_comp, prod_referencia, CAT.cat_id' );

        $this->setJoin( 'INNER JOIN sub_categorias AS SUBCAT ON SUBCAT.subcat_id = PROD.subcat_id' );

        $this->setJoin( 'INNER JOIN categorias AS CAT ON CAT.cat_id = SUBCAT.cat_id' );

        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->table  =   'produtos AS PROD';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) == 1 ) {

            $result['codigo']        =   $data[0]->prod_codigo;

            $result['valor']         =   'R$: ' . number_format( $data[0]->prod_valor, 2, ',', '.' );

            $result['descricao']     =   $data[0]->prod_descricao;

            $result['descComp']      =   $data[0]->prod_descricao_comp;

            $result['referencia']    =   $data[0]->prod_referencia;

            $result['value']         =   $data[0]->prod_id;

            $result['migalhas']      =   $this->getMigalhas();

            $result['relacionados']  =   $this->getProdutosRelacionados( $data[0]->cat_id );

        }

        return $result;

    }


    /**
     * Método obtem as migalhas para um determinado produto
     *
     * @param  none
     * @return array
     * @access PUBLIC
     */
    public function getMigalhas() {

        $data      =   $this->getCategoriaProdutos();

        $migalhas  =   '';

        if( count( $data ) == 1 ) {

            $categoria = $data[0]['catName'];

            $migalhas   =  "<li><a class='breadcump' href='http://www.grupobasso.com.br/pesquisar/resultado/$categoria'>" . $data[0]['catName']    . "</a></li>";

            $subcategoria = $data[0]['subCatName'];
 
            $migalhas  .=  "<li><a class='breadcump' href='http://www.grupobasso.com.br/pesquisar/resultado/Todas%20as%20Categorias/$subcategoria'>" . $data[0]['subCatName'] . "</a></li>";

        }

        return $migalhas;

    }


    /**
     * Método obtem os produtos relacionados a um determinado produto
     *
     * @param  INT $idCat  -   ID da categoria do produto
     * @return array
     * @access PUBLIC
     */
    public function getProdutosRelacionados( $idCat ) {

        $this->reset();

        $this->setField( 'PROD.prod_id, prod_nome, prod_valor' );

        $this->setJoin( 'INNER JOIN sub_categorias AS SUBCAT ON SUBCAT.subcat_id = PROD.subcat_id' );

        $this->setJoin( 'INNER JOIN categorias AS CAT ON CAT.cat_id = SUBCAT.cat_id' );

        $this->setWhere( "CAT.cat_id = $idCat" );

        $this->table  =   'produtos AS PROD';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ($data as $produto) {

                $this->idProduto             =  $produto->prod_id;

                $result[ $i ]['value']       =  $produto->prod_id;

                $result[ $i ]['image']       =  $this->getImageDefaultDiretory();

                $result[ $i ]['nome']        =  $produto->prod_nome;

                $result[ $i ]['valor']       =  'R$ ' . number_format( $produto->prod_valor, 2, ',', '.' );

                $result[ $i ]['link']        =  base_url() . 'produtos/' . $this->idProduto;

                $i++;

            }

        }

        return $result;

    }


    /**
     * Método obtem todas as informações necessárias para exibir o produto na página de detalhe no site
     *
     * @param  none
     * @return array
     * @access PUBLIC
     */
    public function getDestaques() {

        $this->reset();

        $this->setField( 'PROD.prod_id, prod_nome, prod_valor' );

        $this->setJoin( 'INNER JOIN tipos_opcoes_tags_produtos_ass AS TAGS ON TAGS.prod_id = PROD.prod_id' );

        $this->setWhere( "TAGS.tpopctag_id = 1" );

        $this->setClausula( "GROUP BY PROD.prod_id" );

        $this->table  =   'produtos AS PROD';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ($data as $produto) {

                $this->idProduto          =  $produto->prod_id;

                $result[ $i ]['value']    =  $produto->prod_id;

                $result[ $i ]['image']    =  $this->getImageDefaultDiretory();

                $result[ $i ]['nome']     =  $produto->prod_nome;

                $result[ $i ]['valor']    =  number_format( $produto->prod_valor, 2, ',', '.' );

                $result[ $i ]['link']     =  base_url() . 'produtos/' . $this->idProduto;

                $i++;

            }

        }

        return $result;

    }


    /**
     * Método obtem todas as informações necessárias para exibir as ofertas do dia
     *
     * @param  none
     * @return array
     * @access PUBLIC
     */
    public function getOfertasDia() {

        $this->reset();

        $this->setField( 'PROD.prod_id, prod_nome, prod_valor, prod_descricao' );

        $this->setJoin( 'INNER JOIN tipos_opcoes_tags_produtos_ass AS TAGS ON TAGS.prod_id = PROD.prod_id' );

        $this->setWhere( "TAGS.tpopctag_id = 3" );

        $this->table  =   'produtos AS PROD';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ($data as $produto) {

                $this->idProduto             =  $produto->prod_id;

                $result[ $i ]['value']       =  $produto->prod_id;

                $result[ $i ]['image']       =  $this->getImageDefaultDiretory();

                $result[ $i ]['nome']        =  $produto->prod_nome;

                $result[ $i ]['desc']        =  $produto->prod_descricao;

                $result[ $i ]['valor']       =  'R$ ' . number_format( $produto->prod_valor, 2, ',', '.' );

                $result[ $i ]['moreValor']   =  number_format( $produto->prod_valor + 30, 2, ',', '.' );

                $result[ $i ]['link']        =  base_url() . 'produtos/' . $this->idProduto;

                $i++;

            }

        }

        return $result;

    }


    /**
     * Método obtem todas as informações necessárias para exibir os produtos mais vendidos
     *
     * @param  none
     * @return array
     * @access PUBLIC
     */
    public function getMaisVendidos() {

        $this->reset();

        $this->setField( 'PROD.prod_id, prod_nome, prod_valor, prod_descricao, CAT.cat_id' );

        $this->setJoin( 'INNER JOIN tipos_opcoes_tags_produtos_ass AS TAGS ON TAGS.prod_id = PROD.prod_id' );

        $this->setJoin( 'INNER JOIN sub_categorias AS SUBCAT ON SUBCAT.subcat_id = PROD.subcat_id' );

        $this->setJoin( 'INNER JOIN categorias AS CAT ON CAT.cat_id = SUBCAT.cat_id' );

        $this->setWhere( "TAGS.tpopctag_id = 2" );

        $this->setClausula( 'ORDER BY CAT.cat_id' );

        $this->table  =   'produtos AS PROD';

        $data         =   $this->get();

        $result       =   array();

        $cats         =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            $j  =  0;

            foreach ($data as $produto) {

                $this->idProduto  =  $produto->prod_id;

                $result['produtos'][ $produto->cat_id ][ $i ]['value']       =  $produto->prod_id;

                $result['produtos'][ $produto->cat_id ][ $i ]['image']       =  $this->getImageDefaultDiretory();

                $result['produtos'][ $produto->cat_id ][ $i ]['nome']        =  $produto->prod_nome;

                $result['produtos'][ $produto->cat_id ][ $i ]['desc']        =  $produto->prod_descricao;

                $result['produtos'][ $produto->cat_id ][ $i ]['valor']       =  'R$ ' . number_format( $produto->prod_valor, 2, ',', '.' );

                $result['produtos'][ $produto->cat_id ][ $i ]['moreValor']   =  number_format( $produto->prod_valor + 30, 2, ',', '.' );

                $result['produtos'][ $produto->cat_id ][ $i ]['link']        =  base_url() . 'produtos/' . $this->idProduto;

                if( !in_array($produto->cat_id, $cats) ) {

                    $cat[$j]  =  $produto->cat_id;

                    $j++;
                }
                $i++;
            }

            $cat   =    array_unique( $cat );

            //print_r( $cat ); exit;

            if( count( $cat ) > 0 ) {

                $i             =   0;

                $this->table   =   'categorias';

                foreach ($cat as $key => $value ) {
                 
                    $this->reset();

                    $this->setField( 'cat_nome' );

                    $this->setWhere( "cat_id = '$value'" );                    

                    $result['categorias'][$i]['name']   =   $this->getRecord();

                    $result['categorias'][$i]['id']   =   $value;

                    $i++;

                }

            }

        }

        return $result;

    }


    /**
     * Método obtem todas as informações necessárias para exibir os novos produtos
     *
     * @param  none
     * @return array
     * @access PUBLIC
     */
    public function getNovosProdutos() {

        $this->reset();

        $this->setField( 'PROD.prod_id, prod_nome, prod_valor, prod_descricao, CAT.cat_id' );

        $this->setJoin( 'INNER JOIN tipos_opcoes_tags_produtos_ass AS TAGS ON TAGS.prod_id = PROD.prod_id' );

        $this->setJoin( 'INNER JOIN sub_categorias AS SUBCAT ON SUBCAT.subcat_id = PROD.subcat_id' );

        $this->setJoin( 'INNER JOIN categorias AS CAT ON CAT.cat_id = SUBCAT.cat_id' );

        $this->setWhere( "TAGS.tpopctag_id = 4" );

        $this->setClausula( 'GROUP BY PROD.prod_id' );

        $this->setClausula( 'ORDER BY CAT.cat_id' );

        $this->table  =   'produtos AS PROD';

        $data         =   $this->get();

        $result       =   array();

        $cats         =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            $j  =  0;

            foreach ($data as $produto) {

                $this->idProduto  =  $produto->prod_id;

                $result['produtos'][ $produto->cat_id ][ $i ]['value']       =  $produto->prod_id;

                $result['produtos'][ $produto->cat_id ][ $i ]['image']       =  $this->getImageDefaultDiretory();

                $result['produtos'][ $produto->cat_id ][ $i ]['nome']        =  $produto->prod_nome;

                $result['produtos'][ $produto->cat_id ][ $i ]['desc']        =  $produto->prod_descricao;

                $result['produtos'][ $produto->cat_id ][ $i ]['valor']       =  'R$ ' . number_format( $produto->prod_valor, 2, ',', '.' );

                $result['produtos'][ $produto->cat_id ][ $i ]['moreValor']   =  number_format( $produto->prod_valor + 30, 2, ',', '.' );

                $result['produtos'][ $produto->cat_id ][ $i ]['link']        =  base_url() . 'produtos/' . $this->idProduto;

                if( !in_array($produto->cat_id, $cats) ) {

                    $cat[$j]  =  $produto->cat_id;

                    $j++;
                }
                $i++;
            }

            $cat   =    array_unique( $cat );

            //print_r( $cat ); exit;

            if( count( $cat ) > 0 ) {

                $i             =   0;

                $this->table   =   'categorias';

                foreach ($cat as $key => $value ) {
                 
                    $this->reset();

                    $this->setField( 'cat_nome' );

                    $this->setWhere( "cat_id = '$value'" );                    

                    $result['categorias'][$i]['name']   =   $this->getRecord();

                    $result['categorias'][$i]['id']   =   $value;

                    $i++;

                }

            }

        }

        return $result;

    }


    /**
     * Método obtem todos os produtos
     *
     * @return array json
     * @access PUBLIC
     */
    public function buscarProdutos() {

        //Seta os campos que desejo retornar
        $this->setField( 'prod_id, prod_nome, prod_valor, prod_descricao, CAT.cat_id' );

        $this->setJoin( 'INNER JOIN sub_categorias AS SUBCAT ON SUBCAT.subcat_id = PROD.subcat_id' );

        //Seta o join entre a tabela produtos e a tabela de sub categorias
        $this->setJoin( 'INNER JOIN categorias AS CAT ON CAT.cat_id = SUBCAT.cat_id' );

        is_numeric( $this->idProduto ) ?  $this->setWhere( "prod_id = '$this->idProduto'" ) : null;

        //Seta a tabela de busca
        $this->table  =   'produtos AS PROD';

        //Realiza a busca
        $data         =   $this->get();

        //Seta o array que será retornado
        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ($data as $prod ) {

                $this->idProduto       =   $prod->prod_id;

                $result[$i]['image']   =   $this->getImageDefaultDiretory();

                $result[$i]['value']   =   $prod->prod_id;

                $result[$i]['nome']    =   $prod->prod_nome;

                $result[$i]['valor']   =   number_format( $prod->prod_valor, 2, ',', '.' );

                $result[$i]['desc']    =   $prod->prod_descricao;

                $result[$i]['link']    =   base_url() . 'produtos/' . $this->idProduto;

                $result[$i]['cat']     =   $prod->cat_id;

                $i++;

            }

        }

        return $result;

    }


    /**
     * Método obtem todas as informações necessárias para exibir os produtos mais procurados
     *
     * @param  none
     * @return array
     * @access PUBLIC
     */
    public function getMaisProcurados() {

        $this->reset();

        $this->setField( 'PROD.prod_id, prod_nome, prod_valor' );

        $this->setJoin( 'INNER JOIN tipos_opcoes_tags_produtos_ass AS TAGS ON TAGS.prod_id = PROD.prod_id' );

        $this->setWhere( "TAGS.tpopctag_id = 5" );

        $this->table  =   'produtos AS PROD';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ($data as $produto) {

                $this->idProduto             =  $produto->prod_id;

                $result[ $i ]['value']       =  $produto->prod_id;

                $result[ $i ]['image']       =  $this->getImageDefaultDiretory();

                $result[ $i ]['nome']        =  $produto->prod_nome;

                $result[ $i ]['valor']       =  number_format( $produto->prod_valor, 2, ',', '.' );

                $result[ $i ]['link']        =  base_url() . 'produtos/' . $this->idProduto;

                $i++;

            }

        }

        return $result;

    }


    /**
     * Método obtem todos os produtos
     *
     * @return array json
     * @access PUBLIC
     */
    public function getProdutos( $byProduto = false, $resetAll = true ) {

        $resetAll ? $this->reset() : null;

        //Seta os campos que desejo retornar
        $this->setField( 'prod_id, prod_nome, undmed_id, prod_valor, prod_ean, prod_referencia, prod_descricao, prod_descricao_comp, prod_codigo, prod_status, subcat_nome, prod_peso, prod_largura, prod_altura, prod_comprimento' );

        $this->setJoin( 'INNER JOIN sub_categorias AS SUBCAT ON SUBCAT.subcat_id = PROD.subcat_id' );

        //Seta o join entre a tabela produtos e a tabela de sub categorias
        $this->setJoin( 'INNER JOIN categorias AS CAT ON CAT.cat_id = SUBCAT.cat_id' );

        if( $byProduto )  $this->setWhere( "prod_id = '$this->idProduto'" );

        //Seta a tabela de busca
        $this->table  =   'produtos AS PROD';

        //Realiza a busca
        $data         =   $this->get();

        //Seta o array que será retornado
        $result       =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ($data as $prod ) {

                $result[$i]['value']       =   $prod->prod_id;

                $result[$i]['nome']        =   $prod->prod_nome;

                $result[$i]['valor']       =   number_format( $prod->prod_valor, 2, ',', '.' );

                $result[$i]['referencia']  =   $prod->prod_referencia;

                $result[$i]['codigo']      =   $prod->prod_codigo;

                $result[$i]['status']      =   $prod->prod_status == 1 ? 'Ativo' : 'Inativo';

                $result[$i]['sta']         =   $prod->prod_status;

                $result[$i]['subcat']      =   $prod->subcat_nome;

                $result[$i]['undmed']      =   $prod->undmed_id;

                $result[$i]['peso']        =   $prod->prod_peso;

                $result[$i]['largura']     =   $prod->prod_largura;

                $result[$i]['altura']      =   $prod->prod_altura;

                $result[$i]['prof']        =   $prod->prod_comprimento;

                $result[$i]['ean']         =   $prod->prod_ean;

                $result[$i]['desc']        =   $prod->prod_descricao;

                $result[$i]['descCmp']     =   $prod->prod_descricao_comp;

                $i++;

            }

        }

        return $result;

    }



    public function getTagsProdutoByTitulo( $titulo ) {

        $this->reset();

        //Seta os campos que desejo retornar
        $this->setField( 'TPTG.tpopctag_id, tpopctag_nome' );

        $this->setJoin( "INNER JOIN tipos_opcoes_tags AS TPTG ON TPTG.tpopctag_id = ASS.tpopctag_id" );

        $this->setJoin( "INNER JOIN tipos_opcoes_titulo AS TPTIT ON TPTIT.tpopctit_id = TPTG.tpopctit_id" );

        $this->setJoin( "INNER JOIN tipos_opcoes AS TPOP ON TPOP.tpopc_id = TPTIT.tpopc_id" );

        $this->setWhere( "TPTIT.tpopctit_id = '$titulo'" );

        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->setClausula( 'GROUP BY TPTG.tpopctag_id' );

        $this->table  =   'tipos_opcoes_tags_produtos_ass AS ASS';

        $data         =   $this->get();

        $result       =   array();

        if( count( $data ) > 0 ) {

            $i   =   0;

            foreach ( $data as $key ) {

                $result[$i]['id']    =   $key->tpopctag_id;

                $result[$i]['name']  =   $key->tpopctag_nome;

                $i++;

            }

        }

        return $result;

    }

    /**
     * Método obtem todos os produtos
     *
     * @return array json
     * @access PUBLIC
     */
    public function getDataLista() {

        $this->reset();

        //Seta os campos que desejo retornar
        $this->setField( 'TPTG.tpopctag_id, TPOP.tpopc_id, TPTIT.tpopctit_id, tpopc_nome, tpopctit_nome, tpopctag_nome' );

        $this->setJoin( "INNER JOIN tipos_opcoes_tags AS TPTG ON TPTG.tpopctag_id = ASS.tpopctag_id" );

        $this->setJoin( "INNER JOIN tipos_opcoes_titulo AS TPTIT ON TPTIT.tpopctit_id = TPTG.tpopctit_id" );

        $this->setJoin( "INNER JOIN tipos_opcoes AS TPOP ON TPOP.tpopc_id = TPTIT.tpopc_id" );

        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->setClausula( 'GROUP BY TPTIT.tpopctit_id' );

        $this->table    =    'tipos_opcoes_tags_produtos_ass AS ASS';        

        $data           =    $this->get();

        $result         =    array();

        $i              =    0;

        if( count( $data ) > 0 ) {

            foreach ( $data as $key ) {

                $result[ $i ][ 'lista' ]     =    $key->tpopc_nome;

                $result[ $i ][ 'idlista' ]   =    $key->tpopc_id;

                $result[ $i ][ 'idtitulo' ]  =    $key->tpopctit_id;

                $result[ $i ][ 'titulo' ]    =    $key->tpopctit_nome;

                $result[ $i ][ 'tagss' ]     =    $this->getTagsProdutoByTitulo( $key->tpopctit_id );
                    
                $i++;

            }

        }

        //print_r( $result ); exit;

        return $result;

    }


    /**
     * Obtem uma informação especifica do produto
     *
     * @param  INT $data  -  Informação que deseja obter
     *
     * @return MIX
     * @access PUBLIC
     */
    public function getDataEspecificProduct( $data ) {

        $this->reset();

        switch ( $data ) {
            case 1:
                $field  =  'prod_valor';
            break;
            case 2:
                $field  =  'prod_nome';
            break;
            case 3:
                $field  =  'prod_descricao';
            break;
            case 4:
                $field  =  'prod_peso';
            break;
            case 5:
                $field  =  'prod_largura';
            break;
            case 6:
                $field  =  'prod_altura';
            break;
            case 7:
                $field  =  'prod_comprimento';
            break;
        }

        $this->setField( $field );

        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->table  =  'produtos';

        return $this->getRecord();

    }


    public function getProdutosByCart( $produtos = array() ) {

        $this->setField( 'prod_id, prod_nome, prod_referencia, prod_codigo, prod_valor' );

        $this->table  =  'produtos';

        $result       =   array();

        $i            =   0;

        if( count( $produtos ) > 0 ) {

            foreach ($produtos as $key => $value ) {
                    
                $this->resetWhere();

                $id     =   $value['id'];

                $this->setWhere( "prod_id = '$id'" );

                $data   =   $this->get();

                $result[$key]['valu']  =  $data[0]->prod_id;

                $result[$key]['prod']  =  $data[0]->prod_nome;

                $result[$key]['refe']  =  $data[0]->prod_referencia;

                $result[$key]['codi']  =  $data[0]->prod_codigo;

                $result[$key]['qtd']   =  $value['qtd'];

                $result[$key]['valor_int']  =  $data[0]->prod_valor;

                $result[$key]['valo']  =  number_format( $data[0]->prod_valor, 2, ',', '.' );

                $result[$key]['link']  =  base_url() . 'produtos/' . $id;

                $i++;

            }

            foreach ($produtos as $key => $value ) {
                $id     =   $value['id'];
                $result[$key]['image']  =  $this->getImageDefaultDiretory($id);
            }

        }

        return $result;

    }


    /**
     * Método resgata as informações de estoque
     * @param  NULL
     * @return ARRAY
     * @access PUBLIC
     */
    public function getEstoque() {

        //Reset all attr of Querys class
        $this->reset();

        //Seta os campos que desejo retornar
        $this->setField( 'est_minimo, est_max, est_qtd' );

        //Seta a condição de busca
        $this->setWhere( "prod_id = '$this->idProduto'" );

        $this->table  =   'estoque';

        //Realiza a consulta
        $data    =   $this->get();

        //Declara o array que será retornado
        $result  =   array();

        if( count( $data ) == 1 ) {

            $result[ 'qtd' ]     =   $data[0]->est_qtd;

            $result[ 'qtdMin' ]  =   $data[0]->est_minimo;

            $result[ 'qtdMax' ]  =   $data[0]->est_max;

        }

        return $result;

    }


    /**
     * Método obtem todos os locais
     * @param  NULL
     * @return ARRAY
     * @access PUBLIC
     */
    public function getLocais( $idLocal = '' ) {

        //Reset all attr of Querys class
        $this->reset();

        //Seta os campos que desejo retornar
        $this->setField( 'loc_id, loc_empresa, loc_endereco' );

        //Seta a condição caso o ID do local seja numerico
        is_numeric( $idLocal ) ? $this->setWhere( "loc_id = '$idLocal'" ) : null;

        //Seta a condição da tabela
        $this->table  =   'locais';

        //Realiza a consulta
        $data    =   $this->get();

        //Declara o array que será retornado
        $result  =   array();

        if( count( $data ) > 0 ) {

            $i  =  0;

            foreach ($data as $key => $value ) {

                $result[ $i ][ 'val' ]   =   $value->loc_id;

                $result[ $i ][ 'emp' ]   =   $value->loc_empresa;

                $result[ $i ][ 'end' ]   =   $value->loc_endereco;

                $i++;

            }

        }

        return $result;

    }


}







