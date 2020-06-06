<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
    
    public function qrcode(){
        $this->load->library('ciqrcode');

        header("Content-Type: image/png");
        $params['data'] = 'deu bom';
        $this->ciqrcode->generate($params);
    }
    
    public function EnviarEmail(){
        // Carrega a library email
        $this->load->library('email');
         
        //Inicia o processo de configuração para o envio do email
        $config['protocol'] = 'mail'; // define o protocolo utilizado
        $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
        $config['validate'] = TRUE; // define se haverá validação dos endereços de email 
        $config['mailtype'] = 'text';
 
        // Inicializa a library Email, passando os parâmetros de configuração
        $this->email->initialize($config);
        
        // Define remetente e destinatário
        $this->email->from('vinicius_furuka@hotmail.com.br', 'Remetente'); // Remetente
        $this->email->to('hicaarol@gmail.com',"destinatario"); // Destinatário
 
        // Define o assunto do email
        $this->email->subject('Enviando emails com a library nativa do CodeIgniter');
        $this->email->message("oi eu sou goku");
        
        // Define remetente e destinatário
        $this->email->from('vinicius_furuka@hotmail.com.br', 'Remetente'); // Remetente
        $this->email->to('breno.oliveira@dcomp.sor.ufscar.br',"destinatario"); // Destinatário
 
        // Define o assunto do email
        $this->email->subject('Enviando emails com a library nativa do CodeIgniter');
        $this->email->message("oi eu sou goku");
         
        /*
         * Se o envio foi feito com sucesso, define a mensagem de sucesso
         * caso contrário define a mensagem de erro, e carrega a view home
         */
        if($this->email->send())
        {
            echo "FOI";
        } else {
            echo "NÃO FOI";
        }
    }
}
