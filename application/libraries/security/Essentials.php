<?php

namespace security {

    use security\Essentials;

    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

    /**
    * Class has content to validate diversity finity of requisitions of security tyo application
    *
    * @package    Security
    * @subpackage Essentials
    */
	class Essentials {

		//Define hosts permited to execute application
		private $hosts    =   array( 'exchangecorporate.com.br', 'app.saldocerto.com.br', '192.168.25.42:83' );


		/**
		* Method check host permited to execute application
		* 
		* @param  null
		* @access public
		* @return bool		
		*/
		public function checkHost() {

			//Get the host
			$host   =   $_SERVER['HTTP_HOST'];

			//Verify if host is permited or no
			return in_array($host, $this->hosts ) ? true : false;

		}


		/**
		* Cria uma mascara e melhora a segurança da senha no banco de dados
		*
		* @param  STRING $pass  -  Senha do usuário
		*
		* @access PUBLIC
		* @return string		
		*/
		public function maskPassword( $pass ) {

			$mask      =   "F*?,[<$;J=L&5cD65k@fy=s%JPwmWhsu-q~!d6}vXN#r>H%&n," . $pass . "vk5U(36H4`]mav@DSy#YgM?kNSHKf>/na?";

			//echo $mask; exit;

			return hash('sha256', $mask );

		}


		/**
		* Method check is variable is empty
		* 
		* @param  string $var      -  Variável para ser validada
		* @param  string $message  -  Mensagem a ser enviada caso a variável não seja validada
		* @param  char   $action   -  ação a ser executada
		*
		* @access PUBLIC
		* @return void		
		*/
		public function verify( $var, $message, $action ) {

			if( $action == 'empty' ) {

				$this->isEmpty( $var ) ?  $this->setMessage( $message, 102 ) : null;

			}

		}


		/**
		* Method check is variable is empty
		* 
		* @param  STRING $var 
		* @access PUBLIC
		* @return bool		
		*/
		public function isEmpty( $var ) {

			//Check if variable is content 0
			return strlen( trim( $var ) ) == 0 ? true : false;

		}


		/**
		* Method print data with format json or text
		* 
		* @param  STRING $message  -  Mensagem que deseja imprimir
		* @param  INT   $code      -  Codigo da mensagem
		* @access PUBLIC
		* @return void
		*
		**/
		public function setMessage( $message, $code = 102 ) {

			/**
			* Códigos de erros:
			* 100  =>  Mensagem de sucesso, seja lá o que tenha sido (Success)
			* 101  =>  Usuário fez login pela modal de login e recebeu sucesso nas credenciais de login (Success)
			* 102  =>  Ocorreu um erro de validação na tarefa que o usuário estava fazendo (Erro)
			* 103  =>  Erro de login, alguma coisa ocorreu: sessão expirada, credênciais de validação inválidas (Usuário estava logado) (Erro)
			*
			*/

			//Mount array to return
			$result  =  array( 'message' => $message, 'code' => $code );

			//Send message
			$this->sendMessage( $result );

		}



		/**
		* Method print data with format json or text
		* 
		* @param  STRING $message  -  array que deseja imprimir
		* @access PRIVATE
		* @return void
		*
		**/
		private function sendMessage( $message = array() ) {

			echo json_encode( $message );

			exit;

		}


		/**
		* Método obtem o IP REAL do usuário
		* 
		* @param  NULL	
		* @return VOID
		* @access PRIVATE
		**/
		public function getUserIP() {

		    $client  = @$_SERVER['HTTP_CLIENT_IP'];

		    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];

		    $remote  = $_SERVER['REMOTE_ADDR'];

		    if(filter_var($client, FILTER_VALIDATE_IP)) {
		        $ip = $client;
		    }elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
		        $ip = $forward;
		    }else {
		        $ip = $remote;
		    }

		    return $ip;
		}


		public function validEmail( $email ) {

			$regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

			return preg_match( $regex, $email ) ? true : false;

		}
		

		public function  sqlInjection( $var ) {

			$var = preg_replace("/'|from|select|insert|delete|where|drop table|show tables|#|\*|--|/", '', $var);

			return $var;

		}

		public function  onlyNumber( $var ) {

	        $regex = "/[0-9]$/"; 

	        return preg_match( $regex, $var ) ? true : false;

		}

		public function onlyAlphaNumeric( $var ) {

	        $regex = "/[A-Za-z0-9]+/";

	        return preg_match( $regex, $var ) ? true : false;

		}

		public function validarCPF( $cpf = '' ) { 

			$cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
			
			// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
			if ( strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
				
				return false;
			
			} else { // Calcula os números para verificar se o CPF é verdadeiro
				
				for ($t = 9; $t < 11; $t++) {
					
					for ($d = 0, $c = 0; $c < $t; $c++) {

						$d += $cpf{$c} * (($t + 1) - $c);

					}

					$d = ((10 * $d) % 11) % 10;
					
					if ($cpf{$c} != $d) {

						return false;

					}

				}

				return true;
			}

		}


		//Formato de data: DD/MM/YYYY
        public function validateDate( $date, $break = '/' ) {

            if( substr_count($date, $break) == 2 ) {

                list($day, $month, $year)  =   explode( $break, $date );
                
                return !checkdate((int)$month, (int)$day, (int)$year) ? false : true;

            }else {

                return false;
                
            }

        } 


        public function maskCpf( $cpf ) {

        	$mask   =  substr($cpf, 0, 3) . '.';

        	$mask  .=  substr($cpf, 3, 3) . '.';

        	$mask  .=  substr($cpf, 6, 3) . '-';

        	$mask  .=  substr($cpf, 9);

        	return $mask;

        }

        public function MaskCep( $cep ) {

        	$mask   =  substr($cep, 0, 5) . '-';

        	$mask  .=  substr($cep, 5);

        	return $mask;

        }


		/*


		//Valida números de celular com o padrão: (11) 9 5391-4521
		public function  validNumberCel( $numCel ) {

	        $regex = '/^(\([0-9]{2}\)?)+([ 9 ])+[0-9]{4,4}[-]?[0-9]{4,4}$/';

	        return preg_match( $regex, $numCel ) ? true : false;

		}


	


		public function detect_request_ajax()
		{

			$this->httpRequested  =    isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] : NULL;

			$this->httpOrigen     =    isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : NULL;

			if(!isset($this->httpRequested) && empty($this->httpRequested) && strtolower($this->httpRequested) != 'xmlhttprequest' && $this->httpOrigen != $this->origen ) {

				throw new Exception("Error Processing Request", 1);		

			}	

		}




		*/

		/**
		 * isCnpjValid
		 *
		 * Esta função testa se um Cnpj é valido ou não. 
		 *
		 * @author	Raoni Botelho Sporteman <raonibs@gmail.com>
		 * @version	1.0 Debugada em 27/09/2011 no PHP 5.3.8
		 * @param	string		$cnpj			Guarda o Cnpj como ele foi digitado pelo cliente
		 * @param	array		$num			Guarda apenas os números do Cnpj
		 * @param	boolean		$isCnpjValid	Guarda o retorno da função
		 * @param	int			$multiplica 	Auxilia no Calculo dos Dígitos verificadores
		 * @param	int			$soma			Auxilia no Calculo dos Dígitos verificadores
		 * @param	int			$resto			Auxilia no Calculo dos Dígitos verificadores
		 * @param	int			$dg				Dígito verificador
		 * @return	boolean						"true" se o Cnpj é válido ou "false" caso o contrário
		 *
		 */
		 
		 /*
		public function validarCnpj( $cnpj ) {

			$cnpj    =   preg_replace('/\D/', '', $cnpj );

			//Etapa 1: Cria um array com apenas os digitos numéricos, isso permite receber o cnpj em diferentes formatos como "00.000.000/0000-00", "00000000000000", "00 000 000 0000 00" etc...
			$j = 0;

			for($i=0; $i<(strlen($cnpj)); $i++) {
				
				if(is_numeric($cnpj[$i])) {

					$num[$j]=$cnpj[$i];

					$j++;

				}

			}

			//Etapa 2: Conta os dígitos, um Cnpj válido possui 14 dígitos numéricos.
			if(count($num) != 14 ) {
				
				$isCnpjValid = false;

			}

			//Etapa 3: O número 00000000000 embora não seja um cnpj real resultaria um cnpj válido após o calculo dos dígitos verificares e por isso precisa ser filtradas nesta etapa.
			if ($num[0] == 0 && $num[1] == 0 && $num[2] == 0 && $num[3] == 0 && $num[4] == 0 && $num[5] == 0 && $num[6] == 0 && $num[7] == 0 && $num[8] == 0 && $num[9] == 0 && $num[10] == 0 && $num[11] == 0 ) {
				
				$isCnpjValid = false;
			
			}else {
				
				//Etapa 4: Calcula e compara o primeiro dígito verificador.
				$j = 5;
				
				for($i=0; $i<4; $i++) {
					
					$multiplica[$i]=$num[$i]*$j;
					
					$j--;

				}
				
				$soma = array_sum($multiplica);
				
				$j = 9;
				
				for($i=4; $i<12; $i++) {

					$multiplica[$i]=$num[$i]*$j;

					$j--;

				}
				
				$soma = array_sum( $multiplica );	
				
				$resto = $soma % 11;			

				if( $resto < 2 ) {
					
					$dg = 0;
				
				}else {
					
					$dg = 11 - $resto;
				
				}
				
				if( $dg != $num[12] ) {
					
					$isCnpjValid = false;

				} 

			}

			//Etapa 5: Calcula e compara o segundo dígito verificador.
			if( !isset( $isCnpjValid ) ) {
				
				$j = 6;
				
				for( $i = 0; $i < 5; $i++ ) {
					
					$multiplica[$i] = $num[$i] * $j;
					
					$j--;

				}
					
				$soma = array_sum( $multiplica );
				
				$j=9;
				
				for( $i = 5; $i < 13; $i++ ) {
					
					$multiplica[$i] = $num[$i] * $j;
					
					$j--;
				
				}
					
				$soma  = array_sum( $multiplica );	
				
				$resto = $soma % 11;			
				
				if($resto < 2) {
					
					$dg = 0;
				
				}else {
					
					$dg = 11 - $resto;

				}
				
				if( $dg != $num[13] ) {

					$isCnpjValid = false;
				
				}else {
					
					$isCnpjValid = true;
				}
			
			}

			return $isCnpjValid;	

		}
		*/

   
        
	}


}	