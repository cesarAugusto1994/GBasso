<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias_admin extends CI_Controller {

    private $Header     =  null;

    private $Essential  =  null;

    private $Login      =  null;

    private $Categorias =  null;

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
    * Método grava os produtos em banco de dados
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function cadastrar() {

        $this->Categorias   =     new objects\Categorias;

        //Recebe os dados via POST
        $status      =    $this->Essential->sqlInjection( $this->input->post( 'status' ) );

        $home        =    $this->Essential->sqlInjection( $this->input->post( 'home' ) );

        $nome        =    $this->Essential->sqlInjection( $this->input->post( 'nome' ) );

        $descricao   =    $this->Essential->sqlInjection( $this->input->post( 'descricao' ) );

        !$this->Essential->onlyNumber( $status ) ? $this->Essential->setMessage( 'Selecione o status da categoria', 102 ) : null;

        !$this->Essential->onlyNumber( $home ) ? $this->Essential->setMessage( 'Selecione o campo home', 102 ) : null;

        $this->Essential->verify( $nome, 'Digite o nome da categoria', 'empty' );

        $this->Essential->verify( $descricao, 'Digite o nome da descrição', 'empty' );        

        $this->Categorias->gravarCategoria( false, $nome, $descricao, $home, $status );

        $this->Essential->setMessage( 'Categoria cadastrada com sucesso', 100 );

    }


    /**
    * Método grava os produtos em banco de dados
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function salvar_edicao_categoria() {

        $this->Categorias   =     new objects\Categorias;

        //Recebe os dados via POST
        $idCategoria =    $this->Essential->sqlInjection( $this->input->post( 'idcat' ) );

        $status      =    $this->Essential->sqlInjection( $this->input->post( 'status' ) );

        $home        =    $this->Essential->sqlInjection( $this->input->post( 'home' ) );

        $nome        =    $this->Essential->sqlInjection( $this->input->post( 'nome' ) );

        $descricao   =    $this->Essential->sqlInjection( $this->input->post( 'descricao' ) );

        !$this->Essential->onlyNumber( $idCategoria ) ? $this->Essential->setMessage( 'Categoria inválida', 102 ) : null;

        !$this->Essential->onlyNumber( $status ) ? $this->Essential->setMessage( 'Selecione o status da categoria', 102 ) : null;

        !$this->Essential->onlyNumber( $home ) ? $this->Essential->setMessage( 'Selecione o campo home', 102 ) : null;

        $this->Essential->verify( $nome, 'Digite o nome da categoria', 'empty' );

        $this->Essential->verify( $descricao, 'Digite o nome da descrição', 'empty' );        

        $this->Categorias->idCategoria  =  $idCategoria;

        $this->Categorias->gravarCategoria( true, $nome, $descricao, $home, $status );

        $this->Essential->setMessage( 'Categoria editada com sucesso', 100 );

    }


    /**
    * Método grava os produtos em banco de dados
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function cadastrar_subCategoria() {

        $this->Categorias   =     new objects\Categorias;

        //Recebe os dados via POST
        $idCategoria   =    $this->Essential->sqlInjection( $this->input->post( 'categoria' ) );

        $home          =    $this->Essential->sqlInjection( $this->input->post( 'home' ) );

        $nome          =    $this->Essential->sqlInjection( $this->input->post( 'nome' ) );

        !$this->Essential->onlyNumber( $idCategoria ) ? $this->Essential->setMessage( 'Selecione uma categoria', 102 ) : null;

        !$this->Essential->onlyNumber( $home ) ? $this->Essential->setMessage( 'Selecione o campo home', 102 ) : null;

        $this->Essential->verify( $nome, 'Digite o nome da sub categoria', 'empty' );

        $this->Categorias->idCategoria  =  $idCategoria;

        $this->Categorias->gravarSubCategoria( false, $nome, $home, 0 );

        $this->Essential->setMessage( 'Sub Categoria cadastrada com sucesso', 100 );

    }


    /**
    * Método grava os produtos em banco de dados
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function salvar_edicao_subCategoria() {

        $this->Categorias   =     new objects\Categorias;

        //Recebe os dados via POST
        $idSubCategoria  =    $this->Essential->sqlInjection( $this->input->post( 'idSubCat' ) );

        $idCategoria     =    $this->Essential->sqlInjection( $this->input->post( 'categoria' ) );

        $home            =    $this->Essential->sqlInjection( $this->input->post( 'home' ) );

        $nome            =    $this->Essential->sqlInjection( $this->input->post( 'nome' ) );

        !$this->Essential->onlyNumber( $idSubCategoria ) ? $this->Essential->setMessage( 'Sub Categoria inválida', 102 ) : null;

        !$this->Essential->onlyNumber( $idCategoria ) ? $this->Essential->setMessage( 'Selecione uma categoria', 102 ) : null;

        !$this->Essential->onlyNumber( $home ) ? $this->Essential->setMessage( 'Selecione o campo home', 102 ) : null;

        $this->Essential->verify( $nome, 'Digite o nome da sub categoria', 'empty' );

        $this->Categorias->idSubCategoria  =  $idSubCategoria;

        $this->Categorias->idCategoria     =  $idCategoria;

        $this->Categorias->gravarSubCategoria( true, $nome, $home, '' );

        $this->Essential->setMessage( 'Sub Categoria editada com sucesso', 100 );

    }


    /**
    * Método grava uma TAG de categoria em banco de dados
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function salvar_tag_categoria() {

        $this->Categorias   =     new objects\Categorias;

        //Recebe os dados via POST
        $cat      =    $this->Essential->sqlInjection( $this->input->post( 'categoria' ) );

        $subCat   =    $this->Essential->sqlInjection( $this->input->post( 'subcategoria' ) );

        $home     =    $this->Essential->sqlInjection( $this->input->post( 'home' ) );

        $nome     =    $this->Essential->sqlInjection( $this->input->post( 'nome' ) );

        !$this->Essential->onlyNumber( $cat ) ? $this->Essential->setMessage( 'Selecione a categoria', 102 ) : null;

        !$this->Essential->onlyNumber( $subCat ) ? $this->Essential->setMessage( 'Selecione a sub categoria', 102 ) : null;

        !$this->Essential->onlyNumber( $home ) ? $this->Essential->setMessage( 'Selecione o campo home', 102 ) : null;

        $this->Essential->verify( $nome, 'Digite o nome da tag', 'empty' );

        $this->Categorias->idCategoria     =  $cat;

        $this->Categorias->idSubCategoria  =  $subCat;

        !$this->Categorias->categoriaExists() ? $this->Essential->setMessage( 'Categoria inválida', 102 ) : null;

        !$this->Categorias->subCategoriaExists() ? $this->Essential->setMessage( 'Sub Categoria inválida', 102 ) : null;

        //
        $this->Categorias-> gravarItemCategoria( false, '', $nome, $home );

        $this->Essential->setMessage( 'Tag cadastrada com sucesso', 100 );

    }



    /**
    * Método edita uma TAG de categoria em banco de dados
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function salvar_edicao_tag_categoria() {

        $this->Categorias   =     new objects\Categorias;

        //Recebe os dados via POST
        $idTag    =    $this->Essential->sqlInjection( $this->input->post( 'idTag' ) );

        $cat      =    $this->Essential->sqlInjection( $this->input->post( 'categoria' ) );

        $subCat   =    $this->Essential->sqlInjection( $this->input->post( 'subcategoria' ) );

        $home     =    $this->Essential->sqlInjection( $this->input->post( 'home' ) );

        $nome     =    $this->Essential->sqlInjection( $this->input->post( 'nome' ) );

        !$this->Essential->onlyNumber( $idTag ) ? $this->Essential->setMessage( 'Tag inválida', 102 ) : null;

        !$this->Essential->onlyNumber( $cat ) ? $this->Essential->setMessage( 'Selecione a categoria', 102 ) : null;

        !$this->Essential->onlyNumber( $subCat ) ? $this->Essential->setMessage( 'Selecione a sub categoria', 102 ) : null;

        !$this->Essential->onlyNumber( $home ) ? $this->Essential->setMessage( 'Selecione o campo home', 102 ) : null;

        $this->Essential->verify( $nome, 'Digite o nome da tag', 'empty' );

        $this->Categorias->idCategoria     =  $cat;

        $this->Categorias->idSubCategoria  =  $subCat;

        !$this->Categorias->categoriaExists() ? $this->Essential->setMessage( 'Categoria inválida', 102 ) : null;

        !$this->Categorias->subCategoriaExists() ? $this->Essential->setMessage( 'Sub Categoria inválida', 102 ) : null;

        !$this->Categorias->tagCategoriaExists( $idTag ) ? $this->Essential->setMessage( 'Tag inválida', 102 ) : null;

        //
        $this->Categorias-> gravarItemCategoria( true, $idTag, $nome, $home );

        $this->Essential->setMessage( 'Tag editada com sucesso', 100 );

    }


    /**
    * Método deleta
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function deletarTagsCategorias() {

        $this->Categorias   =   new objects\Categorias;

        $qtd                =   $this->Essential->sqlInjection( $this->input->post( 'qtd' ) );

        if( is_numeric( $qtd ) && $qtd > 0 ) {

            $cat    =   array();

            for( $i = 0; $i < $qtd; $i++ ) {

                $id   =   $this->input->post( 'id' . $i );

                if( !is_numeric( $id ) ) {

                    $this->Essential->setMessage( 'Tag ' . ( $i + 1 ) . ' inválida', 102 );

                }else {

                    $cat[$i]  =  $id;

                }

            }

            for( $i = 0; $i < $qtd; $i++ ) {

                $id  =  $cat[$i];

                $this->Categorias->deletarTagsCategorias( $id );

            }

            $this->Essential->setMessage( 'Tag(s) deletada(s) com sucesso', 100 );

        }else {

            $this->Essential->setMessage( 'Selecione uma ou mais tags', 102 );

        }

    }



    /**
    * Método deleta
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function deletarCategorias() {

        $this->Categorias   =   new objects\Categorias;

        $qtd                =   $this->Essential->sqlInjection( $this->input->post( 'qtd' ) );

        if( is_numeric( $qtd ) && $qtd > 0 ) {

            $cat    =   array();

            for( $i = 0; $i < $qtd; $i++ ) {

                $id   =   $this->input->post( 'id' . $i );

                if( !is_numeric( $id ) ) {

                    $this->Essential->setMessage( 'Categoria ' . ( $i + 1 ) . ' inválida', 102 );

                }else {

                    $cat[$i]  =  $id;

                }

            }

            for( $i = 0; $i < $qtd; $i++ ) {

                $this->Categorias->idCategoria  =  $cat[$i];

                $this->Categorias->deletarCategorias();

            }

            $this->Essential->setMessage( 'Categoria(s) deletada(s) com sucesso', 100 );

        }else {

            $this->Essential->setMessage( 'Selecione uma ou mais categorias', 102 );

        }

    }


    /**
    * Método deleta
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function deletarSubCategorias() {

        $this->Categorias   =   new objects\Categorias;

        $qtd                =   $this->Essential->sqlInjection( $this->input->post( 'qtd' ) );

        if( is_numeric( $qtd ) && $qtd > 0 ) {

            $cat    =   array();

            for( $i = 0; $i < $qtd; $i++ ) {

                $id   =   $this->input->post( 'id' . $i );

                if( !is_numeric( $id ) ) {

                    $this->Essential->setMessage( 'Sub Categoria ' . $i + 1 . ' inválida', 102 );

                }else {

                    $cat[$i]  =  $id;

                }

            }

            for( $i = 0; $i < $qtd; $i++ ) {

                $this->Categorias->idSubCategoria  =  $cat[$i];

                $this->Categorias->deletarSubCategorias();

            }

            $this->Essential->setMessage( 'Sub Categoria(s) deletada(s) com sucesso', 100 );

        }else {

            $this->Essential->setMessage( 'Selecione uma ou mais Sub Categorias', 102 );

        }

    }


    /**
    * Método deleta
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function getConfigMenuCategoria() {

        $this->Categorias   =   new objects\Categorias;

        $id                 =   $this->Essential->sqlInjection( $this->input->post( 'idCat' ) );

        $result             =   array();

        if( is_numeric( $id ) && $id > 0 ) {

            $this->Categorias->idCategoria   =   $id;

            !$this->Categorias->categoriaExists() ? $this->Essential->setMessage( 'Categoria inválida', 102 ) : null;

            $result['subcat']  =   $this->Categorias->getConfigMenuCategoria();

            $result['code']    =   100;

            echo json_encode( $result );

            exit;

        }else {

            $this->Essential->setMessage( 'Categoria inválida', 102 );

        }

    }


    /**
    * Método grava os produtos em banco de dados
    *
    * @param
    * @return array json
    * @access PUBLIC
    */
    public function salvar_ordem_sub_categoria() {

        $this->Categorias   =     new objects\Categorias;

        //Recebe os dados via POST
        $qtd   =    $this->Essential->sqlInjection( $this->input->post( 'qtd' ) );

        if( is_numeric( $qtd ) ) {

            $cat    =   array();

            for( $i = 0; $i < $qtd; $i++ ) {

                $id      =   $this->input->post( 'id' . $i );

                $ordem   =   $this->input->post( 'ordem' . $i );

                if( !is_numeric( $id ) ) {

                    $this->Essential->setMessage( 'Sub Categoria ' . ( $i + 1 ) . ' inválida', 102 );

                }else {

                    if( is_numeric( $ordem ) ) {

                        $cat[$i]['id']     =  $id;

                        $cat[$i]['ordem']  =  $ordem;

                    }else {

                        $this->Essential->setMessage( 'Ordem de número ' . ( $i + 1 ) . ' inválida', 102 );

                    }

                }

            }            

            for( $i = 0; $i < $qtd; $i++ ) {

                $this->Categorias->idSubCategoria  =  $cat[$i]['id'];

                $this->Categorias->gravarSubCategoria( true, '', '', $cat[$i]['ordem'] );

            }

            $this->Essential->setMessage( 'Sub Categoria(s) deletada(s) com sucesso', 100 );

        }else {

            $this->Essential->setMessage( 'Sub categoria inválida', 102 );

        }

    }

}    

















