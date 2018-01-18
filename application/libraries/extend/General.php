<?php 

namespace extend;

use extend\general;

if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );


/**
*  Versão 1.0.00
*  data:  28-05-2015
*-------------------------------------------------------------------------------------------------------------
*  Add :  generate_seed()
*-------------------------------------------------------------------------------------------------------------
*  Add :  generateNumberRandom()
*-------------------------------------------------------------------------------------------------------------
*/


/**
* Esta classe possui muitos métodos úteis que não são usados tão frequentemente, mas em todo caso né... :)
*
* @since     1.0.00 28-05-2015
* @version   1.0.00
*
**/


class General  {


    /**
    * Esse método gera um valor randomico com base em microsegundos
    * Geralmente, esse valor será usado para alimentar a função mt_srand() para geração de numeros randomicos mais precisos
    *
    * @param   NULL
    * @return  INT
    * @access  protected
    *
    **/
    protected function generate_seed()
    {
        list($usec, $sec) = explode(' ', microtime());

        return (float) $sec + ((float) $usec * 100000);
    }



    /**
    * Esse método gera um valor randomico
    *
    * @param   NULL
    * @return  INT
    * @access  public
    *
    **/
    public function generateNumberRandom()
    {

        $seed    =  $this->generate_seed();

        //Alimenta o gerador de seeds do php
        mt_srand( $seed );

        //gera o numero randomico
        return rand(1111111, 9999999);

    }


    /**
    * Esse método formata um valor de dinheiro
    *
    * @param   DECIMAL  $money         -   Valor que deseja formatar
    * @param   INT      $format        -   Condição para formatar o valor  
    *                                      1 => PADRÃO AMERICANO  ex: 21.00, 2000.00
    *                                      2 => PADRÃO BRASILEIRO ex: 21.00, 2,000.00
    * @param   INT      $preg_format   -   Formatação inicial do valor. DEFAULT: INTEIROS 0 à 9 com .
    * @param   INT      $preg_return   -   Formatação final do valor. DEFAULT: INTEIROS 0 à 9 com .
    * @return  DECIMAL
    * @access  public
    *
    **/
    public function number_format( $money, $negative = true ) {

        if( !is_numeric( $money ) && trim( $money ) != '' ) {

            $money   =   preg_replace('/[^\d\,-]/', '', $money);

            $money   =   preg_replace('/[,]/', '.', $money);

            $money   =   (float) number_format( $money, 2, '.', '');

            return !$negative ? preg_replace('/[-]/', '', $money) : $money;

        }else if( is_numeric( $money ) ) {

            return $money;

        }else {

            return 0.00;

        }      

    }   



    /**
    * Esse método é uma extensão da função array_map.
    * O método é recursivo e executa uma determinada função em todos os indices do array
    *
    * @param   STRING  $callback   -   Função que deseja executar em todos os indices do array
    * @param   ARRAY   $array      -   Array que deseja processar
    * @return  ARRAY
    * @access  public
    *
    **/
    public function array_map_recursive($callback, $array) {
        foreach ($array as $key => $value) {
            if (is_array($array[$key])) {
                $array[$key] = $this->array_map_recursive($callback, $array[$key]);
            }
            else {
                $array[$key] = call_user_func($callback, $array[$key]);
            }
        }
        return $array;
    }


    public function color_blend_by_opacity( $foreground, $opacity, $background=null ) {
        static $colors_rgb=array(); // stores colour values already passed through the hexdec() functions below.
        
        if( is_null($background) )
            $background = 'FFFFFF'; // default background.

        $pattern = '~^[a-f0-9]{6,6}$~i'; // accept only valid hexadecimal colour values.
        if( !@preg_match($pattern, $foreground)  or  !@preg_match($pattern, $background) )
        {
            trigger_error( "Invalid hexadecimal colour value(s) found", E_USER_WARNING );
            return false;
        }
            
        $opacity = intval( $opacity ); // validate opacity data/number.
        if( $opacity>100  || $opacity<0 )
        {
            trigger_error( "Opacity percentage error, valid numbers are between 0 - 100", E_USER_WARNING );
            return false;
        }

        if( $opacity==100 )    // $transparency == 0
            return strtoupper( $foreground );
        if( $opacity==0 )    // $transparency == 100
            return strtoupper( $background );
        // calculate $transparency value.
        $transparency = 100-$opacity;

        if( !isset($colors_rgb[$foreground]) )
        { // do this only ONCE per script, for each unique colour.
            $f = array(  'r'=>hexdec($foreground[0].$foreground[1]),
                         'g'=>hexdec($foreground[2].$foreground[3]),
                         'b'=>hexdec($foreground[4].$foreground[5])    );
            $colors_rgb[$foreground] = $f;
        }
        else
        { // if this function is used 100 times in a script, this block is run 99 times.  Efficient.
            $f = $colors_rgb[$foreground];
        }
        
        if( !isset($colors_rgb[$background]) )
        { // do this only ONCE per script, for each unique colour.
            $b = array(  'r'=>hexdec($background[0].$background[1]),
                         'g'=>hexdec($background[2].$background[3]),
                         'b'=>hexdec($background[4].$background[5])    );
            $colors_rgb[$background] = $b;
        }
        else
        { // if this FUNCTION is used 100 times in a SCRIPT, this block will run 99 times.  Efficient.
            $b = $colors_rgb[$background];
        }
        
        $add = array(    'r'=>( $b['r']-$f['r'] ) / 100,
                         'g'=>( $b['g']-$f['g'] ) / 100,
                         'b'=>( $b['b']-$f['b'] ) / 100    );
                        
        $f['r'] += intval( $add['r'] * $transparency );
        $f['g'] += intval( $add['g'] * $transparency );
        $f['b'] += intval( $add['b'] * $transparency );
        
        return sprintf( '%02X%02X%02X', $f['r'], $f['g'], $f['b'] );
    
    }

    function generate_color_rand() {

        return str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);

    }  



    public function maskCep( $cep ) {

        $cep         =   preg_replace('/\D/', '', $cep );

        $cepMasked   =   $cep;

        if( strlen($cep) == 8 )  {

            $cepMasked   =   substr($cep, 0, 5 );

            $cepMasked  .=   '-' . substr($cep, 5, 3 );

        }

        return $cepMasked;

    }   



    public function maskCpf( $cpf ) {

        $cpf         =   preg_replace('/\D/', '', $cpf );

        $cpfMasked   =   $cpf;

        if( strlen($cpf) == 11 )  {

            $cpfMasked   =   substr($cpf, 0, 3 ) . '.';

            $cpfMasked  .=   substr($cpf, 3, 3 ) . '.';

            $cpfMasked  .=   substr($cpf, 6, 3 );

            $cpfMasked  .=   '-' . substr($cpf, 9, 2 );

        }

        return $cpfMasked;

    }
        

    public function maskCnpj( $cnpj ) {

        $newCnpj   =   $cnpj;

        if( strlen( $cnpj ) == 14 ) {

            $newCnpj   =    substr($cnpj, 0, 2 ) . '.';

            $newCnpj   .=   substr($cnpj, 2, 3 ) . '.';

            $newCnpj   .=   substr($cnpj, 5, 3 ) . '/';

            $newCnpj   .=   substr($cnpj, 8, 4 ) . '-';

            $newCnpj   .=   substr($cnpj, -2 );

        }

        return $newCnpj;

    }


    public function maskTelefone( $num, $type = 'celular' ) {

        $num     =   preg_replace('/\D/', '', $num );

        $numero  =  $num;

        if( is_numeric( $num ) ) {

            if( strlen($num) == 10 || $type != "celular" ) {

                $numero    =    '(' . substr( $num, 0, 2 ) . ')';

                $numero   .=    ' ' . substr( $num, 2, 4 ) . '-';

                $numero   .=    substr( $num, 6, 4 );

            }else if( strlen($num) == 11 && $type == "celular" ) {

                $numero    =    '(' . substr( $num, 0, 2 ) . ')';

                $numero   .=    ' ' . substr( $num, 2, 1 ) . ' ';

                $numero   .=    substr( $num, 3, 4 ) . '-';

                $numero   .=    substr( $num, 7, 4 );

            }else {

                if( strlen($num) == 11 ) {

                    $numero    =    '(' . substr( $num, 0, 2 ) . ')';

                    $numero   .=    ' ' . substr( $num, 2, 1 ) . ' ';

                    $numero   .=    substr( $num, 3, 4 ) . '-';

                    $numero   .=    substr( $num, 7, 4 );

                }else if( strlen($num) == 10 ) {

                    $numero    =    '(' . substr( $num, 0, 2 ) . ')';

                    $numero   .=    ' ' . substr( $num, 2, 4 ) . '-';

                    $numero   .=    substr( $num, 6, 4 );

                }

            }

            return $numero;

        }

    }


}