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
		$this->load->view('HeaderMain');
		$this->load->view('Main');
	}
	
	public function AccessAdmin()
	{
		$this->load->view('HeaderAdmin');
		$this->load->view('Main');	
	}

	public function AccessUsers()
	{
		$this->load->view('HeaderUsers');
		$this->load->view('Main');	
	}

	public function AccessUsersEmpresa()
	{
		$this->load->view('HeaderUsersEmpresa');
		$this->load->view('Main');	
	}

	public function Login()
	{
		$this->load->model('PARTICULAR_MODEL');
		$this->load->model('EMPRESA_MODEL');
		$this->load->model('EMPLEADO_MODEL');

		$this->load->library('VALIDATE_LOGIN');

		$rut = $this->input->post('rut');
		$pass = hash('sha256',$this->input->post('pass'));

		$rut1 = trim($rut);
		$pass1 = trim($pass);

		$error1 = $this->validate_login->ValidateLastNumberRut($rut1);
		$error2 = $this->validate_login->ValidateNumberRut($rut1);
		$error3 = $this->validate_login->ValidateLargeRut($rut1);

		$mensaje = ["1"=> $error1,"2"=>$error2,"3"=>$error3];

		if(empty($mensaje['1']) && empty($error2['2']) && empty($mensaje['3']))
		{	
			$loginParticular = $this->PARTICULAR_MODEL->GetRutAndPass($rut1,$pass1);

			if(count($loginParticular) != 0)
			{
				$estaHabilidato = $this->PARTICULAR_MODEL->GetStatusAccount($rut1,'ACTIVO');

				if(count($estaHabilidato) != 0)
				{
					$rr = $estaHabilidato[0];
					$NombreUsuario = $rr['NOMBRE_PARTICULAR'];
					$this->session->set_userdata('rut',$rut1);
					$this->session->set_userdata('usuario',$NombreUsuario);
					redirect('/Welcome/AccessUsers','refresh');
				}else 
				{
					$mensaje="Su cuenta se encuentra deshabilitada";
					$this->session->set_userdata('MensajeErrorLogin',$mensaje);
					redirect('/Welcome','refresh');		
				}
			}else 
			{
				$mensaje ="Credenciales incorrectas";
				$this->session->set_userdata('MensajeErrorLogin',$mensaje);
				redirect('/Welcome','refresh');		
			}
		}else 
		{
			$this->session->set_userdata('MensajeErrorLogin',$mensaje);
			redirect('/Welcome','refresh');
		}	
	}

	public function Logout()
	{
		$this->session->sess_destroy();	
		redirect('/Welcome','refresh');
	}
}
