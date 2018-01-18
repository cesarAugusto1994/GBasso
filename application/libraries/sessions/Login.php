<?php 
namespace sessions {

    use sessions;

    use db;

    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

    date_default_timezone_set('America/Sao_Paulo');

    /**
    * Class has content to manipule sessions of Login user
    * Check if user is logged or not and another
    *
    * @package    Sessions
    * @subpackage Login
    */
    class Login extends Session {

        //Atributo que será instanciada a classe Querys
        private $Querys     =  null;

        //Atributo que conterá o ID do admin
        private $idAdmin    =  null;

        //Atributo que conterá o nome do admin
        private $nameAdmin  =  null;

        //Atributo que conterá o timestamp do ultimo login do admin
        private $sessAdmin  =  null;

        //Atributo de sessão do usuário
        private $idUsu      =  null;

        private $idLog      =  null;

        private $nome       =  null;

        private $Carrinho   =  null;

        //Atributo que contem dados de sessão customizado
        private $custom     =  array();

        /**
        * Construct of class, nothing interesting here
        * Go go go...
        *
        * @param  null
        * @access public
        * @return void        
        */
        public function __construct( $loadType = 1 ){

            //Nothing more
            parent::__construct();

            //Instance class Querys of package DB
            $this->Querys   =   new db\Querys;

            if( $loadType == 1 ) {

                $this->loadDataAdmin();

            }else {

                $this->loadCredentialsLogin();

            }

        }


        /**
        * Verifica se os parametros de usuário e senha enviados pelo formulário de login são válidos
        *
        * @param  STRING $user  - Nome de usuário
        * @param  STRING $pass  - Senha do usuário
        *
        * @access PUBLIC
        * @return bool        
        */
        public function validarCredenciaisAdmin( $user, $pass ) {

            //Reseta os atributos da classe Querys
            $this->Querys->reset();

            //Seta os campos que desejo retornar
            $this->Querys->setField( 'adm_id, adm_nome, adm_session' );

            //Seta  a condição de busca
            $this->Querys->setWhere( "adm_user = '$user' AND adm_pass = '$pass' AND adm_status = 1" );

            //Set table
            $this->Querys->table  =  'admin';

            //Obtem o retorno
            $response   =   $this->Querys->get();

            //Reseta os atributos da classe Querys
            $this->Querys->reset();

            //Verifica se algo foi retornado
            if( count( $response ) == 1 ) {

                $session    =    date( 'Y-m-d H:i:s' );

                //Set name admin
                $this->setNameAdmin( $response[0]->adm_nome );

                //Set ID admin
                $this->setIDAdmin( $response[0]->adm_id );

                //Set first session admin
                $this->setSessionAdmin( $session );

                //Update session
                $this->gravarSessionAdmin( $session, $response[0]->adm_id );

                //return success
                return true;

            }else {

                //return fail
                return false;

            }

        }


        /**
        * Verifica se o usuário está logado
        *
        * @param  null        
        * @return void
        * @access PUBLIC
        */
        public function checkSessionAdmin() {

            if( !is_null( $this->sessAdmin ) ) {

                //get date current in timestamp
                $newSession   =  strtotime( date( 'Y-m-d H:i:s' ) );

                //Get last session 
                $lastSession  =  strtotime( $this->sessAdmin );

                //Get diff between sessions
                $diffSession  =  date( 'i', $newSession - $lastSession );

                //Check if session is < 30 minutes
                if( $diffSession > 30 ){  $this->adminSessionDestroy(); return false; }

                //Set field
                $this->Querys->setField( 'adm_id' );

                //Set condition
                $this->Querys->setWhere( "adm_id = '$this->idAdmin' AND adm_status = '1'" );

                //Set table
                $this->Querys->table   =   'admin';

                //get data
                $response  =   $this->Querys->getRecord();

                //Check data response
                if( is_numeric( $response ) ) {   

                    //Session data in format date
                    $newSession  =  date( 'Y-m-d H:i:s', $newSession );

                    //Update session
                    $this->gravarSessionAdmin( $newSession, $this->idAdmin );

                    //Update session attr
                    $this->setSessionAdmin( $newSession );

                    return true;

                }else {

                    return false;

                }

            }else {

                return false;

            }

        }


        /**
        * Destroi session admin
        *
        * @access PUBLIC
        * @return void
        */
        public function adminSessionDestroy() {

            //Destroi sesões admin
            $this->delete( 'admName' );

            $this->delete( 'admID' );

            $this->delete( 'admSession' );

        }




        /**
        * Carrega os atributos de Admin
        *
        * @access PUBLIC
        * @return void
        */
        public function loadDataAdmin() {

            //get name admin
            $this->nameAdmin  =  $this->get( 'admName' );

            //get admin id
            $this->idAdmin    =  $this->get( 'admID' );
    
            //get session admin
            $this->sessAdmin  =  $this->get( 'admSession' );

        }


        /**
        * Grava a ultima sessão do usuário em banco de dados
        *
        * @param  DATE $session  -  Ultima sessão do usuário
        *
        * @access PRIVATE
        * @return void        
        */
        private function gravarSessionAdmin( $session, $idAdmin ) {

            //Reset fields
            $this->Querys->reset();

            //Set array com time to moment
            $gravar      =   array( 'adm_session' => $session );

            //Set condition to update
            $this->Querys->setWhere( "adm_id = '$idAdmin'" );

            //Set table
            $this->Querys->table  =  'admin';

            //Update column log_session with new session time
            $this->Querys->update( $gravar );

        }


        /**
        * Seta o nome do admin em sessão
        *
        * @param  STRING $name  - Nome real do admin
        *
        * @access PRIVATE
        * @return void        
        */
        private function setNameAdmin( $name ) {

            $this->set( 'admName', $name );

        }


        /**
        * Seta o ID do admin em sessão
        *
        * @param  INT $id  - ID do admin
        *
        * @access PRIVATE
        * @return void        
        */
        private function setIDAdmin( $id ) {

            $this->set( 'admID', $id );

        }


        /**
        * Seta a data de ultima atividade do admin em sessão
        *
        * @param  DATE $session  -  Date do admin
        *
        * @access PRIVATE
        * @return void        
        */
        private function setSessionAdmin( $session ) {

            $this->set( 'admSession', $session );            

        }






















        /**
        * Method set in atributes values of credentials for login
        *
        * @param   null
        * @return  void
        * @access  PROTECTED
        **/
        protected function loadCredentialsLogin() {

            $this->idUsu    =   $this->get( 'idusu' );

            $this->idLog    =   $this->get( 'idlog' );

            $this->nome     =   $this->get( 'nome' );

            $this->custom   =   $this->get( 'custom' );

        }


        /**
        * Method call function destroy of class Session.
        * All data session, it will be destroyed
        *
        * @param   null
        * @return  void
        * @access  PUBLIC
        **/
        public function logOut() {

            $this->Carrinho  =  new sessions\Carrinho();

            $cart            =  $this->Carrinho->getCart();

            $this->destroy();

            $this->Carrinho->restoreCarrinho( $cart );

        }


        /**
        * Method validate user by password
        *
        * @param   string  -   $pass   String with password user
        * @return  bool
        * @access  PUBLIC
        **/
        public function checkUserByPass( $pass ) {

            //Reset all attributes of class Querys
            $this->Querys->reset();

            $pass       .=   'QE~y5wAr6*RA@He6UT2(!Duce^dab}Su*_u]';

            //HASH a senha do usuário
            $pass        =   sha1( $pass );

            //get ID do usuário
            $idLogin     =   $this->getIdLogin();

            //Set field to return
            $this->Querys->setField( 'log_id' );

            //Set Join between usuarios and login
            $this->Querys->setJoin( 'INNER JOIN usuarios AS USU ON USU.usu_id = LOG.usu_id' );

            //Set condition query
            $this->Querys->setWhere( "log_id = '$idLogin'" );

            //Set condition query
            $this->Querys->setWhere( "log_pass = '$pass'" );

            //Set condition query
            $this->Querys->setWhere( "log_status = 1" );

            //Set condition query
            $this->Querys->setWhere( "usu_status = 1" );            

            //Seta table to consult
            $this->Querys->table  =  'login as LOG';

            //Verifica se essa é a senha do usuário
            $nada  =  $this->Querys->searchRecord();

            //echo $this->Querys->query; exit;

            return $this->Querys->searchRecord();

        }



        /**
        * Method consult database with base login and password of user
        *
        * @param   string  -   $user   String with name user
        * @param   string  -   $pass   String with password user
        * @return  bool
        * @access  PUBLIC
        **/
        public function logIn( $user, $pass ) {

            //Reset all attributes of class Querys
            $this->Querys->reset();

            //Set field to return
            $this->Querys->setField( 'USU.usu_id, log_id, usu_nome' );

            //Set Join between usuarios and login
            $this->Querys->setJoin( 'INNER JOIN usuarios AS USU ON USU.usu_id = LOG.usu_id' );

            //Set condition query
            $this->Querys->setWhere( "log_user = '$user'" );

            //Set condition query
            $this->Querys->setWhere( "log_pass = '$pass'" );

            //Set condition query
            $this->Querys->setWhere( "log_status = 1" );

            //Seta table to consult
            $this->Querys->table  =  'login as LOG';

            //Process and execute query
            $user                 =   $this->Querys->get();

            //echo count( $user ); exit;

            //echo $this->Querys->query; exit;

            //Check if function retorned only 1 data
            if( count( $user ) != 1 ) {

                return false;

            }else {

                //Seta data in session

                //Reset all attributes of class Querys
                $this->Querys->reset();

                $idLog   =   $user[0]->log_id;

                //Set login name
                $this->setNome( $user[0]->usu_nome );

                //Set login ID
                $this->setIdLogin( $idLog );

                //Set user ID
                $this->setIdUser( $user[0]->usu_id );

                //Get time current and convert to time
                $sessLogin   =   date( 'Y-m-d H:i:s' );

                //Set array com time to moment
                $gravar      =   array( 'log_session' => $sessLogin );

                //Set condition to update
                $this->Querys->setWhere( "log_id = '$idLog'" );

                //Set table
                $this->Querys->table  =  'login';

                //Update column log_session with new session time
                $this->Querys->update( $gravar );

                //Return true
                return true;

            }

        }        


        /**
        * Method check session credentials of user and status of user and login in DB
        *
        * @param  null        
        * @return void
        * @access PUBLIC
        */
        public function checkLogin() {

            //print_r( $_SESSION ); exit;

            $this->loadCredentialsLogin();

            //Set Field to return in query
            $this->Querys->setField( 'log_session, log_status' );

            //Set Join between usuarios and login
            $this->Querys->setJoin( 'INNER JOIN usuarios AS USU ON USU.usu_id = LOG.usu_id' );

            //Set condition query
            $this->Querys->setWhere( "log_id = '$this->idLog'" );

            //Seta table to consult
            $this->Querys->table  =  'login AS LOG';

            //Process query and get result
            $user      =   $this->Querys->get();

            //Variable response to return validation function
            $response  =   true;

            //Check if return is equal 1 data row
            if( count( $user ) == 1 ) {

                //Convert data 
                $newSession   =   strtotime( date( 'Y-m-d H:i:s' ) );

                //Get status login of user
                $logStatus    =   $user[0]->log_status;

                //Get value time session
                $oldSession   =   strtotime( $user[0]->log_session );

                //Get difference time session
                $diffSession  =   date( 'i', $newSession - $oldSession );

                //Check se session is smaller than 30 and status different than one 
                if( $diffSession > 30 || $logStatus != 1 ) {

                    //Response false
                    $response  =  false;                    

                }else {

                    //Atualizando a sessão

                    //Reseta todos os attr de querys
                    $this->Querys->reset();                    

                    //Get time current and convert to time
                    $sessLogin   =   date( 'Y-m-d H:i:s' );

                    //Set array com time to moment
                    $gravar      =   array( 'log_session' => $sessLogin );

                    //Set condition to update
                    $this->Querys->setWhere( "log_id = '$this->idLog'" );

                    //Set table
                    $this->Querys->table  =  'login';

                    //Update column log_session with new session time
                    $this->Querys->update( $gravar );

                }

            }else {                

                //Response false
                $response  =  false;

            }

            //Check se response is false, yes destroy all data session
            !$response ? $this->logOut() : null;

            //return response value
            return $response;

        }



        /**
        * Esse método seta um valor para o nome de usuário
        *
        * @param   STRING  $nome  -  Nome do usuário que deseja setar
        * @return  STRING
        * @access  PUBLIC
        **/   
        public function setNome( $nome ) {

            $this->set( 'nome', $nome );

        }



        /**
        * Esse método retorna o nome do usuário
        *
        * @param   NULL
        * @return  STRING
        * @access  PUBLIC
        *
        **/   
        public function getNome() {

            return $this->nome;

        }


        /**
        * Esse método seta o id do login do usuário
        *
        * @param   INT  $id  -  Identificador de login do usuário
        * @return  VOID
        * @access  PUBLIC
        *
        **/   
        public function setIdLogin( $id ) {

            $this->set( 'idlog', $id );

        }



        /**
        * Esse método retorna o identificador de login do usuário
        *
        * @param   NULL
        * @return  INT
        * @access  PUBLIC
        *
        **/   
        public function getIdLogin() {

            return $this->idLog;

        }



        /**
        * Esse método seta o id de usuário do usuário
        *
        * @param   INT  $id  -  Identificador de usuário do usuário
        * @return  VOID
        * @access  PUBLIC
        *
        **/   
        public function setIdUser( $id ) {

            $this->set( 'idusu', $id );

        }


        /**
        * Esse método retorna o identificador de usuário do usuário
        *
        * @param   NULL
        * @return  INT
        * @access  PUBLIC
        *
        **/
        public function getIdUser() {

            return $this->idUsu;

        }
       

    }

}    