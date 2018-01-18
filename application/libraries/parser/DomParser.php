<?php

namespace parser {

    use parser;

	if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

	//require_once APPPATH . 'libraries/parser/simple_html_dom.php';

	class DomParser {

		private $Dom;

		public function initialize() {

			$this->Dom  =  new parser\simple_html_dom();

			return $this->Dom;

		}

		public function load( $data ) {

			$this->Dom  =  $this->Dom->load( $data );

			return $this->Dom;

		}	

		public function find( $find ) {

			$this->Dom  =  $this->Dom->find( $find );

			return $this->Dom;

		}		

	}

}