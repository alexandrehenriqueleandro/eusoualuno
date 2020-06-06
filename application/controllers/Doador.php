<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doador extends CI_Controller {

	public function index() {
        autoriza();
        $data['doaco'] = $this->Doaco_model->get_doaco_limit($this->session->userdata('email_usuario'));
        $data['usuario'] = $this->Usuario_model->get_usuario($this->session->userdata('email_usuario'));
		$this->load->view('doador/pontos.php', $data);
	}
    
    public function myqr($id){
        autoriza();
        $this->load->library('ciqrcode');
        header("Content-Type: image/png");
        $params['data'] = base64_decode($id);
        $this->ciqrcode->generate($params);
    }
    
}
