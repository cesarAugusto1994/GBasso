<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->helper( 'url' );

		$this->load->library( 'header' );

		$this->load->library( 'parser' );

	}


	public function view() {
		
		$data            =   array();

		$data['header']  =   array();

		$data['body']    =   array();

		$data['footer']  =   array();

		$data['header']['css']  =  $this->header->getCss( array( 0, 1, 2, 3, 4, 5, 6, 7 ) );

		$data['header']['js']   =  $this->header->getJs( array( 1, 2, 3, 4 ) );

		$data['footer']['js']   =  $this->header->getJs( array( 0 ) );

		$data['header']['url']  =  base_url();

		$data['body']['url']    =  base_url();

		$data['footer']['url']  =  base_url();

		$this->parser->parse( 'upload/image_view', $data['body'] );

	}


	public function send() {

		$callback       =   $_GET['CKEditorFuncNum'];

		$response       =   array();

		$image          =   $_FILES[ 'upload' ];

		$dirToSave      =   'assets/img/upload/';

		$length         =   1048576; //1 MB por arquivo

		$fileExtension  =   array( 'jpg', 'png', 'jpeg' );

		$this->load->library( 'extend/Files' );

		$this->files->initialize( $image, $dirToSave, $length, $fileExtension );

		$response   =   $this->files->processSingleFile();

		if( $response['code'] == 102 ) {

			echo '<html><body height="400px;">' . $response['status'] . '</body></html>';

			exit;

		}else {

			$url      =   $response['file'];

			$img      =   $response['status'];

			$output   =   '<html><body><script type="text/javascript">window.parent.CKEDITOR.tools.callFunction('.$callback.', "'.$url.'","'.$msg.'");</script></body></html>';

			echo $output;

		}

		exit;

	}	

}
