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

    public function All()
    {
        return $this->db->get('empresa')->result_array();
    }
}