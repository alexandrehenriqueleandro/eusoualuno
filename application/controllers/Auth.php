<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index() {
        if($this->session->userdata('email_usuario')){
            $data['usuario'] = $this->Usuario_model->get_usuario($this->session->userdata('email_usuario'));
            
            if($data['usuario']['nivel_usuario'] != 1){
                redirect('administracao/');
            } else {
                redirect('doador/');
            }
        }
        
		$this->load->view('login');
	}
    
    public function logar(){
        if(isset($_POST) && count($_POST) > 0 && $this->input->post('email_usuario') != '' 
           && $this->input->post('cpf_usuario') != '') {
            
            $data['usuario'] = $this->Usuario_model->enter($this->input->post('email_usuario'), $this->input->post('cpf_usuario'));
            if(isset($data['usuario']['email_usuario'])){
                                
                $arraydata = array('email_usuario' => $data['usuario']['email_usuario']);
                
                $ci = get_instance();
                $this->session->set_userdata($arraydata);
                
                if($data['usuario']['nivel_usuario'] != 1)
                    redirect('administracao/');
                else
                    redirect('doador/');
                
            } else {
                $data['status'] = '<div class="alert alert-danger" role="alert">O usuário e/ou senha são inválidos</div>';//dados não preenchidos//user não existente
                $this->load->view('login', $data);
            }
        } else {
            $data['status'] = '<div class="alert alert-danger" role="alert">Preencha os campos corretamente</div>';//dados não preenchidos
            $this->load->view('login', $data);
        }
    }
    
    public function logoff(){
        autoriza();
        $keys = array('email_usuario');
        $this->session->unset_userdata($keys);
        header( "refresh:1;url=".site_url('/') );
        $data['status'] = '<div class="alert alert-success" role="alert">Logout com sucesso</div>';
        $this->load->view('login', $data);
    }
    
}
