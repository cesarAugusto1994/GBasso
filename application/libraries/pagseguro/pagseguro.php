<?php if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

class Pagseguro {

	private $paymentRequest;


	public function initializePagSeguroAPI() {

		require APPPATH . 'libraries/pagseguro/api/PagSeguroLibrary.php'; 

	}


	public function requestPayment() {

		$this->paymentRequest   =   new PagSeguroPaymentRequest();

	}


	//Instance of credential PagSeguro
	protected function instanceCredential() {	
        
        //Instance of credential of config file. Location libraries/pagseguro/api/config/PagSeguroConfig.php
        return PagSeguroConfig::getAccountCredentials();

    }

	//Adiciona os itens que serao comprados na requisiçao
	/**
	 *@parm     array( 
	 * 				'idProduct'     => INT,  
	 *				'nameProduct'   => STRING,
	 *				'qtdProduct'    => INT
	 *				'priceProduct'  => FLOAT/DOUBLE
     *			 )
     *
     *@return  VOID
	 *
	**/		
	public function addItemToPaymentRequest( $item = array() ) {

		$this->paymentRequest->addItem( $item[0], $item[1], $item[2], $item[3] );

	}


	//Adiciona o endereco do cliente que esta comprando
	/**
	 *@param    array( 
	 * 				'nameCLient'     => STRING,  
	 *				'address'        => STRING,
	 *				'numberAddress'  => INT/STRING
	 *				'phoneNumber'    => STRING/INT
     *			 )
     *
     *@return  VOID
	 *
	**/
	public function addSenderInformation( $sender = array() ) {

		$this->paymentRequest->setSender( $sender );

	}	


	//Set o Pais corrente da requisiçao
	/**
	 *@param   STRING  DEFAULT "BRL"
	 *
     *@return  VOID
	 *
	**/	
	public function setCurrency( $currency ) {

		$this->paymentRequest->setCurrency( $currency );

	}	


	//Codigo de referencia para o pagamento, usado como controle interno
	/**
	 *@param   INT
	 *
     *@return  VOID
	 *
	**/		
	public function setReferencePayment( $reference ) {

		$this->paymentRequest->setReference( $reference );

	}	


	//Seta a URL que sera enviado o POST com a atualizaçao do pagamento
	/**
	 *@param   URL FORMAT
	 *
     *@return  VOID
	 *
	**/		
	public function setUrlNotification( $url ) {

		$this->paymentRequest->addParameter( 'notificationURL', $url );

	}		

	//Prazo maximo de validade para a requisiçao do PagSeguro
	/**
	 *@param   INT    DEFAULT 172800 (2 Days)
	 *
     *@return  VOID
	 *
	**/		
	public function setMaxAgePayment( $value = 172800 ) {

		$this->paymentRequest->setMaxAge( $value );

	}	


	//Gera a URL de redirecionamento do pagseguro
	/**
	 *
     *@return  STRING
	 *
	**/		
	public function generationUrl() {

        $credentials = $this->instanceCredential();

        return $this->paymentRequest->register( $credentials );  

	}


	protected function log( $log ) {

		LogPagSeguro::debug( $log );		

	}



	/**
	 *@description  Metodo processa uma 
	 *
	 *@param  $codeTransaction  Id da transaçao enviada pelo PagSeguro
	 *
	 *@return Obj|String
	 *
	 */
	public function returnRequestTransaction( $idTransaction ) {

        try { 

        	$credentials  =  $this->instanceCredential();

        	$this->log( 'Recebendo retorno da transaçao: ' . $idTransaction  . " date(d/m/Y h:i:s)");
              
            //Realizando uma consulta de transação a partir do código identificador para obtero o objeto PagSeguroTransaction       
            $transaction  =  PagSeguroTransactionSearchService::searchByCode(   

                $credentials,  

                $idTransaction  

            );  
              
        } catch (PagSeguroServiceException $e) {  

        	$this->log( 'Falha ao receber retorno da transaçao: ' . $idTransaction . " date(d/m/Y h:i:s)");
              
            return ':er102';

        }

        return $transaction; 
        
	}


	/**
	 *@description  Metodo recebe a notificaçao enviada pelo PagSeguro e a processa
	 *
	 *@param  $codeNotification  Id da notificaçao enviada pelo PagSeguro
	 *
	 *@return Obj|String
	 *
	 */
	public function returnRequestNotification( $codeNotification ) {

        try { 

        	$credentials  =  $this->instanceCredential();

        	$this->log( 'Recebendo notificaçao da transaçao: ' . $codeNotification . " date(d/m/Y h:i:s)");;
              
            $transaction = PagSeguroNotificationService::checkTransaction(  

                $credentials,  

                $codeNotification

            );  
              
        } catch (PagSeguroServiceException $e) {  

        	$this->log( 'falha ao receber notificaçao da transaçao: ' . $codeNotification . " date(d/m/Y h:i:s)");
              
            return ':er102';

        }

        return $transaction; 
        
	}


}