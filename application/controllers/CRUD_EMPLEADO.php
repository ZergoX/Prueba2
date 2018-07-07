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
            "ESTADO_EMPLEADO" => "ACTIVO",
            "ROL" =>$data['DatosEmpleado']['ROL'],
            "APELLIDO_PATERNO_EMPLEADO" =>$data['DatosEmpleado']['APELLIDO_PATERNO_EMPLEADO'],
            "APELLIDO_MATERNO_EMPLEADO" => $data['DatosEmpleado']['APELLIDO_MATERNO_EMPLEADO'],
            "TIPO_USUARIO" => "TRABAJADOR"
        ];

        $this->EMPLEADO_MODEL->Deshabilitar_Habilitar($rut,$empleado);

        redirect('CRUD_EMPLEADO/ListEmpleados',"refresh");
    }   
}

