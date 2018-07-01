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
						"TIPO_USUARIO" => "CLIENTE"
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
}
