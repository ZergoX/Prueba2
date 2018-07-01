<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tipo_analisis_model extends CI_Model 
{
    
    public function __construct()
	{
        parent::__construct();
        $this->load->database();                   
    } 

    public function All()
    {
        return $this->db->get('tipo_analisis')->result_array();
    }

    public function Delete($id)
    {
        $this->db->where('ID_TIPO_ANALISIS',$id);
        return $this->db->delete('tipo_analisis');
    }

    public function Update($id,$analisis)
    {
        $this->db->where('ID_TIPO_ANALISIS',$id);
        $this->db->update('TIPO_ANALISIS',$analisis);
    }

    public function Add($analisis)
    {
        return $this->db->insert("tipo_analisis",$analisis);
    }
    
    public function GetById($id)
    {
        $this->db->where('ID_TIPO_ANALISIS',$id);
        return $this->db->get('TIPO_ANALISIS')->result_array();
    }
}