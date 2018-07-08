<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRUD_PARTICULAR extends CI_Controller {

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
		$this->load->view('RegistroParticular');
	}

	public function AddParticular()
	{
		$this->load->model('PARTICULAR_MODEL');
		$this->load->model('TELEFONO_MODEL');

		$this->load->library('VALIDATE_FORM_PARTICULAR');

		$rutCliente = $this->input->post('rutCliente');
		$nombre = $this->input->post('nombre');
		$direccion = $this->input->post('direccion');
		$correo = $this->input->post('correo');
		$pass1 = hash("sha256",$this->input->post('pass1'));
		$pass2 = hash("sha256",$this->input->post('pass2'));
		$telefono1 = $this->input->post('telefono1');
		$telefono2 = $this->input->post('telefono2');

		$rutCliente2 = trim($rutCliente);
		$nombre2 = trim($nombre);
		$direccion2 = trim($direccion);
		$correo2 = trim($correo);
		$pass11 = trim($pass1);
		$pass22 = trim($pass2);
		$telefono11 = trim($telefono1);
		$telefono22 = trim($telefono2);

		$MantenerDatos=["rut" => $rutCliente2,"nombre" => $nombre2, "direccion" => $direccion2, "correo" => $correo2, "telefono1" => $telefono11, "telefono2" => $telefono22];

		$error1=$this->validate_form_particular->ValidateLastNumberRut($rutCliente2);
		$error2=$this->validate_form_particular->ValidateNumberRut($rutCliente2);
		$error3=$this->validate_form_particular->ValidateLargeRut($rutCliente2);
		$error4=$this->validate_form_particular->ValidateLargeNombre($nombre2,2,50);
		$error5=$this->validate_form_particular->ValidateLargeDireccion($direccion2,5,100);	
		$error6=$this->validate_form_particular->ValidateLargeTelefono($telefono11);
		$error7 =$this->validate_form_particular->ValidateLargeTelefono2($telefono22);

		$mensaje = ["1"=>$error1, "2"=>$error2, "3"=>$error3,"4"=>$error4,"5"=>$error5,"6"=>$error6,"7"=>$error7];

		if(empty($mensaje["1"]) && empty($mensaje["2"]) && empty($mensaje["3"]) && empty($mensaje["4"]) && empty($mensaje["5"]) && empty($mensaje["6"]) && empty($mensaje["7"]))
		{
			if($pass11 == $pass22)
			{
				$existeRut = $this->PARTICULAR_MODEL->GetRut($rutCliente2);

				if(count($existeRut) == 0)
				{
					$particular =
					[
						"RUT_PARTICULAR" => $rutCliente2,
						"PASSWORD_PARTICULAR" => $pass22,
						"NOMBRE_PARTICULAR" => $nombre2,
						"DIRECCION_PARTICULAR" => $direccion2,
						"EMAIL_PARTICULAR" => $correo2,
						"ESTADO_PARTICULAR"=> "ACTIVO",
						"TIPO_USUARIO" => "CLIENTE_PARTICULAR"
					];
					$lastPartiular =$this->PARTICULAR_MODEL->Add($particular);
					
					$firstTelefono=
					[
						"NUMERO_TELEFONO" => $telefono11,
						"PARTICULAR_CODIGO_PARTICULAR" => $lastPartiular
					];

					$secondTelefono=
					[
						"NUMERO_TELEFONO" => $telefono22,
						"PARTICULAR_CODIGO_PARTICULAR" =>$lastPartiular
					];

					$info = $this->TELEFONO_MODEL->Add($firstTelefono);
					$this->TELEFONO_MODEL->Add($secondTelefono);

					if($info)
					{
						$mensaje["errores"]="Usuario registrado";
					}else 
					{
						$mensaje["errores"]="No se puedo registrar";
					}

					$this->session->set_userdata("mensaje_particular",$mensaje);
					$this->session->set_userdata("mantener_datos",$MantenerDatos);
					redirect("/CRUD_PARTICULAR","refresh");	

				}else 	
				{
					$mensaje["errores"]= "El rut ingresado ya se escuentra registrado";
					$this->session->set_userdata("mensaje_particular",$mensaje);
					$this->session->set_userdata("mantener_datos",$MantenerDatos);
					redirect("/CRUD_PARTICULAR","refresh");	
				}
			}else 
			{
				$mensaje["errores"]= "las contrasseñas no coinciden";
				$this->session->set_userdata("mensaje_particular",$mensaje);
				$this->session->set_userdata("mantener_datos",$MantenerDatos);
				redirect("/CRUD_PARTICULAR","refresh");
			}
		}else 
		{
			echo "estoy aqui";
			$this->session->set_userdata("mensaje_particular",$mensaje);
			$this->session->set_userdata("mantener_datos",$MantenerDatos);
			redirect("/CRUD_PARTICULAR","refresh");
		}
	}

	public function ListParticular()
	{
		$this->load->model('PARTICULAR_MODEL');

		$data['listado_Particulares'] = $this->PARTICULAR_MODEL->All();

		$this->load->view('ListadoParticulares',$data);
	}

	public function deshabilitarParticular($id)
	{
		$this->load->model('PARTICULAR_MODEL');

		$data['datos_particular'] = $this->PARTICULAR_MODEL->GetById($id);
		$data['datos_particular'] = $data['datos_particular'][0];

		$particular=
		[
			"CODIGO_PARTICULAR" => $data['datos_particular']['CODIGO_PARTICULAR'],
			"RUT_PARTICULAR" => $data['datos_particular']['RUT_PARTICULAR'],
			"NOMBRE_PARTICULAR" => $data['datos_particular']['NOMBRE_PARTICULAR'],
			"PASSWORD_PARTICULAR" => $data['datos_particular']['PASSWORD_PARTICULAR'],
			"DIRECCION_PARTICULAR" => $data['datos_particular']['DIRECCION_PARTICULAR'],
			"ESTADO_PARTICULAR" => "DESHABILITADO",
			"TIPO_USUARIO" => $data['datos_particular']['TIPO_USUARIO']
		];

		$this->PARTICULAR_MODEL->Deshabilitar_Habilitar($id,$particular);

		redirect('/CRUD_PARTICULAR/ListParticular','refresh');
	}

	public function HabilitarParticular($id)
	{
		$this->load->model('PARTICULAR_MODEL');

		$data['datos_particular'] = $this->PARTICULAR_MODEL->GetById($id);
		$data['datos_particular'] = $data['datos_particular'][0];

		$particular=
		[
			"CODIGO_PARTICULAR" => $data['datos_particular']['CODIGO_PARTICULAR'],
			"RUT_PARTICULAR" => $data['datos_particular']['RUT_PARTICULAR'],
			"NOMBRE_PARTICULAR" => $data['datos_particular']['NOMBRE_PARTICULAR'],
			"PASSWORD_PARTICULAR" => $data['datos_particular']['PASSWORD_PARTICULAR'],
			"DIRECCION_PARTICULAR" => $data['datos_particular']['DIRECCION_PARTICULAR'],
			"ESTADO_PARTICULAR" => "ACTIVO",
			"TIPO_USUARIO" => $data['datos_particular']['TIPO_USUARIO']
		];

		$this->PARTICULAR_MODEL->Deshabilitar_Habilitar($id,$particular);

		redirect('/CRUD_PARTICULAR/ListParticular','refresh');
	}

	public function loadPerfilParticular()
	{
		$this->load->model('PARTICULAR_MODEL');
		
		$codigoUsuario = $this->PARTICULAR_MODEL->GetRut($this->session->rut);
		$codigoUsuario = $codigoUsuario[0];
		
		$data['Perfil_particular'] = $this->PARTICULAR_MODEL->GetAllPhone($codigoUsuario['CODIGO_PARTICULAR']);
		$data['Perfil_particular'] = $data['Perfil_particular'][0];
		
		$this->load->view('PerfilParticular',$data);
	}

	public function LoadUpdateParticular($codigo)
	{
		$this->load->model('PARTICULAR_MODEL');
		$this->load->model('TELEFONO_MODEL');

		$datos['cargarDatos'] = $this->PARTICULAR_MODEL->GetAllPhone($codigo);
		$datos['cargarNumeros'] = $this->TELEFONO_MODEL->AllById($codigo);

		$datos['cargarDatos'] = $datos['cargarDatos'][0];

		$this->load->view('UpdateParticulas',$datos);
	}

	public function EditParticular($codigo)
	{
		$this->load->model('PARTICULAR_MODEL');
		$this->load->model('TELEFONO_MODEL');

		$this->load->library('VALIDATE_FORM_PARTICULAR');

		$nombre = $this->input->post('nombre');
		$direccion = $this->input->post('direccion');
		$correo = $this->input->post('correo');
		$telefono = $this->input->post('telefono');

		$nombre1 = trim($nombre);
		$direccion1 = trim($direccion);
		$correo1 = trim($correo);
		$telefono1 = trim($telefono);

		$error1 = $this->validate_form_particular->ValidateLargeNombre($nombre1,2,50);
		$error2 = $this->validate_form_particular->ValidateLargeDireccion($direccion1,2,50);
		$error3 = $this->validate_form_particular->ValidateLargeTelefono($telefono1);

		$mensaje =['1' => $error1, '2' => $error2, '3'=>$error3];

		if(empty($mensaje['1']) && empty($mensaje['2']) && empty($mensaje['3']))
		{
			$particular=
			[
				"NOMBRE_PARTICULAR" => $nombre1,
				"DIRECCION_PARTICULAR" => $direccion1,
				"EMAIL_PARTICULAR" => $correo1
			];

			$telef=
			[
				"NUMERO_TELEFONO"=> $telefono1,
				"PARTICULAR_CODIGO_PARTICULAR" => $codigo
			];

			$this->TELEFONO_MODEL->Update($codigo,$telef);
			$this->PARTICULAR_MODEL->Update($codigo,$particular);
			redirect('/CRUD_PARTICULAR/loadPerfilParticular','refresh');
		}else 
		{
			$this->session->set_userdata('mensaje_error_update_particular',$mensaje);
			redirect('/CRUD_PARTICULAR/LoadUpdateParticular/'.$codigo,'refresh');
		}
	}

	public function deshabilitarCuenta($id)
	{
		$this->load->model('PARTICULAR_MODEL');

		$data['datos_particular'] = $this->PARTICULAR_MODEL->GetById($id);
		$data['datos_particular'] = $data['datos_particular'][0];
		$mensaje="";

		$particular=
		[
			"CODIGO_PARTICULAR" => $data['datos_particular']['CODIGO_PARTICULAR'],
			"RUT_PARTICULAR" => $data['datos_particular']['RUT_PARTICULAR'],
			"NOMBRE_PARTICULAR" => $data['datos_particular']['NOMBRE_PARTICULAR'],
			"PASSWORD_PARTICULAR" => $data['datos_particular']['PASSWORD_PARTICULAR'],
			"DIRECCION_PARTICULAR" => $data['datos_particular']['DIRECCION_PARTICULAR'],
			"ESTADO_PARTICULAR" => "DESHABILITADO",
			"TIPO_USUARIO" => $data['datos_particular']['TIPO_USUARIO']
		];

		$dato=$this->PARTICULAR_MODEL->Deshabilitar_Habilitar($id,$particular);
		redirect('/Welcome/Logout','refresh');
	}

	public function CambiarPass()
	{
		$this->load->model('PARTICULAR_MODEL');

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
			$passOld= $this->PARTICULAR_MODEL->GetRut($this->session->rut);
			$passOld = $passOld[0];

			if($passOld['PASSWORD_PARTICULAR'] == $oldPass1)
			{
				if($newPass1 == $repeatPass1)
				{
					$cambiarPass=
					[
						"PASSWORD_PARTICULAR"=> $repeatPass1
					];

					$exito =$this->PARTICULAR_MODEL->Update($passOld['CODIGO_PARTICULAR'],$cambiarPass);

					if($exito)
					{
						$mensaje="Contraseña cambiada correctamente";
					}

					$this->session->set_userdata('mensaje_pass',$mensaje);
					redirect('/CRUD_PARTICULAR/loadPerfilParticular','refresh');
				}else 
				{
					$mensaje="la nueva contraseña no coinciden";
					$this->session->set_userdata('mensaje_pass',$mensaje);
					redirect('/CRUD_PARTICULAR/loadPerfilParticular','refresh');
				}
			}else 
			{
				$mensaje ="La contraseña actual ingresada no es correcta";
				$this->session->set_userdata('mensaje_pass',$mensaje);
				redirect('/CRUD_PARTICULAR/loadPerfilParticular','refresh');
			}
		}else 
		{
			$this->session->set_userdata('mensaje_pass',$mensaje);
			redirect('/CRUD_PARTICULAR/loadPerfilParticular','refresh');
		}
	}
}
