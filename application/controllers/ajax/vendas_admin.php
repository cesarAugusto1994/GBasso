<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendas_admin extends CI_Controller {

    private $Header     =  null;

    private $Essential  =  null;

    private $Login      =  null;

    private $Vendas     =  null;

    private $Correios   =  null;

    private $Usuarios   =  null;

	public function __construct() {

        parent::__construct();        

        //Instacia a classe Essential do package Security
        $this->Essentials =   new security\Essentials;

        //Instacia a classe Essential do package Security
        $this->Header     =   new data\Header_admin( base_url() );

        //Instancia a classe login
        $this->Login      =   new sessions\Login;

        //Instancia a classe login
        $this->Vendas     =   new objects\Vendas;

        //Load data admin
        $this->Login->loadDataAdmin();

        //Login expirou por algum motivo, um código de erro difernete será enviado e a popup de login será chamada
        if( !$this->Login->checkSessionAdmin() ) $this->Essentials->setMessage( 'Faça login novamente', 103 );

    }


    /**
     * Método realiza o rastreio de uma venda e obtem os dados desse rastreio
     *
     * @param   INT   $id  -  ID da venda
     * @return  ARRAY JSON
     * @access  PUBLIC
     */
    public function getInfoRastreio() {

        //Obtem o ID da venda
        $idVenda   =    $this->input->post( 'id' );

        //Verifica se o ID da venda é um ID válido
        !is_numeric( $idVenda ) ?  $this->Essentials->setMessage( 'Venda inválida' ) : null;

        //Seta o ID da venda
        $this->Vendas->idVenda  =   $idVenda;

        //Obtem o código de rastreio
        $this->Vendas->getCodeRastreio();

        //Verifica se o código de rastreamento é válido
        is_bool( $this->Vendas->codeRastreio ) || is_null( $this->Vendas->codeRastreio ) ? $this->Essentials->setMessage( 'Venda não possui código de rastreamento' ) : null;

        //Instancia a classe do Correios
        $this->Correios  =   new connection\Correios();

        //Seta o código de rastreamento
        $this->Correios->codeRastreio  =  $this->Vendas->codeRastreio;

        //Obtem os dados de rastreio
        $result   =   $this->Correios->rastrear();

        //print_r( $result ); exit;

        //Retorna os dados
        echo json_encode( $result );

    }


    /**
     * Método realiza o rastreio de uma venda e obtem os dados desse rastreio
     *
     * @param   INT   $id  -  ID da venda
     * @return  ARRAY JSON
     * @access  PUBLIC
     */
    public function setCodigoRastreamento() {

        //Obtem o ID da venda
        $idVenda   =   $this->input->post( 'id' );

        $code      =   $this->input->post( 'code' );

        //Verifica se o ID da venda é um ID válido
        !is_numeric( $idVenda ) ?  $this->Essentials->setMessage( 'Venda inválida' ) : null;

        //Verifica se o código é válido
        !$this->Essentials->onlyAlphaNumeric( $code ) ? $this->Essentials->setMessage( 'Código inválido' ): null;

        //Seta o ID da venda
        $this->Vendas->idVenda       =   $idVenda;

        //Seta o código de rastreio
        $this->Vendas->codeRastreio  =   $code;

        //Verifica se a venda existe
        !$this->Vendas->vendaExists() ? $this->Essentials->setMessage( 'Venda inválida' ): null;

        //Obtem a referencia da venda
        $this->Vendas->getReferenciaByVenda();

        //Atualiza a venda
        $this->Vendas->gravarVenda( '', '', true, true );

        //Envia a mensagem para o usuário
        $this->Essentials->setMessage( 'Venda atualizada com sucesso', 100 );

    }


    /**
     * Método obtem todos os dados da venda, comprador, produtos e endereço de entrega
     *
     * @param   INT   $id  -  ID da venda
     * @return  ARRAY JSON
     * @access  PUBLIC
     */
    public function getInfoVendas() {

        //Instancia a classe Usuários
        $this->Usuarios   =   new objects\Usuarios();

        //Obtem o ID da venda
        $idVenda          =   $this->input->post( 'id' );

        //Verifica se o ID da venda é um ID válido
        !is_numeric( $idVenda ) ?  $this->Essentials->setMessage( 'Venda inválida' ) : null;

        //Seta o ID da venda
        $this->Vendas->idVenda   =   $idVenda;

        //Verifica se a venda existe
        !$this->Vendas->vendaExists() ? $this->Essentials->setMessage( 'Venda inválida' ): null;

        //Declara o array que vamos retornar
        $result   =   array();

        //Obtem a referencia da venda
        $this->Vendas->getReferenciaByVenda();

        //Faz o load do ID da venda
        $this->Vendas->getIDUsuario();

        //Obtem o ID do endereço
        $this->Vendas->getIDEndereco();

        //Seta o ID do usuário
        $this->Usuarios->idUsuario   =  $this->Vendas->idUsuario;

        //Seta o ID do endereco
        $this->Usuarios->idEndereco  =  $this->Vendas->idEndereco;

        //Obtem os produtos da venda
        $result['produtos']   =    $this->Vendas->getProdutosCompra();

        //Obtem o nome
        $result['nome']       =    $this->Usuarios->getFullName();

        //Obtem o email
        $result['email']      =    $this->Usuarios->getEmail(); 

        //Obtem o cpf
        $result['cpf']        =    $this->Essentials->maskCpf( $this->Usuarios->getCpf() );

        //Obtem o endereço de entrega
        $result['endereco']   =    $this->Usuarios->getAllEndereco();

        //Obtem o endereço de entrega
        $result['servico']    =    $this->Vendas->getServico();

        //Seta o código de retorno
        $result['code']       =    100;

        echo json_encode( $result );

    }

    public function getProdutos()
    {
        $this->Carrinho = new sessions\Carrinho;

        $produtos                       =   $this->Carrinho->getProdutos();

        //$produtos                       =   $this->Produtos->getProdutosByCart( $produtos );

        //$total                          =   $this->Carrinho->getTotal();

        return $produtos;
    }


    public function pagamentoBoleto()
    {
        var_dump($produtos);
    }

}    

















