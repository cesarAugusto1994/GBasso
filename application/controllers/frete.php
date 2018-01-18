<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frete extends CI_Controller {

    protected function generateFreteFromCifrete( $cep ) 
    {
        $this->load->library('connection/cifrete');
		
		$this->cifrete->setCepOrigem('01310940');
		$this->cifrete->setCepDestino('64000020');
		$this->cifrete->setMaoPropria('s');
		$this->cifrete->setAvisoRecebimento('s');
		$this->cifrete->setDiametro('0');
		$this->cifrete->setValor('0');
		$this->cifrete->setComprimento('30');
		$this->cifrete->setLargura('30');
		$this->cifrete->setAltura('30');
		$this->cifrete->setPeso('1');
		$this->cifrete->setFormato('1');
		$this->cifrete->setEmpresaSenha('');
		$this->cifrete->setEmpresaCodigo('');
		$this->cifrete->setPacRetorno(TRUE);
		$this->cifrete->setSedexRetorno(TRUE);
		$this->cifrete->setESedexRetorno(FALSE);
		$this->cifrete->calcular();
		
		$data['preco_pac'] = $this->cifrete->getResultadoPac();
		$data['preco_sedex'] = $this->cifrete->getResultadoSedex();
		$data['preco_esedex'] = $this->cifrete->getResultadoESedex();
		
		$data['preco_pac_prazo'] = $this->cifrete->getResultadoPacEntrega();
		$data['preco_sedex_prazo'] = $this->cifrete->getResultadoSedexEntrega();
		$data['preco_esedex_prazo'] = $this->cifrete->getResultadoESedexEntrega();

        return $data;
    
    }

}

















