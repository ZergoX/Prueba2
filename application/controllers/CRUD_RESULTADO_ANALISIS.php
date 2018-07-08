<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRUD_RESULTADO_ANALISIS extends CI_Controller {

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
        $this->load->model('ANALISIS_MUESTRAS_MODEL');


		$data['listado_analisis_procesar'] = $this->ANALISIS_MUESTRAS_MODEL->AllAnalisisParticular('PROCESAR');
		
        $this->load->view('ListadoAnalisisProcesar',$data);
	}
	
	public function CapturarDatoAnalisis($codigo)
	{
		$this->load->model('RESULTADO_ANALISIS_MODEL');

		$DatoAnalisis['resultado']=$this->RESULTADO_ANALISIS_MODEL->GetByCodigo($codigo);
		$DatoAnalisis['resultado']= $DatoAnalisis['resultado'][0];
		$this->session->set_userdata('codigo_analisis',$DatoAnalisis['resultado']['ID_ANALISIS_MUESTRAS']);
		$this->load->view('RegistroResultadoAnalisis',$DatoAnalisis);
	}

	public function AddResultado()
	{
		$this->load->model('RESULTADO_ANALISIS_MODEL');
		$this->load->model('ANALISIS_MUESTRAS_MODEL');

		$this->load->library('VALIDATE_FORM_RESULTADO');

		$ppm = $this->input->post('ppm');

		$error1 = $this->validate_form_resultado->ValidateLargePMM($ppm);
		
		$fecha = date('Y-m-d');

		$mensaje=['1'=>$error1];

		$nombre =$this->ANALISIS_MUESTRAS_MODEL->getNameByCodigo($this->session->codigo_analisis);
		$nombre = $nombre[0];

		if(empty($mensaje['1']))
		{
			$resultado=
			[
				"ID_TIPO_ANALISIS" => $nombre['Tipo_analisis'],
				"ID_ANALISIS_MUESTRAS" =>$this->session->codigo_analisis,
				"FECHA_REGISTRO" => $fecha,
				"PPM" => $ppm,
				"RUT_EMPLEADO_ANALISTA"=> $this->session->rut
			];

			$analisis=
			[
				"ID_ANALISIS_MUESTRAS" => $this->session->codigo_analisis,
				"ESTADO_MUESTRA" => "FINALIZADA"
			];

			$exito =$this->RESULTADO_ANALISIS_MODEL->Add($resultado);
			$this->ANALISIS_MUESTRAS_MODEL->update($this->session->codigo_analisis,$analisis);

			if($exito)
			{
				$mensaje="Registro Guardado correctamente";
			}

			$this->session->set_userdata('mensaje_error_resultado',$mensaje);
			redirect('/CRUD_RESULTADO_ANALISIS/CapturarDatoAnalisis/'.$this->session->codigo_analisis,'refresh');
		}else 
		{
			$this->session->set_userdata('mensaje_error_resultado',$mensaje);
			redirect('/CRUD_RESULTADO_ANALISIS/CapturarDatoAnalisis/'.$this->session->codigo_analisis,'refresh');
			
		}
	}

	public function loadAllReusultadoAnalisis()
	{
		$this->load->model('RESULTADO_ANALISIS_MODEL');

		$data['listaAnalisisResultado'] = $this->RESULTADO_ANALISIS_MODEL->All('FINALIZADA',$this->session->rut);
		$this->load->view('ListadoTodoResultado',$data);
	}
}
