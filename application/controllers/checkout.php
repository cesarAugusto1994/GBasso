<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("America/New_York");

class Checkout extends CI_Controller{

    private $Essentials =  null;

    private $Header    =  null;

    private $Produtos  =  null;

    private $Menus     =  null;

    private $Carrinho  =  null;

    private $Usuarios  =  null;

    private $Login     =  null;

    private $Categorias  =  null;

    private $Vendas = null;

    protected $token      =  'F103EDB34EC44003885F413C377F3F42';
    protected $email      =  'cezzaar@gmail.com';
    protected $emailLoja  =  'v41547011778302880350@sandbox.pagseguro.com.br';

    private $idUsuario;

    protected $notify     =  'http://www.grupobasso.com.br/compras/checkout/notificacao';
    protected $urlPagSegTransactions  =  'https://ws.pagseguro.uol.com.br/v2/transactions/';
    protected $urlPagseguro  =  'https://ws.pagseguro.uol.com.br/v2/';
    
	public function __construct() {        		
        
        parent::__construct();        

        //Instacia a classe Essential do package Security
        $this->Essential  =   new security\Essentials;

        //Instacia header para manipular arquivos css e js do sistema
        $this->Header     =   new data\Header( base_url() );

        //Instancia a classe de produtos
        $this->Produtos   =   new objects\Produtos;

        $this->Menus      =   new objects\Menus;
        
        $this->Categorias =   new objects\Categorias;

        $this->Config     =    new objects\Configuracoes();

        $this->Login      =   new sessions\Login(2); 

        $this->Essentials =   new security\Essentials;

        $this->Vendas     =   new objects\Vendas;

        $this->Usuarios   =   new objects\Usuarios;

        $this->Carrinho   =   new sessions\Carrinho;

        $this->load->config('pagseguro');
		$this->load->library('pagseguro');

        $this->pgAccount = $this->config->item ( 'pagseguroAccount' );
		$this->pgToken = $this->config->item ( 'pagseguroToken' );

        $this->email      =  $this->Config->getUsuarioApiPagseguro();
        $this->token      =  $this->Config->getTokenApiPagseguro();
	
    }

    /**
    * Visualiza o carrinho
    *
    * @param  NULL
    * @return null
    * @access PUBLIC
    */
    public function carrinho() 
    {
        $data  =  array();

        $this->Carrinho            =   new sessions\Carrinho;

        $this->Usuarios            =   new objects\Usuarios;

        $this->Login               =   new sessions\Login(2);

        $this->Essentials           =   new security\Essentials;

        $this->Usuarios->idUsuario =   $this->Login->getIdUser();

        $nome = $this->Usuarios->getFullName();

        $email = $this->Usuarios->getEmail();

        $cpf = $this->Usuarios->getCpf();
        
        if( is_bool( $nome ) ) {

            $nome  =  'Visitante';

        }else {

            $bName  =   explode(' ', $nome);

            if( count( $bName ) >= 2 ) {

                $nome   =   $bName[0] . ' ' . $bName[1];

            }else {

                $nome   =   $bName[0];

            }

        }

        //Define data info to header
        $data['header']            =   array();

        //Define data info to body
        $data['body']              =   array();

        //Define data info to footer
        $data['footer']            =   array();

        //Declara o array que vai levar todas as imagens
        $data['body']['images']    =   array();

        $js    =  array( 0, 1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14, 20, 22 );

        $css   =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        $fJs   =  array( 18, 15, 17, 19 );

        $produtos                       =   $this->Carrinho->getProdutos();

        $produtos                       =   $this->Produtos->getProdutosByCart( $produtos );

        $total                          =   $this->Carrinho->getTotal();

        $logado = $this->Login->checkLogin() ? true :  false;

        $data['header']['url']          =   base_url();

        $data['header']['css']          =   $this->Header->getCss( $css );

        $data['header']['catss']        =   $this->Menus->getCategorias();

        $data['header']['categorias']    =  $this->Categorias->getCategoriasToHome();

        $data['header']['js']           =   $this->Header->getJs( $js );

        $data['header']['inc']          =   '';

        $data['header']['pesq']  =   "";

        $data['header']['menus']        =   $this->Menus->getMenusToHome(); 

        $data['header']['inc']          =   $this->Header->getIncludes( array( 1, 7 ) );

        $data['header']['nome']         =   $nome;        

        $data['header']['email']        =   $email;  

        $data['header']['cpf']          =   $cpf;

        $data['header']['total']        =   number_format( $total, 2, ',', '.' );

        $data['header']['logado']       =   $logado;

        $data['body']['totalS']         =   $total;

        $data['body']['logado']         =   $logado;

        $data['body']['images']         =   $this->Produtos->getAllImages();

        $data['body']['imageDefault']   =   $this->Produtos->getImageDefaultDiretory();

        $data['body']['carrinho']       =   $produtos;

        $data['body']['total']          =   number_format( $this->Carrinho->getTotal(), 2, ',', '.');

        $data['body']['info']           =   $this->Produtos->getInfoProdutoView();

        $data['body']["url"]            =   base_url();

        $data['footer']["url"]          =   base_url();

        $data['footer']['js']           =   $this->Header->getJs( $fJs );
        
        $this->parser->parse("default/header", $data['header']);

        $this->parser->parse('carrinho', $data['body']);

        $this->parser->parse('default/footer', $data['footer']);

    }

    public function preCheckout()
    {
    
        $data  =  array();

        $this->Carrinho            =   new sessions\Carrinho;

        $this->Usuarios            =   new objects\Usuarios;

        $this->Login               =   new sessions\Login(2);

        if($this->Login->getIdUser()) {
            return redirect('http://www.grupobasso.com.br/compras/checkout');
        }

        $this->Usuarios->idUsuario =   $this->Login->getIdUser();

        $nome = $this->Usuarios->getFullName();

        $email = $this->Usuarios->getEmail();

        $cpf = $this->Usuarios->getCpf();

        if( is_bool( $nome ) ) {

            $nome  =  'Visitante';

        }else {

            $bName  =   explode(' ', $nome);

            if( count( $bName ) >= 2 ) {

                $nome   =   $bName[0] . ' ' . $bName[1];

            }else {

                $nome   =   $bName[0];

            }

        }

        //Define data info to header
        $data['header']            =   array();

        //Define data info to body
        $data['body']              =   array();

        //Define data info to footer
        $data['footer']            =   array();

        //Declara o array que vai levar todas as imagens
        $data['body']['images']    =   array();

        $js    =  array( 0, 1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14, 20, 22 );

        $css   =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        $fJs   =  array( 18, 15, 17, 19 );

        $produtos                       =   $this->Carrinho->getProdutos();

        $produtos                       =   $this->Produtos->getProdutosByCart( $produtos );

        $total                          =   $this->Carrinho->getTotal();

        $data['header']['url']          =   base_url();

        $data['header']['css']          =   $this->Header->getCss( $css );

        $data['header']['catss']        =   $this->Menus->getCategorias();

        $data['header']['categorias']    =   $this->Categorias->getCategoriasToHome();

        $data['header']['js']           =   $this->Header->getJs( $js );

        $data['header']['inc']          =   '';

        $data['header']['pesq']  =   "";

        $data['header']['menus']        =   $this->Menus->getMenusToHome(); 

        $data['header']['inc']          =   $this->Header->getIncludes( array( 1, 7 ) );

        $data['header']['nome']         =   $nome;        

        $data['header']['email']        =   $email;  

        $data['header']['cpf']          =   $cpf;

        $data['header']['total']        =   number_format( $total, 2, ',', '.' );

        $data['header']['logado']       =   $this->Login->checkLogin() ? true :  false;

        $data['body']['totalS']         =   $total;

        $data['body']['images']         =   $this->Produtos->getAllImages();

        $data['body']['imageDefault']   =   $this->Produtos->getImageDefaultDiretory();

        $data['body']['carrinho']       =   $produtos;

        $data['body']['total']          =   number_format( $this->Carrinho->getTotal(), 2, ',', '.');

        $data['body']['info']           =   $this->Produtos->getInfoProdutoView();

        $data['body']["url"]            =   base_url();

        $data['footer']["url"]          =   base_url();

        $data['footer']['js']           =   $this->Header->getJs( $fJs );
        
        $this->parser->parse("default/header", $data['header']);

        $this->parser->parse('precheckout', $data['body']);

        $this->parser->parse('default/footer', $data['footer']);

    }

    public function index()
    {
        $data  =  array();

        $this->Carrinho            =   new sessions\Carrinho;

        $this->Usuarios            =   new objects\Usuarios;

        $this->Login               =   new sessions\Login(2);

        $this->Config                 =    new objects\Configuracoes();

        $produtos                       =   $this->Carrinho->getProdutos();

        $produtos                       =   $this->Produtos->getProdutosByCart( $produtos );

        $total                          =   $this->Carrinho->getTotal();

        if(empty($produtos)) {
            return redirect('http://www.grupobasso.com.br/');   
        }

        $userEmail = $this->input->post( 'email' );

        $this->Usuarios->idUsuario =   $this->Login->getIdUser();

        $nome = $this->Usuarios->getFullName();

        $email = $this->Usuarios->getEmail();

        $cpf = $this->Usuarios->getCpf();

        $telefoneCelular = $this->Usuarios->getTelefoneCelular();
        $telefonePrincipal= $this->Usuarios->getTelefonePrincipal();

        $telefone = $telefoneCelular ? $telefoneCelular : $telefonePrincipal;

        $ddd = "";
        $telefoneNumero = "";

        if(!empty($telefone)) {
            $ddd = substr($telefone, 0, 2);
            $telefoneNumero = substr($telefone, 2);
        }

        if( is_bool( $nome ) ) {

            $nome  =  'Visitante';

        }else {

            $bName  =   explode(' ', $nome);

            if( count( $bName ) >= 2 ) {

                $nome   =   $bName[0] . ' ' . $bName[1];

            }else {

                $nome   =   $bName[0];

            }

        }

        $parcelasSemJuros          =   $this->Config->getParcelasSemJuros();

        //Define data info to header
        $data['header']            =   array();

        //Define data info to body
        $data['body']              =   array();

        //Define data info to footer
        $data['footer']            =   array();

        //Declara o array que vai levar todas as imagens
        $data['body']['images']    =   array();

        $js    =  array( 0, 1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14, 20, 22 );

        $css   =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        $fJs   =  array( 18, 15, 17, 19 );


        $enderecos = $this->Usuarios->getAllEndereco();

        $enderecoPrincipal = array_filter($enderecos, function($end) {
            return $end['pri'] == 'Sim';
        });

        $enderecoPrincipal = !empty($enderecoPrincipal) ? $enderecoPrincipal[0] : $enderecos[0];
        
        $data['header']['url']          =   base_url();

        $data['header']['css']          =   $this->Header->getCss( $css );

        $data['header']['catss']        =   $this->Menus->getCategorias();

        $data['header']['categorias']    =   $this->Categorias->getCategoriasToHome();

        $data['header']['js']           =   $this->Header->getJs( $js );

        $data['header']['inc']          =   '';

        $data['header']['pesq']  =   "";

        $data['header']['menus']        =   $this->Menus->getMenusToHome(); 

        $data['header']['inc']          =   $this->Header->getIncludes( array( 1, 7 ) );

        $data['header']['nome']         =   $nome;        

        $data['header']['email']        =   $email;  

        $data['header']['cpf']          =   $cpf;

        $data['header']['total']        =   number_format( $total, 2, ',', '.' );

        $data['header']['logado']       =   $this->Login->checkLogin() ? true :  false;

        $data['body']['totalS']         =   $total;

        $data['body']['images']         =   $this->Produtos->getAllImages();

        $data['body']['imageDefault']   =   $this->Produtos->getImageDefaultDiretory();

        $data['body']['carrinho']       =   $produtos;

        $data['body']['total']          =   number_format( $this->Carrinho->getTotal(), 2, ',', '.');

        $data['body']['info']           =   $this->Produtos->getInfoProdutoView();

        $data['body']["url"]            =   base_url();

        $data['body']["ddd"]            =   $ddd;

        $data['body']["telefone"]            =   $telefoneNumero;

        $data['body']["enderecoPrincipal"]  =  $enderecoPrincipal;

        $data['body']["enderecos"]  =   $enderecos;
        
        $data['body']["usuario"]  =   $this->Usuarios->getAllDataUser();
        
        $data['body']["parcelasSemJuros"]  =   $parcelasSemJuros;

        $data['footer']["url"]          =   base_url();

        $data['footer']['js']           =   $this->Header->getJs( $fJs );
        
        $this->parser->parse("default/header", $data['header']);

        $this->parser->parse('checkout', $data['body']);

        $this->parser->parse('default/footer', $data['footer']);

    }

    public function getSession()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->urlPagseguro . 'sessions?email=' . $this->emailLoja . '&token=' . $this->token);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, true);

        $data = curl_exec($ch);
        $xml = new SimpleXMLElement($data, null, true);

        echo $xml->id;
        curl_close($ch);
    }

    public function getProdutos()
    {
        $this->Carrinho = new sessions\Carrinho;

        $produtos                       =   $this->Carrinho->getProdutos();

        return $produtos;
    }

    public function pagamentoBoleto()
    {
        $result = $this->finalizarCompra();
        
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($result);
        exit;
    }

    public function pagamentoCartao()
    {
        $result = $this->finalizarCompra();

        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($result);
        exit;
    }

    public function finalizarCompra()
    {
        $this->Usuarios             =   new objects\Usuarios();

        $this->Login               =   new sessions\Login(2);

        $this->Essentials           =   new security\Essentials;

        $this->Usuarios->idUsuario =   $this->Login->getIdUser();

        $tpPag = $this->input->post( 'tpPag' ); 
        $gateway = 1; 
        $idEndereco = $this->input->post( 'enderecoId' ); 
        $cep = $this->input->post( 'cep' );
        $servico = $this->input->post( 'servico' );

        $cep               =   preg_replace('/\D/', '', $cep);

        $this->Usuarios->cep    =   $cep;

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
        //$valorFrete                =   $this->Config->getValorSemFrete() > $this->Carrinho->getTotal() ? $valorFrete : 0.00;

        $parcelasSemJuros          =   $this->Config->getParcelasSemJuros();

        //Determina se o frete foi cobrado ou não
        $flagFreteCobrado          =   $valorFrete > 0 ? 1 : 0;

        //
        $result = array();

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
                    //$response   =  $this->callPaymentDebitoOnline( $valorFrete, $parcelasSemJuros, $servico );
                break;            
            }

            //Verifica se o retorno é falso
            if( !$response ) {

                //echo 'error';

                //Grava o log do erro
                $this->Vendas->gravarLogError( 'Pagseguro não retornou um XML válido', 0000, 0 );

                //Envia a mensagem para o usuário
                $this->Essentials->setMessage( 'Sua compra foi processada e estamos aguardando confirmação da operadora', 102 );

            }else {

                #Agora vamos processar os dados retornados da venda
                //Converte o XML para array
                $data    =    $this->XmlParser->toArray();

                //var_dump($data);exit;

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
                    $this->Carrinho->deleteAll();

                    if ( $tpPag == 2 || $tpPag == 3 ) {

                        //get link do boleto
                        $link    =  $this->Vendas->getLinkBoleto();

                        $result  =  array( 'link' => $link, 'code' => 100, 'message' => 'Sua compra foi finalizada com sucesso, estamos aguardando a confirmação da operadora.' );

                        //Retorna os dados em formato json
                        //echo json_encode( $result ); exit;

                        return $result;

                    } else {

                        $result  =  array( 
                                        'message'  =>  'Sua compra foi finalizada com sucesso, estamos aguardando a confirmação da operadora.',
                                        'code'     =>  100,
                                        'ref'      =>  $this->Vendas->referencia
                                    );

                        //echo json_encode( $result );

                        return $result;
                    }

                }

            }

        }

        return $result;

    }

    public function finalizado()
    {
         $data  =  array();

        $this->Usuarios            =   new objects\Usuarios;

        $this->Login               =   new sessions\Login(2);

        $produtos                       =   $this->Carrinho->getProdutos();

        $produtos                       =   $this->Produtos->getProdutosByCart( $produtos );

        $total                          =   $this->Carrinho->getTotal();

        $this->Usuarios->idUsuario =   $this->Login->getIdUser();

        $nome = $this->Usuarios->getFullName();

        $email = $this->Usuarios->getEmail();

        $cpf = $this->Usuarios->getCpf();

        if( is_bool( $nome ) ) {

            $nome  =  'Visitante';

        }else {

            $bName  =   explode(' ', $nome);

            if( count( $bName ) >= 2 ) {

                $nome   =   $bName[0] . ' ' . $bName[1];

            }else {

                $nome   =   $bName[0];

            }

        }

        //Define data info to header
        $data['header']            =   array();

        //Define data info to body
        $data['body']              =   array();

        //Define data info to footer
        $data['footer']            =   array();

        //Declara o array que vai levar todas as imagens
        $data['body']['images']    =   array();

        $js    =  array( 0, 1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14, 20, 22 );

        $css   =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

        $fJs   =  array( 18, 15, 17, 19 );
        
        $data['header']['url']          =   base_url();

        $data['header']['css']          =   $this->Header->getCss( $css );

        $data['header']['catss']        =   $this->Menus->getCategorias();

        $data['header']['categorias']    =   $this->Categorias->getCategoriasToHome();

        $data['header']['js']           =   $this->Header->getJs( $js );

        $data['header']['inc']          =   '';

        $data['header']['pesq']  =   "";

        $data['header']['menus']        =   $this->Menus->getMenusToHome(); 

        $data['header']['inc']          =   $this->Header->getIncludes( array( 1, 7 ) );

        $data['header']['nome']         =   $nome;        

        $data['header']['email']        =   $email;  

        $data['header']['cpf']          =   $cpf;

        $data['header']['total']        =   number_format( $total, 2, ',', '.' );

        $data['header']['logado']       =   $this->Login->checkLogin() ? true :  false;

        $data['body']['totalS']         =   $total;

        $data['body']['images']         =   $this->Produtos->getAllImages();

        $data['body']['imageDefault']   =   $this->Produtos->getImageDefaultDiretory();

        $data['body']['carrinho']       =   $produtos;

        $data['body']['total']          =   number_format( $this->Carrinho->getTotal(), 2, ',', '.');

        $data['body']["url"]            =   base_url();

        $data['body']["linkBoleto"]     =   isset($_GET['link']) ? $_GET['link'] : null;

        $data['body']["usuario"]  =   $this->Usuarios->getAllDataUser();

        $data['footer']["url"]          =   base_url();

        $data['footer']['js']           =   $this->Header->getJs( $fJs );
        
        $this->parser->parse("default/header", $data['header']);

        $this->parser->parse('finalizado', $data['body']);

        $this->parser->parse('default/footer', $data['footer']);
    }

    public function callPaymentBoleto( $valorFrete, $parcelasSemJuros, $servico ) 
    {

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

        $cep               =   $this->input->post( 'cep' );

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
        strlen( $telefone ) > 9 || !is_numeric( $telefone ) ? $this->Essentials->setMessage( 'Telefone inválido' ) : null;

        //Valida o CEP
        strlen( $cep ) != 8 || !is_numeric( $cep ) ? $this->Essentials->setMessage( 'Cep inválido' ) : null;

        //Seta o ID do usuário na classe Usuários
        $this->Vendas->idUsuario   =   $this->Login->getIdUser();

        //Seta o CEP
        $this->Usuarios->cep       =   $cep;

        //Get full endereço
        $endereco                  =   $this->Usuarios->getFullEndereco();

        if(empty($endereco['est'])) {
            $endereco['end'] = $this->input->post( 'endereco' );
            $endereco['bai'] = $this->input->post( 'bairro' );
            $endereco['cid'] = $this->input->post( 'cidade' );
            $endereco['est'] = $this->input->post( 'estado' );
        }

        !isset( $endereco['est'] ) ? $this->Essentials->setMessage( 'Endereço inválido' ) : null;

        if($endereco['est'] == 'Sao Paulo') {
            $endereco['est'] = 'SP';
        }
        
        //Obtem o total da venda
        $totalVenda                =   $this->Carrinho->getTotal();

        //Seta o status da venda como 1: Aguardando pagamento
        $status = 1;

        $servico = 1;

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
            'senderEmail'                    =>  urlencode( $this->emailLoja ),
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
            'shippingCost'                   =>  urlencode( number_format($valorFrete, 2) )
        );

        //Junta o array com os produtos ao array dos parametros
        $data        =   array_merge( $data, $itens );

        //Instancia a classe Curl para conexão em outros servidores
        $this->Curl  =   new connection\Curl( $this->urlPagSegTransactions );

        //Prepara os parametros para o POST
        $data        =   $this->Curl->urlify( $data );

        $this->Curl->setOpt( 'CURLOPT_URL', $this->urlPagSegTransactions . "?email=" . $this->email . "&token=" . $this->token );

        $this->Curl->setOpt( 'CURLOPT_POST', $data );

        $this->Curl->setOpt( 'CURLOPT_POSTFIELDS', $data );

        $this->Curl->setOpt( 'CURLOPT_RETURNTRANSFER', true );

        $this->Curl->setOpt( 'CURLOPT_SSL_VERIFYPEER', false );

        //faz a conexão e recebe os dados
        $response         =   $this->Curl->execute();

        //Seta o retorno na LIB XML
        $this->XmlParser  =   new parser\Xml( $response );

        //Verifica se o retorno é um XML válido
        $response         =   $this->XmlParser->isXml();

        //Retorna se o XML é válido ou não
        return $response;

    }

    public function callPaymentCreditCard( $valorFrete, $parcelasSemJuros, $servico ) 
    {

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

        $cep               =   $this->input->post( 'cep' );

        $total =         $this->input->post( 'total' );

        $parcelas =         $this->input->post( 'numParcelas' );
        $parcelaValor =     $this->input->post( 'valorParcelas' );
        
        $fatores = array(
            1  => 1,
            2  => 0.52255,
            3  => 0.35347,
            4  => 0.26898,
            5  => 0.21830,
            6  => 0.18453,
            7  => 0.16044,
            8  => 0.14240,
            9  => 0.12838,
            10 => 0.11717,
            11 => 0.10802,
            12 => 0.10040,
            13 => 0.08806,
            14 => 0.08254,
            15 => 0.07777,
            16 => 0.07359,
            17 => 0.06991,
            18 => 0.06664
        );

        if($parcelas > 2) {
            //$parcelaValor = number_format(($total) * $fatores[$parcelas], 2);
        }
/*
        echo $total . '<br/>';
        echo $fatores[$parcelas] . '<br/>';
        echo $parcelas . '<br/>';
        echo $parcelaValor; exit;
*/
        $ddd               =   preg_replace('/\D/', '', $ddd);

        $telefone          =   preg_replace('/\D/', '', $telefone);

        $cep               =   preg_replace('/\D/', '', $cep);

        $cpfDono           =   preg_replace('/\D/', '', $cpfDono);

        $dataNascDono = $this->input->post( 'cardNasc' );

        $enderecoId = $this->input->post( 'enderecoId' );

        $tpPag = $this->input->post( 'tpPag' );

        $cardToken = $this->input->post( 'cardToken' );

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
        !is_numeric( $telefone ) ? $this->Essentials->setMessage( 'Telefone inválido' ) : null;

        //Valida o CEP
        strlen( $cep ) != 8 || !is_numeric( $cep ) ? $this->Essentials->setMessage( 'Cep inválido' ) : null;

        //Valida o número de parcelas
        !is_numeric( $parcelas ) || $parcelas < 1 ?  $this->Essentials->setMessage( 'Selecione o número de parcelas' ) : null;

        //Valida o valor da parcela
        !is_numeric( $parcelaValor ) || $parcelaValor < 1 ?  $this->Essentials->setMessage( 'Valor da parcela inválido' ) : null;

        //Valida a data de nascimento
        $this->Dates->validateDate( $dataNascDono ) ?  $this->Essentials->setMessage( 'Data de nascimento inválida' ) : null;

        //$this->finalizarCompra($tpPag, 1, $enderecoId, $cep, 1);

        //Seta o ID do usuário na classe Usuários
        $this->Vendas->idUsuario   =  $this->Login->getIdUser();

        //Seta o CEP
        $this->Usuarios->cep       =   $cep;

        //Get full endereço
        $endereco                  =   $this->Usuarios->getFullEndereco();
        
        if(empty($endereco['est'])) {
            $endereco['end'] = $this->input->post( 'endereco' );
            $endereco['bai'] = $this->input->post( 'bairro' );
            $endereco['cid'] = $this->input->post( 'cidade' );
            $endereco['est'] = $this->input->post( 'estado' );
        }

        !isset( $endereco['est'] ) ? $this->Essentials->setMessage( 'Endereço inválido' ) : null;

        if($endereco['est'] == 'Sao Paulo') {
            $endereco['est'] = 'SP';
        }

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

        $email = $this->emailLoja;

        $valorParcela = number_format( (float) $parcelaValor, 2, '.', '' );

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
            'installmentValue'               =>  urlencode( $valorParcela ),
            'noInterestInstallmentQuantity'  =>  urlencode( $parcelasSemJuros ),
            #'noInterestInstallmentQuantity'  =>  urlencode( 2 ),
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
        $this->Curl  =   new connection\Curl( $this->urlPagSegTransactions );

        //Prepara os parametros para o POST
        $data        =   $this->Curl->urlify( $data );

        $this->Curl->setOpt( 'CURLOPT_URL', $this->urlPagSegTransactions );

        $this->Curl->setOpt( 'CURLOPT_POST', $data );

        $this->Curl->setOpt( 'CURLOPT_POSTFIELDS', $data );

        $this->Curl->setOpt( 'CURLOPT_RETURNTRANSFER', true );

        $this->Curl->setOpt( 'CURLOPT_SSL_VERIFYPEER', false );

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

    public function notificacao() 
    {

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
        if( $type != 'transaction' ) {

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
        $this->Vendas->gravarVenda( $status, '', true, true );

        //Grava o LOG de notificação
        $this->Vendas->gravarLogNotificacao( $ip, $notifyCode );

        //Dados atualizados
        exit( 'Dados atualizados com sucesso' );

    }

    protected function salvarProdutosVenda() 
    {

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
        $valorFrete      =   $frete;

        //Retorna os dados
        return $valorFrete;

    }
}    