<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produtos_admin extends CI_Controller {

    private $Header     =  null;

    private $Essential  =  null;

    private $Login      =  null;

    private $Produtos   =  null;

    private $Files      =  null;

    private $General    =  null;

    private $Correios   =  null;

    private $sdkML      =  null;

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

        $this->Produtos  =    new objects\Produtos;
        
        $this->General   =    new extend\General;


        //Recebe os dados via POST
        $status          =    $this->Essential->sqlInjection( $this->input->post( 'status' ) );

        $codigo          =    $this->Essential->sqlInjection( $this->input->post( 'codigo' ) );

        $nome            =    $this->Essential->sqlInjection( $this->input->post( 'nome' ) );

        $cat             =    $this->Essential->sqlInjection( $this->input->post( 'categoria' ) );

        $idSubCat        =    $this->Essential->sqlInjection( $this->input->post( 'subcategoria' ) );

        $ref             =    $this->Essential->sqlInjection( $this->input->post( 'referencia' ) );

        $valor           =    $this->Essential->sqlInjection( $this->input->post( 'valor' ) );

        $undMedida       =    $this->Essential->sqlInjection( $this->input->post( 'unidadeMedida' ) );

        $peso            =    $this->Essential->sqlInjection( $this->input->post( 'peso' ) );

        $largura         =    $this->Essential->sqlInjection( $this->input->post( 'largura' ) );

        $altura          =    $this->Essential->sqlInjection( $this->input->post( 'altura' ) );

        $profundidade    =    $this->Essential->sqlInjection( $this->input->post( 'profundidade' ) );

        $codBarras       =    $this->Essential->sqlInjection( $this->input->post( 'codigoBarras' ) );

        $images          =    isset( $_FILES['images'] ) ? $_FILES['images'] : null;

        $descricao       =    $this->Essential->sqlInjection( $this->input->post( 'descricao' ) );

        $descComple      =    str_replace(array("\r", "\n", "\t"),"", htmlentities( $this->input->post( 'editor1' ) ) );

        $tags            =    $this->Essential->sqlInjection( $this->input->post( 'qtdHTags' ) );


        //Validações  
        !$this->Essential->onlyNumber( $status ) ? $this->Essential->setMessage( 'Selecione o status do produto', 102 ) : null;

        $this->Essential->verify( $codigo, 'Digite o código do produto', 'empty' );

        $this->Essential->verify( $nome, 'Digite o nome do produto', 'empty' );

        !$this->Essential->onlyNumber( $cat ) ? $this->Essential->setMessage( 'Selecione uma categoria', 102 ) : null;

        !$this->Essential->onlyNumber( $idSubCat ) ? $this->Essential->setMessage( 'Selecione uma Sub Categoria', 102 ) : null;

        $this->Essential->verify( $ref, 'Digite a referencia do produto', 'empty' );

        $valor  =  $this->General->number_format( $valor );

        ( !$valor > 0 ) ? $this->Essential->setMessage( 'Digite um valor válido para o produto', 102 ) : null;

        !$this->Essential->onlyNumber( $undMedida ) ? $this->Essential->setMessage( 'Selecione a unidade de medida', 102 ) : null;

        $this->Produtos->referenciaExist( $ref ) ? $this->Essential->setMessage( 'Já existe um produto cadastrado com a referência: ' . $ref, 102 ) : null;

        $idTags   =     array();

        if( is_numeric( $tags ) ) {

            $j  =  0;

            for( $i = 0; $i < $tags; $i++ ) {

                $id   =    $this->input->post( 'hTag' . $i );

                if( is_numeric( $id ) ) {

                    $idTags[$j]  =   $id;

                    $j++;

                }

            }

        }

        $respImg  =  array();

        //Verificando as imagens
        if( !is_null( $images ) ) {

            $this->Files    =  new extend\Files( $images );

            $dirToSave      =   'assets/uploads/images/';

            $length         =   1048576 * 3; //3 MB por arquivo

            $fileExtension  =   array( 'jpg', 'png' );

            $this->Files->initialize( $dirToSave, $length, $fileExtension );

            $respImg        =   $this->Files->processMultFiles();

            if( isset( $respImg['code'] ) ) {

                $this->Essential->setMessenger( $respImg['status'], 102 );

            }

        }

        //Grava o produto
        $this->Produtos->gravarProdutos( false, $idSubCat, $undMedida, $nome, $codigo, $valor, $descricao, $descComple, $ref, $peso, $altura, $largura, $profundidade, $codBarras, $status );

        //Resgata o ID do produto
        $this->Produtos->getIDProduto( $ref );

        //Grava o estoque do produto
        $this->Produtos->gravarEstoque( 0, 0, 0 );

        //verifica se alguma imagem foi enviada
        if( count( $respImg ) > 0 ) {

            //get images
            foreach ($respImg as $value ) {

                //Grava as imagens
                $this->Produtos->gravarImagemProduto( '', $value['file'], 1);
            
            }

        }

        if( count( $idTags ) > 0 ) {

            foreach ($idTags as $key => $value) {
                    
                $id   =   $value;

                $this->Produtos->gravarTagsProduto( $id );

            }

        }

        $response  =  array( 'id' => $this->Produtos->idProduto, 'code' => 100 );

        //Envia a mensagem para o usuário
        echo json_encode( $response ); exit;

    }

    /**
     * Método grava os produtos em banco de dados
     *
     * @param  
     * @return array json
     * @access PUBLIC
     */
    public function salvar_edicao() {

        $this->Produtos  =    new objects\Produtos;
        
        $this->General   =    new extend\General;


        //Recebe os dados via POST
        $idProduto       =    $this->Essential->sqlInjection( $this->input->post( 'idProduto' ) );

        $status          =    $this->Essential->sqlInjection( $this->input->post( 'status' ) );

        $codigo          =    $this->Essential->sqlInjection( $this->input->post( 'codigo' ) );

        $nome            =    $this->Essential->sqlInjection( $this->input->post( 'nome' ) );

        $cat             =    $this->Essential->sqlInjection( $this->input->post( 'categoria' ) );

        $idSubCat        =    $this->Essential->sqlInjection( $this->input->post( 'subcategoria' ) );

        $ref             =    $this->Essential->sqlInjection( $this->input->post( 'referencia' ) );

        $valor           =    $this->Essential->sqlInjection( $this->input->post( 'valor' ) );

        $undMedida       =    $this->Essential->sqlInjection( $this->input->post( 'unidadeMedida' ) );

        $peso            =    $this->Essential->sqlInjection( $this->input->post( 'peso' ) );

        $largura         =    $this->Essential->sqlInjection( $this->input->post( 'largura' ) );

        $altura          =    $this->Essential->sqlInjection( $this->input->post( 'altura' ) );

        $profundidade    =    $this->Essential->sqlInjection( $this->input->post( 'profundidade' ) );

        $codBarras       =    $this->Essential->sqlInjection( $this->input->post( 'codigoBarras' ) );

        $images          =    isset( $_FILES['images'] ) ? $_FILES['images'] : null;

        $descricao       =    $this->Essential->sqlInjection( $this->input->post( 'descricao' ) );

        $descComple      =    str_replace(array("\r", "\n", "\t"),"", htmlentities( $this->input->post( 'editor1' ) ) );

        $tags            =    $this->Essential->sqlInjection( $this->input->post( 'qtdHTags' ) );


        //Validações  
        $this->Produtos->idProduto  =   $idProduto;

        !$this->Essential->onlyNumber( $idProduto ) ? $this->Essential->setMessage( 'Produto inválido', 102 ) : null;

        !$this->Produtos->produtoExists() ? $this->Essential->setMessage( 'Produto inexistente', 102 ) : null;

        !$this->Essential->onlyNumber( $status ) ? $this->Essential->setMessage( 'Selecione o status do produto', 102 ) : null;

        $this->Essential->verify( $codigo, 'Digite o código do produto', 'empty' );

        $this->Essential->verify( $nome, 'Digite o nome do produto', 'empty' );

        !$this->Essential->onlyNumber( $cat ) ? $this->Essential->setMessage( 'Selecione uma categoria', 102 ) : null;

        !$this->Essential->onlyNumber( $idSubCat ) ? $this->Essential->setMessage( 'Selecione uma Sub Categoria', 102 ) : null;

        $this->Essential->verify( $ref, 'Digite a referencia do produto', 'empty' );

        $valor  =  $this->General->number_format( $valor );

        ( !$valor > 0 ) ? $this->Essential->setMessage( 'Digite um valor válido para o produto', 102 ) : null;

        !$this->Essential->onlyNumber( $undMedida ) ? $this->Essential->setMessage( 'Selecione a unidade de medida', 102 ) : null;

        $this->Produtos->referenciaExist( $ref, true ) ? $this->Essential->setMessage( 'Já existe um produto cadastrado com a referência: ' . $ref, 102 ) : null;

        $idTags   =     array();

        if( is_numeric( $tags ) ) {

            $j  =  0;

            for( $i = 0; $i < $tags; $i++ ) {

                $id   =    $this->input->post( 'hTag' . $i );

                if( is_numeric( $id ) ) {

                    $idTags[$j]  =   $id;

                    $j++;

                }

            }

        }

        $respImg  =  array();

        //Verificando as imagens
        if( !is_null( $images ) ) {

            $this->Files    =  new extend\Files( $images );

            $dirToSave      =   'assets/uploads/images/';

            $length         =   1048576 * 3; //3 MB por arquivo

            $fileExtension  =   array( 'jpg', 'png' );

            $this->Files->initialize( $dirToSave, $length, $fileExtension );

            $respImg        =   $this->Files->processMultFiles();

            if( isset( $respImg['code'] ) ) {

                $this->Essential->setMessage( $respImg['status'], 102 );

            }

        }

        //Grava o produto
        $this->Produtos->gravarProdutos( true, $idSubCat, $undMedida, $nome, $codigo, $valor, $descricao, $descComple, $ref, $peso, $altura, $largura, $profundidade, $codBarras, $status );

        //Deleta as TAGS do produto
        $this->Produtos->deletarTagsProdutos();

        //verifica se alguma imagem foi enviada
        if( count( $respImg ) > 0 ) {

            //get images
            foreach ($respImg as $value ) {

                //Grava as imagens
                $this->Produtos->gravarImagemProduto( '', $value['file'], 1);
            
            }

        }

        if( count( $idTags ) > 0 ) {

            foreach ($idTags as $key => $value) {
                    
                $id   =   $value;

                $this->Produtos->gravarTagsProduto( $id );

            }

        }

        $response  =  array( 'id' => $this->Produtos->idProduto, 'code' => 100 );

        //Envia a mensagem para o usuário
        echo json_encode( $response ); exit;

    }

    /**
     * Método utiliza a classe de produtos para consultar todas as listas de opções
     *
     * @param  none
     * @return array json
     * @access PUBLIC
     */
    public function getListaTipos() {

        $result          =   array();

        $this->Produtos  =   new objects\Produtos;

        $result          =   $this->Produtos->getListaTipos();

        echo json_encode( $result );

    }

    /**
     * Método obtem todos os títulos de lista do banco de dados
     *
     * @param  $idLista    -  ID da lista em que o titulo será pesquisado
     * @param  $titulo     -  Nome do titulo da lista
     * @return array json
     * @access PUBLIC
     */
    public function getListaTitulos() {

        $result          =   array();

        $this->Produtos  =   new objects\Produtos;

        $idLista         =   $this->Essential->sqlInjection( $this->input->post( 'idLista' ) );

        $titulo          =   $this->Essential->sqlInjection( $this->input->post( 'titulo' ) );

        $result          =   $this->Produtos->getListaTitulos( $idLista, $titulo  );

        echo json_encode( $result );

    }

    /**
     * Método obtem todos os títulos de lista do banco de dados
     *
     * @param  $idLista    -  ID da lista em que o titulo será pesquisado
     * @param  $text       -  Nome do titulo da lista
     * @return array json
     * @access PUBLIC
     */
    public function gravarListaTitulo() {

        $result          =   array();

        $this->Produtos  =   new objects\Produtos;

        $idLista         =   $this->Essential->sqlInjection( $this->input->post( 'idLista' ) );

        $titulo          =   $this->Essential->sqlInjection( $this->input->post( 'titulo' ) );

        $this->Essential->verify( $idLista, 'Selecione a lista', 'empty' );

        $this->Essential->verify( $titulo, 'Mínimo 1 caractere para o título', 'empty' );

        !$this->Essential->onlyNumber( $idLista ) ? $this->Essential->setMessage( 'Tipo de lista não selecionado', 102 ) : null;

        $this->Produtos->gravarListaTitulo( $idLista, '', $titulo );

        $id      =  $this->Produtos->getLastIDListaTitulos( $idLista );

        $result  =  array( 'code' => 100, 'id' => $id );

        echo json_encode( $result );

    }

    /**
     * Método utiliza a classe de produtos para consultar todas as listas de tags
     *
     * @param  none
     * @return array json
     * @access PUBLIC
     */
    public function getListaTags() {

        $result          =   array();

        $this->Produtos  =   new objects\Produtos;

        $idTitulo        =   $this->Essential->sqlInjection( $this->input->post( 'idTitulo' ) );

        $tag             =   $this->Essential->sqlInjection( $this->input->post( 'tag' ) );

        $result          =   $this->Produtos->getListaTags( $idTitulo, $tag  );

        echo json_encode( $result );

    }


    /**
     * Método obtem todos os títulos de lista do banco de dados
     *
     * @param  $idLista    -  ID da lista em que o titulo será pesquisado
     * @param  $text       -  Nome do titulo da lista
     * @return array json
     * @access PUBLIC
     */
    public function gravarListaTag() {

        $result          =   array();

        $this->Produtos  =   new objects\Produtos;

        $idTitulo        =   $this->Essential->sqlInjection( $this->input->post( 'idTitulo' ) );

        $tag             =   $this->Essential->sqlInjection( $this->input->post( 'tag' ) );

        $this->Essential->verify( $idTitulo, 'Selecione um título', 'empty' );

        $this->Essential->verify( $tag, 'Mínimo 1 caractere para a tag', 'empty' );

        !$this->Essential->onlyNumber( $idTitulo ) ? $this->Essential->setMessage( 'Título de lista não selecionado', 102 ) : null;

        $this->Produtos->gravarListaTag( $idTitulo, '', $tag );

        $id      =  $this->Produtos->getLastIDListaTags( $idTitulo );

        $result  =  array( 'code' => 100, 'id' => $id );

        echo json_encode( $result );

    }

    /**
     * Método utiliza a classe de produtos para consultar todas as categorias cadastradas
     *
     * @param  none
     * @return array json
     * @access PUBLIC
     */
    public function getCategorias() {

        $result          =   array();

        $this->Produtos  =   new objects\Produtos;

        $result          =   $this->Produtos->getCategorias();

        echo json_encode( $result );

    }

    /**
     * Método consulta e obtem as subcategorias cadastradas numa determinada categoria
     *
     * @param  $idCat       -  ID da categoria
     * @return array json
     * @access PUBLIC
     */
    public function getSubCategorias() {

        $result          =   array();

        $this->Produtos  =   new objects\Produtos;

        $idCat           =   $this->Essential->sqlInjection( $this->input->post( 'idCat' ) );

        !$this->Essential->onlyNumber( $idCat ) ? $this->Essential->setMessage( 'Selecione uma categoria', 102 ) : null;

        $result          =   $this->Produtos->getSubCategorias( $idCat );

        echo json_encode( $result );

    }

    /**
     * Método consulta e obtem as unidades de medida 
     *
     * @return array json
     * @access PUBLIC
     */
    public function getUnidadeMedida() {

        $result          =   array();

        $this->Produtos  =   new objects\Produtos;

        $result          =   $this->Produtos->getUnidadeMedida();

        echo json_encode( $result );

    }

    /**
     * Método consulta e retorna todas as imagens de um produto
     *
     * @return array json
     * @access PUBLIC
     */
    public function getImages() {

        $result          =   array();

        //recebe o ID do produto
        $idProduto       =   $this->Essential->sqlInjection( $this->input->post( 'id' ) );

        //Verifica se o mesmo é um inteiro
        !$this->Essential->onlyNumber( $idProduto ) ? $this->Essential->setMessage( 'Produto inválido', 102 ) : null;

        //Instancia a classe de produtos
        $this->Produtos  =   new objects\Produtos;

        //Atribui o ID do produto
        $this->Produtos->idProduto   =  $idProduto;

        //Realiza a consulta
        $result          =   $this->Produtos->getImages();

        //retorna os dados
        echo json_encode( $result );

    }    

    /**
     * Método seta a imagem do produto
     *
     * @return array json
     * @access PUBLIC
     */
    public function setImageDefault() {

        $result     =   array();

        //recebe o ID do produto
        $idProduto  =   $this->Essential->sqlInjection( $this->input->post( 'id' ) );

        //recebe o ID do produto
        $img        =   $this->Essential->sqlInjection( $this->input->post( 'img' ) );

        //Verifica se o mesmo é um inteiro
        !$this->Essential->onlyNumber( $idProduto ) ? $this->Essential->setMessage( 'Produto inválido', 102 ) : null;

        //Verifica se o mesmo é um inteiro
        !$this->Essential->onlyNumber( $img ) ? $this->Essential->setMessage( 'Imagem inválida', 102 ) : null;

        //Instancia a classe de produtos
        $this->Produtos  =   new objects\Produtos;

        //Atribui o ID do produto
        $this->Produtos->idProduto   =  $idProduto;

        //Verifica se a imagem existe
        !$this->Produtos->imageExists( $img ) ? $this->Essential->setMessage( 'Imagem inválida', 102 ) : null;

        //Atualiza a imagem
        $this->Produtos->setImageDefault( $img );

        //retorna os dados
        $this->Essential->setMessage( 'Imagem atualizada com sucesso', 100 );

    } 

    /**
     * Método deleta imagens do produto
     *
     * @return array json
     * @access PUBLIC
     */
    public function deletarImagensProdutos() {

        //Instancia a classe de produtos
        $this->Produtos  =   new objects\Produtos;

        //recebe o ID do produto
        $idProduto  =   $this->Essential->sqlInjection( $this->input->post( 'idProduto' ) );

        $qtd        =   $this->Essential->sqlInjection( $this->input->post( 'qtd' ) );

        !$this->Essential->onlyNumber( $idProduto ) ? $this->Essential->setMessage( 'Produto inválido', 102 ) : null;

        !$this->Essential->onlyNumber( $qtd ) ? $this->Essential->setMessage( 'Selecione uma ou mais imagens para deletar', 102 ) : null;

        ( $qtd < 1 ) ? $this->Essential->setMessage( 'Selecione uma ou mais imagens para deletar', 102 ) : null;

        ( $qtd > 40 ) ? $this->Essential->setMessage( 'Limite de imagens excedido', 102 ) : null;

        $this->Produtos->idProduto  =  $idProduto;

        !$this->Produtos->produtoExists() ? $this->Essential->setMessage( 'Produto inexistente', 102 ) : null;

        $imagens   =  array();

        for( $i = 0; $i < $qtd; $i++ ) {

            $idImage   =    $this->input->post( 'id' . $i );

            if( is_numeric( $idImage ) ) {

                $imagens[ $i ]  =   $idImage;

            }else {

                $this->Essential->setMessage( 'Imagem de número ' . ( $i + 1 ) . ' inválida', 102 );

            }

        }

        for( $i = 0; $i < count( $imagens ); $i++ ) {

            $id  =  $imagens[ $i ];

            $this->Produtos->deletarImagem( $id );

        }

        //retorna os dados
        $this->Essential->setMessage( 'Imagens deletadas com sucesso', 100 );

    } 

    /**
     * Método deleta produtos
     *
     * @return array json
     * @access PUBLIC
     */
    public function deletarProdutos() {

        //Instancia a classe de produtos
        $this->Produtos  =   new objects\Produtos;

        $qtd    =   $this->Essential->sqlInjection( $this->input->post( 'qtd' ) );

        !$this->Essential->onlyNumber( $qtd ) ? $this->Essential->setMessage( 'Selecione uma ou mais produtos para deletar', 102 ) : null;

        ( $qtd > 4 ) ? $this->Essential->setMessage( 'Você pode deletar apenas 4 produtos por vez', 102 ) : null;

        $produtos   =  array();

        for( $i = 0; $i < $qtd; $i++ ) {

            $id  =   $this->input->post( 'id' . $i );

            if( is_numeric( $id ) ) {

                $produtos[ $i ]  =   $id;

            }else {

                $this->Essential->setMessage( 'Produto de número ' . ( $i + 1 ) . ' inválido', 102 );

            }

        }

        for( $i = 0; $i < count( $produtos ); $i++ ) {

            $this->Produtos->idProduto  =  $produtos[ $i ];

            $this->Produtos->deletarProdutos();

        }

        //retorna os dados
        $this->Essential->setMessage( 'Produtos deletados com sucesso', 100 );

    } 

    /**
     * Método valida os dados do frete com correios
     *
     * @param  FLOAT $peso         -   Peso do produto
     * @param  FLOAT $largura      -   Largura do produto
     * @param  FLOAT $altura       -   Altura do produto
     * @param  FLOAT $comprimento  -   Comprimento do produto
     * @return ARRAY JSON
     * @access PUBLIC
     */
    public function validarFrete() {

        $this->General    =   new extend\General();

        //Recebe os dados via Post
        $peso             =   $this->General->number_format( $this->input->post( 'peso' ) );

        $largura          =   $this->General->number_format( $this->input->post( 'largura' ) );

        $altura           =   $this->General->number_format( $this->input->post( 'altura' ) );

        $comprimento      =   $this->General->number_format( $this->input->post( 'comprimento' ) );

        //Instancia a classe Correios
        $this->Correios   =   new connection\Correios();

        $this->Correios->nVlPeso         =  $peso;

        $this->Correios->nVlLargura      =  $largura;

        $this->Correios->nVlAltura       =  $altura;

        $this->Correios->nVlComprimento  =  $comprimento;

        $this->Correios->prepareData();

        $response           =   $this->Correios->getFrete();

        $this->xmlParser    =   new parser\Xml( $response );

        !$this->xmlParser->isXml() ? $this->Essential->setMessage( 'Ocorreu um erro ao consultar o Frete' ) : null;

        $response           =   $this->xmlParser->toArray();

        $result             =   array('Valor' => '', 'error' => '' );

        if( is_array( $response ) ) {

            $error                   =   $this->Correios->getError( $response['cServico']['Erro'] );

            $result['Valor']         =   $response['cServico']['Valor'];

            $result['Error']         =   is_bool( $error ) ? 'Nenhum' : $error;

        }else {

            $result  =  array( 'error' => 'Sistema indisponível' );

        }

        echo json_encode( $result );

        exit;

    } 

    /**
     * Método salva os dados do estoque do produto
     *
     * @param  FLOAT $qtd         -   Quantidade disponível em estoque
     * @param  FLOAT $qtdMin      -   Quantidade mínima em estoque
     * @param  FLOAT $qtdMax      -   Quantidade máxima em estoque
     * @param  INT   $idProduto   -   ID do produto
     * @return ARRAY JSON
     * @access PUBLIC
     */
    public function salvarEstoque() {

        //Instancia a classe General
        $this->General   =   new extend\General();

        //Instancia a classe de produtos
        $this->Produtos  =   new objects\Produtos;

        //Recebe os dados via Post
        $qtd             =   $this->General->number_format( $this->input->post( 'qtd' ) );

        $qtdMin          =   $this->General->number_format( $this->input->post( 'qtdMin' ) );

        $qtdMax          =   $this->General->number_format( $this->input->post( 'qtdMax' ) );

        $idProduto       =   $this->input->post( 'idProduto' );

        //Verifica se o ID do produto é um número válido
        !is_numeric( $idProduto )  ? $this->Essential->setMessage( 'Produto inválido' ) : null;

        //Seta o ID do produto
        $this->Produtos->idProduto  =  $idProduto;

        //Verifica se o produto existe em banco de dados
        !$this->Produtos->produtoExists() ? $this->Essential->setMessage( 'Produto inválido' ) : null;

        //Atualiza os dados do estoque
        $this->Produtos->gravarEstoque( $qtd, $qtdMin, $qtdMax, true );

        //Envia a mensagem para o usuário
        $this->Essential->setMessage( 'Editado com sucesso', 100 );

    } 

    /**
     * Método obtem todos os dados do estoque
     *
     * @param  INT   $idProduto  -  ID do produto a se obter o estoque
     * @return ARRAY JSON
     * @access PUBLIC
     */
    public function gestEstoque() {

        //Instancia a classe de produtos
        $this->Produtos  =   new objects\Produtos;

        $idProduto       =   $this->input->post( 'id' );

        //Verifica se o ID do produto é um número válido
        !is_numeric( $idProduto )  ? $this->Essential->setMessage( 'Produto inválido' ) : null;

        //Seta o ID do produto
        $this->Produtos->idProduto  =  $idProduto;

        //Declara o array que vamos retornar os dados
        $result   =   array();

        //Ontem os dados do estoque
        $result   =   $this->Produtos->getEstoque();

        //Retorna os dados
        echo json_encode( $result );

    }

    /**
     * Método salva os dados do local
     *
     * @param  STRING $empresa     -   Nome da empresa
     * @param  STRING $endereco    -   Endereço onde a empresa está localizada
     * @return ARRAY JSON
     * @access PUBLIC
     */
    public function salvarLocal() {

        //Instancia a classe de produtos
        $this->Produtos  =   new objects\Produtos;

        //Recebe os dados via Post
        $empresa         =   $this->Essential->sqlInjection( $this->input->post( 'empresa' ) );

        $endereco        =   $this->Essential->sqlInjection( $this->input->post( 'endereco' ) );

        //Valida os campos
        $this->Essential->verify( $empresa, 'Preencha o nome da empresa', 'empty' );

        $this->Essential->verify( $endereco, 'Preencha o endereço da empresa', 'empty' );

        //Grava o local
        $this->Produtos->gravarLocal( $empresa, $endereco );

        //Envia a mensagem para o usuário
        $this->Essential->setMessage( 'Local adicionado com sucesso', 100 );

    }

    /**
     * Método salva os dados do local
     *
     * @param  STRING $empresa     -   Nome da empresa
     * @param  STRING $endereco    -   Endereço onde a empresa está localizada
     * @return ARRAY JSON
     * @access PUBLIC
     */
    public function salvarEdicaoLocal() {

        //Instancia a classe de produtos
        $this->Produtos  =   new objects\Produtos;

        //Recebe os dados via Post
        $empresa         =   $this->Essential->sqlInjection( $this->input->post( 'empresa' ) );

        $endereco        =   $this->Essential->sqlInjection( $this->input->post( 'endereco' ) );

        $idLocal         =   $this->input->post( 'idLocal' );

        //Valida os campos
        !is_numeric( $idLocal ) ? $this->Essential->setMessage( 'Local inválido', 102 ) : null;

        $this->Essential->verify( $empresa, 'Preencha o nome da empresa', 'empty' );

        $this->Essential->verify( $endereco, 'Preencha o endereço da empresa', 'empty' );

        //Grava o local
        $this->Produtos->gravarLocal( $empresa, $endereco, $idLocal, true );

        //Envia a mensagem para o usuário
        $this->Essential->setMessage( 'Local adicionado com sucesso', 100 );

    }

    /**
     * Método salva os dados do local
     *
     * @param  STRING $id  -   ID do local
     * @return ARRAY JSON
     * @access PUBLIC
     */
    public function getLocal() {

        //Instancia a classe de produtos
        $this->Produtos  =   new objects\Produtos;

        //Recebe os dados via Post
        $idLocal         =   $this->input->post( 'id' );

        !is_numeric( $idLocal ) ? $this->Essential->setMessage( 'Local inválido', 102 ) : null;

        //Declara o array que será retornado
        $result   =   array();

        //Obtem os dados
        $result   =   $this->Produtos->getLocais( $idLocal );

        //Verifica se o local foi retornado
        count( $result ) != 1  ? $this->Essential->setMessage( 'Local inválido', 102 ) : null;

        //Retorna os dados
        echo json_encode( $result );

        exit;

    }

    public function importarProdutoMercadoLivre() {

        $idProduto       =   $this->input->post( 'idProduto' );

        $this->Produtos  =   new objects\Produtos;

        $this->sdkML     =   new mercadolivre\Meli('5915910393877890', '4DCXLjqty8bAKvhX4iXsurlO4yo84vvl', '', '');

        $response        =   $this->sdkML->allowAccess();        

        if( $response[ 'error' ] ) {

            $this->Essential->setMessage( $response[ 'message' ], 102 );

        }else {

            $item  =  '/items/MLB' . $idProduto;

            $data  =  json_decode( json_encode( $this->sdkML->get( $item, array() ) ), True);

            if( isset( $data['body'] ) ) {

                $response  =   $this->Produtos->importarProduto( $data );

                if( $response ) {

                    $this->Essential->setMessage( 'Produto importado com sucesso', 100 );

                }else {

                    $this->Essential->setMessage( 'Produto já importado', 102 );

                }

            }else {

                $this->Essential->setMessage( 'Ocorreu um erro ao tentar importar o produto', 102 );

            }

        }

    }

    public function enviarProduto() {

        $this->Produtos   =   new objects\Produtos;

        $id               =   $this->input->post( 'id' );

        $categoria        =   $this->input->post( 'subcat' );

        if( !is_numeric( $categoria ) ) {

            $this->Essential->setMessage( 'Selecione uma Sub Categoria', 102 );

        }

        $this->Produtos->idProduto  =  $id;

        !is_numeric( $id ) ? $this->Essential->setMessage( 'Produto inválido', 102 ) : NULL;        

        !$this->Produtos->produtoExists() ? $this->Essential->setMessage( 'Produto inválido', 102 ) : NULL;

        //Recebe o produto já formatado para enviar para o ML
        $data  =  $this->Produtos->prepareToMercadoLivre( $categoria );

        //print_r( $data ); exit;

        //Inicializa a classe do Mercado Livre
        $this->sdkML  =   new mercadolivre\Meli('5915910393877890', '4DCXLjqty8bAKvhX4iXsurlO4yo84vvl', '', '');

        //Tenta realizar a autenticação no Mercado Livre
        $response     =   $this->sdkML->allowAccess();

        //Verifica se houve algum erro
        if( $response[ 'error' ] ) {

            //Com o erro, envia o erro para o usuário
            $this->Essential->setMessage( $response[ 'message' ], 102 );

        }else {

            //Tenta enviar o produto para o Mercado Livre
            $response  =   $this->sdkML->post('/items', $data, array('access_token' => $_SESSION['access_token']));

            //print_r( $response ); exit;

            $response  =   json_decode( json_encode( $response ), True);

            if( isset( $response['body']['message'] ) ) {

                $this->Essential->setMessage( 'ERRO: ' . $response['body']['message'], 102 );

            }else {

                $this->Essential->setMessage( 'Produto enviado com sucesso', 100 );

            }

        }

    }

    public function getCatML() {

        $this->Produtos   =   new objects\Produtos;

        $data  =  $this->Produtos->getCatML();

        echo json_encode( $data );

    }

    public function getSubCatML() {

        $this->Produtos    =   new objects\Produtos;

        $id                =   $this->input->post( 'id' );

        !is_numeric( $id ) ?   $this->Essential->setMessage( 'Selecione uma categoria válida', 102 ) : NULL;

        $data              =   $this->Produtos->getSubCatML( $id );

        echo json_encode( $data );

    }

}

















