<?php 

namespace sessions {

    use sessions\session;

    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

    class Session {
    	
        public function __construct(){

            if ( $this->is_session_started() === FALSE ) {

                session_start();

                //session_write_close();

                //sleep(5);                

            }

        }


        /**
        * @return bool
        */
        public function is_session_started()
        {
            if ( php_sapi_name() !== 'cli' ) {
                if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                    return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
                } else {
                    return session_id() === '' ? FALSE : TRUE;
                }
            }
            return FALSE;
        }

        public function set( $key, $value ){

            $_SESSION[$key] = $value;

        }

        public function setArray( $key, $index, $value = array() ){

            $_SESSION[$key][$index] = $value;

        }

        public function deleteArray( $key, $index ){

            unset( $_SESSION[$key][$index] );

        }

        public function get( $key ){

            return isset( $_SESSION[$key] ) ? $_SESSION[$key] : null;

        }


        public function setCustom( $index, $value, $count ) {

            $_SESSION['custom'][$index][$count]  =  $value;

        }


        public function countCustom( $index ){

            return isset( $_SESSION['custom'][$index] ) ? count( $_SESSION['custom'][$index] ) : 0;

        }

        public function getCustom( $index ){

            return isset( $_SESSION['custom'][$index] ) ? $_SESSION['custom'][$index] : null;

        }

        public function delCustom( $index ){

            if ( isset( $_SESSION['custom'][$index] ) ) 

                unset($_SESSION['custom'][$index]);

        }


        public function regenerateId( $delOld = false ){

            session_regenerate_id( $delOld );

        }


        public function delete( $key ){

            unset( $_SESSION[$key] );

        }


        public function destroy() {

            foreach($_SESSION as $key => $val){

                unset($_SESSION[$key]);

            }

        }

    }

}    