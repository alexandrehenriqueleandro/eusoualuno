<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administracao extends CI_Controller {

	public function index() {
        autoriza();
        $data['gastos'] = $this->Gasto_model->get_all_gastos();
        $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
		$this->load->view('administracao/admin-doacao.php', $data);
	}
    
    public function notificacoes(){
        autoriza();
        $this->load->view('administracao/notificacoes.php');
    }
    
    public function qrcode(){
        autoriza();
        $this->load->view('administracao/qrCode_reader.php');
    }
    
    public function nova_doacao(){
        autoriza();
        if(isset($_POST) && count($_POST) > 0) {   
            $params = array(
                'id_us' => $this->input->post('id_us'),
				'email_usuario' => $this->input->post('email_usuario'),
				'valor_doacoes' => $this->input->post('valor_doacoes'),
                'data_doacoes' => $this->input->post('data_doacoes'),
				'tipo_doacoes' => $this->input->post('tipo_doacoes'),
            );
            
            $data['usuario'] = $this->Usuario_model->get_usuario($this->input->post('id_us'));
            
            if(isset($data['usuario']['id_us'])){
                
                $credit = 0.0;
                if($this->input->post('tipo_doacoes') == 'Dinheiro'){
                    if($this->input->post('valor_doacoes') < 50.0){
                        $credit = 1.0;
                    } else if($this->input->post('valor_doacoes') < 100.00){
                        $credit = 2.0;
                    } else {
                        $credit = 3.0;
                    }
                } else if($this->input->post('tipo_doacoes') == 'Voluntario'){
                    $credit = 3.0;
                    $params['valor_doacoes'] = 0.0;
                } else {
                    $credit = 1.0;
                    $params['valor_doacoes'] = 0.0;
                }
                
                $doaco_id = $this->Doaco_model->add_doaco($params);
                
                $params = array('credito_usuario' => $data['usuario']['credito_usuario'] + $credit);
                $this->Usuario_model->update_usuario($data['usuario']['id_us'],$params);
                
                $data['status'] = '<div class="alert alert-success" role="alert">Cadastro realizado com sucesso!</div>';
                header( "refresh:1;url=".site_url('administracao/') );
                $data['gastos'] = $this->Gasto_model->get_all_gastos();
                $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
                $this->load->view('administracao/admin-doacao.php', $data);
            } else {
                $data['status'] = '<div class="alert alert-danger" role="alert">Cadastre o doador!</div>';
                header( "refresh:1;url=".site_url('administracao/') );
                $data['gastos'] = $this->Gasto_model->get_all_gastos();
                $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
                $this->load->view('administracao/admin-doacao.php', $data);   
            }
            
        } else {            
            $data['status'] = '<div class="alert alert-danger" role="alert">Erro ao cadastrar doação!</div>';
            header( "refresh:1;url=".site_url('administracao/') );
            $data['gastos'] = $this->Gasto_model->get_all_gastos();
            $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
            $this->load->view('administracao/admin-doacao.php', $data);
        }
    }
    
    public function novo_gasto(){
        autoriza();
        if(isset($_POST) && count($_POST) > 0) {   
            $params = array(
				'valor_gastos' => $this->input->post('valor_gastos'),
				'data_gastos' => $this->input->post('data_gastos'),
				'tipo_gastos' => $this->input->post('tipo_gastos'),
            );
            
            $gasto_id = $this->Gasto_model->add_gasto($params);
            
            $data['status'] = '<div class="alert alert-success" role="alert">Cadastro realizado com sucesso!</div>';
            header( "refresh:1;url=".site_url('administracao/') );
            $data['gastos'] = $this->Gasto_model->get_all_gastos();
            $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
            $this->load->view('administracao/admin-doacao.php', $data);
        } else {            
            $data['status'] = '<div class="alert alert-danger" role="alert">Erro ao cadastrar gasto!</div>';
            header( "refresh:1;url=".site_url('administracao/') );
            $data['gastos'] = $this->Gasto_model->get_all_gastos();
            $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
            $this->load->view('administracao/admin-doacao.php', $data);
        }
    }
    
    public function novo_doador(){
        autoriza();
        if(isset($_POST) && count($_POST) > 0) {   
            $params = array(
                'id_us' => $this->input->post('id_us'),
                'email_usuario' => $this->input->post('email_usuario'),
				'cpf_usuario' => $this->input->post('cpf_usuario'),
				'nome_usuario' => $this->input->post('nome_usuario'),
                'credito_usuario' => 0.0,
				'nivel_usuario' => 1,
            );
            
            $data['usuario'] = $this->Usuario_model->get_usuario($this->input->post('id_us'));
        
            if(isset($data['usuario']['email_usuario'])) {
                $data['status'] = '<div class="alert alert-danger" role="alert">O doador já está cadastrado!</div>';
                header( "refresh:1;url=".site_url('administracao/') );
                $data['gastos'] = $this->Gasto_model->get_all_gastos();
                $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
                $this->load->view('administracao/admin-doacao.php', $data);   
            } else {
                $usuario_id = $this->Usuario_model->add_usuario($params);
                $data['status'] = '<div class="alert alert-success" role="alert">Cadastro realizado com sucesso!</div>';
                header( "refresh:1;url=".site_url('administracao/') );
                $data['gastos'] = $this->Gasto_model->get_all_gastos();
                $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
                $this->load->view('administracao/admin-doacao.php', $data);
            }
        } else {            
            $data['status'] = '<div class="alert alert-danger" role="alert">Erro ao cadastrar gasto!</div>';
            header( "refresh:1;url=".site_url('administracao/') );
            $data['gastos'] = $this->Gasto_model->get_all_gastos();
            $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
            $this->load->view('administracao/admin-doacao.php', $data);
        }
    }
    
    public function notificar(){
        autoriza();
        if(isset($_POST) && count($_POST) > 0) {
            // Carrega a library email
            $this->load->library('email');

            //Inicia o processo de configuração para o envio do email
            $config['protocol'] = 'mail'; // define o protocolo utilizado
            $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
            $config['validate'] = TRUE; // define se haverá validação dos endereços de email 
            $config['mailtype'] = 'text';

            // Inicializa a library Email, passando os parâmetros de configuração
            $this->email->initialize($config);
            $data['usuario'] = $this->Usuario_model->get_all_usuario();
            foreach($data['usuario'] as $u){
                // Define remetente e destinatário
                $this->email->from('vinicius_furuka@hotmail.com', 'APAE'); // Remetente
                $this->email->to($u['email_usuario'], $u['nome_usuario']); // Destinatário

                // Define o assunto do email
                $this->email->subject($this->input->post('nome_evento').' - '.$this->input->post('data_evento'));
                $this->email->message($this->input->post('descricao_evento'));
                $ans = $this->email->send();
            }

            /*
             * Se o envio foi feito com sucesso, define a mensagem de sucesso
             * caso contrário define a mensagem de erro, e carrega a view home
             */
            if($ans) {
                $data['status'] = '<div class="alert alert-success" role="alert">Usuários notificados!</div>';
                header( "refresh:1;url=".site_url('administracao/') );
                $data['gastos'] = $this->Gasto_model->get_all_gastos();
                $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
                $this->load->view('administracao/admin-doacao.php', $data);
            } else {
                $data['status'] = '<div class="alert alert-danger" role="alert">Erro ao notificar usuários!</div>';
                header( "refresh:1;url=".site_url('administracao/') );
                $data['gastos'] = $this->Gasto_model->get_all_gastos();
                $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
                $this->load->view('administracao/admin-doacao.php', $data);
            }
        }
    }
    
    public function cobrar(){
        autoriza();
        if(isset($_POST) && count($_POST) > 0) {
            $data['usuario'] = $this->Usuario_model->get_usuario($this->input->post('id'));
            if(isset($data['usuario']['email_usuario'])) {
                $ans = $data['usuario']['credito_usuario'] - $this->input->post('price');
                if($ans < 0)
                    $params = array('credito_usuario' => 0.0);
                else 
                    $params = array('credito_usuario' => $data['usuario']['credito_usuario'] - $this->input->post('price'));
                
                $this->Usuario_model->update_usuario($data['usuario']['email_usuario'], $params);           
                header('Content-type: application/json');
                echo json_encode($ans);
            } else {
                header('Content-type: application/json');
                echo json_encode("err");

            }
        }
    }
    
    public function doacao_del($id_doacoes){
        autoriza();
        $doaco = $this->Doaco_model->get_doaco($id_doacoes);

        // check if the doaco exists before trying to delete it
        if(isset($doaco['id_doacoes']))
        {
            $this->Doaco_model->delete_doaco($id_doacoes);
            $data['status'] = '<div class="alert alert-success" role="alert">Doação excluida com sucesso!</div>';
            header( "refresh:1;url=".site_url('administracao/') );
            $data['gastos'] = $this->Gasto_model->get_all_gastos();
            $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
            $this->load->view('administracao/admin-doacao.php', $data);
        } else {
            $data['status'] = '<div class="alert alert-danger" role="alert">Erro ao excluir doação!</div>';
            header( "refresh:1;url=".site_url('administracao/') );
            $data['gastos'] = $this->Gasto_model->get_all_gastos();
            $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
            $this->load->view('administracao/admin-doacao.php', $data);
            
        }
    
    }
    
    public function gasto_del($id_gastos){
        autoriza();
        $gasto = $this->Gasto_model->get_gasto($id_gastos);

        // check if the gasto exists before trying to delete it
        if(isset($gasto['id_gastos'])) {
            $this->Gasto_model->delete_gasto($id_gastos);
            
            $data['status'] = '<div class="alert alert-success" role="alert">Gasto excluido com sucesso!</div>';
            header( "refresh:1;url=".site_url('administracao/') );
            $data['gastos'] = $this->Gasto_model->get_all_gastos();
            $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
            $this->load->view('administracao/admin-doacao.php', $data);
        } else {
            $data['status'] = '<div class="alert alert-danger" role="alert">Erro ao excluir gasto!</div>';
            header( "refresh:1;url=".site_url('administracao/') );
            $data['gastos'] = $this->Gasto_model->get_all_gastos();
            $data['doacoes'] = $this->Doaco_model->get_all_doacoes();
            $this->load->view('administracao/admin-doacao.php', $data);
            
        }
    
    }
    
}