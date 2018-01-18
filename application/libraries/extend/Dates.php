<?php 

namespace extend {

    use DateTime;

    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

    /**
    *  Versão 1.0.00
    *  data:  15-05-2015
    *  Add :  dateDiff( $dateStart, $dateFinal, $return = '%a' )
    *         1: Método calcula diferença entre datas e retorna o mesmo em dias ou no padrão escolhido
    *  Add :  dateFormat( $date, $format = 'Y-m-d' )
    *         1: Método formata uma data e retorna no padrão escolhido. DEFAULT: Y-m-d, mas pode ser customizado
    *
    **/

    /**
    * Esta classe faz manipulações envolvendo datas
    * Qualquer tipo de manipulação de data será realizado por intermédio desta classe
    * 
    * @since     1.0.00 15-05-2015
    * @version   1.0.00
    *
    **/
    class Dates {
 

        /**
        * Esse método formata uma data para o padrão usando - ao invés de /
        *
        * @param   string $date - Data para se substituir as barras por -, caso houver
        * @return  string
        * @access  PRIVATE
        **/
        private function setDefaultDate( $date ) {

            if( is_int( $date ) )

                return date( 'Y-m-d', $date );

            else

                return preg_replace('|/|', '-', $date );

        }
 

        /**
        * Esse método formata uma data e a retorna num padrão escolhido, seja ele: d-m-Y, d/m/Y ou qualquer outro
        *
        * @param   STRING $date    -  Data que deseja formatar para algum padrão
        * @param   STRING $format  -  Formato esperado para retorno. DEFAULT: Y-m-d, mas pode ser customizado
        * @return  STRING
        * @access  PUBLIC
        **/
    	public function format( $date, $format = 'Y-m-d h:i:s' ) {

            $date   =   $this->setDefaultDate( $date );

    		$d1     =   new DateTime( $date );

    		//Formata no padrão esperado e retorna
    		return $d1->format( $format );

    	}


        /**
        * Esse método retorna o primeiro dia de uma determinada data passada por padrão
        *
        * @param   STRING $date    -  Data que deseja obter o primeiro dia do mês
        * @param   STRING $format  -  Formato esperado para retorno. DEFAULT: Y-m-d, mas pode ser customizado
        * @return  STRING
        * @access  PUBLIC
        **/
        public function getFirstDayOfMounth( $date, $format = 'Y-m-d h:i:s' ) {

            $date   =   $this->setDefaultDate( $date );

            $date   =   new DateTime( $date );

            return $date->modify( 'first day of this month' )->format( $format );

        }


        /**
        * Esse método retorna o ultimo dia de uma determinada data passada por padrão
        *
        * @param   STRING $date    -  Data que deseja obter o ultimo dia do mês
        * @param   STRING $format  -  Formato esperado para retorno. DEFAULT: Y-m-d, mas pode ser customizado
        * @return  STRING
        * @access  PUBLIC
        **/
        public function getLastDayOfMounth( $date, $format = 'Y-m-d h:i:s' ) {

            $date   =   $this->setDefaultDate( $date );

            $date   =   new DateTime( $date );

            return $date->modify( 'last day of this month' )->format( $format );

        }


        /**
        * Esse método retorna o primeiro dia do próximo mês
        *
        * @param   STRING $date    -  Data que deseja obter o primeiro dia do próximo mês
        * @param   STRING $format  -  Formato esperado para retorno. DEFAULT: Y-m-d, mas pode ser customizado
        * @return  STRING
        * @access  PUBLIC
        **/
        public function getFirstDayOfNextMounth( $date, $format = 'Y-m-d h:i:s' ) {

            $date   =   $this->setDefaultDate( $date );

            $date   =   new DateTime( $date );

            return $date->modify( 'first day of next month' )->format( $format );

        }

        /**
        * Esse método retorna o próximo mês
        *
        * @param   STRING $date    -  Data que deseja obter o próximo mês
        * @param   STRING $format  -  Formato esperado para retorno. DEFAULT: Y-m-d, mas pode ser customizado
        * @return  STRING
        * @access  PUBLIC
        **/
        public function getNextMounth( $date, $format = 'Y-m-d h:i:s' ) {

            $date   =   $this->setDefaultDate( $date );

            $date   =   new DateTime( $date );

            return $date->modify( '+1 month' )->format( $format );

        }


        /**
        * Esse método retorna o ultimo dia de uma determinada data passada por padrão
        *
        * @param   STRING $date    -  Data que deseja obter o ultimo dia do mês
        * @param   STRING $format  -  Formato esperado para retorno. DEFAULT: Y-m-d, mas pode ser customizado
        * @return  STRING
        * @access  PUBLIC
        **/
        public function getLastDayOfNextMounth( $date, $format = 'Y-m-d h:i:s' ) {

            $date   =   $this->setDefaultDate( $date );

            $date   =   new DateTime( $date );

            return $date->modify( 'last day of next month' )->format( $format );

        }


        public function mesPorExtenso() {

            $mes  =   date( 'm' );

            switch ($mes){

                case 1: 
                    $mes = "Janeiro"; 
                break;

                case 2: 
                    $mes = "Fevereiro"; 
                break;

                case 3: 
                    $mes = "Março"; 
                break;

                case 4: 
                    $mes = "Abril"; 
                break;

                case 5: 
                    $mes = "Maio"; 
                break;

                case 6: 
                    $mes = "Junho"; 
                break;

                case 7: 
                    $mes = "Julho"; 
                break;

                case 8: 
                    $mes = "Agosto"; 
                break;

                case 9: 
                    $mes = "Setembro"; 
                break;

                case 10:
                     $mes = "Outubro"; 
                break;

                case 11:
                     $mes = "Novembro"; 
                break;

                case 12:
                     $mes = "Dezembro"; 
                break;
             
            }

            return $mes;

        }



        /**
        * Esse método calcula a diferença de data entre duas datas.
        * O retorno padrão é em DIAS (%a), mas pode ser customizado para retornos no padrão %Y Anos, %m Meses, %d Dias, %H Horas, %i Minutos, %s Segundos, d-m-Y e etc
        *
        * @param   STRING $dateStart  -   Corresponde a data inicial para que se faça a operação que calcula a diferença entre essa data e uma segunda passada
        * @param   STRING $dateFinal  -   Data final para que se calcule a diferença entre ela e a primera data
        * @param   STRING $format     -   Formato esperado para retorno. DEFAULT: %a (DIAS), mas pode ser customizado
        * @return  STRING
        * @access  public
        *
        **/
    	public function dateDiff( $dateStart, $dateFinal, $format = '%a' ) {

    		$d1     =   new DateTime( $dateStart );

    		$d2     =   new DateTime( $dateFinal );

    		//Calcula a diferença entre as datas
    		$diff   =   $d1->diff($d2, true);	

    		//Formata no padrão esperado e retorna
    		return $diff->format( $format );

    	}


        public function addDays( $date, $days, $format = 'Y-m-d' ) {

            list($year, $month, $day)  =   explode( '-', $date );

            $date   =   mktime( 0 , 0 , 0 , $month, $day + $days, $year );

            return $this->format( $date, $format );

        }

        public function addYear( $date ) {

            list($year, $month, $day)  =   explode( '-', $date );

            $date   =   mktime( 0 , 0 , 0 , $month, $day, $year + 1 );

            return $this->format( $date, 'Y' );

        }



        /**
        * Esse método verifica se a data final é maior que a data inicial
        *
        * @param   STRING $dateIni  -   Data inicial
        * @param   STRING $dateEnd  -   Data final
        * @return  bool
        *
        * @access  PUBLIC
        **/
        public function compareDates( $dateIni, $dateEnd ) {

            $iniTime     =    strtotime( $this->setDefaultDate( $dateIni ) );

            $endTime     =    strtotime( $this->setDefaultDate( $dateEnd ) );
        
            return ( $endTime >= $iniTime ) ? true : false;

        }



        /**
        * Esse método verifica se ano é bissexto
        *
        * @param   STRING $year  -   Ano a ser validado
        * @return  bool
        * @access  PUBLIC
        *
        **/
        public function is_leap_year( $year ) {
            return ((($year % 4) == 0) && ((($year % 100) != 0) || (($year %400) == 0)));
        }



        /**
        * Esse método verifica se ano é bissexto
        *
        * @param   STRING $date  -   Data a ser validade
        * @return  STRING
        * @access  public
        *
        **/
        public function addPeridiocidade( $date )
        {
            // Retorna apenas o dia da data de vencimento
            $day       =    $this->format($date, 'd');

            // Retorna apenas o mes da data de vencimento
            $month     =    $this->format($date, 'm');

            // Retorna apenas o mes da data de vencimento
            $year      =    $this->format($date, 'Y');

            // Valida se o ano é bissexto
            $bissexto  =    $this->is_leap_year($year);

            if (!$bissexto){

                if($this->getLastDayOfMounth($date, 'd') != 31 && $day > 28){
                    if($month == 02 && $day > 28){
                        $date   =   $year . '-' . $month . '-' . '28';
                    } else{
                        $date   =   $year . '-' . $month . '-' . '30';
                    }
                }

            } else {
                if($this->getLastDayOfMounth($date, 'd') != 31 && $day > 29){
                    if($month == 02 && $day > 29){
                        $date   =   $year . '-' . $month . '-' . '29';
                    } else{
                        $date   =   $year . '-' . $month . '-' . '30';
                    }
                }
            }

            return $date;
                
        }




        public function isValidTimeStamp($timestamp) {

            return ((string) (int) $timestamp === $timestamp) && ($timestamp <= PHP_INT_MAX) && ($timestamp >= ~PHP_INT_MAX);
            
        }


        public function validateDate( $date, $break = '/' ) {

            if( substr_count($date, $break) == 2 ) {

                list($day, $month, $year)  =   explode( $break, $date );
                
                if( checkdate((int)$month, (int)$day, (int)$year) ) {

                    $moreYear  =   date( 'Y', strtotime( '+ 20 years' ) );

                    $lessYear  =   date( 'Y', strtotime( '- 20 years' ) );

                    return ( $year > $moreYear || $year < $lessYear ) ? false : true;

                }

            }else {

                return false;
                
            }

        }           

    }

}    