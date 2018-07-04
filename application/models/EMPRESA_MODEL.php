<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class empresa_model extends CI_Model {
    
    public function __construct()
	{
        parent::__construct();
        $this->load->database();                   
    } 

    public function Add($empresa)
    {
        $this->db->insert("empresa",$empresa);
        return $this->db->insert_id();
    }

    public function GetRut($rut)
    {
        $this->db->where("RUT_EMPRESA",$rut);
        return $this->db->get('empresa')->result_array();
    }
    
    public function GetById($id)
    {
        $this->db->where('CODIGO_EMPRESA',$id);
        return $this->db->get('empresa')->result_array();
    }

    public function All()
    {
        return $this->db->get('empresa')->result_array();
    }

    public function Deshabilitar_Habilitar($id,$empresa)
    {
        $this->db->where("CODIGO_EMPRESA",$id);
        $this->db->update("empresa",$empresa);
    }
    
    public function GetRutAndPass($rut,$pass)
    {
        $this->db->where('RUT_EMPRESA',$rut);
        $this->db->where('PASSWORD_EMPRESA',$pass);
        return $this->db->get('empresa')->result_array();
    }

    public function GetStatusAccount($rut,$estado)
    {
        $this->db->where('ESTADO_EMPRESA',$estado);
        $this->db->where('RUT_EMPRESA',$rut);
        return $this->db->get('empresa')->result_array();
    }

    public function Update($codigo,$empresa)
    {
        $this->db->where('CODIGO_EMPRESA',$codigo);
        return $this->db->update("empresa",$empresa);
    }
}