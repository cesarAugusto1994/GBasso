<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuracoes_admin extends CI_Controller {

    private $Essentials  =  null;

    private $idUsuario   =  null;

    private $Login       =  null;

    private $Dates       =  null;

    private $Config      =  null;

    private $General     =  null;
    
	public function __construct() {

        parent::__construct();        

        //Instacia a classe Essential do package Security
        $this->Essentials  =   new security\Essentials;

        //Instancia a classe usuarios
        $this->Usuarios    =   new objects\Usuarios();

        //Instancia a classe do Login
        $this->Login       =   new sessions\Login(2);

        //Load data admin
        $this->Login->loadDataAdmin();

        //Login expirou por algum motivo, um código de erro difernete será enviado e a popup de login será chamada
        if( !$this->Login->checkSessionAdmin() ) $this->Essentials->setMessage( 'Faça login novamente', 103 );

    }


    /**
     * Método salva o valor adicional para frete
     *
     * @param  NULL
     * @return ARRAY JSON 
     * @access PUBLIC
     */
    public function valorAdicionalFrete() {

        //Instancia a classe general
        $this->General            =   new extend\General();

        //Instancia a classe de configurações
        $this->Config             =   new objects\Configuracoes();

        //Obtem o valor adicional para o frete
        $valor                    =   $this->input->post( 'valor' );

        //Formata o valor
        $valor                    =   $this->General->number_format( $valor );

        //Seta o valor na classe
        $this->Config->valor      =   $valor;

        //Seta o ID da configuração
        $this->Config->idConfig   =   1;

        //Grava a configuração
        $this->Config->gravarConfiguracao();

        //Envia a mensagem para o usuário
        $this->Essentials->setMessage( 'Gravado com sucesso', 100 );

    }


    /**
     * Método salva o valor adicional para frete
     *
     * @param  NULL
     * @return ARRAY JSON 
     * @access PUBLIC
     */
    public function valorMinFrete() {

        //Instancia a classe general
        $this->General            =   new extend\General();

        //Instancia a classe de configurações
        $this->Config             =   new objects\Configuracoes();

        //Obtem o valor adicional para o frete
        $valor                    =   $this->input->post( 'valor' );

        //Formata o valor
        $valor                    =   $this->General->number_format( $valor );

        //Seta o valor na classe
        $this->Config->valor      =   $valor;

        //Seta o ID da configuração
        $this->Config->idConfig   =   2;

        //Grava a configuração
        $this->Config->gravarConfiguracao();

        //Envia a mensagem para o usuário
        $this->Essentials->setMessage( 'Gravado com sucesso', 100 );

    }


    /**
     * Método salva o valor adicional para frete
     *
     * @param  NULL
     * @return ARRAY JSON 
     * @access PUBLIC
     */
    public function numeroParcelasSemJuros() {

        //Instancia a classe de configurações
        $this->Config             =   new objects\Configuracoes();

        //Obtem o valor adicional para o frete
        $valor                    =   $this->input->post( 'valor' );

        //Verifica se o valor é inteiro
        !is_numeric( $valor )  ?  $this->Essentials->setMessage( 'O valor da parcela deve ser um número inteiro' ) : null;

        //Verifica se o valro está entre 0 e 12
        $valor < 0 || $valor > 12 ?  $this->Essentials->setMessage( 'O valor da parcela deve estar entre 0 e 12' ) : null;

        //Seta o valor na classe
        $this->Config->valor      =   $valor;

        //Seta o ID da configuração
        $this->Config->idConfig   =   2;

        //Grava a configuração
        $this->Config->gravarConfiguracao();

        //Envia a mensagem para o usuário
        $this->Essentials->setMessage( 'Gravado com sucesso', 100 );

    }


    /**
     * Método salva o cep de origem, o CEP de origem será usado para gerar o valor do frete
     *
     * @param  STRING $valor  -  Cep de origem 
     * @return ARRAY JSON 
     * @access PUBLIC
     */
    public function cepOrigem() {

        //Instancia a classe general
        $this->General            =   new extend\General();

        //Instancia a classe de configurações
        $this->Config             =   new objects\Configuracoes();

        //Obtem o valor do cep
        $cep                      =   $this->input->post( 'cep' );

        //Obtem somente os inteiros
        $cep                      =   preg_replace('/\D/', '', $cep);

        //Verifica se o cep tem 8 caracteres
        strlen( $cep ) != 8 ?  $this->Essentials->setMessage( 'Cep inválido' ) : null; 

        //Seta o valor na classe
        $this->Config->valor      =   $cep;

        //Seta o ID da configuração
        $this->Config->idConfig   =   4;

        //Grava a configuração
        $this->Config->gravarConfiguracao();

        //Envia a mensagem para o usuário
        $this->Essentials->setMessage( 'Gravado com sucesso', 100 );

    }

}    

















