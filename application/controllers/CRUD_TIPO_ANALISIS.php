<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRUD_TIPO_ANALISIS extends CI_Controller {

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
        $this->load->model('TIPO_ANALISIS_MODEL');

        $data['listado_analisis']= $this->TIPO_ANALISIS_MODEL->All();

		$this->load->view('ListadoAnalisis',$data);
    }

    public function DeleteAnalisis($id)
    {
        $this->load->model('TIPO_ANALISIS_MODEL');

        $this->TIPO_ANALISIS_MODEL->Delete($id);

        redirect("/CRUD_TIPO_ANALISIS","refresh");
    }

    public function CapturarDatos($id)
    {
        $this->load->model('TIPO_ANALISIS_MODEL');

        $data['datos_analisis'] =$this->TIPO_ANALISIS_MODEL->GetById($id);
        $data['datos_analisis'] = $data['datos_analisis'][0];
        $this->load->view('UpdateAnalisis',$data);
    }

    public function UpdateAnalisis($id)
    {
        $this->load->model('TIPO_ANALISIS_MODEL');

        $nombre = $this->input->post('nombre');

        $nombre1= trim($nombre);

        $nombre2 = strlen($nombre1);

        if($nombre2>0 && $nombre2<50)
        {
            $analisis=
            [
                "NOMBRE_TIPO_ANALISIS" => $nombre1
            ];

            $this->TIPO_ANALISIS_MODEL->Update($id,$analisis);
            redirect("/CRUD_TIPO_ANALISIS",'refresh');
        }else 
        {
            $mensaje="El nombre del analisis no puede estar vacio";
            $this->session->set_userdata("mensaje_actualizar_analisis",$mensaje);
            redirect('/CRUD_TIPO_ANALISIS/CapturarDatos/'. $id,'refresh');
        }
    }

    public function AddAnalisis()
    {
        $this->load->model('TIPO_ANALISIS_MODEL');    

        $nombre= $this->input->post('analisis');
        $nombre1 = trim($nombre);

        $nombre2 = strlen($nombre1);
        $mensaje="";

        if($nombre2>0 && $nombre2<50)
        {
            $analisis=
            [
                "NOMBRE_TIPO_ANALISIS" => $nombre1
            ];
            
            $agregoAnalisis = $this->TIPO_ANALISIS_MODEL->Add($analisis);

            if($agregoAnalisis)
            {
                $mensaje="Analisis registrado correctamente ";
            }else 
            {
                $mensaje="No se puedo guardar el analisis ingresado";
            }

            $this->session->set_userdata("mensaje_agregar_analisis",$mensaje);
            redirect('/Welcome/AccessAdmin/','refresh');
        }else 
        {
            $mensaje="El nombre del analisis no puede estar vacio";
            $this->session->set_userdata("mensaje_agregar_analisis",$mensaje);
            redirect('/Welcome/AccessAdmin/','refresh');
        }
    }
}