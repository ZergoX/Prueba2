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
						"TIPO_USUARIO" => "CLIENTE"
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
}
