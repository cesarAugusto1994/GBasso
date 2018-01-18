<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banners_admin extends CI_Controller {

    private $Header     =  null;

    private $Essential  =  null;

    private $Login      =  null;

    private $Banners    =  null;

    private $Files      =  null;

    private $General    =  null;
    
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

        //Login expirou por algum motivo, um código de erro difernete será enviado e a popup de login será chamada
        if( !$this->Login->checkSessionAdmin() ) $this->Essential->setMessage( 'Faça login novamente', 103 );

    }



    /**
    * Método grava as imagens do banner rotativo em banco de dados
    *
    * @param  
    * @return array json
    * @access PUBLIC
    */
    public function cadastrar() {

        $this->Banners   =    new objects\Banners;

        //Recebe os dados via POST
        $images          =    isset( $_FILES['images'] ) ? $_FILES['images'] : null;

        $local           =    $this->input->post( 'localBanner' );

        !is_numeric( $local ) ? $this->Essential->setMessage( 'Local do banner inválido', 102 ) : null;

        !( $local > 0 && $local < 8 ) ? $this->Essential->setMessage( 'Local do banner inválido', 102 ) : null;

        count( $images['name'] ) > 1 && $local > 1  ? $this->Essential->setMessage( 'Você pode selecione apenas 1 imagem para esse tipo de banner', 102 ) : null;;

        //Verificando as imagens
        if( !is_null( $images ) ) {

            $this->Files    =  new extend\Files( $images );

            $dirToSave      =   'assets/uploads/banners/';

            $length         =   1048576 * 3; //3 MB por arquivo

            $fileExtension  =   array( 'jpg', 'png' );

            $this->Files->initialize( $dirToSave, $length, $fileExtension );

            $respImg        =   $this->Files->processMultFiles();

            if( isset( $respImg['code'] ) ) {

                $this->Essential->setMessage( $respImg['status'], 102 );

            }

        }else {

            $this->Essential->setMessage( 'Selecione no minimo 1 imagem', 102 );

        }

        //Verifica se algo foi retornado
        if( count( $respImg ) == 0 )  {
            
            $this->Essential->setMessage( 'Selecione no minimo 1 imagem', 102 );

        }else {

            if( $local != 1 ) {

                $this->Banners->idLocal =  $local;

                $this->Banners->deletarBanners();

            }

            foreach ( $respImg as $key ) {

                $imagem  =  $key['file'];

                $this->Banners->gravar( $local, '', $imagem, '', 1, 1 );

            }

        }

        $response  =  array( 'id' => $local, 'code' => 100 );

        //Envia a mensagem para o usuário
        echo json_encode( $response ); exit;

    }



    /**
    * Método deleta banners
    *
    * @param  INT $id[num]   -  ID do banner a ser deletado
    * @param  INT $qtd       -  Quantidade de banners que serão deletados
    * @return array json
    * @access PUBLIC
    */
    public function deletarBanners() {

        //Instancia a classe de produtos
        $this->Banners  =   new objects\Banners;

        $qtd            =   $this->Essential->sqlInjection( $this->input->post( 'qtd' ) );

        !$this->Essential->onlyNumber( $qtd ) ? $this->Essential->setMessage( 'Selecione uma ou mais imagens para deletar', 102 ) : null;

        ( $qtd > 4 ) ? $this->Essential->setMessage( 'Você pode deletar apenas 4 banners por vez', 102 ) : null;

        $banner   =  array();

        for( $i = 0; $i < $qtd; $i++ ) {

            $id  =   $this->input->post( 'id' . $i );

            if( is_numeric( $id ) ) {

                $banner[ $i ]  =   $id;

            }else {

                $this->Essential->setMessage( 'Imagem de número ' . ( $i + 1 ) . ' inválido', 102 );

            }

        }

        for( $i = 0; $i < count( $banner ); $i++ ) {

            $this->Banners->idBanner  =  $banner[ $i ];

            $this->Banners->deletarBanners();

        }

        //retorna os dados
        $this->Essential->setMessage( 'Banners deletadas com sucesso', 100 );

    }



    /**
    * Método deleta banners
    *
    * @param  INT $id       -  ID do banner a ser deletado
    * @param  INT $ordem    -  Número de ordem do banner
    * @return array json
    * @access PUBLIC
    */
    public function salvarOrdem() {

        //Instancia a classe de produtos
        $this->Banners  =   new objects\Banners;
        
        $id     =   $this->input->post( 'id' );

        $ordem  =   $this->input->post( 'ordem' );

        !is_numeric( $id ) ? $this->Essential->setMessage( 'Banner inválido', 102 ) : null;

        $this->Banners->idBanner  =  $id;

        !$this->Banners->bannerExists() ? $this->Essential->setMessage( 'Banner inválido', 102 ) : null;

        !is_numeric( $ordem ) ? $this->Essential->setMessage( 'Ordem inválida', 102 ) : null;

        $this->Banners->gravar( '', '', '', '', $ordem, '', true );

        $this->Essential->setMessage( 'Ordem alterada com sucesso', 100 );

    }

}    

















