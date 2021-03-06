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
		if($this->session->rut != null)
		{
			$this->load->view('HeaderAdmin');
			$this->load->view('Main');	
		}else
		{
			redirect('/Welcome','refresh');		
		}
	}

	public function AccessReceptorMuetras()
	{
		if($this->session->rut != null)
		{
			$this->load->view('HeaderReceptorMuestras');
			$this->load->view('Main');	
		}else 
		{
			redirect('/Welcome','refresh');		
		}
	}

	public function AccessTecnicoLaboratorio()
	{
		if($this->session->rut != null)
		{
			$this->load->view('HeaderTecnicoLaboratorio');
			$this->load->view('Main');
		}else 
		{
			redirect('/Welcome','refresh');
		}
	}

	public function AccessUsers()
	{
		if($this->session->rut !=null)
		{
			$this->load->view('HeaderUsers');
			$this->load->view('Main');	
		}else 
		{
			redirect('/Welcome','refresh');
		}

	}

	public function AccessUsersEmpresa()
	{
		if($this->session->rut != null)
		{
			
			$this->load->view('HeaderUsersEmpresa');
			$this->load->view('Main');	
		}else 
		{
			redirect('/Welcome','refresh');
		}
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

		/*if(empty($mensaje['1']) && empty($error2['2']) && empty($mensaje['3']))
		{*/	
			$loginParticular = $this->PARTICULAR_MODEL->GetRutAndPass($rut1,$pass1);
			$loginEmpresa = $this->EMPRESA_MODEL->GetRutAndPass($rut1,$pass1);
			$loginEmpleado = $this->EMPLEADO_MODEL->GetRutAndPass($rut1,$pass1);
			
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
			}else if(count($loginEmpresa) != 0)
			{
				$estaHabilidatoEmpresa = $this->EMPRESA_MODEL->GetStatusAccount($rut1,'ACTIVO');

				if(count($estaHabilidatoEmpresa) !=0)
				{
					$rr = $estaHabilidatoEmpresa[0];
					$NombreUsuario = $rr['NOMBRE_EMPRESA'];
					$this->session->set_userdata('rut',$rut1);
					$this->session->set_userdata('usuario',$NombreUsuario);
					redirect('/Welcome/AccessUsersEmpresa','refresh');
				}else 
				{
					$mensaje="Su cuenta se encuentra deshabilitada";
					$this->session->set_userdata('MensajeErrorLogin',$mensaje);
					redirect('/Welcome','refresh');		
				}
			}else if(count($loginEmpleado) !=0)
			{
				$tipoEmpleado = $this->EMPLEADO_MODEL->TypeRol($rut,'A');
				$tipoEmpleadoReceptor = $this->EMPLEADO_MODEL->TypeRol($rut,'R');
				$tipoEmpleadoTecnicoAnalista = $this->EMPLEADO_MODEL->TypeRol($rut,'T');
				$estaHabilidatoEmpleado = $this->EMPLEADO_MODEL->GetStatusAccount($rut1,'ACTIVO');
				
				if(count($tipoEmpleado) !=0)
				{
					if(count($estaHabilidatoEmpleado) != 0)
					{
						$rr = $estaHabilidatoEmpleado[0];
						$NombreUsuario = $rr['NOMBRE_EMPLEADO'] . " " .$rr['APELLIDO_PATERNO_EMPLEADO']. " ". $rr['APELLIDO_MATERNO_EMPLEADO'];
						$this->session->set_userdata('rut',$rut1);
						$this->session->set_userdata('usuario',$NombreUsuario);
						redirect('/Welcome/AccessAdmin','refresh');
					}else 
					{
						$mensaje="Su cuenta se encuentra deshabilitada";
						$this->session->set_userdata('MensajeErrorLogin',$mensaje);
						
						redirect('/Welcome','refresh');		
					}
				}else if(count($tipoEmpleadoReceptor) !=0)
				{
					if(count($estaHabilidatoEmpleado) != 0)
					{
						$rr = $estaHabilidatoEmpleado[0];
						$NombreUsuario = $rr['NOMBRE_EMPLEADO'] . " " .$rr['APELLIDO_PATERNO_EMPLEADO']. " ". $rr['APELLIDO_MATERNO_EMPLEADO'];
						$this->session->set_userdata('rut',$rut1);
						$this->session->set_userdata('usuario',$NombreUsuario);
						redirect('/Welcome/AccessReceptorMuetras','refresh');
					}else 
					{
						$mensaje="Su cuenta se encuentra deshabilitada";
						$this->session->set_userdata('MensajeErrorLogin',$mensaje);
						
						redirect('/Welcome','refresh');		
					}
				}else if(count($tipoEmpleadoTecnicoAnalista) != 0)
				{
					if(count($estaHabilidatoEmpleado) !=0)
					{
						$rr = $estaHabilidatoEmpleado[0];
						$NombreUsuario = $rr['NOMBRE_EMPLEADO'] . " " .$rr['APELLIDO_PATERNO_EMPLEADO']. " ". $rr['APELLIDO_MATERNO_EMPLEADO'];
						$this->session->set_userdata('rut',$rut1);
						$this->session->set_userdata('usuario',$NombreUsuario);
						redirect('/Welcome/AccessTecnicoLaboratorio','refresh');
					}else 
					{
						$mensaje="Su cuenta se encuentra deshabilitada";
						$this->session->set_userdata('MensajeErrorLogin',$mensaje);
						
						redirect('/Welcome','refresh');		
					}
				}else 
				{
					$mensaje ="Usuario desconocido";
					$this->session->set_userdata('MensajeErrorLogin',$mensaje);
					redirect('/Welcome','refresh');						
				}
			}else 
			{
				$mensaje ="Credenciales incorrectas ";
				$this->session->set_userdata('MensajeErrorLogin',$mensaje);
				redirect('/Welcome','refresh');		
			}
		/*}else 
		{
			$this->session->set_userdata('MensajeErrorLogin',$mensaje);
			redirect('/Welcome','refresh');
		}*/
	}

	public function Logout()
	{
		$this->session->sess_destroy();	
		redirect('/Welcome','refresh');
	}
}
