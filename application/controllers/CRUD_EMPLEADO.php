<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRUD_EMPLEADO extends CI_Controller {

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
        $this->load->view('RegistroEmpleado');
	}

    public function AddEmpleado()
    {
        $this->load->model('EMPLEADO_MODEL');

        $this->load->library('VALIDATE_FORM_EMPLEADO');

        $rut = $this->input->post('rut');
        $nombre = $this->input->post('nombre');
        $paterno = $this->input->post('paterno');
        $materno = $this->input->post('materno');
        $pass1 = hash('sha256',$this->input->post('pass1'));
        $pass2 = hash('sha256',$this->input->post('pass2')); 
        $rol = $this->input->post('rol');

        $rut1 = trim($rut);
        $nombre1 = trim($nombre);
        $paterno1 = trim($paterno);
        $materno1 = trim($materno);
        $pass11 = trim($pass1);
        $pass22 = trim($pass2);
        $rol1 = trim($rol);

        $mantenerDatos = ["rut" => $rut1, "nombre" => $nombre1, "paterno"=> $paterno1, "materno" => $materno1, "pass1" =>$pass11, "pass2" => $pass22, "rol"=> $rol1];
        
        $error1=$this->validate_form_empleado->ValidateLastNumberRut($rut1);
        $error2=$this->validate_form_empleado->ValidateNumberRut($rut1);        
        $error3=$this->validate_form_empleado->ValidateLargeRut($rut1);
        $error4=$this->validate_form_empleado->ValidateLargeNombre($nombre1);
        $error5=$this->validate_form_empleado->ValidateLargePaterno($paterno1);
        $error6=$this->validate_form_empleado->ValidateLargeMaterno($materno1);
        $error8=$this->validate_form_empleado->ValidateLargePass1($pass11);
        $error9=$this->validate_form_empleado->ValidateLargePass2($pass22);
        $error10=$this->validate_form_empleado->ValidateOptionRol($rol1);

        $mensaje =["1"=>$error1,"2"=>$error2,"3"=>$error3,"4"=>$error4,"5"=>$error5,"6"=>$error6,"8"=>$error8,"9"=>$error9,"10"=>$error10];

        if(empty($mensaje['1']) && empty($mensaje['2']) && empty($mensaje['3']) && empty($mensaje['4']) && empty($mensaje['5']) && empty($mensaje['6']) && empty($mensaje['8']) && empty($mensaje['9']) && empty($mensaje['10']))
        {
            if($pass11 == $pass22)
            {
                $existeRut = $this->EMPLEADO_MODEL->GetRut($rut1);

                if(count($existeRut) == 0)
                {
                    $empleado=
                    [   
                        "RUT_EMPLEADO" => $rut1,
                        "NOMBRE_EMPLEADO" => $nombre1,
                        "PASSWORD_EMPLEADO" => $pass22,
                        "ESTADO_EMPLEADO" => "ACTIVO",
                        "TIPO_USUARIO" => "TRABAJADOR",
                        "ROL" => $rol1,
                        "APELLIDO_PATERNO_EMPLEADO" => $paterno1,
                        "APELLIDO_MATERNO_EMPLEADO" => $materno1
                    ];
                    $exito = $this->EMPLEADO_MODEL->Add($empleado);

                    if($exito)
                    {
                        $mensaje['11'] = "Empleado registrado correctamente";        
                    }
                    $this->session->set_userdata("MensajeRegistroEmpleado",$mensaje);
                    $this->session->set_userdata("MantenerDatosEmpleado",$mantenerDatos);
                    redirect('/CRUD_EMPLEADO','refresh');
                }else 
                {
                    $mensaje['11'] = "El rut ingresado ya se encuentra registrado";    
                    $this->session->set_userdata("MensajeRegistroEmpleado",$mensaje);
                    $this->session->set_userdata("MantenerDatosEmpleado",$mantenerDatos);
                    redirect('/CRUD_EMPLEADO','refresh');
                }
            }else 
            {
                $mensaje['11'] = "Las contraseñas no coinciden";
                $this->session->set_userdata("MensajeRegistroEmpleado",$mensaje);
                $this->session->set_userdata("MantenerDatosEmpleado",$mantenerDatos);
                redirect('/CRUD_EMPLEADO','refresh');
            }
        }else 
        {
            $this->session->set_userdata("MensajeRegistroEmpleado",$mensaje);
            $this->session->set_userdata("MantenerDatosEmpleado",$mantenerDatos);
            redirect('/CRUD_EMPLEADO','refresh');
        }
    }

    public function ListEmpleados()
    {
        $this->load->model('EMPLEADO_MODEL');

        $data['listado_empleados'] = $this->EMPLEADO_MODEL->All();

        $this->load->view('ListadoEmpleados',$data);
    }
    
       public function PerfilReceptor(){

        $this->load->model('EMPLEADO_MODEL');
		
		$Empleado = $this->EMPLEADO_MODEL->GetRut($this->session->rut);
		//$codigoUsuario = $codigoUsuario[0];

		//$data['Perfil_empleado'] = $this->EMPLEADO_MODEL->GetAllPhone($codigoUsuario['CODIGO_PARTICULAR']);
        $data['Perfil_empleado'] = $Empleado;
        $data['Perfil_empleado']=$data['Perfil_empleado'][0];
        //var_dump($data);
	    $this->load->view('PerfilReceptor',$data);

       }

       public function LoadUpdateEmpleado($rut){

        $this->load->model('EMPLEADO_MODEL');

        $datos['cargarDatos'] = $this->EMPLEADO_MODEL->GetByRut($rut);

		$datos['cargarDatos'] = $datos['cargarDatos'][0];

		$this->load->view('UpdateEmpleado',$datos);
       }

    public function HabilitarEmpleado($rut)
    {
        $this->load->model('EMPLEADO_MODEL');

        $data['DatosEmpleado'] = $this->EMPLEADO_MODEL->GetRut($rut);
        $data['DatosEmpleado'] =$data['DatosEmpleado'][0];

        $empleado=
        [
            "RUT_EMPLEADO" => $data['DatosEmpleado']['RUT_EMPLEADO'],
            "NOMBRE_EMPLEADO" => $data['DatosEmpleado']['NOMBRE_EMPLEADO'],
            "PASSWORD_EMPLEADO" => $data['DatosEmpleado']['PASSWORD_EMPLEADO'],
            "ESTADO_EMPLEADO" => "ACTIVO",
            "ROL" =>$data['DatosEmpleado']['ROL'],
            "APELLIDO_PATERNO_EMPLEADO" =>$data['DatosEmpleado']['APELLIDO_PATERNO_EMPLEADO'],
            "APELLIDO_MATERNO_EMPLEADO" => $data['DatosEmpleado']['APELLIDO_MATERNO_EMPLEADO'],
            "TIPO_USUARIO" => "TRABAJADOR"
        ];

        $this->EMPLEADO_MODEL->Deshabilitar_Habilitar($rut,$empleado);

        redirect('CRUD_EMPLEADO/ListEmpleados',"refresh");
    }   
 
    public function DeshabilitarEmpleado($rut)
    {
        $this->load->model('EMPLEADO_MODEL');

        $data['DatosEmpleado'] = $this->EMPLEADO_MODEL->GetRut($rut);
        $data['DatosEmpleado'] =$data['DatosEmpleado'][0];

        $empleado=
        [
            "RUT_EMPLEADO" => $data['DatosEmpleado']['RUT_EMPLEADO'],
            "NOMBRE_EMPLEADO" => $data['DatosEmpleado']['NOMBRE_EMPLEADO'],
            "PASSWORD_EMPLEADO" => $data['DatosEmpleado']['PASSWORD_EMPLEADO'],
            "ESTADO_EMPLEADO" => "DESHABILITADO",
            "ROL" =>$data['DatosEmpleado']['ROL'],
            "APELLIDO_PATERNO_EMPLEADO" =>$data['DatosEmpleado']['APELLIDO_PATERNO_EMPLEADO'],
            "APELLIDO_MATERNO_EMPLEADO" => $data['DatosEmpleado']['APELLIDO_MATERNO_EMPLEADO'],
            "TIPO_USUARIO" => "TRABAJADOR"
        ];

        $this->EMPLEADO_MODEL->Deshabilitar_Habilitar($rut,$empleado);

        redirect('CRUD_EMPLEADO/ListEmpleados',"refresh");
    }   

    public function EditEmpleado($rut)
	{
		$this->load->model('EMPLEADO_MODEL');

		$this->load->library('VALIDATE_FORM_PARTICULAR');

		$nombre = $this->input->post('nombre');

		$nombre1 = trim($nombre);

		$error1 = $this->validate_form_particular->ValidateLargeNombre($nombre1,2,50);

        

		$mensaje =['1' => $error1];
        if(empty($mensaje['1']))
		{
			$empleado=
			[
				"NOMBRE_EMPLEADO" => $nombre1,

			];
            
			$this->EMPLEADO_MODEL->Update($rut,$empleado);
			redirect('/CRUD_EMPLEADO/PerfilReceptor','refresh');
		}else 
		{
			$this->session->set_userdata('mensaje_error_update_particular',$mensaje);
			redirect('/CRUD_EMPLEADO/LoadUpdateEmpleado/'.$rut,'refresh');
		}
    }

    public function CambiarPassReceptor()
	{
		$this->load->model('EMPLEADO_MODEL');

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
			$passOld= $this->EMPLEADO_MODEL->GetRut($this->session->rut);
			$passOld = $passOld[0];

			if($passOld['PASSWORD_EMPLEADO'] == $oldPass1)
			{
				if($newPass1 == $repeatPass1)
				{
					$cambiarPass=
					[
						"PASSWORD_EMPLEADO"=> $repeatPass1
					];

					$exito =$this->EMPLEADO_MODEL->Update($passOld['RUT_EMPLEADO'],$cambiarPass);

					if($exito)
					{
						$mensaje="Contraseña cambiada correctamente";
					}

					$this->session->set_userdata('mensaje_pass',$mensaje);
					redirect('/CRUD_EMPLEADO/PerfilReceptor','refresh');
				}else 
				{
					$mensaje="la nueva contraseña no coinciden";
					$this->session->set_userdata('mensaje_pass',$mensaje);
					redirect('/CRUD_EMPLEADO/PerfilReceptor','refresh');
				}
			}else 
			{
				$mensaje ="La contraseña actual ingresada no es correcta";
				$this->session->set_userdata('mensaje_pass',$mensaje);
				redirect('/CRUD_EMPLEADO/PerfilReceptor','refresh');
			}
		}else 
		{
			$this->session->set_userdata('mensaje_pass',$mensaje);
			redirect('/CRUD_EMPLEADO/PerfilReceptor','refresh');
		}
    }
    
    public function PerfilTecnicoAnalista()
    {
        $this->load->model('EMPLEADO_MODEL');

        $data['listado_tecnico'] = $this->EMPLEADO_MODEL->GetRut($this->session->rut);
        $data['listado_tecnico']= $data['listado_tecnico'][0];
        
        $this->load->view('PerfilTecnicoAnalista',$data);
    }

    public function UpdateTecnicoAnalista($id)
    {
        $this->load->model('EMPLEADO_MODEL');

        $data['listado_tecnico'] = $this->EMPLEADO_MODEL->GetRut($this->session->rut);
        $data['listado_tecnico']= $data['listado_tecnico'][0];
        
        $this->load->view('UpdateTecnicoAnalista',$data);
    }

    public function EditEmpleadoAnalista($rut)
	{
		$this->load->model('EMPLEADO_MODEL');

		$this->load->library('VALIDATE_FORM_PARTICULAR');

		$nombre = $this->input->post('nombre');
        $paterno =$this->input->post('paterno');
        $materno = $this->input->post('materno');

        $paterno1 = trim($paterno);
        $nombre1 = trim($nombre);
        $materno1 = trim($materno);

        $error1 = $this->validate_form_particular->ValidateLargeNombre($nombre1,2,50);
        $error2 = $this->validate_form_particular->ValidateLargepaterno($paterno1,2,50);
        $error3 = $this->validate_form_particular->ValidateLargematerno($materno,2,50);

        $mensaje =['1' => $error1, '2'=> $error2, '3'=>$error3];
        
        if(empty($mensaje['1']) && empty($mensaje['2']) && empty($mensaje['3']))
		{
			$empleado=
			[
                "NOMBRE_EMPLEADO" => $nombre1,
                "APELLIDO_MATERNO_EMPLEADO" => $materno1,
                "APELLIDO_PATERNO_EMPLEADO" => $paterno1

			];
            
			$this->EMPLEADO_MODEL->Update($rut,$empleado);
			redirect('/CRUD_EMPLEADO/PerfilTecnicoAnalista','refresh');
		}else 
		{
			$this->session->set_userdata('mensaje_error_update_particular',$mensaje);
			redirect('/CRUD_EMPLEADO/UpdateTecnicoAnalista/'.$rut,'refresh');
		}
    }

    public function CambiarPassTecnico()
	{
		$this->load->model('EMPLEADO_MODEL');

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
			$passOld= $this->EMPLEADO_MODEL->GetRut($this->session->rut);
			$passOld = $passOld[0];

			if($passOld['PASSWORD_EMPLEADO'] == $oldPass1)
			{
				if($newPass1 == $repeatPass1)
				{
					$cambiarPass=
					[
						"PASSWORD_EMPLEADO"=> $repeatPass1
					];

					$exito =$this->EMPLEADO_MODEL->Update($passOld['RUT_EMPLEADO'],$cambiarPass);

					if($exito)
					{
						$mensaje="Contraseña cambiada correctamente";
					}

					$this->session->set_userdata('mensaje_pass',$mensaje);
					redirect('/CRUD_EMPLEADO/PerfilTecnicoAnalista','refresh');
				}else 
				{
					$mensaje="la nueva contraseña no coinciden";
					$this->session->set_userdata('mensaje_pass',$mensaje);
					redirect('/CRUD_EMPLEADO/PerfilTecnicoAnalista','refresh');
				}
			}else 
			{
				$mensaje ="La contraseña actual ingresada no es correcta";
				$this->session->set_userdata('mensaje_pass',$mensaje);
				redirect('/CRUD_EMPLEADO/PerfilTecnicoAnalista','refresh');
			}
		}else 
		{
			$this->session->set_userdata('mensaje_pass',$mensaje);
			redirect('/CRUD_EMPLEADO/PerfilTecnicoAnalista','refresh');
		}
    }
}

