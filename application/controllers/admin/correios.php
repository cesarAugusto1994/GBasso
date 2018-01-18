<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("America/New_York");

class Correios extends CI_Controller {

    private $Header     =  null;

    private $Essential  =  null;

    private $Login      =  null;

    private $Correios   =  null;
    
	public function __construct() {
            
        parent::__construct();          

        //Instacia a classe Essential do package Security
        $this->Essential  =   new security\Essentials;

        //Instacia a classe Essential do package Security
        $this->Header     =   new data\Header_admin( base_url() );

        //Instancia a classe login
        $this->Login      =   new sessions\Login;

        //Instancia a classe login
        $this->Correios   =   new connection\Correios;

        //Load data admin
        $this->Login->loadDataAdmin();

        //Redireciona o usuário para login caso sua sessão tenha expirado ou não exista
        if( !$this->Login->checkSessionAdmin() ) redirect( base_url( 'admin/login' ) );

    }


    public function rastreio() {

        $this->Correios->urlCorreios  =  'http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI=DU184795359BR';

        $this->Correios->initCurl();

        $this->Correios->setOpt( 'CURLOPT_URL', $this->Correios->urlCorreios );

        $this->Correios->setOpt( 'CURLOPT_SSL_VERIFYPEER', 0 );

        $this->Correios->setOpt( 'CURLOPT_USERAGENT', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:10.0) Gecko/20100101 Firefox/10.0' );

        $this->Correios->setOpt( 'CURLOPT_RETURNTRANSFER', true );

        $data     =   $this->Correios->execute();

        $html     =   new simple_html_dom();

        $table    =   $html->load( $data );

        $rowData  =   array();

        foreach($table->find('tr') as $row ) {
            // initialize array to store the cell data from each row
            $flight = array();
            foreach($row->find('td') as $cell) {
                // push the cell's text to the array
                $flight[] = $cell->plaintext;
            }
            $rowData[] = $flight;
        }

        $data  =  array();

        $i     =  0;

        $j     =  0;

        foreach ($rowData as $key => $value) {

            if( $i > 0 && count( $value ) == 3 ) {

                $data[$j]  =  array(
                                  'data'      =>  $value[0],
                                  'local'     =>  $value[1],
                                  'situacao'  =>  $value[2]
                              );

                $j++;

            }else if( count( $value ) == 1 ) {

                $data[$j]  =  array(
                                  'data'      =>  $rowData[$key-1][0],
                                  'local'     =>  $rowData[$key][0],
                                  'situacao'  =>  $rowData[$key-1][2]
                              );

                $j++;

            }

            $i++;

        }

        print_r( $data ); exit;




    }

}    









