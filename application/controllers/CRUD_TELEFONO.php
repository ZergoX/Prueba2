<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRUD_TELEFONO extends CI_Controller {

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
		$this->load->model('TELEFONO_MODEL');
		$this->load->model('PARTICULAR_MODEL');

		$obtenerParticular = $this->PARTICULAR_MODEL->GetRut($this->session->rut);
		$obtenerParticular = $obtenerParticular[0];

		$data['listado_telefonos'] = $this->TELEFONO_MODEL->AllById($obtenerParticular['CODIGO_PARTICULAR']);

		$this->load->view('ListadoTelefonos',$data);
    }

    public function Add()
    {
        $this->load->Model('TELEFONO_MODEL');
        $this->load->model('PARTICULAR_MODEL');

        $this->load->library('VALIDATE_FORM_EMPRESA');

        $telefono = $this->input->post('telefono');

        $mensaje =$this->validate_form_empresa->ValidateLargeTelefono($telefono);

        $dato =$this->PARTICULAR_MODEL->GetRut($this->session->rut);
        $dato = $dato[0];

        if(empty($mensaje))
        {
            $telefono=
            [
                "NUMERO_TELEFONO" => $telefono,
                "PARTICULAR_CODIGO_PARTICULAR" => $dato['CODIGO_PARTICULAR']
            ];
            $this->TELEFONO_MODEL->Add($dato['CODIGO_PARTICULAR'],$telefono);
            redirect('CRUD_TELEFONO',"refresh");                
        }else 
        {
            echo "ndigitos superados";
            $this->session->set_userdata("mensaje_erro_add_telefono",$mensaje);
            redirect('CRUD_TELEFONO',"refresh");
        }
    }

    public function DeleteTelefono($id)
    {
        $this->load->model("TELEFONO_MODEL");

        $this->TELEFONO_MODEL->Delete($id);

        redirect('CRUD_TELEFONO','refresh');
    }
}
