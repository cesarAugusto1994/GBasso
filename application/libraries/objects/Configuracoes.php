<?php 

namespace objects {

    use objects;

    use db;

    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

    date_default_timezone_set('America/Sao_Paulo');

    class Configuracoes extends db\Querys  {

        protected  $idConfig   =   null;

        protected  $valor      =   null;

        public function __contruct() { }


        /**
         * Método seta valores em atributos da classe
         *
         * @param  STRING $property  -   Nome do atributo
         * @param  STRING $value     -   Valor para o atributo
         * @return VOID
         * @access PUBLIC
         */
        public function __set( $property, $value ) {

            //Verifica se o atributo existe na classe
            if( property_exists($this, $property) ) {

                //Atribui o valor
                $this->$property  =  $value;

            }

        }


        /**
         * Método seta valores em atributos da classe
         *
         * @param  STRING $property  -   Nome do atributo
         * @param  STRING $value     -   Valor para o atributo
         * @return VOID
         * @access PUBLIC
         */
        public function gravarConfiguracao() {

            //Prepara o array para gravar
            $gravar        =   array( 'config_id' => $this->idConfig, 'conf_valor' => $this->valor, 'conf_cadastro' => date( 'Y-m-d H:i:s' ) );

            $response      =   $this->configExists();

            $this->table   =   'config';

            if( !$response ) {

                $this->insert( $gravar );

            }else {

                $this->setWhere( "config_id = '$this->idConfig'" );

                $this->update( $gravar );

            }

        }


        /**
         * Método verifica se uma determinada configuração existe
         *
         * @param  NULL
         * @return BOOL
         * @access PUBLIC
         */
        public function configExists() {

            //Reseta os attr de Querys
            $this->reset();

            //Seta a tabela
            $this->table   =   'config';

            //Seta os campos
            $this->setField( 'conf_id' );

            //Seta a condição de busca
            $this->setWhere( "config_id = '$this->idConfig'" );

            //Realiza a consulta
            return $this->searchRecord();

        }


        /**
         * Método retorna os dados da configuração
         *
         * @param  NULL
         * @return BOOL
         * @access PUBLIC
         */
        public function getConfigs() {

            //Reseta os attr de Querys
            $this->reset();

            //Seta a tabela
            $this->table   =   'config';

            //Seta os campos
            $this->setField( 'conf_id, conf_valor' );

            //Retorna os dados
            $data     =   $this->get();

            //Seta o array que vai retornar os dados
            $result   =   array();

            if( count( $data ) > 0 ) {

                //Contador
                $i  =  0;

                //Extrai os dados
                foreach ($data as $key ) {

                    $result[$i]['id']   =  $key->conf_id;
                        
                    if( $key->conf_id == 1 )  
                        //Valor adicional frete  
                        $result[$i]['addFrete']     =  $key->conf_valor;
                    else if( $key->conf_id == 2 )    
                        //Valor minimo frete gratis
                        $result[$i]['freteGratis']  =  $key->conf_valor;
                    else if( $key->conf_id == 3 ) 
                        //Parcelas sem juros
                        $result[$i]['parcelas']     =  $key->conf_valor;
                    else
                        //Obtem o cep
                        $result[$i]['cep']          =  $key->conf_valor;        

                    $i++;                

                }

            }

            //print_r( $result ); exit;

            return $result;

        }


        /**
         * Método retorna o valor que não cobra frete
         *
         * @param  NULL
         * @return MIX BOOL | STRING
         * @access PUBLIC
         */
        public function getValorSemFrete() {

            //Reseta os attr de Querys
            $this->reset();

            //Seta a tabela
            $this->table   =   'config';

            //Seta os campos
            $this->setField( 'conf_valor' );

            //Seta a condição
            $this->setWhere( "config_id = '2'" );

            //Obtem os dados
            return $this->getRecord();

        }


        /**
         * Método retorna o valor adicional para o frete
         *
         * @param  NULL
         * @return MIX BOOL | STRING
         * @access PUBLIC
         */
        public function getParcelasSemJuros() {

            //Reseta os attr de Querys
            $this->reset();

            //Seta a tabela
            $this->table   =   'config';

            //Seta os campos
            $this->setField( 'conf_valor' );

            //Seta a condição
            $this->setWhere( "config_id = '3'" );

            //Obtem os dados
            return $this->getRecord();

        }


        /**
         * Método retorna o valor adicional para o frete
         *
         * @param  NULL
         * @return MIX BOOL | STRING
         * @access PUBLIC
         */
        public function getValorAddFrete() {

            //Reseta os attr de Querys
            $this->reset();

            //Seta a tabela
            $this->table   =   'config';

            //Seta os campos
            $this->setField( 'conf_valor' );

            //Seta a condição
            $this->setWhere( "config_id = '1'" );

            //Obtem os dados
            return $this->getRecord();

        }


        /**
         * Método retorna o Cep de origem
         *
         * @param  NULL
         * @return MIX BOOL | STRING
         * @access PUBLIC
         */
        public function getCepOrigem() {

            //Reseta os attr de Querys
            $this->reset();

            //Seta a tabela
            $this->table   =   'config';

            //Seta os campos
            $this->setField( 'conf_valor' );

            //Seta a condição
            $this->setWhere( "config_id = '4'" );

            //Obtem os dados
            return $this->getRecord();

        }

        public function getUsuarioApiPagseguro() {

            //Reseta os attr de Querys
            $this->reset();

            //Seta a tabela
            $this->table   =   'config';

            //Seta os campos
            $this->setField( 'conf_valor' );

            //Seta a condição
            $this->setWhere( "config_id = '5'" );

            //Obtem os dados
            return $this->getRecord();

        }

        public function getTokenApiPagseguro() {

            //Reseta os attr de Querys
            $this->reset();

            //Seta a tabela
            $this->table   =   'config';

            //Seta os campos
            $this->setField( 'conf_valor' );

            //Seta a condição
            $this->setWhere( "config_id = '6'" );

            //Obtem os dados
            return $this->getRecord();

        }

    }

}







