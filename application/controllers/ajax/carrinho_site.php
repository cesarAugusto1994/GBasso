<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carrinho_site extends CI_Controller {

    private   $Essentials =  null;

    private   $Produtos   =  null;

    private   $Carrinho   =  null;

    private   $Usuarios   =  null;

    private   $Login      =  null;

    private   $Dates      =  null;

    private   $Curl       =  null;

    private   $XmlParser  =  null;

    private   $Vendas     =  null;

    private   $Correios   =  null;

    private   $Config     =  null;

    private   $idUsuario  =  null;

    private   $infoFrete  =  array();

    protected $token      =  '3DE59198A46349CF88C9E495FFC05932';

    protected $email      =  'clinco@webmkt.com.br';

    protected $emailLoja  =  'suporte@vtenis.com.br';

    protected $notify     =  'http://www.vtenis.com.br/loja/atualizacao/notificacao/pagseguro';

    protected $urlPagSeg  =  'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/';

	public function __construct() {

        parent::__construct();

        //Instacia a classe Essential do package Security
        $this->Essentials =   new security\Essentials;

        //Instancia a classe de Produtos
        $this->Produtos   =   new objects\Produtos;

        //Instancia a classe do Carrinho
        $this->Carrinho   =   new sessions\Carrinho;

        //Instancia a classe do Login
        $this->Login      =   new sessions\Login(2);

        $segmento         =   substr( trim( $this->uri->slash_segment( 3 ) ), 0, -1 );

        $realizarCompra   =   substr( trim( $this->uri->slash_segment( 4 ) ), 0, -1 );

        //Verifica se o acesso é para notificacão de pagamentos
        if( $segmento == 'pagseguro' ) {

            //Libera o acesso do pagseguro ao sistema de atualização
            header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");

        }else if( $realizarCompra == 'compra' || $segmento == 'getValorFrete' ) {

            !$this->Login->checkLogin() ? $this->Essentials->setMessage( 'Faça login para prosseguir', 101 ) : null;

            $this->idUsuario  =  $this->Login->getIdUser();

        }

    }


    /**
    * Método gera um ID de sessão
    *
    * @param  NULL
    * @return VOID
    * @access PUBLIC
    */
    public function getSessionIDPagseguro() {

        $url           =   'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions';

        $this->Curl    =   new connection\Curl( $url );

        $this->Config  =   new objects\Configuracoes();

        $data          =   array( 'email' => urlencode( $this->email ), 'token' => urlencode( $this->token ) );

        $data          =   $this->Curl->urlify( $data );

        $this->Curl->setOpt( 'CURLOPT_URL', $url );

        $this->Curl->setOpt( 'CURLOPT_POST', $data );

        $this->Curl->setOpt( 'CURLOPT_POSTFIELDS', $data );

        $this->Curl->setOpt( 'CURLOPT_RETURNTRANSFER', true );

        $response         =   $this->Curl->execute();

        $this->XmlParser  =   new parser\Xml( $response );

        if( $this->XmlParser->isXml( $response ) ) {

            $response      =   $this->XmlParser->toArray();

            $parcSemJuros  =   $this->Config->getParcelasSemJuros();

            $valorSemFrete =   $this->Config->getValorSemFrete();

            $id            =   $response['id'];

            $code          =   100;

            $result        =    array(
                                    'id' => $id,
                                    'code' => $code,
                                    'parcSemJuros' => $parcSemJuros,
                                    'semFrete' => $valorSemFrete
                                );

            echo json_encode( $result ); exit;

        }else {

            $this->Essentials->setMessage( 'Ocorreu um erro' );

        }

    }


    /**
    * Método finaliza a compra do usuário
    *
    * @param  INT $gateway  -   Gateway que está sendo usado para o pagamento
    * @param  INT $tpPag    -   Tipo de pagamento que o usuário selecionou
    * @return VOID
    * @access PUBLIC
    */
    public function finalizar_compra() {

        $this->Usuarios             =   new objects\Usuarios();

        $this->Usuarios->idUsuario  =   $this->idUsuario;

        //Obtem o meio de pagamento
        $tpPag       =    $this->input->post( 'tpPag' );

        //Obtem o gateway de pagamento selecionado
        $gateway     =    $this->input->post( 'gateway' );

        //Obtem o ID do endereço
        $idEndereco  =    $this->input->post( 'idEndereco' );

        //Recebe o Cep
        $cep         =    preg_replace( '/\D/', '', $this->input->post( 'cepEntrega' ) );

        //Recebe o código do serviço
        $servico     =    $this->input->post( 'servicoFrete' );

        $this->Usuarios->cep    =   $cep;

        //Instancia a classe de Vendas
        $this->Vendas           =   new objects\Vendas;

        //Gera o valor do frete
        $valorFrete             =   $this->generateFrete( $cep, $servico );

        //Verifica se o meios de pagamento foi selecionado
        !is_numeric( $tpPag ) ? $this->Essentials->setMessage( 'Selecione o meio de pagamento' ) : null;

        //Verifica se algum engraçadinho alterou o meio de pagamento com um FIREBUG da vida
        !( $tpPag > 0 && $tpPag < 4 ) ? $this->Essentials->setMessage( 'Meio de pagamento inválido' ) : null;

        //Verifica se algum engraçadinho alterou o gateway de pagamento
        $gateway != 1  ?  $this->Essentials->setMessage( 'Gateway de pagamento inválido' ) : null;

        //Verifica se o endereço existe
        !$this->Usuarios->enderecoExists() ?  $this->Essentials->setMessage( 'Selecione um endereço válido' ) : null;

        //Atribui o ID do endereço
        $this->Vendas->idEndereco  =   $idEndereco;

        $valorFreteNormal          =   $valorFrete;

        //Verifica se o valor da compra é menor que o valor do limite para sem frete, se sim, valor do frete normal, se não, frete grátis
        $valorFrete                =   $this->Config->getValorSemFrete() > $this->Carrinho->getTotal() ? $valorFrete : 0.00;

        $parcelasSemJuros          =   $this->Config->getParcelasSemJuros();

        //Determina se o frete foi cobrado ou não
        $flagFreteCobrado          =   $valorFrete > 0 ? 1 : 0;

        //var_dump( $valorFrete ); exit;

        //Verifica se o gateway de pagamento é 1, sendo assim, ele escolheu pagseguro
        if( $gateway == 1 ) {

            //Seta o Gatway da venda (PAGSEGURO)
            $this->Vendas->idGateway = 1;

            //Verifica o tipo de pagamento selecionado e chama o método equivalente
            switch ( $tpPag ) {
                case 1:
                    //Faz a chamada para o método de pagamento de cartão de crédito
                    $response   =  $this->callPaymentCreditCard( $valorFrete, $parcelasSemJuros, $servico );
                break;
                case 2:
                    //Faz a chamada para o método de pagamento de boleto
                    $response   =  $this->callPaymentBoleto( $valorFrete, $parcelasSemJuros, $servico );
                break;
                case 3:
                    //Faz a chamada para o método de pagamento de Débito online
                    $response   =  $this->callPaymentDebitoOnline( $valorFrete, $parcelasSemJuros, $servico );
                break;
            }

            //Verifica se o retorno é falso
            if( !$response ) {

                //Grava o log do erro
                $this->Vendas->gravarLogError( 'Pagseguro não retornou um XML válido', 0000, 0 );

                //Envia a mensagem para o usuário
                $this->Essentials->setMessage( 'Sua compra foi processada e estamos aguardando confirmação da operadora', 102 );

            }else {

                #Agora vamos processar os dados retornados da venda
                //Converte o XML para array
                $data    =    $this->XmlParser->toArray();

                //verifica se ocorreu algum erro
                if( isset( $data['error'] ) ) {

                    //Grava o log do erro
                    $this->Vendas->gravarLogError( $data['error']['message'], $data['error']['code'], 0 );

                    //Ocorreu algum erro, então vamos enviar uma mensagem
                    $this->Essentials->setMessage( 'Ocorreu um erro ao processar a venda, nossa equipe foi informada e vamos entrar em contato com você cliente', 102 );

                }else {

                    //Seta o array retornado na classe de vendas
                    $this->Vendas->setDataReturnTransaction( $data );

                    //Prepara os dados da venda do pagseguro para serem gravadas
                    $this->Vendas->prepararVendaPagseguro();

                    //Grava venda do pagseguro
                    $this->Vendas->gravarVendaPagseguro();

                    //Grava o frete
                    $this->Vendas->gravarFrete( $valorFreteNormal, $flagFreteCobrado );

                    //Obtem o ID do frete
                    $this->Vendas->getIdFrete();

                    foreach ($this->infoFrete as $key => $value ) {

                        $this->Vendas->idProduto  =   $value['id'];

                        $this->Vendas->gravarFreteProdutos( $value['valor'] );

                    }

                    //Deleta os dados do carrinho
                    //$this->Carrinho->deleteAll();

                    if( $tpPag == 2 || $tpPag == 3 ) {

                        //get link do boleto
                        $link    =  $this->Vendas->getLinkBoleto();

                        $result  =  array( 'link' => $link, 'code' => 100, 'message' => 'Sua compra foi finalizada com sucesso, estamos aguardando a confirmação da operadora' );

                        //Retorna os dados em formato json
                        echo json_encode( $result ); exit;

                    }else {

                        $result  =  array(
                                        'message'  =>  'Sua compra foi finalizada com sucesso, estamos aguardando a confirmação da operadora',
                                        'code'     =>  100,
                                        'ref'      =>  $this->Vendas->referencia
                                    );

                        echo json_encode( $result );

                    }

                }

            }

        }

    }


    /**
    * Método realiza uma chamada a API do pagseguro checkout transparent requisitando um pagamento por débito online
    *
    * @param  NULL
    * @return ARRAY JSON
    * @access PUBLIC
    */
    public function callPaymentDebitoOnline( $valorFrete, $parcelasSemJuros, $servico ) {

        //Instancia a classe de Datas
        $this->Dates       =   new extend\Dates;

        //Recebe os dados via POST
        $email             =   $this->input->post( 'email' );

        $nome              =   $this->input->post( 'nome' );

        $cpfDono           =   $this->input->post( 'cpf' );

        $ddd               =   $this->input->post( 'ddd' );

        $telefone          =   $this->input->post( 'telefone' );

        $senderHash        =   $this->input->post( 'senderHash' );

        $numero            =   $this->input->post( 'numero' );

        $complemento       =   $this->input->post( 'complemento' );

        $cep               =   $this->input->post( 'cepEntrega' );

        $bancoName         =   $this->input->post( 'bankName' );

        $bancos            =   array( 'itau', 'bradesco', 'bancodobrasil', 'banrisul', 'hsbc' );

        $ddd               =   preg_replace('/\D/', '', $ddd);

        $telefone          =   preg_replace('/\D/', '', $telefone);

        $cep               =   preg_replace('/\D/', '', $cep);

        $cpfDono           =   preg_replace('/\D/', '', $cpfDono);

        //Valida o e-mail
        !$this->Essentials->validEmail( $email ) ? $this->Essentials->setMessage( 'E-mail inválido' ) : null;

        //Valida o nome do dono do cartão
        !$this->Essentials->verify( $nome, 'Preencha o campo nome', 'empty' );

        //Verifica se o usuário preencheu o nome completo
        substr_count($nome, ' ') < 1 ? $this->Essentials->setMessage( 'Preencha seu nome completo' ) : null;

        //Valida o CPF
        !$this->Essentials->validarCPF( $cpfDono ) ? $this->Essentials->setMessage( 'CPF inválido' ) : null;

        //Valida o DDD
        strlen( $ddd ) != 2 || !is_numeric( $ddd ) ? $this->Essentials->setMessage( 'DDD inválido' ) : null;

        //Valida o telefone
        strlen( $telefone ) != 8 || !is_numeric( $telefone ) ? $this->Essentials->setMessage( 'Telefone inválido' ) : null;

        //Valida o CEP
        strlen( $cep ) != 8 || !is_numeric( $cep ) ? $this->Essentials->setMessage( 'Cep inválido' ) : null;

        //Valida se o usuário selecionou um banco válido
        !in_array($bancoName, $bancos) ? $this->Essentials->setMessage( 'O banco selecionado é inválido' ) : null;

        //Seta o ID do usuário na classe Usuários
        $this->Vendas->idUsuario   =   $this->idUsuario;

        //Seta o CEP
        $this->Usuarios->cep       =   $cep;

        //Get full endereço
        $endereco                  =   $this->Usuarios->getFullEndereco();

        //Verifica se foi retornado algum endereco
        !isset( $endereco['est'] ) ? $this->Essentials->setMessage( 'Endereço inválido' ) : null;


        /**
        * Essa parte é referente ao processamento da venda
        *
        **/
        //Obtem o total da venda
        $totalVenda                =   $this->Carrinho->getTotal();

        //Seta o status da venda como 1: Aguardando pagamento
        $status                    =   1;

        //Gera a referencia da venda
        $this->Vendas->gerarReferencia();

        //Grava a venda
        $this->Vendas->gravarVenda( $status, $totalVenda, $servico );

        //Resgata o ID da venda
        $response    =   $this->Vendas->getIDVenda();

        //Verifica se o ID da venda foi resgatado com sucesso
        !$response   ?   $this->Essentials->setMessage( 'Ocorreu um erro, a compra não foi finalizada' ) : null;

        //Salva os produtos da venda e recebe os produtos da venda
        $itens     =  $this->salvarProdutosVenda();

        //Obtem o nome completo do usuário
        $fullName  =  $this->Usuarios->getFullName();

        //Verifica se houve algum retorno
        is_bool( $fullName ) ? $this->Essentials->setMessage( 'Ocorreu um erro ao buscar o nome do usuário cadastrado em sua conta, sua compra não foi finalizada' ) : null;

        /**
        * Esta parte é referente a conexão ao servidor do PAGSEGURO
        *
        **/
        //Configura o array que será enviado via POST
        $data   =  array(
            'email'                          =>  urlencode( $this->email ),
            'token'                          =>  urlencode( $this->token ),
            'paymentMode'                    =>  urlencode( 'default' ),
            'paymentMethod'                  =>  urlencode( 'eft' ),
            'bankName'                       =>  urlencode( $bancoName ),
            'receiverEmail'                  =>  urlencode( $this->email ),
            'currency'                       =>  urlencode( 'BRL' ),
            'notificationURL'                =>  urlencode( $this->notify ),
            'reference'                      =>  urlencode( $this->Vendas->referencia ),
            'senderName'                     =>  urlencode( $nome ),
            'senderCPF'                      =>  urlencode( $cpfDono ),
            'senderAreaCode'                 =>  urlencode( $ddd ),
            'senderPhone'                    =>  urlencode( $telefone ),
            'senderEmail'                    =>  urlencode( $email ),
            'senderHash'                     =>  urlencode( $senderHash ),
            'shippingAddressStreet'          =>  urlencode( $endereco['end'] ),
            'shippingAddressNumber'          =>  urlencode( $numero ),
            'shippingAddressComplement'      =>  urlencode( $complemento ),
            'shippingAddressDistrict'        =>  urlencode( $endereco['bai'] ),
            'shippingAddressPostalCode'      =>  urlencode( $cep ),
            'shippingAddressCity'            =>  urlencode( $endereco['cid'] ),
            'shippingAddressState'           =>  urlencode( $endereco['est'] ),
            'shippingAddressCountry'         =>  urlencode( 'BR' ),
            'shippingType'                   =>  urlencode( '' ),
            'shippingCost'                   =>  urlencode( $valorFrete )
        );

        //Junta o array com os produtos ao array dos parametros
        $data        =   array_merge( $data, $itens );

        //Instancia a classe Curl para conexão em outros servidores
        $this->Curl  =   new connection\Curl( $this->urlPagSeg );

        //Prepara os parametros para o POST
        $data        =   $this->Curl->urlify( $data );

        $this->Curl->setOpt( 'CURLOPT_URL', $this->urlPagSeg );

        $this->Curl->setOpt( 'CURLOPT_POST', $data );

        $this->Curl->setOpt( 'CURLOPT_POSTFIELDS', $data );

        $this->Curl->setOpt( 'CURLOPT_RETURNTRANSFER', true );

        //faz a conexão e recebe os dados
        $response         =   $this->Curl->execute();

        //Seta o retorno na LIB XML
        $this->XmlParser  =   new parser\Xml( $response );

        //Verifica se o retorno é um XML válido
        $response         =   $this->XmlParser->isXml();

        //Retorna se o XML é válido ou não
        return $response;

    }


    /**
    * Método realiza uma chamada a API do pagseguro checkout transparent requisitando um pagamento por boleto
    *
    * @param  NULL
    * @return ARRAY JSON
    * @access PUBLIC
    */
    public function callPaymentBoleto( $valorFrete, $parcelasSemJuros, $servico ) {

        //Instancia a classe de Datas
        $this->Dates       =   new extend\Dates;

        //Recebe os dados via POST
        $email             =   $this->input->post( 'email' );

        $nome              =   $this->input->post( 'nome' );

        $cpfDono           =   $this->input->post( 'cpf' );

        $ddd               =   $this->input->post( 'ddd' );

        $telefone          =   $this->input->post( 'telefone' );

        $senderHash        =   $this->input->post( 'senderHash' );

        $numero            =   $this->input->post( 'numero' );

        $complemento       =   $this->input->post( 'complemento' );

        $cep               =   $this->input->post( 'cepEntrega' );

        $ddd               =   preg_replace('/\D/', '', $ddd);

        $telefone          =   preg_replace('/\D/', '', $telefone);

        $cep               =   preg_replace('/\D/', '', $cep);

        $cpfDono           =   preg_replace('/\D/', '', $cpfDono);

        //Valida o e-mail
        !$this->Essentials->validEmail( $email ) ? $this->Essentials->setMessage( 'E-mail inválido' ) : null;

        //Valida o nome do dono do cartão
        !$this->Essentials->verify( $nome, 'Preencha o campo nome', 'empty' );

        //Verifica se o usuário preencheu o nome completo
        substr_count($nome, ' ') < 1 ? $this->Essentials->setMessage( 'Preencha seu nome completo' ) : null;

        //Valida o CPF
        !$this->Essentials->validarCPF( $cpfDono ) ? $this->Essentials->setMessage( 'CPF inválido' ) : null;

        //Valida o DDD
        strlen( $ddd ) != 2 || !is_numeric( $ddd ) ? $this->Essentials->setMessage( 'DDD inválido' ) : null;

        //Valida o telefone
        strlen( $telefone ) != 8 || !is_numeric( $telefone ) ? $this->Essentials->setMessage( 'Telefone inválido' ) : null;

        //Valida o CEP
        strlen( $cep ) != 8 || !is_numeric( $cep ) ? $this->Essentials->setMessage( 'Cep inválido' ) : null;

        //Seta o ID do usuário na classe Usuários
        $this->Vendas->idUsuario   =   $this->idUsuario;

        //Seta o CEP
        $this->Usuarios->cep       =   $cep;

        //Get full endereço
        $endereco                  =   $this->Usuarios->getFullEndereco();

        //Verifica se foi retornado algum endereco
        !isset( $endereco['est'] ) ? $this->Essentials->setMessage( 'Endereço inválido' ) : null;

        //Obtem o total da venda
        $totalVenda                =   $this->Carrinho->getTotal();

        //Seta o status da venda como 1: Aguardando pagamento
        $status                    =   1;

        //Gera a referencia da venda
        $this->Vendas->gerarReferencia();

        //Grava a venda
        $this->Vendas->gravarVenda( $status, $totalVenda, $servico );

        //Resgata o ID da venda
        $response    =   $this->Vendas->getIDVenda();

        //Verifica se o ID da venda foi resgatado com sucesso
        !$response   ?   $this->Essentials->setMessage( 'Ocorreu um erro, a compra não foi finalizada' ) : null;

        //Salva os produtos da venda e recebe os produtos da venda
        $itens     =  $this->salvarProdutosVenda();

        //Obtem o nome completo do usuário
        $fullName  =  $this->Usuarios->getFullName();

        //Verifica se houve algum retorno
        is_bool( $fullName ) ? $this->Essentials->setMessage( 'Ocorreu um erro ao buscar o nome do usuário cadastrado em sua conta, sua compra não foi finalizada' ) : null;

        /**
        * Esta parte é referente a conexão ao servidor do PAGSEGURO
        *
        **/
        //Configura o array que será enviado via POST
        $data   =  array(
            'email'                          =>  urlencode( $this->email ),
            'token'                          =>  urlencode( $this->token ),
            'paymentMode'                    =>  urlencode( 'default' ),
            'paymentMethod'                  =>  urlencode( 'boleto' ),
            'receiverEmail'                  =>  urlencode( $this->email ),
            'currency'                       =>  urlencode( 'BRL' ),
            'notificationURL'                =>  urlencode( $this->notify ),
            'reference'                      =>  urlencode( $this->Vendas->referencia ),
            'senderName'                     =>  urlencode( $nome ),
            'senderCPF'                      =>  urlencode( $cpfDono ),
            'senderAreaCode'                 =>  urlencode( $ddd ),
            'senderPhone'                    =>  urlencode( $telefone ),
            'senderEmail'                    =>  urlencode( $email ),
            'senderHash'                     =>  urlencode( $senderHash ),
            'shippingAddressStreet'          =>  urlencode( $endereco['end'] ),
            'shippingAddressNumber'          =>  urlencode( $numero ),
            'shippingAddressComplement'      =>  urlencode( $complemento ),
            'shippingAddressDistrict'        =>  urlencode( $endereco['bai'] ),
            'shippingAddressPostalCode'      =>  urlencode( $cep ),
            'shippingAddressCity'            =>  urlencode( $endereco['cid'] ),
            'shippingAddressState'           =>  urlencode( $endereco['est'] ),
            'shippingAddressCountry'         =>  urlencode( 'BR' ),
            'shippingType'                   =>  urlencode( '' ),
            'shippingCost'                   =>  urlencode( $valorFrete )
        );

        //Junta o array com os produtos ao array dos parametros
        $data        =   array_merge( $data, $itens );

        //Instancia a classe Curl para conexão em outros servidores
        $this->Curl  =   new connection\Curl( $this->urlPagSeg );

        //Prepara os parametros para o POST
        $data        =   $this->Curl->urlify( $data );

        $this->Curl->setOpt( 'CURLOPT_URL', $this->urlPagSeg );

        $this->Curl->setOpt( 'CURLOPT_POST', $data );

        $this->Curl->setOpt( 'CURLOPT_POSTFIELDS', $data );

        $this->Curl->setOpt( 'CURLOPT_RETURNTRANSFER', true );

        //faz a conexão e recebe os dados
        $response         =   $this->Curl->execute();

        //Seta o retorno na LIB XML
        $this->XmlParser  =   new parser\Xml( $response );

        //Verifica se o retorno é um XML válido
        $response         =   $this->XmlParser->isXml();

        //Retorna se o XML é válido ou não
        return $response;

    }


    /**
    * Método realiza uma chamada a API do pagseguro checkout transparent requisitando um pagamento por cartão de crédito
    *
    * @param  NULL
    * @return ARRAY JSON
    * @access PUBLIC
    */
    public function callPaymentCreditCard( $valorFrete, $parcelasSemJuros, $servico ) {

        //Instancia a classe de Datas
        $this->Dates       =   new extend\Dates;

        //Recebe os dados via POST
        $email             =   $this->input->post( 'email' );

        $nome              =   $this->input->post( 'nome' );

        $cpfDono           =   $this->input->post( 'cpf' );

        $ddd               =   $this->input->post( 'ddd' );

        $telefone          =   $this->input->post( 'telefone' );

        $senderHash        =   $this->input->post( 'senderHash' );

        $numero            =   $this->input->post( 'numero' );

        $complemento       =   $this->input->post( 'complemento' );

        $cep               =   $this->input->post( 'cepEntrega' );

        $cardToken         =   $this->input->post( 'cardToken' );

        $parcelas          =   $this->input->post( 'parcelas' );

        $parcelaValor      =   $this->input->post( 'parcelaValor' );

        $dataNascDono      =   $this->input->post( 'dataNascDono' );

        $ddd               =   preg_replace('/\D/', '', $ddd);

        $telefone          =   preg_replace('/\D/', '', $telefone);

        $cep               =   preg_replace('/\D/', '', $cep);

        $cpfDono           =   preg_replace('/\D/', '', $cpfDono);

        //Valida o e-mail
        !$this->Essentials->validEmail( $email ) ? $this->Essentials->setMessage( 'E-mail inválido' ) : null;

        //Valida o nome do dono do cartão
        !$this->Essentials->verify( $nome, 'Preencha o campo nome', 'empty' );

        //Verifica se o usuário preencheu o nome completo
        substr_count($nome, ' ') < 1 ? $this->Essentials->setMessage( 'Preencha seu nome completo' ) : null;

        //Valida o CPF
        !$this->Essentials->validarCPF( $cpfDono ) ? $this->Essentials->setMessage( 'CPF inválido' ) : null;

        //Valida o DDD
        strlen( $ddd ) != 2 || !is_numeric( $ddd ) ? $this->Essentials->setMessage( 'DDD inválido' ) : null;

        //Valida o telefone
        strlen( $telefone ) != 8 || !is_numeric( $telefone ) ? $this->Essentials->setMessage( 'Telefone inválido' ) : null;

        //Valida o CEP
        strlen( $cep ) != 8 || !is_numeric( $cep ) ? $this->Essentials->setMessage( 'Cep inválido' ) : null;

        //Valida o número de parcelas
        !is_numeric( $parcelas ) || $parcelas < 1 ?  $this->Essentials->setMessage( 'Selecione o número de parcelas' ) : null;

        //Valida o valor da parcela
        !is_numeric( $parcelaValor ) || $parcelaValor < 1 ?  $this->Essentials->setMessage( 'Valor da parcela inválido' ) : null;

        //Valida a data de nascimento
        $this->Dates->validateDate( $dataNascDono ) ?  $this->Essentials->setMessage( 'Data de nascimento inválida' ) : null;

        //Seta o ID do usuário na classe Usuários
        $this->Vendas->idUsuario   =   $this->idUsuario;

        //Seta o CEP
        $this->Usuarios->cep       =   $cep;

        //Get full endereço
        $endereco                  =   $this->Usuarios->getFullEndereco();

        //Verifica se foi retornado algum endereco
        !isset( $endereco['est'] ) ? $this->Essentials->setMessage( 'Endereço inválido' ) : null;


        /**
        * Essa parte é referente ao processamento da venda
        *
        **/
        //Obtem o total da venda
        $totalVenda                =   $this->Carrinho->getTotal();

        //Seta o status da venda como 1: Aguardando pagamento
        $status                    =   1;

        //Gera a referencia da venda
        $this->Vendas->gerarReferencia();

        //Grava a venda
        $this->Vendas->gravarVenda( $status, $totalVenda, $servico );

        //Resgata o ID da venda
        $response    =   $this->Vendas->getIDVenda();

        //Verifica se o ID da venda foi resgatado com sucesso
        !$response   ?   $this->Essentials->setMessage( 'Ocorreu um erro, a compra não foi finalizada' ) : null;

        //Salva os produtos da venda e recebe os produtos da venda
        $itens     =  $this->salvarProdutosVenda();

        //Obtem o nome completo do usuário
        $fullName  =  $this->Usuarios->getFullName();

        //Verifica se houve algum retorno
        is_bool( $fullName ) ? $this->Essentials->setMessage( 'Ocorreu um erro ao buscar o nome do usuário cadastrado em sua conta, sua compra não foi finalizada' ) : null;

        /**
        * Esta parte é referente a conexão ao servidor do PAGSEGURO
        *
        **/
        //Configura o array que será enviado via POST
        $data   =  array(
            'email'                          =>  urlencode( $this->email ),
            'token'                          =>  urlencode( $this->token ),
            'paymentMode'                    =>  urlencode( 'default' ),
            'paymentMethod'                  =>  urlencode( 'creditCard' ),
            'receiverEmail'                  =>  urlencode( $this->email ),
            'currency'                       =>  urlencode( 'BRL' ),
            'notificationURL'                =>  urlencode( $this->notify ),
            'reference'                      =>  urlencode( $this->Vendas->referencia ),
            'senderName'                     =>  urlencode( $nome ),
            'senderCPF'                      =>  urlencode( $cpfDono ),
            'senderAreaCode'                 =>  urlencode( $ddd ),
            'senderPhone'                    =>  urlencode( $telefone ),
            'senderEmail'                    =>  urlencode( $email ),
            'senderHash'                     =>  urlencode( $senderHash ),
            'shippingAddressStreet'          =>  urlencode( $endereco['end'] ),
            'shippingAddressNumber'          =>  urlencode( $numero ),
            'shippingAddressComplement'      =>  urlencode( $complemento ),
            'shippingAddressDistrict'        =>  urlencode( $endereco['bai'] ),
            'shippingAddressPostalCode'      =>  urlencode( $cep ),
            'shippingAddressCity'            =>  urlencode( $endereco['cid'] ),
            'shippingAddressState'           =>  urlencode( $endereco['est'] ),
            'shippingAddressCountry'         =>  urlencode( 'BR' ),
            'shippingType'                   =>  urlencode( '' ),
            'shippingCost'                   =>  urlencode( number_format( (float) $valorFrete, 2, '.', '' ) ),
            'creditCardToken'                =>  urlencode( $cardToken ),
            'installmentQuantity'            =>  urlencode( $parcelas ),
            'installmentValue'               =>  urlencode( number_format( (float) $parcelaValor, 2, '.', '' ) ),
            'noInterestInstallmentQuantity'  =>  urlencode( $parcelasSemJuros ),
            'creditCardHolderName'           =>  urlencode( $nome ),
            'creditCardHolderCPF'            =>  urlencode( $cpfDono ),
            'creditCardHolderBirthDate'      =>  urlencode( $dataNascDono ),
            'creditCardHolderAreaCode'       =>  urlencode( $ddd ),
            'creditCardHolderPhone'          =>  urlencode( $telefone ),
            'billingAddressStreet'           =>  urlencode( $endereco['end'] ),
            'billingAddressNumber'           =>  urlencode( $numero ),
            'billingAddressComplement'       =>  urlencode( $complemento ),
            'billingAddressDistrict'         =>  urlencode( $endereco['bai'] ),
            'billingAddressPostalCode'       =>  urlencode( $cep ),
            'billingAddressCity'             =>  urlencode( $endereco['cid'] ),
            'billingAddressState'            =>  urlencode( $endereco['est'] ),
            'billingAddressCountry'          =>  urlencode( 'BRA' )
        );

        //Junta o array com os produtos ao array dos parametros
        $data        =   array_merge( $data, $itens );

        //print_r( $data ); exit;

        //Instancia a classe Curl para conexão em outros servidores
        $this->Curl  =   new connection\Curl( $this->urlPagSeg );

        //Prepara os parametros para o POST
        $data        =   $this->Curl->urlify( $data );

        $this->Curl->setOpt( 'CURLOPT_URL', $this->urlPagSeg );

        $this->Curl->setOpt( 'CURLOPT_POST', $data );

        $this->Curl->setOpt( 'CURLOPT_POSTFIELDS', $data );

        $this->Curl->setOpt( 'CURLOPT_RETURNTRANSFER', true );

        //faz a conexão e recebe os dados
        $response         =   $this->Curl->execute();

        //Seta o retorno na LIB XML
        $this->XmlParser  =   new parser\Xml( $response );

        //Verifica se o retorno é um XML válido
        $response         =   $this->XmlParser->isXml();

        //print_r( $this->XmlParser->toArray() ); exit;

        //Retorna se o XML é válido ou não
        return $response;

    }


    /**
    * Método salva os produtos do carrinho na tabela associativa de vendas e retorna um array com os produtos que foram salvos
    *
    * @param  NULL
    * @return ARRAY
    * @access PROTECTED
    */
    protected function salvarProdutosVenda() {

        /**
        * Essa parte é referente ao processamento dos produtos da venda
        *
        **/
        //Obtem todos os produtos
        $produtos  =   $this->Carrinho->getProdutos();

        //Array vai conter os produtos para serem enviados ao PAGSEGURO
        $itens     =   array();

        //Verifica se o carrinho está vazio
        count( $produtos ) == 0 ? $this->Essentials->setMessage( 'Seu carrinho está vázio, sua compra não foi finalizada' ) : null;

        //Seta o contador dds índices do array de itens de produtos
        $i  =  1;

        //Extraindo todos os produtos
        foreach ($produtos as $key ) {

            $this->Produtos->idProduto  =   $key['id'];

            //Recebe o index para o ID do item
            $index1          =   "itemId$i";

            //Recebe o index para o nome do produto
            $index2          =   "itemDescription$i";

            //Recebe o index para o valor do produto
            $index3          =   "itemAmount$i";

            //Recebe o index para a quantidade do produto
            $index4          =   "itemQuantity$i";

            //Recebe o ID do produto
            $itens[$index1]  =   $this->Produtos->idProduto;

            //Recebe o nome do produto
            $itens[$index2]  =   $this->Produtos->getDataEspecificProduct( 2 );

            //Recebe o valor do produto
            $itens[$index3]  =   $key['valor'];

            //Recebe a quantidade do produto
            $itens[$index4]  =   $key['qtd'];

            //Seta o ID do produto na venda
            $this->Vendas->idProduto   =   $key['id'];

            //Grava o produto na tabela associativa de vendas
            $this->Vendas->gravarProdutosVenda( $key['qtd'], $key['valor'] );

            //Incrementa o contador
            $i++;

        }

        return $itens;

    }


    /**
    * Método recebe a notificação enviada automaticamente pelo Pagseguro
    *
    * @param  NULL
    * @return VOID
    * @access PUBLIC
    */
    public function notificacao() {

        //Instancia a classe de vendas
        $this->Vendas   =   new objects\Vendas();

        //Inicializa a classe pagseguro
        $this->load->library( 'pagseguro/pagseguro' );

        //Inicializa a API do pagseguro
        $this->pagseguro->initializePagSeguroAPI();

        // Tipo de notificação recebida
        $type         =   $this->input->post( 'notificationType' );

        //Código da notificação recebida
        $notifyCode   =   $this->input->post( 'notificationCode' );

        //Gte IP user
        $ip           =   $this->Essentials->getUserIP();

        //Verifica se o tipo de notificação é transaction
        if( $type != 'transaction' ){

            //Grava o log de erro
            $this->Vendas->gravarLogErrorNotificacao( $ip, 'Tipo de notificação inválido', '200' );

            exit( 'Erro 200' );

        }

        //Faz a chamada para  API de notificação requisando os dados da transação
        $transaction    =    $this->pagseguro->returnRequestNotification( $notifyCode );

        //Verifica se o retorno dos dados é um objeto
        if( !is_object( $transaction ) ){

            //Grava o log de erro
            $this->Vendas->gravarLogErrorNotificacao( $ip, 'Erro, nenhum dado foi retornado', '201' );

            exit( 'Erro 201' );

        }


        //Obtem o código da transação
        $code                      =   $transaction->getCode();

        //Obtem a referência da transação
        $referencia                =   $transaction->getReference();

        //Obtem o Status da transação
        $status                    =   $transaction->getStatus()->getValue();

        //Recebe o tipo de pagamento
        $tpPagto                   =   $transaction->getPaymentMethod()->getType()->getValue();

        //recebe o código do pagamento
        $codTpPagto                =   $transaction->getPaymentMethod()->getCode()->getValue();

        //Seta o código da transação no atributo da classe Vendas
        $this->Vendas->codeTrans   =  preg_replace( '/-/', '', $code );

        //Seta a referência no atributo da classe Vendas
        $this->Vendas->referencia  =  $referencia;

        //Seta a data atual
        $this->Vendas->date        =  date( 'Y-m-d h:i:s' );

        //Seta o tipo de pagamento
        $this->Vendas->tpTrans     =  $tpPagto;

        //Seta o tipo de pagamento
        $this->Vendas->meioPag     =  $codTpPagto;

        //Seta o status
        $this->Vendas->status      =  $status;

        //Obtem o ID da venda do pagseguro
        $response                  =  $this->Vendas->getIDVendaPagseguro();

        //Obtem o ID do usuário que fez a venda
        $response2                 =  $this->Vendas->getIDUsuario();

        //Verifica se o ID da venda do pagseguro foi retornado
        if( !$response ){

            //Grava o log de erro
            $this->Vendas->gravarLogErrorNotificacao( $ip, 'Ocorreu um erro tentar resgatar o ID da venda', '202' );

            exit( 'Erro 202' );

        }

        //Verifica se o ID do usuário foi retornado
        if( !$response2 ){

            //Grava o log de erro
            $this->Vendas->gravarLogErrorNotificacao( $ip, 'Ocorreu um erro tentar resgatar o ID do usuário que fez a venda', '203' );

            exit( 'Erro 202' );

        }

        //Resgata o ID da venda
        $this->Vendas->getIDVenda();

        //Atualiza a venda do pagseguro
        $this->Vendas->gravarVendaPagseguro( true );

        //Atualiza o status da venda
        $this->Vendas->gravarVenda( $status, '', true );

        //Grava o LOG de notificação
        $this->Vendas->gravarLogNotificacao( $ip, $notifyCode );

        //Dados atualizados
        exit( 'Dados atualizados com sucesso' );

    }


    /**
    * Método adiciona produtos ao carrinho de compras
    *
    * @param  INT   $id   -  ID do produto que será adicinado
    * @param  INT   $qtd  -  Quantidade da compra deste produto
    * @return ARRAY JSON
    * @access PUBLIC
    */
    public function add() {

    	//Recebe o ID do produto
    	$id    =  $this->Essentials->sqlInjection( $this->input->post( 'id' ) );

    	//Recebe a quantidade do produto
    	$qtd   =  $this->Essentials->sqlInjection( $this->input->post( 'qtd' ) );

    	//verifica se o ID do produto é um número válido
    	if( is_numeric( $id ) ) {

    		//Seta o ID do produto na classe produtos
    		$this->Produtos->idProduto  =  $id;

    		//Verifica se o produto existe em banco de dados
    		$response  =   $this->Produtos->produtoExists();

    		//Verifica se o retorno é TRUE, se sim, o produto existe
    		if( $response ) {

    			//Pega o valor absoluto da quantidade (PREVINE CONTRA PONTO FLUTUANTE E NEGATIVOS)
    			$qtd  =  (INT) abs( $qtd );

    			if( $qtd > 0 && $qtd < 99 ) {

    				//Seta o ID do produto na classe carrinho
    				$this->Carrinho->idProduto  =   $id;

    				//Verifica se o produto existe na classe carrinho
    				$response  =   $this->Carrinho->produtoExists();

    				//Obtem o valor do produto
    				$valor     =   $this->Produtos->getDataEspecificProduct( 1 );

    				if( !$response ) {

    					//Adiciona o produto
    					$this->Carrinho->addProduto( $valor, $qtd );

    				}else {

    					//Adiciona o produto
    					$this->Carrinho->editaCarrinho( $valor, $qtd );

    				}

    				$qtd    =   $this->Carrinho->getQtd() . ' itens: ';

    				$total  =   'R$ ' . number_format( $this->Carrinho->getTotal(), 2, ',', '.' );

    				$result =   array(
    								'message'  =>  'Produto adicionado',
    								'code'     =>  100,
    								'total'    =>  $total,
    								'qtd'      =>  $qtd
    							);

    				echo json_encode( $result ); exit;

    			}else {

    				$this->Essentials->setMessage( 'Quantidade inválida' );

    			}

    		}else {

    			$this->Essentials->setMessage( 'Produto inválido' );

    		}

    	}else {

    		$this->Essentials->setMessage( 'Produto inválido' );

    	}

    }


    /**
    * Método retorna a quantidade total de itens no carrinho
    *
    * @param  NULL
    * @return ARRAY JSON
    * @access PUBLIC
    */
    public function getDataCarrinho() {

        $qtd    =   $this->Carrinho->getQtd() . ' itens: ';

        $total  =   'R$ ' . number_format( $this->Carrinho->getTotal(), 2, ',', '.' );

        $result =   array(
                        'message'  =>  'Produto adicionado',
                        'code'     =>  100,
                        'total'    =>  $total,
                        'qtd'      =>  $qtd
                    );

        echo json_encode( $result ); exit;

    }


    /**
    * Método deleta produtos do carrinho
    *
    * @param  INT   $id[num] -  ID do produto que será deletado
    * @param  INT   $qtd     -  Quantidade de produtos que serão deletados
    * @return ARRAY JSON
    * @access PUBLIC
    */
    public function deletar() {

        $qtd  =   $this->input->post( 'qtd' );

        if( is_numeric( $qtd ) && $qtd > 0 ) {

            $produtos   =   array();

            for( $i = 0; $i < $qtd; $i++ ) {

                $id              =  $this->input->post( 'id' . $i );

                if( !is_numeric( $id ) ) {

                    $this->Essentials->setMessage( 'Item de número ' . ($i + 1) . ' inválido' );

                }

                $produtos[ $i ]  =  $id;

            }

            foreach ($produtos as $key => $value) {

                $this->Carrinho->idProduto  =  $value;

                $this->Carrinho->delete();

            }

            $this->Essentials->setMessage( 'Deletado com sucesso', 100 );

        }else {

            $this->Essentials->setMessage( 'Selecione os itens para deletar do carrinho' );

        }

    }

    public function deletarItem()
    {

        $id   =  $this->input->post( 'id' );

        $this->Carrinho->idProduto  =  $id ;
        $this->Carrinho->delete();

        $this->Essentials->setMessage( 'Deletado com sucesso', 100 );

    }


    /**
     * Método obtem o valor do frete com base no Cep e tipo de serviço selecionado
     *
     * @param  STRING $cep      -   Cep de destino
     * @param  INT    $servico  -   Tipo de serviço solicitado
     * @return ARRAY
     * @access PUBLIC
     */
    public function getValorFrete() {

        //Recebe os dados via POST
        $cepDestino                 =    $this->input->post( 'cep' );

        $servico                    =    $this->input->post( 'servico' );

        //Obtem somente os inteiros do CEP
        $cep                        =    preg_replace('/\D/', '', $cepDestino);

        //Obtem somente os inteiros do servico
        $servico                    =    preg_replace('/\D/', '', $servico);

        //Instancia a classe usuário
        $this->Usuarios             =    new objects\Usuarios();

        //Instancia a classe usuário
        $this->Vendas               =    new objects\Vendas();

        //Seta o ID do usuário
        $this->Usuarios->idUsuario  =    $this->idUsuario;

        //Verifica se o CEP é válido
        strlen( $cep ) != 8  ?  $this->Essentials->setMessage( 'Cep inválido, selecione um endereço válido, Cep informado: ' . $cep ) : null;

        //Seta o Cep na classe Usuários
        $this->Usuarios->cep    =   $cep;

        //Gera o valor do frete
        $valorFrete   =   $this->generateFrete( $cep, $servico );

        //Prepara os dados para serem retornados
        $result       =   array( 'frete' => number_format( $valorFrete, 2, ',', '.' ), 'cFrete' => $valorFrete );

        //Retorna o valor do frete
        echo json_encode( $result );

        //Sai do script
        exit;

    }

    public function getValorFreteCarrinho() {

        //Recebe os dados via POST
        $cepDestino                 =    $this->input->post( 'cep' );

        //$servico                    =    $this->input->post( 'servico' );

        $this->Usuarios             =    new objects\Usuarios();

        //Instancia a classe usuário
        $this->Vendas               =    new objects\Vendas();

        //Obtem somente os inteiros do CEP
        $cep                        =    preg_replace('/\D/', '', $cepDestino);

        //Obtem somente os inteiros do servico
        //$servico                    =    preg_replace('/\D/', '', $servico);

        //Verifica se o CEP é válido
        strlen( $cep ) != 8  ?  $this->Essentials->setMessage( 'Cep inválido, selecione um endereço válido, Cep informado: ' . $cep) : null;

        //Gera o valor do frete
        $result   =   $this->generateFreteToCart( $cep );

        //Prepara os dados para serem retornados
        //$result       =   array( 'frete' => number_format( $valorFrete, 2, ',', '.' ), 'cFrete' => $valorFrete );

        //Retorna o valor do frete
        echo json_encode( $result );

        //Sai do script
        exit;

    }


    /**
     * Método gera o valor do frete e o retorna. O valor é gerado pelo processamento dos itens no carrinho e do valor adicional a ser somado
     *
     * @param
     * @param
     * @return MIX ARRAY JSON | DECIMAL
     * @access PROTECTED
     */
    protected function generateFrete( $cep, $servico )
    {
        //Instancia a classe General
        $this->General                =    new extend\General();

        //Instancia a classe de XML e seta o valor retornado pelo Correios
        $this->XmlParser              =    new parser\Xml();

        //Instancia a classe de configurações
        $this->Config                 =    new objects\Configuracoes();

        //Obtem o código do servico
        $servico  =   $this->Vendas->getCodeServicoEntrega( $servico );

        //Verifica se o serviço foi encontrado
        is_bool( $servico ) ? $this->Essentials->setMessage( 'O serviço selecionado é inválido' ) : null;

        //Verifica se o cep existe
        $response   =   $this->Usuarios->cepExists();

        //Verifica se o retorno é falso, se sim, erro, CEP inválido
        //!$response  ?  $this->Essentials->setMessage( 'Cep inválido, selecione um endereço válido, Cep informado: ' . $cep ) : null;

        //Obtem o Cep de origem
        $cepOrigem                    =  $this->Config->getCepOrigem();

        //Erro, cep de origem não cadastrado
        is_bool( $cepOrigem ) ?  $this->Essentials->setMessage( 'Ocorreu um erro ao obter o valor do frete' ) : null;

        //Obtem os produtos do carrinho
        $produtos  =   $this->Carrinho->getProdutos();

        //Verifica se o carrinho está vazio
        count( $produtos ) == 0 ? $this->Essentials->setMessage( 'Seu carrinho está vázio, sua compra não foi finalizada' ) : null;

        //Seta o valor inicial do frete
        $frete   =   0.00;

        $i       =   0;

        //Extraindo todos os produtos
        foreach ($produtos as $key ) {

            //Instancia a classe correios
            $this->Correios                  =    new connection\Correios();

            //Seta o serviço
            $this->Correios->nCdServico      =    $servico;

            //Seta o cep de origem
            $this->Correios->sCepOrigem      =    $cepOrigem;

            $this->Correios->sCepDestino     =    $cep;

            //Seta o ID do produto na classe
            $this->Produtos->idProduto       =   $key['id'];

            //Recebe a quantidade do produto
            $qtd                             =   $key['qtd'];

            //Obtem o valor do peso do produto
            $this->Correios->nVlPeso         =   $this->Produtos->getDataEspecificProduct( 4 );

            //Obtem o valor da largura do produto
            $this->Correios->nVlLargura      =   $this->Produtos->getDataEspecificProduct( 5 );

            //OBtem o valor da altura do produto
            $this->Correios->nVlAltura       =   $this->Produtos->getDataEspecificProduct( 6 );

            //Obtem o valor do comprimento do produto
            $this->Correios->nVlComprimento  =   $this->Produtos->getDataEspecificProduct( 7 );

            //Prepara os dados
            $this->Correios->prepareData();

            //Realiza a consulta no correios
            $response          =   $this->Correios->getFrete();

            //Seta o Xml na classe
            $this->XmlParser->Xml  =   $response;

            //Verifica se o XML é válido
            !$this->XmlParser->isXml() ? $this->Essentials->setMessage( 'Ocorreu um erro ao consultar o Frete' ) : null;

            //Converte o XML para array
            $response          =   $this->XmlParser->toArray();

            //Verifica se o retorno da conversão é um array válido
            if( is_array( $response ) ) {

                //Verifica se existe algum erro
                $error  =   $this->Correios->getError( $response['cServico']['Erro'] );

                if( is_bool( $error ) ) {

                    $valor   =   $this->General->number_format( $response['cServico']['Valor'] );

                    $this->infoFrete[$i]['id']     =   $key['id'];

                    $this->infoFrete[$i]['valor']  =   $valor;

                    //Multiplica o valor do frete pela quantidade do produto e soma na variável Frete
                    $frete  +=  ( $valor * $qtd );

                    $i++;

                }else {

                    $this->Essentials->setMessage( 'Ocorreu um erro ao consultar o Frete' );

                }

            }else {

                $this->Essentials->setMessage( 'Ocorreu um erro ao consultar o Frete' );

            }

        }

        //Obtem o valor adicional para o frete
        $valorAddFrete   =   $this->Config->getValorAddFrete();

        //Obtem o valor do frete somando ao valor adicional do frete
        $valorFrete      =   $frete + $valorAddFrete;

        //Retorna os dados
        return $valorFrete;

    }

    protected function generateFreteToCart( $cep )
    {

        //Instancia a classe General
        $this->General                =    new extend\General();

        //Instancia a classe de XML e seta o valor retornado pelo Correios
        $this->XmlParser              =    new parser\Xml();

        //Instancia a classe de configurações
        $this->Config                 =    new objects\Configuracoes();

        //Obtem o código do servico

        $servicos  = array();

        $servicos  = array(array('id' => 1,'nome' => 'PAC'),array('id' => 2,'nome' => 'SEDEX'));

        //Verifica se o serviço foi encontrado
        //is_bool( $servico ) ? $this->Essentials->setMessage( 'O serviço selecionado é inválido' ) : null;

        //Verifica se o cep existe
        //$response   =   $this->Usuarios->cepExists();

        //Verifica se o retorno é falso, se sim, erro, CEP inválido
        //!$response  ?  $this->Essentials->setMessage( 'Cep inválido, selecione um endereço válido, Cep informado: ' . $cep ) : null;

        //Obtem o Cep de origem 04205-002
        $cepOrigem                    =  $this->Config->getCepOrigem();

        //Erro, cep de origem não cadastrado
        is_bool( $cepOrigem ) ?  $this->Essentials->setMessage( 'Ocorreu um erro ao obter o valor do frete' ) : null;

        //Obtem os produtos do carrinho
        $produtos  =   $this->Carrinho->getProdutos();

        //Verifica se o carrinho está vazio
        count( $produtos ) == 0 ? $this->Essentials->setMessage( 'Seu carrinho está vázio, sua compra não foi finalizada' ) : null;

        $valoresFrete = array();

        foreach($servicos as $key => $servico) {

             $serv  =   $this->Vendas->getCodeServicoEntrega( $servico['id'] );

            //Seta o valor inicial do frete
            $frete   =   0.00;

            $i       =   $key;

            //Extraindo todos os produtos
            foreach ($produtos as $key ) {

                //Instancia a classe correios
                $this->Correios                  =    new connection\Correios();

                //Seta o serviço
                $this->Correios->nCdServico      =    $serv;

                //Seta o cep de origem
                $this->Correios->sCepOrigem      =    $cepOrigem;

                $this->Correios->sCepDestino     =    $cep;

                //Seta o ID do produto na classe
                $this->Produtos->idProduto       =   $key['id'];

                //Recebe a quantidade do produto
                $qtd                             =   $key['qtd'];

                //Obtem o valor do peso do produto
                $this->Correios->nVlPeso         =   $this->Produtos->getDataEspecificProduct( 4 );

                //Obtem o valor da largura do produto
                $this->Correios->nVlLargura      =   $this->Produtos->getDataEspecificProduct( 5 );

                //OBtem o valor da altura do produto
                $this->Correios->nVlAltura       =   $this->Produtos->getDataEspecificProduct( 6 );

                //Obtem o valor do comprimento do produto
                $this->Correios->nVlComprimento  =   $this->Produtos->getDataEspecificProduct( 7 );

                //Prepara os dados
                $this->Correios->prepareData();

                //Realiza a consulta no correios
                $response          =   $this->Correios->getFrete();

                //Seta o Xml na classe
                $this->XmlParser->Xml  =   $response;

                //Verifica se o XML é válido
                !$this->XmlParser->isXml() ? $this->Essentials->setMessage( 'Ocorreu um erro ao consultar o Frete' ) : null;

                //Converte o XML para array
                $response          =   $this->XmlParser->toArray();

                //Verifica se o retorno da conversão é um array válido
                if( is_array( $response ) ) {

                    //Verifica se existe algum erro
                    $error  =   $this->Correios->getError( $response['cServico']['Erro'] );

                    if( is_bool( $error ) ) {

                        $valor   =   $this->General->number_format( $response['cServico']['Valor'] );

                        $this->infoFrete[$i]['id']     =   $key['id'];

                        $this->infoFrete[$i]['valor']  =   $valor;

                        //Multiplica o valor do frete pela quantidade do produto e soma na variável Frete
                        $frete  +=  ( $valor * $qtd );

                        $i++;

                    }else {

                        $this->Essentials->setMessage( 'Ocorreu um erro ao consultar o Frete' );

                    }

                }else {

                    $this->Essentials->setMessage( 'Ocorreu um erro ao consultar o Frete' );

                }

            }

         //Obtem o valor adicional para o frete
        $valorAddFrete   =   $this->Config->getValorAddFrete();

        //Obtem o valor do frete somando ao valor adicional do frete
        $valoresFrete[]  =   array('nome' => $servico['nome'], 'valor' => $frete);

        //Retorna os dados

        }


        return $valoresFrete;

    }

    protected function generateFreteFromCifrete( $cep )
    {

        $this->load->library('connection/cifrete');

		$this->cifrete->setCepOrigem('04205002');
		$this->cifrete->setCepDestino($cep);
		$this->cifrete->setMaoPropria('s');
        $this->cifrete->setAvisoRecebimento('s');

        //Obtem os produtos do carrinho
        $produtos  =   $this->Carrinho->getProdutos();

        //Verifica se o carrinho está vazio
        count( $produtos ) == 0 ? $this->Essentials->setMessage( 'Seu carrinho está vázio, sua compra não foi finalizada' ) : null;

        //Seta o valor inicial do frete
        $frete   =   0.00;

        $i       =   0;

        $data['preco_pac'] = 0;
        $data['preco_sedex'] = 0;
        $data['preco_esedex'] = 0;

        $data['preco_pac_prazo'] = 0;
        $data['preco_sedex_prazo'] = 0;
        $data['preco_esedex_prazo'] = 0;

        //Extraindo todos os produtos
        foreach ($produtos as $key ) {

            //Seta o ID do produto na classe
            $this->Produtos->idProduto       =   $key['id'];

            //Recebe a quantidade do produto
            $qtd                             =   $key['qtd'];

            $altura = 0;
            $largura = 0;
            $comprimento = 0;
            $peso = 0;
            $diametro = $altura + $largura;

            foreach(range(1, $qtd) as $item) {

                $altura += (float)$this->Produtos->getDataEspecificProduct( 6 );
                $largura += (float)$this->Produtos->getDataEspecificProduct( 5 );
                $comprimento += (float)$this->Produtos->getDataEspecificProduct( 7 );
                $peso += (float)$this->Produtos->getDataEspecificProduct( 4 );
                $diametro += $altura + $largura;

            }

            $this->cifrete->setDiametro($diametro);
            $this->cifrete->setValor('0');
            $this->cifrete->setComprimento($comprimento);
            $this->cifrete->setLargura($largura);
            $this->cifrete->setAltura($altura);
            $this->cifrete->setPeso($peso);
            $this->cifrete->setFormato('1');
            $this->cifrete->setEmpresaSenha('');
            $this->cifrete->setEmpresaCodigo('');
            $this->cifrete->setPacRetorno(TRUE);
            $this->cifrete->setSedexRetorno(TRUE);
            $this->cifrete->setESedexRetorno(FALSE);
            $this->cifrete->calcular();

            $data['preco_pac'] += $this->cifrete->getResultadoPac();
            $data['preco_sedex'] += $this->cifrete->getResultadoSedex();
            $data['preco_esedex'] += $this->cifrete->getResultadoESedex();

            $data['preco_pac_prazo'] = $this->cifrete->getResultadoPacEntrega();
            $data['preco_sedex_prazo'] = $this->cifrete->getResultadoSedexEntrega();
            $data['preco_esedex_prazo'] = $this->cifrete->getResultadoESedexEntrega();

        }



        return $data;

    }

    public function irParaCheckout()
    {
        !$this->Login->checkLogin() ? redirect('/minha/conta/login') : null;
    }

}
