<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRUD_CONTACTOS extends CI_Controller {

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
        $this->load->model('CONTACTO_MODEL');
        $this->load->model('EMPRESA_MODEL');

        $codigo = $this->EMPRESA_MODEL->GetRut($this->session->rut);
        $codigo = $codigo[0];
        
        $data['LoadContactos'] = $this->CONTACTO_MODEL->AllById($codigo['CODIGO_EMPRESA']);
        $this->load->view('ListadoContactos',$data);
	}

	public function AddContactos()
	{
		$this->load->view('RegistroContactos');
	}

	public function AgregarContactos()
	{
		$this->load->model('CONTACTO_MODEL');
		$this->load->model('EMPRESA_MODEL');

		$this->load->library('VALIDATE_FORM_EMPRESA');

		$rut = $this->input->post('rut');
		$nombre = $this->input->post('nombre');
		$correo = $this->input->post('correo');
		$telefono  = $this->input->post('telefono');

		$rut1 = trim($rut);
		$nombre1 = trim($nombre);
		$correo1 = trim($correo);
		$telefono1 = trim($telefono);

		$mantenerDatos = ['rut' => $rut1,'nombre'=>$nombre1,'correo'=>$correo1,'telefono'=>$telefono1];

		$error1=$this->validate_form_empresa->ValidateLastNumberRut($rut1);
		$error2=$this->validate_form_empresa->ValidateNumberRut($rut1);
		$error3=$this->validate_form_empresa->ValidateLargeRut($rut1);
		$error4=$this->validate_form_empresa->ValidateLargeNombreContacto($nombre1);
		$error5=$this->validate_form_empresa->ValidateLargeCorreo($correo1);
		$error6=$this->validate_form_empresa->ValidateLargeTelefono($telefono1);

		$mensaje = ['1'=> $error1,'2'=>$error2,'3'=>$error3,'4'=>$error4,'5'=>$error5,'6'=>$error6];

		$codigoEmpresa = $this->EMPRESA_MODEL->GetRut($this->session->rut);
		$codigoEmpresa = $codigoEmpresa[0];

		
		if(empty($mensaje['1']) && empty($mensaje['2']) && empty($mensaje['3']) && empty($mensaje['4']) && empty($mensaje['5']) && empty($mensaje['6']))
		{
			$getCodigoEmpresa = $this->EMPRESA_MODEL->GetRut($this->session->rut);
			$getCodigoEmpresa = $getCodigoEmpresa[0];
			$GetRutContacot = $this->CONTACTO_MODEL->AllById($getCodigoEmpresa['CODIGO_EMPRESA']);
			//$GetRutContacot =$GetRutContacot[0];

			$existe=$this->CONTACTO_MODEL->getRut($rut1);

			if(count($existe) == 0)
			{
				$contacto=
				[
					"RUT_CONTACTO" => $rut1,
					"NOMBRE_CONTACTO" => $nombre1,
					"EMAIL_CONTACTO" => $correo1,
					"TELEFONO_CONTACTO" => $telefono1,
					"EMPRESA_CODIGO_EMPRESA" => $codigoEmpresa['CODIGO_EMPRESA']
				];

				$agrego = $this->CONTACTO_MODEL->Add($contacto);

				if($agrego)
				{
					$mensaje['7']="Contacto agregado correctamente";
				}
				$this->session->set_userdata('mantenerDatosContactos',$mantenerDatos);
				$this->session->set_userdata('mensaje_error_contacto',$mensaje);
				redirect('/CRUD_CONTACTOS/AddContactos','refresh');
			}else 
			{
				$mensaje['8'] ="El rut ingresado ya se encuentra registrado";
				$this->session->set_userdata('mantenerDatosContactos',$mantenerDatos);
				$this->session->set_userdata('mensaje_error_contacto',$mensaje);
				redirect('/CRUD_CONTACTOS/AddContactos','refresh');
			}
			
		}else 
		{
			$this->session->set_userdata('mensaje_error_contacto',$mensaje);
			$this->session->set_userdata('mantenerDatosContactos',$mantenerDatos);
			redirect('/CRUD_CONTACTOS/AddContactos','refresh');
		}
	}

	public function DeleteContacto($rut)
	{
		$this->load->model('CONTACTO_MODEL');

		$this->CONTACTO_MODEL->Delete($rut);

		redirect('/CRUD_CONTACTOS','refresh');
	}

	public function LoadContacto($rut)
	{
		$this->load->model('CONTACTO_MODEL');

		$data['Load_contacto']= $this->CONTACTO_MODEL->getRut($rut);
		$data['Load_contacto'] = $data['Load_contacto'][0];

		$this->load->view('UpdateContacto',$data);
	}

	public function UpdateContacto($rut)
	{
		$this->load->model('CONTACTO_MODEL');

		$this->load->library('VALIDATE_FORM_EMPRESA');

		$nombre  = $this->input->post('nombre');
		$correo = $this->input->post('correo');
		$telefono = $this->input->post('telefono');

		$nombre1 = trim($nombre);
		$correo1 = trim($correo);
		$telefono1 = trim($telefono);

		$error1=$this->validate_form_empresa->ValidateLargeNombreContacto($nombre1);
		$error2=$this->validate_form_empresa->ValidateLargeCorreo($correo1);
		$error3=$this->validate_form_empresa->ValidateLargeTelefono($telefono1);

		$mensaje = ['1'=> $error1,'2'=>$error2,'3'=>$error3];
		$rutContacto= $this->CONTACTO_MODEL->getRut($rut);
		$rutContacto=$rutContacto[0];

		if(empty($mensaje['1']) && empty($mensaje['2']) && empty($mensaje['3']))
		{
			$contacto =
			[
				'NOMBRE_CONTACTO' => $nombre1,
				'EMAIL_CONTACTO' => $correo1,
				'TELEFONO_CONTACTO' => $telefono1
			]; 

			$this->CONTACTO_MODEL->Update($rut,$contacto);
			redirect('/CRUD_CONTACTOS','refresh');
		}else 
		{
			$this->session->set_userdata('mensaje_error_contacto',$mensaje);
			redirect('/CRUD_CONTACTOS/LoadContacto/'.$rutContacto['RUT_CONTACTO'],'refresh');
		}
	}
}