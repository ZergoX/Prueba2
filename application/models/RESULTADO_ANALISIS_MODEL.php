<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class resultado_analisis_model extends CI_Model {
    
    public function __construct()
	{
        parent::__construct();
        $this->load->database();                   
    } 

    public function Add($resultado)
    {
        return $this->db->insert('resultado_analisis',$resultado);
    }

    public function GetByCodigo($codigo)
    {
        $this->db->where("ID_ANALISIS_MUESTRAS",$codigo);
        return $this->db->get('analisis_muestras')->result_array();
    }

    public function All($tipo,$rut)
    {   
        $this->db->select('a.ESTADO_MUESTRA, a.ID_ANALISIS_MUESTRAS, re.FECHA_REGISTRO,re.PPM,re.RUT_EMPLEADO_ANALISTA')->
        from('analisis_muestras a')->
        join('resultado_analisis re','a.ID_ANALISIS_MUESTRAS = re.ID_ANALISIS_MUESTRAS')->
        where('a.ESTADO_MUESTRA',$tipo)->
        where('re.RUT_EMPLEADO_ANALISTA',$rut)->
        group_by('a.ID_ANALISIS_MUESTRAS');
        return $this->db->get('resultado_analisis')->result_array();
    }


}