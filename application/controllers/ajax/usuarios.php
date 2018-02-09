<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    private $Essentials  =  null;

    private $idUsuario   =  null;

    private $Usuarios    =  null;

    private $Login       =  null;

    private $Dates       =  null;

    private $Vendas      =  null;

	public function __construct() {

        parent::__construct();

        //Instacia a classe Essential do package Security
        $this->Essentials  =   new security\Essentials;

        //Instancia a classe usuarios
        $this->Usuarios    =   new objects\Usuarios();

        //Instancia a classe do Login
        $this->Login       =   new sessions\Login(2);

        //Obtem os segmentos da URL
        $segmento          =   substr( trim( $this->uri->slash_segment( 4 ) ), 0, -1 );

        //Verifica se as páginas acessadas não é a login e nem a de cadastro, dai verifica se o usuário está logado
        if( $segmento != 'cadastrar' && $segmento != 'logar' ) {

            !$this->Login->checkLogin() ? $this->Essentials->setMessage( 'Faça login novamente', 101 ) : null;

            $this->idUsuario   =   $this->Login->getIdUser();

        }

    }


    /**
    * Método cadastra um usuário em banco de dados
    *
    * @param  NULL
    * @return ARRAY JSON
    * @access PUBLIC
    **/
    public function cadastrar() {

        $this->Dates  =   new extend\Dates;

        //Recebe os dados via POST
        $nome         =   $this->Essentials->sqlInjection( $this->input->post( 'nome' ) );

        $sobrenome    =   $this->Essentials->sqlInjection( $this->input->post( 'sobrenome' ) );

        $cpf          =   $this->Essentials->sqlInjection( $this->input->post( 'cpf' ) );

        $sexo         =   $this->Essentials->sqlInjection( $this->input->post( 'sexo' ) );

        $dataNasc     =   $this->Essentials->sqlInjection( $this->input->post( 'dataNasc' ) );

        $email        =   $this->Essentials->sqlInjection( $this->input->post( 'email' ) );

        $tipoPessoa        =    $this->Essentials->sqlInjection( $this->input->post( 'tipo' ) );

        $celular        =    $this->Essentials->sqlInjection( $this->input->post( 'telefone_celular' ) );
        $telefonePrincipal = $this->Essentials->sqlInjection( $this->input->post( 'telefone_principal' ) );
        $telefoneComercial = $this->Essentials->sqlInjection( $this->input->post( 'telefone_comercial' ) );

        $destinatario =   $this->Essentials->sqlInjection( $this->input->post( 'nome' ) );

        $ptReferencia =   $this->Essentials->sqlInjection( $this->input->post( 'pontoReferencia' ) );

        $cep          =   $this->Essentials->sqlInjection( $this->input->post( 'cep' ) );

        $endereco     =   $this->Essentials->sqlInjection( $this->input->post( 'endereco' ) );

        $bairro       =   $this->Essentials->sqlInjection( $this->input->post( 'bairro' ) );

        $numero       =   $this->Essentials->sqlInjection( $this->input->post( 'numero' ) );

        $comple       =   $this->Essentials->sqlInjection( $this->input->post( 'comple' ) );

        $user         =   $this->Essentials->sqlInjection( $this->input->post( 'email' ) );

        $senha        =   $this->Essentials->sqlInjection( $this->input->post( 'pass' ) );

        $reSenha      =   $this->Essentials->sqlInjection( $this->input->post( 'rePass' ) );

        $this->Essentials->verify( $nome, 'Preencha o campo Nome', 'empty' );

        //$this->Essentials->verify( $sobrenome, 'Preencha o campo Sobrenome', 'empty' );

        $this->Essentials->verify( $cpf, 'Preencha o campo Cpf', 'empty' );

        $this->Essentials->verify( $sexo, 'Selecione uma opção de Sexo', 'empty' );

        $this->Essentials->verify( $dataNasc, 'Preencha o campo Data de nascimento', 'empty' );

        $this->Essentials->verify( $email, 'Preencha o campo E-mail', 'empty' );

        $cep  =  preg_replace('/\D/', '', $cep );

        $cpf  =  preg_replace('/\D/', '', $cpf );

        if( trim( $cep ) != '' ) {

            $this->Essentials->verify( $destinatario, 'Preencha o campo Destinatário', 'empty' );

            $this->Essentials->verify( $ptReferencia, 'Preencha o campo Ponto de Referência', 'empty' );

            strlen( $cep ) != 8 ? $this->Essentials->setMessage( 'CEP inválido' ) : null;

            $this->Essentials->verify( $endereco, 'Preencha o campo Endereço', 'empty' );

            $this->Essentials->verify( $bairro, 'Preencha o campo Bairro', 'empty' );

            $this->Essentials->verify( $numero, 'Preencha o campo Número', 'empty' );

        }

        $this->Essentials->verify( $user, 'Preencha o campo Usuário', 'empty' );

        $this->Essentials->verify( $senha, 'Preencha o campo Senha', 'empty' );

        $this->Essentials->verify( $reSenha, 'Preencha o campo Repita a senha', 'empty' );

        if( strlen( $senha ) < 6 && strlen( $reSenha ) < 6 ) {

            $this->Essentials->setMessage( 'Senha deve conter no mínimo 6 caracteres', 102 );

        }else if( strcmp($senha, $reSenha) != 0 ) {

            $this->Essentials->setMessage( 'Senhas não conferem', 102 );

        }

        !$this->Essentials->validarCPF( $cpf ) ? $this->Essentials->setMessage( 'CPF inválido', 102 ) : null;

        !$this->Essentials->validEmail( $email ) ? $this->Essentials->setMessage( 'E-mail inválido', 102 ) : null;

        !$this->Essentials->validateDate( $dataNasc ) ? $this->Essentials->setMessage( 'Data inválida', 102 ) : null;

        $this->Usuarios->email  =  $email;

        $this->Usuarios->cpf    =  $cpf;

        $this->Usuarios->cpfExists()   ? $this->Essentials->setMessage( 'CPF existente', 102 )    : null;

        $this->Usuarios->emailExists() ? $this->Essentials->setMessage( 'E-mail existente', 102 ) : null;

        (strcmp($email, $user) != 0 ) ? $this->Essentials->setMessage( 'O e-mail deve ser igual ao usuário', 102 ) : null;

        $dataNasc               =  $this->Dates->format( $dataNasc );

        $this->Usuarios->gravarUsuario( $nome, $sobrenome, $sexo, $dataNasc, false, $tipoPessoa, $celular, $telefonePrincipal, $telefoneComercial );

        if( strlen( $cep ) == 8 ) {

            $this->Usuarios->cep  =  $cep;

            $this->Usuarios->getIDUsuario();

            $this->Usuarios->gravarEndereco( 1, $destinatario, $ptReferencia, $endereco, $bairro, $numero, $comple, 1 );

        }

        $senha  =  $this->Essentials->maskPassword( $senha );

        //Get ID usuário
        $this->Usuarios->getIDUsuario();

        $this->Usuarios->gravarLogin( $email, $senha, 1, 1 );

        $this->Essentials->setMessage( 'Cadastrado com sucesso', 100 );

    }


    /**
    * Método cadastra um usuário em banco de dados
    *
    * @param  NULL
    * @return ARRAY JSON
    * @access PUBLIC
    **/
    public function logar() {

        //Recebe os dados via POST
        $user    =    $this->Essentials->sqlInjection( $this->input->post( 'email' ) );

        $pass    =    $this->Essentials->sqlInjection( $this->input->post( 'pass' ) );

        !$this->Essentials->validEmail( $user ) ? $this->Essentials->setMessage( 'Usuário ou senha inválido', 102 ) : null;

        $pass < 6 ? $this->Essentials->setMessage( 'Usuário ou senha inválido', 102 ) : null;

        $pass      =    $this->Essentials->maskPassword( $pass );

        $response  =    $this->Login->logIn( $user, $pass );

        if( $response ) {

            $message   =   'Redirecionando';

            $code      =   100;

        }else {

            $message   =   'Usuário ou senha inválido';

            $code      =   102;

        }

        $this->Essentials->setMessage( $message, $code );

    }


    /**
    * Método obtem todas as compras do usuários
    *
    * @param  NULL
    * @return ARRAY JSON
    * @access PUBLIC
    **/
    public function getCompras() {

        //Instancia a classe do usuário
        $this->Vendas              =   new objects\Vendas();

        //Seta o ID do usuário na classe Vendas
        $this->Vendas->idUsuario   =   $this->idUsuario;

        //Inicializa o array principal que vamos retornar os dados
        $result           =   array();

        //Inicializa o array que vai conter todos os dados das vendas
        $result['data']   =   array();

        //Seta o código de sucesso
        $result['code']   =   100;

        //Obtem todas as vendas
        $result['data']   =   $this->Vendas->getCompras();

        //Retorna todos os dados
        echo json_encode( $result ); exit;

    }


    /**
    * Método obtem todos os dados de uma detemrinada venda
    *
    * @param  INT  $ref  -   Referência da venda
    * @return ARRAY JSON
    * @access PUBLIC
    **/
    public function getDetalheCompra() {

        //Instancia a classe do usuário
        $this->Vendas   =   new objects\Vendas();

        //Seta o ID do usuário na classe Vendas
        $this->Vendas->idUsuario   =   $this->idUsuario;

        //Recebe a referencia da venda
        $ref              =   $this->input->post( 'ref' );

        //Verifica se a referência é válida
        !$this->Essentials->onlyNumber( $ref ) ? $this->Essentials->setMessage( 'Referência inválida', 102 ) : null;

        //Inicializa o array principal que vamos retornar os dados
        $result           =   array();

        //Inicializa o array que vai conter todos os dados das vendas
        $result['data']   =   array();

        //Seta o código de sucesso
        $result['code']   =   100;

        //Seta a referencia na classe Vendas
        $this->Vendas->referencia   =   $ref;

        //Resgata o ID da venda
        $response                   =   $this->Vendas->getIDVenda();

        //Verifica se o ID da venda foi retornado
        !$response  ?  $this->Essentials->setMessage( 'Compra não encontrada', 102 ) : null;

        //Obtem todas as vendas
        $result['data']             =   $this->Vendas->getDetalheCompra();

        //Obtem todas os produtos da venda
        $result['prod']             =   $this->Vendas->getProdutosCompra();

        //Retorna todos os dados
        echo json_encode( $result ); exit;

    }


    /**
    * Método atualiza os dados cadastrais de um usuário
    *
    * @param  STRING $nome       -   Nome do usuário
    * @param  STRING $sobrenome  -   Sobre nome do usuário
    * @param  STRING $cpf        -   CPF do usuário
    * @param  INT    $sexo       -   Sexo do usuário
    * @param  DATE   $dataNasc   -   Data de nascimento do usuário
    * @param  STRING $email      -   Email do usuário
    * @param  STRING $user       -   Nome de usuário que é o próprio email
    * @param  STRING $pass       -   Senha do usuário
    * @param  STRING $rePass     -   Senha do usuário digitada novamente
    * @return ARRAY JSON
    * @access PUBLIC
    **/
    public function atualizarUsuario() {

        $this->Dates  =   new extend\Dates;

        //Recebe os dados via POST
        $nome         =   $this->Essentials->sqlInjection( $this->input->post( 'nome' ) );

        $sobrenome    =   $this->Essentials->sqlInjection( $this->input->post( 'sobrenome' ) );

        $cpf          =   $this->Essentials->sqlInjection( $this->input->post( 'cpf' ) );

        $sexo         =   $this->Essentials->sqlInjection( $this->input->post( 'sexo' ) );

        $dataNasc     =   $this->Essentials->sqlInjection( $this->input->post( 'dataNasc' ) );

        $email        =   $this->Essentials->sqlInjection( $this->input->post( 'email' ) );

        $user         =   $this->Essentials->sqlInjection( $this->input->post( 'user' ) );

        $senha        =   $this->Essentials->sqlInjection( $this->input->post( 'pass' ) );

        $reSenha      =   $this->Essentials->sqlInjection( $this->input->post( 'rePass' ) );

        $this->Essentials->verify( $nome, 'Preencha o campo Nome', 'empty' );

        $this->Essentials->verify( $sobrenome, 'Preencha o campo Sobrenome', 'empty' );

        $this->Essentials->verify( $cpf, 'Preencha o campo Cpf', 'empty' );

        $this->Essentials->verify( $sexo, 'Selecione uma opção de Sexo', 'empty' );

        $this->Essentials->verify( $dataNasc, 'Preencha o campo Data de nascimento', 'empty' );

        $this->Essentials->verify( $email, 'Preencha o campo E-mail', 'empty' );

        $this->Essentials->verify( $user, 'Preencha o campo Usuário', 'empty' );

        $this->Usuarios->idUsuario  =   $this->idUsuario;

        if( strlen( $senha ) != 0 || strlen( $reSenha ) != 0 ) {

            if( strlen( $senha ) < 6 && strlen( $reSenha ) < 6 ) {

                $this->Essentials->setMessage( 'Senha deve conter no mínimo 6 caracteres', 102 );

            }else if( strlen( trim( $senha ) ) == 0 ) {

                $this->Essentials->setMessage( 'Preencha o campo Senha', 102 );

            }else if( strlen( trim( $reSenha ) ) == 0 ) {

                $this->Essentials->setMessage( 'Preencha o campo Repita a Senha', 102 );

            }else if( strcmp($senha, $reSenha) != 0 ) {

                $this->Essentials->setMessage( 'Senhas não conferem', 102 );

            }

        }

        !$this->Essentials->onlyNumber( $cpf )  ? $this->Essentials->setMessage( 'CPF inválido', 102 ) : null;

        !$this->Essentials->validarCPF( $cpf ) ? $this->Essentials->setMessage( 'CPF inválido', 102 ) : null;

        !$this->Essentials->validEmail( $email ) ? $this->Essentials->setMessage( 'E-mail inválido', 102 ) : null;

        !$this->Essentials->validateDate( $dataNasc ) ? $this->Essentials->setMessage( 'Data inválida', 102 ) : null;

        (strcmp($email, $user) != 0 ) ? $this->Essentials->setMessage( 'O e-mail deve ser igual ao usuário', 102 ) : null;

        $dataNasc               =  $this->Dates->format( $dataNasc );

        $this->Usuarios->email  =  $email;

        $this->Usuarios->cpf    =  preg_replace( '/\D/', '', $cpf );

        $this->Usuarios->cpfExists()   ? $this->Essentials->setMessage( 'CPF existente', 102 )    : null;

        $this->Usuarios->emailExists() ? $this->Essentials->setMessage( 'E-mail existente', 102 ) : null;

        $this->Usuarios->gravarUsuario( $nome, $sobrenome, $sexo, $dataNasc, true );

        if( strlen( $senha ) != 0 ) {

            $senha  =  $this->Essentials->maskPassword( $senha );

            $this->Usuarios->gravarLogin( $email, $senha, 1, 1, true );

        }

        $this->Essentials->setMessage( 'Cadastrado com sucesso', 100 );

    }


    /**
    * Método obtem o o endereço completo com base no CEP
    *
    * @param  NULL
    * @return ARRAY JSON
    * @access PUBLIC
    **/
    public function getCep() {

        //Recebe o cep via POST
        $cep                  =   $this->input->post( 'cep' );

        //Verifica se é um CEP válido
        !$this->Essentials->onlyNumber( $cep ) ? $this->Essentials->setMessage( 'Cep inválido' ) : null;

        //Seta o cep na classe usuários
        $this->Usuarios->cep  =   $cep;

        //Obtem o endereço
        $result               =   $this->Usuarios->getFullEndereco();

        //Retorna os dados
        echo json_encode( $result ); exit;

    }


    /**
    * Método obtem o o endereço completo com base no CEP
    *
    * @param  INT id - ID do endereço
    * @return ARRAY JSON
    * @access PUBLIC
    **/
    public function getEnderecoById() {

        //Recebe o cep via POST
        $id   =   $this->input->post( 'id' );

        //Verifica se é um CEP válido
        !$this->Essentials->onlyNumber( $id ) ? $this->Essentials->setMessage( 'Endereço inválido' ) : null;

        //Seta o cep na classe usuários
        $this->Usuarios->idEndereco  =   $id;

        $this->Usuarios->idUsuario   =   $this->idUsuario;

        //Obtem o CEP com base no ID do endereço
        $response  =  $this->Usuarios->getCepById();

        //Verifica o retorno
        !$response  ?  $this->Essentials->setMessage( 'Endereço inválido' ) : null;

        //Obtem o endereço
        $result    =   $this->Usuarios->getAllEndereco();

        //Retorna os dados
        echo json_encode( $result ); exit;

    }


    /**
    * Método salva um novo endereço
    *
    * @param  INT    $cep
    * @param  STRING $endereco
    * @param  STRING $bairro
    * @param  STRING $numero
    * @param  STRING $comple
    * @return ARRAY JSON
    * @access PUBLIC
    **/
    public function salvarEndereco() {

        //Recebe os parametros via POST
        $destinatario   =   $this->Essentials->SqlInjection( $this->input->post( 'destinatario' ) );

        $ptReferencia   =   $this->Essentials->SqlInjection( $this->input->post( 'pontoReferencia' ) );

        $principal      =   isset( $_POST['principal'] ) ? 1 : 0;

        $cep            =   $this->Essentials->SqlInjection( $this->input->post( 'cep' ) );

        $endereco       =   $this->Essentials->SqlInjection( $this->input->post( 'endereco' ) );

        $bairro         =   $this->Essentials->SqlInjection( $this->input->post( 'bairro' ) );

        $numero         =   $this->Essentials->SqlInjection( $this->input->post( 'numero' ) );

        $comple         =   $this->Essentials->SqlInjection( $this->input->post( 'comple' ) );

        $cep            =   preg_replace('/-/', '', $cep);

        $this->Essentials->verify( $destinatario, 'Preencha o campo Destinatário', 'empty' );

        $this->Essentials->verify( $ptReferencia, 'Preencha o campo Ponto de Referência', 'empty' );

        //Valida o cep
        !$this->Essentials->onlyNumber( $cep ) ? $this->Essentials->setMessage( 'Cep inválido' ) : null;

        strlen( $cep ) != 8 ? $this->Essentials->setMessage( 'Cep inválido' ) : null;

        $this->Essentials->verify( $endereco, 'Preencha o campo endereço', 'empty' );

        $this->Essentials->verify( $bairro, 'Preencha o campo bairro', 'empty' );

        $this->Essentials->verify( $numero, 'Preencha o campo número', 'empty' );

        $this->Essentials->verify( $comple, 'Preencha o campo complemento', 'empty' );

        //Seta o cep na classe $cep
        $this->Usuarios->cep         =   $cep;

        $this->Usuarios->idUsuario   =   $this->idUsuario;

        //Verifica se o endereço existe
        $response  =  $this->Usuarios->enderecoExists( $numero, $comple );

        //Verifica o retorno
        $response  ?  $this->Essentials->setMessage( 'Endereço já existe em sua conta' ) : null;

        //Reseta os endereços principais do usuário caso o flag de endereço seja 1
        $principal == 1 ?  $this->Usuarios->resetAllEnderecoPrincipal() : null;

        //Grava o novo endereço
        $this->Usuarios->gravarEndereco( 1, $destinatario, $ptReferencia, $endereco, $bairro, $numero, $comple, $principal );

        //Envia uma mensagem para o usuário
        $this->Essentials->setMessage( 'Endereço gravado com sucesso', 100 );

    }


    /**
    * Método salva um novo endereço
    *
    * @param  INT    $idEndereco
    * @param  INT    $cep
    * @param  STRING $endereco
    * @param  STRING $bairro
    * @param  STRING $numero
    * @param  STRING $comple
    * @return ARRAY JSON
    * @access PUBLIC
    **/
    public function salvarEdicaoEndereco() {

        //Recebe os parametros via POST
        $idEndereco     =   $this->input->post( 'idEndereco' );

        $destinatario   =   $this->Essentials->SqlInjection( $this->input->post( 'destinatario' ) );

        $ptReferencia   =   $this->Essentials->SqlInjection( $this->input->post( 'pontoReferencia' ) );

        $principal      =   isset( $_POST['principal'] ) ? 1 : 0;

        $cep            =   $this->Essentials->SqlInjection( $this->input->post( 'cep' ) );

        $endereco       =   $this->Essentials->SqlInjection( $this->input->post( 'endereco' ) );

        $bairro         =   $this->Essentials->SqlInjection( $this->input->post( 'bairro' ) );

        $numero         =   $this->Essentials->SqlInjection( $this->input->post( 'numero' ) );

        $comple         =   $this->Essentials->SqlInjection( $this->input->post( 'comple' ) );

        $cep            =   preg_replace('/-/', '', $cep);

        $this->Essentials->verify( $destinatario, 'Preencha o campo Destinatário', 'empty' );

        $this->Essentials->verify( $ptReferencia, 'Preencha o campo Ponto de Referência', 'empty' );

        //Valida o cep
        !$this->Essentials->onlyNumber( $idEndereco ) ? $this->Essentials->setMessage( 'Endereço inválido' ) : null;

        !$this->Essentials->onlyNumber( $cep ) ? $this->Essentials->setMessage( 'Cep inválido' ) : null;

        strlen( $cep ) != 8 ? $this->Essentials->setMessage( 'Cep inválido' ) : null;

        $this->Essentials->verify( $endereco, 'Preencha o campo endereço', 'empty' );

        $this->Essentials->verify( $bairro, 'Preencha o campo bairro', 'empty' );

        $this->Essentials->verify( $numero, 'Preencha o campo número', 'empty' );

        $this->Essentials->verify( $comple, 'Preencha o campo complemento', 'empty' );

        //Seta o cep na classe $cep
        $this->Usuarios->cep         =   $cep;

        $this->Usuarios->idUsuario   =   $this->idUsuario;

        $this->Usuarios->idEndereco  =   $idEndereco;

        //Verifica se o endereço existe
        $response  =  $this->Usuarios->enderecoExists();

        //Verifica o retorno
        !$response  ?  $this->Essentials->setMessage( 'Endereço inválido' ) : null;

        //Reseta os endereços principais do usuário caso o flag de endereço seja 1
        $principal == 1 ?  $this->Usuarios->resetAllEnderecoPrincipal() : null;

        //Grava o novo endereço
        $this->Usuarios->gravarEndereco( 1, $destinatario, $ptReferencia, $endereco, $bairro, $numero, $comple, $principal, true );

        //Envia uma mensagem para o usuário
        $this->Essentials->setMessage( 'Endereço gravado com sucesso', 100 );

    }


    /**
    * Método deleta 1 ou mais endereços
    *
    * @param  INT    $qtd     -  Quantidade de itens a deletar
    * @param  INT    $id[num] -  ID do endereço para deletar
    * @return ARRAY JSON
    * @access PUBLIC
    **/
    public function deletarEnderecos() {

        //Quantidade de endereços para delatar
        $qtd  =   $this->input->post( 'qtd' );

        //Verifica se a quantidade é um número inteiro
        !is_numeric( $qtd ) ? $this->Essentials->setMessage( 'Selecione 1 ou mais endereços para deletar' ) : null;

        //Verifica se a quantidade de itens a deletar é menor que 1
        $qtd < 1 ?  $this->Essentials->setMessage( 'Selecione 1 ou mais endereços para deletar' ) : null;

        //Seta o ID do usuário
        $this->Usuarios->idUsuario  =   $this->idUsuario;

        //Array que vai armazenar os endereços
        $enderecos  =  array();

        //Otem todos os ID's dos endereços
        for( $i = 0; $i < $qtd; $i++ ) {

            $id  =   $this->input->post( 'id' . $i );

            !is_numeric( $id ) ? $this->Essentials->setMessage( 'Endereço de número ' . ($i + 1) . ' é inválido' ) : null;

            $this->Usuarios->idEndereco  =   $id;

            !$this->Usuarios->enderecoExists() ? $this->Essentials->setMessage( 'Endereço de número ' . ($i + 1) . ' inválido' ) : null;

            $this->Usuarios->enderecoIsVenda() ? $this->Essentials->setMessage( 'Endereço de número ' . ($i + 1) . ' está associado a uma venda' ) : null;

            $enderecos[$i]   =  $id;

        }

        //Inicia o for para deletar os endereços
        for( $i = 0; $i < $qtd; $i++ ) {

            $this->Usuarios->idEndereco  =  $enderecos[$i];

            $this->Usuarios->deletarEnderecos();

        }

        $this->Essentials->setMessage( 'Endereços deletados com sucesso' );

    }


    /**
    * Método obtem todos os enderec'so cadastrados de um usuário
    *
    * @param  NULL
    * @return ARRAY JSON
    * @access PUBLIC
    **/
    public function getEnderecosCadastrados() {

        $result  =   array();

        $this->Usuarios->idUsuario  =  $this->idUsuario;

        $result  =   $this->Usuarios->getAllEndereco();

        echo json_encode( $result );

    }

}
