<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class contacto_model extends CI_Model {
    
    public function __construct()
	{
        parent::__construct();
        $this->load->database();                   
    } 

    public function Add($contacto)
    {        
        return $this->db->insert("contacto",$contacto);
    }

    public function AllById($codigo)
    {
        $this->db->where('EMPRESA_CODIGO_EMPRESA',$codigo);
        return $this->db->get('contacto')->result_array();
    }

    public function getRut($rut)
    {
        $this->db->where('RUT_CONTACTO',$rut);
        return $this->db->get('contacto')->result_array();
    }

    public function Delete($rut)
    {
        $this->db->where('RUT_CONTACTO',$rut);
        return $this->db->delete('contacto');
    }

    public function Update($rut, $contacto)
    {
        $this->db->where('RUT_CONTACTO',$rut);
        return $this->db->Update('contacto',$contacto);
    }
}