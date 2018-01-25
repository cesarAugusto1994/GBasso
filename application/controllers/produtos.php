<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("America/New_York");

class Produtos extends CI_Controller{

    private $Essentials =  null;

    private $Header    =  null;

    private $Produtos  =  null;

    private $Menus     =  null;

    private $Carrinho  =  null;

    private $Usuarios  =  null;

    private $Login     =  null;

    private $Categorias  =  null;

    private $pgAccount = null;
    
    private $pgToken = null;
    
	public function __construct() {        		
        
        parent::__construct();        

        //Instacia a classe Essential do package Security
        $this->Essential  =   new security\Essentials;

        //Instacia header para manipular arquivos css e js do sistema
        $this->Header     =   new data\Header( base_url() );

        //Instancia a classe de produtos
        $this->Produtos   =   new objects\Produtos;

        $this->Menus      =   new objects\Menus;
        
        $this->Categorias  =   new objects\Categorias;

        $this->Usuarios            =   new objects\Usuarios;

        $this->Login               =   new sessions\Login(2);

        $this->Usuarios->idUsuario =   $this->Login->getIdUser();

        $this->load->config('pagseguro');
		$this->load->library('pagseguro');

        $this->pgAccount = $this->config->item ( 'pagseguroAccount' );
		$this->pgToken = $this->config->item ( 'pagseguroToken' );
    }


    /**
    * Método exibe os detalhes de um determinado produto
    *
    * @param  INT $id  -  ID do produto que está sendo consultado
    * @return null
    * @access PUBLIC
    */
    public function index( $id = '' ) {

        $data  =  array();

        //Define data info to header
        $data['header']            =   array();

        //Define data info to body
        $data['body']              =   array();

        //Define data info to footer
        $data['footer']            =   array();

        //Declara o array que vai levar todas as imagens
        $data['body']['images']    =   array();

        //Verifica o ID do produto é um número inteiro
        $response   =   $this->Essential->onlyNumber( $id ) ? true : false;

        if( $response ) {

            //Atribui o ID do produto
            $this->Produtos->idProduto   =  $id;

            $js    =  array( 0, 1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14 );

            $css   =  array( 0, 1, 3, 4, 5, 6, 8, 9, 10, 11, 12, 7 );

            $fJs   =  array( 18, 15, 17, 18 );

            $data['header']['url']          =   base_url();

            $data['header']['css']          =   $this->Header->getCss( $css );

            $data['header']['js']           =   $this->Header->getJs( $js );

            $data['header']['inc']          =   '';

            $data['header']['menus']        =   $this->Menus->getMenusToHome();

            $data['header']['catss']        =   $this->Menus->getCategorias();

            $data['header']['categorias']    =   $this->Categorias->getCategoriasToHome();

            $data['header']['inc']          =   $this->Header->getIncludes( array( 1 ) );

            $data['header']['pesq']  =   "";

            $data['header']['logado']       =   $this->Login->checkLogin() ? true :  false;

            $data['body']['images']         =   $this->Produtos->getAllImages();

            $data['body']['imageDefault']   =   $this->Produtos->getImageDefaultDiretory();

            $data['body']['produto']        =   $this->Produtos->getNameProduto();

            $data['body']['info']           =   $this->Produtos->getInfoProdutoView();

            $data['body']["url"]            =   base_url();

            $data['body']["id"]             =   $id;

            $data['footer']["url"]          =   base_url();

            $data['footer']['js']           =   $this->Header->getJs( $fJs );
            
            $this->parser->parse("default/header", $data['header']);

            $this->parser->parse('produto', $data['body']);

            $this->parser->parse('default/footer', $data['footer']);

        }else {

            echo "Produto inválido";

        }

    }


    /**
    * Visualiza o carrinho
    *
    * @param  NULL
    * @return null
    * @access PUBLIC
    */
    public function carrinho() {

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

    public function checkout()
    {
        $data  =  array();

        $this->Carrinho            =   new sessions\Carrinho;

        $this->Usuarios            =   new objects\Usuarios;

        $this->Login               =   new sessions\Login(2);

        $userEmail = $this->input->post( 'email' );

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

        $data['body']["enderecoPrincipal"]  =  $enderecoPrincipal;

        $data['body']["enderecos"]  =   $enderecos;
        
        $data['body']["usuario"]  =   $this->Usuarios->getAllDataUser();

        $data['footer']["url"]          =   base_url();

        $data['footer']['js']           =   $this->Header->getJs( $fJs );
        
        $this->parser->parse("default/header", $data['header']);

        $this->parser->parse('checkout', $data['body']);

        $this->parser->parse('default/footer', $data['footer']);

    }

    public function getSession()
    {
        ini_set('display_errors', E_ALL);
        ini_set('error_reporting', true);

        //try {

        $ch = curl_init();

        $urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/v2/";
        #$emailPagseguro = "v41547011778302880350@sandbox.pagseguro.com.br";
        #$tokenPagseguro = "56240387G1616477";

        $emailPagseguro = "cezzaar@gmail.com";
        $tokenPagseguro = "F103EDB34EC44003885F413C377F3F42";
        #$urlNotificacao = "http://www.sualoja.com.br/retornopagamento.php";
        $urlNotificacao = "http://www.grupobasso.com.br/retornopagamento";

        //$scriptPagseguro = "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";

        $formatedUri = $urlPagseguro . 'sessions?email=' . $emailPagseguro . '&token=' . $tokenPagseguro;

        //echo $formatedUri;

        curl_setopt($ch, CURLOPT_URL, $formatedUri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, true);

        $data = curl_exec ($ch)or die(curl_errno($ch) .': '. curl_error($ch)); 

        if ( ! $data) {
            print ' ' . curl_errno($ch) .' : '. curl_error($ch);
        }


        $xml = new SimpleXMLElement($data);

        echo $xml->id;
        curl_close($ch);

        //} catch(Exception $e) {
            //echo $e->getMessage();
        //}

        
    }

    public function pagarBoleto()
    {
        $urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/v2/";
        $emailPagseguro = "v41547011778302880350@sandbox.pagseguro.com.br";
        $tokenPagseguro = "56240387G1616477";
        $urlNotificacao = "http://www.sualoja.com.br/retornopagamento.php";

        $scriptPagseguro = "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";

        $xml = $this->gerarXmlBoleto($_POST['id'], $dadosProduto->desc, $valor, $_POST['nome'], $_POST['cpf'], $_POST['ddd'], $_POST['telefone'], $_POST['email'], $_POST['senderHash'], $_POST['endereco'], $_POST['numero'], $_POST['complemento'], $_POST['bairro'], $_POST['cep'], $_POST['cidade'], $_POST['estado']);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlPagseguro . "transactions/?email=" . $emailPagseguro . "&token=" . $tokenPagseguro);
        curl_setopt($ch, CURLOPT_POST, true );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=ISO-8859-1'));

        $data = curl_exec($ch);
        $dataXML = simplexml_load_string($data);

        if (empty($dataXML->paymentLink)) {
            header('Content-Type: application/json; charset=UTF-8');
            $errosOcorridos = array('erro' => '1');
            echo json_encode($dataXML);
        } else {
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode($dataXML);
        }
        curl_close($ch);
    } 



    	
	/**
	 * Pagseguro
	 *
	 * @access public
	 * @param int(11) idVenda
	 */
	public function pagseguro($idVenda) {
		
        if($this->session->userdata('logged_in') == true && $this->session->userdata('userData')->idTipoUsuario == 4) {
	
			$this->data['hasError'] = false;
			$this->data['errorList'] = array();
	
			$venda = array_shift($this->Vendas_model->getVenda(array('idVenda' => $idVenda)));
			// validações
	
			if(!is_object($venda)) {
				$this->data['hasError'] = true;
				$this->data['errorList'][] = array('message' => 'Não foi possível localizar sua compra.');
			}
	
			if(!$this->data['hasError']) {
				$userObj = $this->session->userdata ( 'userData' );
				$promocao = $this->Promocoes_model->getPromocaoById($venda->idPromocao);
	
				// Pega o estado do usuário
				$estadoObj = null;
				if($userObj->idEstado) {
					$filter = array ('idEstado' =>  $userObj->idEstado);
					$estadoObj = array_shift ( $this->Estados_model->getEstado ( $filter ) );
				}
	
				// Instantiate a new payment request
				$paymentRequest = new PagSeguroPaymentRequest ();
	
				// Sets the currency
				$paymentRequest->setCurrency ( "BRL" );
	
				// Sets a reference code for this payment request, it is useful to
				// identify this payment in future notifications.
				$paymentRequest->setReference ( $venda->idVenda );
	
				// Add an item for this payment request
				$paymentRequest->addItem ( '0001', truncate(utf8_decode($promocao->nome), 80, '...'), 1, number_format ( $venda->valorDevido, 2, '.', '' ) );
	
				$paymentRequest->setShippingType ( 3 );
				$paymentRequest->setShippingAddress ( str_replace ( '-', '', str_replace ( '.', '', $userObj->CEP ) )
						, utf8_decode($userObj->endereco)
						, $userObj->numero
						, utf8_decode($userObj->complemento)
						, utf8_decode($userObj->bairro)
						, utf8_decode($userObj->cidade)
						, (($estadoObj->sigla)? $estadoObj->sigla : ''), 'BRA' );
	
				// Sets your customer information.
				$telefone = numbersOnly($userObj->telefone1);
				$paymentRequest->setSenderName(utf8_decode(truncate($userObj->nome, 49)));
				$paymentRequest->setSenderEmail($userObj->email);
				$paymentRequest->setSenderPhone(substr ( $telefone, 0, 2 ), substr ( $telefone, 2, 8 ));
	
				$paymentRequest->setRedirectUrl ( base_url('ofertas/retornoPagamento') );
				$paymentRequest->setMaxAge(86400 * 3);
	
				try {
					$credentials = new PagSeguroAccountCredentials ( $this->config->item ( 'pagseguroAccount' ), $this->config->item ( 'pagseguroToken' ) );
					$url = $paymentRequest->register ( $credentials );
	
					$dados = array(
							'meioPagamento' => 2
							,'statusPagamento' => 1
							,'dataAtualizacao' => date('Y-m-d H:i:s')
					);
	
					$this->Vendas_model->update($dados, $venda->idVenda);
					redirect ( $url );
	
				} catch ( PagSeguroServiceException $e ) {
					$this->data['hasError'] = true;
					$this->data['errorList'][] = array('message' => 'Ocorreu um erro ao comunicar com o Pagseguro.' .$e->getCode() . ' - ' .  $e->getMessage());
				}
	
    
			}
		} else {
			redirect(base_url('login'));
		}
	}
	
	/**
	 * retornoPagamentoPagseguro
	 *
	 * Recebe o retorno de pagamento da promoção via pagseguro
	 * @access public
	 * @return void
	 */
	public function retornoPagamento() 
    {
		$transaction = false;
	
		// Verifica se existe a transação
		if ($this->input->get ( 'idTransacao' )) {
			$transaction = self::TransactionNotification ( $this->input->get ( 'idTransacao' ) );
		}
	
		// Se a transação for um objeto
		if (is_object ( $transaction )) {
			self::setTransacaoPagseguro($transaction);
		}
	
		redirect ( base_url('minha-conta') );
	}
	
	/**
	 * setTransacaoPagseguro
	 *
	 * Seta os status da transação vindas do Pagseguro
	 *
	 * @param array $transaction
	 * @return void
	 */
	private function setTransacaoPagseguro($transaction = null) {
		// Pegamos o objeto da transação
		$transactionObj = self::getTransaction ( $transaction );
	
		// Buscamos a venda
		$filter = array ('idVenda' => $transactionObj ['reference']);
		$vendaList = $this->Vendas_model->getVenda ( $filter );
	
		// existindo a venda
		if (is_array ( $vendaList ) && sizeof ( $vendaList ) > 0) {
			$venda = array_shift($vendaList);
	
			// Aguardando pagamento
			if ($transactionObj ['status'] == 1) {
	
				$dados = array(
						'meioPagamento' => 2
						,'statusPagamento' => 1
						,'idTransacao' => $transaction->getCode()
						,'dataAtualizacao' => date('Y-m-d H:i:s')
				);
	
				$this->Vendas_model->update($dados, $venda->idVenda);
			}
	
	
			// Aguardando aprovação
			if ($transactionObj ['status'] == 2) {
				$dados = array(
						'meioPagamento' => 2
						,'statusPagamento' => 2
						,'idTransacao' => $transaction->getCode()
						,'dataAtualizacao' => date('Y-m-d H:i:s')
				);
	
				$this->Vendas_model->update($dados, $venda->idVenda);
			}
	
			// Transação paga
			if ($transactionObj ['status'] == 3) {
	
				$lastEvent = strtotime($transaction->getLastEventDate());
	
				$dados = array(
						'statusPagamento' => 3
						,'valorPago' =>  $transaction->getGrossAmount()
						,'taxas' => $transaction->getFeeAmount()
						,'idTransacao' => $transaction->getCode()
						,'dataAtualizacao' => date('Y-m-d H:i:s')
						,'dataCredito' => date('Y-m-d H:i:s', $lastEvent)
				);
	
				$this->Vendas_model->update($dados, $venda->idVenda);
			}
	
			// Pagamento cancelado
			if ($transactionObj ['status'] == 7 && $venda->statusPagamento != 3) {
				$dados = array(
						'meioPagamento' => 2
						,'statusPagamento' => 7
						,'taxas' => $transaction->getFeeAmount()
						,'idTransacao' => $transaction->getCode()
						,'dataAtualizacao' => date('Y-m-d H:i:s')
				);
	
				$this->Vendas_model->update($dados, $venda->idVenda);
			}
		}
	}
	
	/**
	 * getTransaction
	 *
	 * Método para buscar a transação no pag reguto
	 * @access public
	 * @param PagSeguroTransaction $transaction
	 * @return array
	 */
	public static function getTransaction(PagSeguroTransaction $transaction) {
		return array ('reference' => $transaction->getReference (), 'status' => $transaction->getStatus ()->getValue () );
	}
	
	/**
	 * NotificationListener
	 *
	 * Recebe as notificações do pagseguro sobre atualização de pagamento.
	 * @access public
	 * @return bool
	 */
	public function NotificationListener() {
	
		$code = (isset ( $_POST ['notificationCode'] ) && trim ( $_POST ['notificationCode'] ) !== "" ? trim ( $_POST ['notificationCode'] ) : null);
		$type = (isset ( $_POST ['notificationType'] ) && trim ( $_POST ['notificationType'] ) !== "" ? trim ( $_POST ['notificationType'] ) : null);
		$transaction = false;
	
		if ($code && $type) {
	
			$notificationType = new PagSeguroNotificationType ( $type );
			$strType = $notificationType->getTypeFromValue ();
	
			switch ($strType) {
	
				case 'TRANSACTION' :
					$transaction = self::TransactionNotification ( $code );
					break;
	
				default :
					LogPagSeguro::error ( "Unknown notification type [" . $notificationType->getValue () . "]" );
	
			}
		} else {
	
			LogPagSeguro::error ( "Invalid notification parameters." );
			self::printLog ();
		}
	
		if (is_object ( $transaction )) {
			self::setTransacaoPagseguro($transaction);
		}
	
		return TRUE;
	}
	
	/**
	 * TransactionNotification
	 *
	 * Recupera a transação através de uma notificação
	 * @access private
	 * @param unknown_type $notificationCode
	 * @return Ambigous <a, NULL, PagSeguroTransaction>
	 */
	
	private static function TransactionNotification($notificationCode) {
		$CI = & get_instance ();
		$credentials = new PagSeguroAccountCredentials ( $CI->config->item ( 'pagseguroAccount' ), $CI->config->item ( 'pagseguroToken' ) );
	
		try {
			$transaction = PagSeguroNotificationService::checkTransaction ( $credentials, $notificationCode );
		} catch ( PagSeguroServiceException $e ) {
			die ( $e->getMessage () );
		}
	
		return $transaction;
	}
	
	/**
	 * Método que registra logs do pagseguro
	 * @access private
	 * @param String $strType
	 */
	private static function printLog($strType = null) {
		$count = 30;
		echo "<h2>Receive notifications</h2>";
		if ($strType) {
			echo "<h4>notifcationType: $strType</h4>";
		}
		echo "<p>Last <strong>$count</strong> items in <strong>log file:</strong></p><hr>";
		echo LogPagSeguro::getHtml ( $count );
	}
}    