<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class particular_model extends CI_Model {
    
    public function __construct()
	{
        parent::__construct();
        $this->load->database();                   
    } 

    public function Add($particular)
    {
        $this->db->insert("particular",$particular);
        return $this->db->insert_id();
    }

    public function Delete($codigo_particular)
    {
        $this->db->where("CODIGO_PARTICULAR",$codigo_particular);
        return $this->db->delete("particular");
    }

    public function Update($codigo_particular,$particular)
    {
        $this->db->where("CODIGO_PARTICULAR",$codigo_particular);
        return $this->db->update("particular",$particular);
    }

    public function All()
    {
        return $this->db->get("particular")->result_array();
    }

    public function GetRut($rut)
    {
        $this->db->where("RUT_PARTICULAR",$rut);
        return $this->db->get('particular')->result_array();
    }
  
    public function Deshabilitar_Habilitar($id,$particular)
    {
        $this->db->where("CODIGO_PARTICULAR",$id);
        $this->db->update("particular",$particular);
    }

    public function GetById($id)
    {
        $this->db->where('CODIGO_PARTICULAR',$id);
        return $this->db->get('PARTICULAR')->result_array();
    }
}