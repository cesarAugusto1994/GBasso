<?php 
namespace sessions {

    use sessions\Carrinho;

    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );


    /**
    * Class has content to manipule sessions of cart
    *
    * @package    Sessions
    * @subpackage Carrinho
    */
    class Carrinho extends Session {

        //Atributo que será instanciada a classe Querys
        private $Querys     =  null;

        public  $idProduto  =  null;


        /**
        * Construct of class, nothing interesting here
        * Go go go...
        *
        * @param  NULL
        * @access public
        * @return void        
        */
        public function __construct(){

            //Nothing more
            parent::__construct();

        }


        /**
        * Método adiciona um produto no carrinho
        *
        * @param  INT $valor      -  Valor do produto que será adicionado
        * @param  INT $qtd        -  Quantidade do produto que será adicionado
        * @access PUBLIC
        * @return BOOL
        */
        public function addProduto( $valor, $qtd ){

            //Obtem todos os dados do carrinho
            $cart   =  $this->get( 'cart' );

            //Seta os dados no array que será gravado em sessão
            $data   =  array( 'id' => $this->idProduto, 'valor' => $valor, 'qtd' => $qtd );

            //Determina qual INDEX do array será inserido o produto
            $index  =  ( !is_array( $cart ) ) ? 0 : count( $cart );

            //Seta os dados no carrinho
            $this->setArray( 'cart', $index, $data );

        }


        /**
        * Método deleta todos os produtos do carrinho
        *
        * @param  NULL        
        * @access PUBLIC
        * @return BOOL
        */
        public function deleteAll(){

            $cart   =  $this->get( 'cart' );

            //print_r( $cart ); exit;

            if( is_array( $cart ) && count( $cart ) > 0 ) {

                $i  = 0;

                foreach ($cart as $key => $value ) {
                    
                    $this->deleteArray( 'cart', $i );

                    $i++;

                }

            }

        }


        /**
        * Método deleta um produto do carrinho
        *
        * @param  NULL        
        * @access PUBLIC
        * @return BOOL
        */
        public function delete(){

            $cart   =  $this->get( 'cart' );

            //print_r( $cart ); exit;

            if( is_array( $cart ) && count( $cart ) > 0 ) {

                $i  = 0;

                foreach ($cart as $key => $value ) {
                    
                    if( $value['id'] == $this->idProduto ) {

                        $this->deleteArray( 'cart', $i );

                        break;

                    }

                }

                $this->rebuildCarrinho();

            }

        }


        /**
        * Método faz um rebuid dos INDEX do array do carrinho
        *
        * @param  NULL
        * @access PUBLIC
        * @return VOID
        */
        public function restoreCarrinho( $data ) {

            if( is_array( $data ) && count( $data ) > 0 ) {

                foreach ($data as $key => $value ) {

                    $this->idProduto  =  $value['id'];
                    
                    $this->addProduto( $value['valor'], $value['qtd'] );

                }

            }

        }


        /**
        * Método retorna o array do carrinho
        *
        * @param  NULL
        * @access PUBLIC
        * @return ARRAY
        */
        public function getCart() {

            return $this->get( 'cart' );

        }


        /**
        * Método faz um rebuid dos INDEX do array do carrinho
        *
        * @param  NULL
        * @access PUBLIC
        * @return VOID
        */
        public function rebuildCarrinho() {

            $cart   =  $this->get( 'cart' );

            if( is_array( $cart ) && count( $cart ) > 0 ) {

                $i  = 0;

                foreach ($cart as $key => $value ) {
                    
                    $this->deleteArray( 'cart', $key );

                }

                $i  =  0;

                foreach ($cart as $key => $value ) {

                    $this->idProduto  =  $value['id'];
                    
                    $this->addProduto( $value['valor'], $value['qtd'] );

                }

            }

        }


        /**
        * Método retorna os produtos do carrinho
        *
        * @param  NULL
        * @access PUBLIC
        * @return BOOL
        */
        public function getProdutos() {

            $cart    =   $this->get( 'cart' );

            $result  =   array();

            if( is_array( $cart ) && count( $cart ) > 0 ) {

                $i  =  0;

                foreach ($cart as $key => $value ) {
                    
                    $result[$i]['id']     =  $value['id'];

                    $result[$i]['qtd']    =  $value['qtd'];

                    $result[$i]['valor']  =  $value['valor'];

                    $i++;

                }

            }

            return $result;

        }


        /**
        * Método verifica se um determinado produto já existe no carrinho
        *
        * @param  FLOAT $valor  -  Valor do produto
        * @param  INT   $qtd    -  Quantidade do produto
        * @access PUBLIC
        * @return BOOL
        */
        public function editaCarrinho( $valor = '', $qtd = '' ){

            //Ontem todos os dados do carrinho
            $cart      =  $this->get( 'cart' );

            //Seta o retorno inicialmente como false
            $response  =  false;

            //verifica se existe algum produto no carrinho
            if( is_array( $cart ) && count( $cart ) > 0 ) {

                $i  =  0;

                //Parsea no array do carrinho
                foreach ($cart as $key => $value ) {
                    
                    //Verifica se o ID do produto é igual ao ID do produto que será adicionado
                    if( $value['id'] == $this->idProduto ) {

                        $data           =  array();

                        $data['id']     =  $this->idProduto;

                        $data['valor']  =  trim( $valor ) == '' ?  $value['valor'] : $valor;

                        $data['qtd']    =  trim( $qtd )   == '' ?  $value['qtd']   : $qtd;

                        $this->setArray( 'cart', $i, $data );

                        $response  =  true;
                        
                        break;
                    }

                    $i++;

                }

            }

            //retorna a resposta
            return $response;

        }


        /**
        * Método obtem o total do carrinho
        *
        * @param  NULL
        * @access PUBLIC
        * @return FLOAT
        */
        public function getTotal(){

            //Ontem todos os dados do carrinho
            $cart      =  $this->get( 'cart' );

            //Seta o valor inicial com 0
            $total     =  0.00;

            //Verifica se existe algum produto no carrinho
            if( is_array( $cart ) && count( $cart ) > 0 ) {

                //Parsea no array do carrinho
                foreach ($cart as $key => $value ) {
                    
                    //Obtem o valor total somando o valor do produto * a quantidade
                    $total  +=   ( $value['valor'] *  $value['qtd'] );

                }

            }

            //retorna o total
            return $total;

        }        


        /**
        * Método obtem o total de produtos no carrinho
        *
        * @param  NULL
        * @access PUBLIC
        * @return FLOAT
        */
        public function getQtd(){

            //Ontem todos os dados do carrinho
            $cart      =  $this->get( 'cart' );

            //Seta o valor inicial com 0
            $total     =  0.00;

            //Verifica se existe algum produto no carrinho
            if( is_array( $cart ) && count( $cart ) > 0 ) {

                //Parsea no array do carrinho
                $total  =  count( $cart );

            }

            //retorna o total
            return $total;

        }   


        /**
        * Método verifica se um determinado produto já existe no carrinho
        *
        * @param  NULL
        * @access PUBLIC
        * @return BOOL
        */
        public function produtoExists(){

            //Ontem todos os dados do carrinho
            $cart      =  $this->get( 'cart' );

            //Seta o retorno inicialmente como false
            $response  =  false;

            //verifica se existe algum produto no carrinho
            if( is_array( $cart ) && count( $cart ) > 0 ) {

                //Parsea no array do carrinho
                foreach ($cart as $key => $value ) {
                    
                    //Verifica se o ID do produto é igual ao ID do produto que será adicionado
                    if( $value['id'] == $this->idProduto ) {

                        //Seta como true, ou seja, o produto já está adicionado no carrinho
                        $response = true;

                        //Para o laço de repetição
                        break;

                    }

                }

            }

            //retorna a resposta
            return $response;

        }

    }

}    