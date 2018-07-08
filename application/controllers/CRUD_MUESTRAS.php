<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRUD_MUESTRAS extends CI_Controller {

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
		$this->load->model('PARTICULAR_MODEL');
		$this->load->model('TIPO_ANALISIS_MODEL');

		$codigo = $this->input->post('buscar');

		$codigo1 = trim($codigo);

		$encontroParticular['datos_Particular']=$this->PARTICULAR_MODEL->GetById($codigo1);
		$encontroParticular['listado_analisis'] = $this->TIPO_ANALISIS_MODEL->All();

		if(count($encontroParticular))
		{
			$this->session->set_userdata('codigo_particular',$codigo1);
			$this->load->view('RegistroMuestrasParticular',$encontroParticular);
		}else 
		{
			$mensaje ="No se encontro el usuario buscado";
			$this->session->set_userdata('mensaje_busqueda',$mensaje);
			redirect('/CRUD_MUESTRAS','refresh');
		}
	}

	public function AddMuestras()
	{
		$this->load->model('ANALISIS_MUESTRAS_MODEL');

		$this->load->library('VALIDATE_FORM_MUESTRAS');

		$fecha = $this->input->post('fecha');
		$temperatura = $this->input->post('temperatura');
		$cantidad = $this->input->post('cantidad');
		$analisis = $this->input->post('analisis');

		$mantenerDatos = ['fecha' => $fecha, 'temperatura' =>$temperatura, 'cantidad'=> $cantidad,'analisis'=>$analisis];

		$error1 = $this->validate_form_muestras->ValidateLargeTemperatura($temperatura);
		$error2 = $this->validate_form_muestras->ValidateLargeCantidadMuestras($cantidad);
		$error3 = $this->validate_form_muestras->ValidateLargeAnalisis($analisis);

		$mensaje = ['1'=> $error1,'2'=>$error2,'3'=>$error3];

		if($this->session->codigo_particular != null)
		{	
			if(empty($mensaje['1']) && empty($mensaje['2']) && empty($mensaje['3']))
			{
				$existe =$this->ANALISIS_MUESTRAS_MODEL->GetByCodigo($this->session->codigo_particular,$analisis);
				
				if(count($existe) == 0)
				{
					$muestra=
					[
						"FECHA_RECEPCION" =>$fecha,
						"TEMPERATURA_MUESTRA" => $temperatura,
						"CANTIDAD_MUESTRA" => $cantidad,
						"PARTICULAR_CODIGO_PARTICULAR" => $this->session->codigo_particular,
						"EMPRESA_CODIGO_EMPRESA" => null,
						"RUT_EMPLEADO_RECIBE" => $this->session->rut,
						"tipo_analisis" => $analisis,
						"ESTADO_MUESTRA"=>"PROCESAR"
					];

					$exito = $this->ANALISIS_MUESTRAS_MODEL->Add($muestra);

					if($exito)
					{
						$mensaje['4'] ="Muestra guardada exitosamente";
					}
					$this->session->set_userdata('mensaje_erro_muestra',$mensaje);
					$this->session->set_userdata('mantenerMuestra',$mantenerDatos);
					redirect('/CRUD_MUESTRAS','refresh');
				}else 
				{
					$mensaje['5'] = "El tipo de analisis ya se encuentra registrado para ese cliente";
					$this->session->set_userdata('mensaje_erro_muestra',$mensaje);
					$this->session->set_userdata('mantenerMuestra',$mantenerDatos);
					redirect('/CRUD_MUESTRAS','refresh');
				}
			}else 
			{
				$this->session->set_userdata('mensaje_erro_muestra',$mensaje);
				$this->session->set_userdata('mantenerMuestra',$mantenerDatos);
				redirect('/CRUD_MUESTRAS','refresh');
			}
		}else 
		{
			$mensaje['6'] = "Debe ingresar el codigo del cliente antes de agregar un analisis";
			$this->session->set_userdata('mensaje_erro_muestra',$mensaje);
			$this->session->set_userdata('mantenerMuestra',$mantenerDatos);
			redirect('/CRUD_MUESTRAS','refresh');
		}	
	}

	public function AllMuestras()
	{
		$this->load->model('ANALISIS_MUESTRAS_MODEL');

		$data['listado_muestras'] = $this->ANALISIS_MUESTRAS_MODEL->All($this->session->rut);

		$this->load->view('ListadoMuestrasParticular',$data);
	}
}