<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRUD_EMPRESA extends CI_Controller {

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
		$this->load->view('RegistroEmpresa');
	}

	public function AddEmpresa()
	{
		$this->load->model('EMPRESA_MODEL');
		$this->load->model('CONTACTO_MODEL');

		$this->load->library('VALIDATE_FORM_EMPRESA');

		$rutEmpresa = $this->input->post('rutEmpresa');
		$nombre = $this->input->post('nombre');
		$direccion = $this->input->post('direccion');
		$pass1 = hash("sha256",$this->input->post('pass1'));
		$pass2 = hash("sha256",$this->input->post('pass2'));
		
        $rutContacto = $this->input->post('rutContacto');
        $correo = $this->input->post('correo');
        $telefono = $this->input->post('telefono1');
        $nombrecontacto = $this->input->post('nombreContacto');
		
		$rutEmpresa1 = trim($rutEmpresa);
		$nombre1= trim($nombre);
		$direccion1 = trim($direccion);
		$pass11 = trim($pass1);
		$pass22 = trim($pass2);
		
        $rutContacto1 = trim($rutContacto);
        $correo1 = trim($correo);
        $telefono1 = trim($telefono);
		$nombrecontacto1 = trim($nombre);

		$mantenerDatosEmpresa = ["rutEmpresa" => $rutEmpresa1, "nombreEmpresa"=>$nombre1, "direccionEmpresa" => $direccion1, "RutContacto" => $rutContacto1,"CorreoContacto" => $correo1,"telefonoContacto"=> $telefono1,"nombreContacto"=>$nombrecontacto1];

		$error1=$this->validate_form_empresa->ValidateLastNumberRut($rutEmpresa1);
		$error2=$this->validate_form_empresa->ValidateLargeRut($rutEmpresa1);
		$error3=$this->validate_form_empresa->ValidateNumberRut($rutEmpresa1);
		$error4=$this->validate_form_empresa->ValidateLargeNombre($nombre1);
		$error5=$this->validate_form_empresa->ValidateLargeDireccion($direccion1);
		$error6=$this->validate_form_empresa->ValidateLastNumberRutContacto($rutContacto1);
        $error7=$this->validate_form_empresa->ValidateNumberRutContacto($rutContacto1);
        $error8=$this->validate_form_empresa->ValidateLargeRutContacto($rutContacto1);
        $error9=$this->validate_form_empresa->ValidateLargeCorreo($correo1);
        $error10=$this->validate_form_empresa->ValidateLargeTelefono($telefono1);
		$error11=$this->validate_form_empresa->ValidateLargeNombreContacto($nombrecontacto1);
		
		$mensaje =["1"=>$error1,"2"=>$error2, "3"=>$error3, "4"=>$error4,"5"=>$error5,"6"=>$error6,"7"=>$error7,"8"=>$error8,"9"=>$error9,"10"=>$error10,"11"=>$error11];

		if(empty($mensaje["1"]) && empty($mensaje["2"]) && empty($mensaje["3"]) && empty($mensaje["4"]) && empty($mensaje["5"]) && empty($mensaje["6"]) && empty($mensaje["7"]) && empty($mensaje["8"]) && empty($mensaje["9"]) && empty($mensaje["10"]) && empty($mensaje["11"]))
		{
			if($pass11 == $pass22)
			{
				$existeRut=$this->EMPRESA_MODEL->GetRut($rutEmpresa1);

				if(count($existeRut) == 0)
				{
					$empresa=
					[
						"RUT_EMPRESA" => $rutEmpresa1,
						"NOMBRE_EMPRESA" => $nombre1,
						"PASSWORD_EMPRESA" => $pass22,
						"DIRECCION_EMPRESA" => $direccion1,
						"ESTADO_EMPRESA" => "ACTIVO",
						"TIPO_USUARIO" => "CLIENTE_EMPRESA"
					];
					$lastEmpresa=$this->EMPRESA_MODEL->Add($empresa);

					$contacto=
					[
						"RUT_CONTACTO" => $rutContacto1,
						"NOMBRE_CONTACTO" => $nombre1,
						"EMAIL_CONTACTO" => $correo1,
						"TELEFONO_CONTACTO" => 	$telefono1,
						"EMPRESA_CODIGO_EMPRESA" => $lastEmpresa
					];
					
					$dato= $this->CONTACTO_MODEL->Add($contacto);

					if($dato)
					{
						$mensaje["errores"] = "Registro exitoso";	
					}else 
					{
						$mensaje["errores"] = "No se pudo generar su registro";
					}

					$this->session->set_userdata("mensajes_Empresa",$mensaje);
					$this->session->set_userdata("datosEmpresa",$mantenerDatosEmpresa);
					redirect("/CRUD_EMPRESA","refresh");	
				}else 
				{
					$mensaje["errores"] = "El rut igresado ya posee una cuenta";
					$this->session->set_userdata("mensajes_Empresa",$mensaje);
					$this->session->set_userdata("datosEmpresa",$mantenerDatosEmpresa);
					redirect("/CRUD_EMPRESA","refresh");	
				}
			}else 
			{
				$mensaje["errores"] = "Las contraseñas no coinciden";
				$this->session->set_userdata("mensajes_Empresa",$mensaje);
				$this->session->set_userdata("datosEmpresa",$mantenerDatosEmpresa);
				redirect("/CRUD_EMPRESA","refresh");
			}
		}else 
		{
			$this->session->set_userdata("mensajes_Empresa",$mensaje);
			$this->session->set_userdata("datosEmpresa",$mantenerDatosEmpresa);
			redirect("/CRUD_EMPRESA","refresh");
		}	
	}

	public function ListEmpresa()
	{
		$this->load->model('EMPRESA_MODEL');

		$data['listadoEmpresa'] = $this->EMPRESA_MODEL->All();

		$this->load->view('ListadoEmpresa',$data);
	}

	public function deshabilitarEmpresa($id)
	{
		$this->load->model('EMPRESA_MODEL');

		$data['datos_empresa'] = $this->EMPRESA_MODEL->GetById($id);
		$data['datos_empresa'] = $data['datos_empresa'][0];

		$empresa=
		[
			"CODIGO_EMPRESA" => $data['datos_empresa']['CODIGO_EMPRESA'],
			"RUT_EMPRESA" => $data['datos_empresa']['RUT_EMPRESA'],
			"NOMBRE_EMPRESA" => $data['datos_empresa']['NOMBRE_EMPRESA'],
			"PASSWORD_EMPRESA" => $data['datos_empresa']['PASSWORD_EMPRESA'],
			"DIRECCION_EMPRESA" => $data['datos_empresa']['DIRECCION_EMPRESA'],
			"ESTADO_EMPRESA" => "DESHABILITADO",
			"TIPO_USUARIO" => $data['datos_empresa']['TIPO_USUARIO']
		];

		$this->EMPRESA_MODEL->Deshabilitar_Habilitar($id,$empresa);

		redirect('/CRUD_EMPRESA/ListEmpresa','refresh');
	}

	public function HabilitarEmpresa($id)
	{
		$this->load->model('EMPRESA_MODEL');

		$data['datos_empresa'] = $this->EMPRESA_MODEL->GetById($id);
		$data['datos_empresa'] = $data['datos_empresa'][0];

		$empresa=
		[
			"CODIGO_EMPRESA" => $data['datos_empresa']['CODIGO_EMPRESA'],
			"RUT_EMPRESA" => $data['datos_empresa']['RUT_EMPRESA'],
			"NOMBRE_EMPRESA" => $data['datos_empresa']['NOMBRE_EMPRESA'],
			"PASSWORD_EMPRESA" => $data['datos_empresa']['PASSWORD_EMPRESA'],
			"DIRECCION_EMPRESA" => $data['datos_empresa']['DIRECCION_EMPRESA'],
			"ESTADO_EMPRESA" => "ACTIVO",
			"TIPO_USUARIO" => $data['datos_empresa']['TIPO_USUARIO']
		];

		$this->EMPRESA_MODEL->Deshabilitar_Habilitar($id,$empresa);

		redirect('/CRUD_EMPRESA/ListEmpresa','refresh');
	}

	public function LoadDatos()
	{
		$this->load->model('EMPRESA_MODEL');
		
		$data['CarpturarEmpresa'] = $this->EMPRESA_MODEL->GetRut($this->session->rut);
		$data['CarpturarEmpresa'] = $data['CarpturarEmpresa'][0];
		$this->load->view('PerfilEmpresa',$data);
	}

	public function LoadEmpresaUpdate($rut)
	{
		$this->load->model('EMPRESA_MODEL');

		$data['CarpturarEmpresa'] =$this->EMPRESA_MODEL->GetRut($this->session->rut);
		$data['CarpturarEmpresa'] = $data['CarpturarEmpresa'][0];
		$this->load->view('UpdateEmpresa',$data);
	}

	public function UpdateEmpresa($codigo)
	{
		$this->load->model('EMPRESA_MODEL');

		$this->load->library('VALIDATE_FORM_EMPRESA');

		$nombre = $this->input->post('nombre');
		$direccion = $this->input->post('direccion');

		$nombre1 = trim($nombre);
		$direccion1 = trim($direccion);
		
		$error1 =$this->validate_form_empresa->ValidateLargeNombre($nombre1);
		$error2 =$this->validate_form_empresa->ValidateLargeDireccion($direccion1);

		$mensaje = ['1'=>$error1,'2'=>$error2];

		$rut = $this->EMPRESA_MODEL->GetById($codigo);
		$rut=$rut[0];
		
		if(empty($mensaje['1']) && empty($mensaje['2']))
		{
			$empresa=
			[
				"NOMBRE_EMPRESA" => $nombre1,
				"DIRECCION_EMPRESA" => $direccion1
			];

			$this->EMPRESA_MODEL->Update($codigo,$empresa);
			
			redirect('/CRUD_EMPRESA/LoadDatos','refresh');
		}else 
		{			
			redirect('/CRUD_EMPRESA/LoadEmpresaUpdate/'. $rut['CODIGO_EMPRESA'],'refresh');
		}
	}

	public function deshabilitarCuenta($id)
	{
		$this->load->model('EMPRESA_MODEL');

		$data['datos_particular'] = $this->EMPRESA_MODEL->GetById($id);
		$data['datos_particular'] = $data['datos_particular'][0];
		$mensaje="";

		$empresa=
		[
			"CODIGO_EMPRESA" => $data['datos_particular']['CODIGO_EMPRESA'],
			"RUT_EMPRESA" => $data['datos_particular']['RUT_EMPRESA'],
			"NOMBRE_EMPRESA" => $data['datos_particular']['NOMBRE_EMPRESA'],
			"PASSWORD_EMPRESA" => $data['datos_particular']['PASSWORD_EMPRESA'],
			"DIRECCION_EMPRESA" => $data['datos_particular']['DIRECCION_EMPRESA'],
			"ESTADO_EMPRESA" => "DESHABILITADO",
			"TIPO_USUARIO" => $data['datos_particular']['TIPO_USUARIO']
		];

		$dato=$this->EMPRESA_MODEL->Deshabilitar_Habilitar($id,$empresa);
		redirect('/Welcome/Logout','refresh');
	}

	public function CambiarPass()
	{
		$this->load->model('EMPRESA_MODEL');

		$this->load->library('VALIDATE_LOGIN');

		$oldPass = hash('sha256',$this->input->post('oldpass'));
		$newPass = hash('sha256',$this->input->post('newPass'));
		$repeatPass = hash('sha256',$this->input->post('repeatNewPass'));

		$oldPass1 = trim($oldPass);
		$newPass1 = trim($newPass);
		$repeatPass1 = trim($repeatPass);

		$error1=$this->validate_login->ValidateLargepass($oldPass1);
		$error2=$this->validate_login->ValidateLargepass($newPass1);
		$error3=$this->validate_login->ValidateLargepass($repeatPass1);

		$mensaje=['1' => $error1,'2'=>$error2,'3'=>$error3];

		if(empty($mensaje['1']) && empty($error2['1']) && empty($error3['3']))
		{
			$passOld= $this->EMPRESA_MODEL->GetRut($this->session->rut);
			$passOld = $passOld[0];

			if($passOld['PASSWORD_EMPRESA'] == $oldPass1)
			{
				if($newPass1 == $repeatPass1)
				{
					$cambiarPass=
					[
						"PASSWORD_EMPRESA"=> $repeatPass1
					];

					$exito =$this->EMPRESA_MODEL->Update($passOld['CODIGO_EMPRESA'],$cambiarPass);

					if($exito)
					{
						$mensaje="Contraseña cambiada correctamente";
					}

					$this->session->set_userdata('mensaje_pass',$mensaje);
					redirect('/CRUD_EMPRESA/LoadDatos','refresh');
				}else 
				{
					$mensaje="la nueva contraseña no coinciden";
					$this->session->set_userdata('mensaje_pass',$mensaje);
					redirect('/CRUD_EMPRESA/LoadDatos','refresh');
				}
			}else 
			{
				$mensaje ="La contraseña actual ingresada no es correcta";
				$this->session->set_userdata('mensaje_pass',$mensaje);
				redirect('/CRUD_EMPRESA/LoadDatos','refresh');
			}
		}else 
		{
			$this->session->set_userdata('mensaje_pass',$mensaje);
			redirect('/CRUD_EMPRESA/LoadDatos','refresh');
		}
	}
}
