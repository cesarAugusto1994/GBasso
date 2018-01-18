<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_admin extends CI_Controller {

    private $Header     =  null;

    private $Essential  =  null;

    private $Login      =  null;
    
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

    }


    public function logar() {         	  

    	//Get data post
    	$user     =   $this->Essential->sqlInjection( $this->input->post( 'user' ) );
 
    	$pass     =   $this->Essential->sqlInjection( $this->input->post( 'pass' ) );

        $page     =   $this->Essential->sqlInjection( $this->input->post( 'controller' ) );

    	//Set message default
		$code     =   102;

		$message  =   "Usuário ou senha inválidos";

		//valid data
    	( strlen( $pass ) < 6 || strlen( $user ) < 4 ) ? $this->Essential->setmessage( $message, $code ) : null;

    	//Mask password
    	$pass       =   $this->Essential->maskPassword( $pass );

    	//Check credentials
    	$response   =   $this->Login->validarCredenciaisAdmin( $user, $pass );
 		
 		//Check response
    	if( $response ) {

    		$code     =   100;

    		$message  =   "Redirecionando...";

            if( $page == 'login' ) {

                $code = 100;

            }else {

                $code     =  101;

                $message  =  "Você agora está logado";

            }

    	}

    	//Send message
    	$this->Essential->setmessage( $message, $code );

    }


}    