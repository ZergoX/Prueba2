<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class analisis_muestras_model extends CI_Model {
    
    public function __construct()
	{
        parent::__construct();
        $this->load->database();                   
    } 

    public function Add($muestra)
    {
        $this->db->insert('analisis_muestras',$muestra);
    }

    public function GetByCodigo($codigo,$type)
    {
        $this->db->where('PARTICULAR_CODIGO_PARTICULAR',$codigo);
        $this->db->where('Tipo_analisis',$type);
        return $this->db->get('analisis_muestras')->result_array();
    }

    public function All()
    {
        return $this->db->get('analisis_muestras')->result_array();
    }
}