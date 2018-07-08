<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class telefono_model extends CI_Model {
    
    public function __construct()
	{
        parent::__construct();
        $this->load->database();                   
    } 

    public function Add($telefono)
    {
        return $this->db->insert("telefono",$telefono);
    }

    public function AllById($codigo)
    {
        $this->db->where('PARTICULAR_CODIGO_PARTICULAR',$codigo);
        return $this->db->get('telefono')->result_array();
    }

    public function Update($codigo,$telefono)
    {
        $this->db->where("PARTICULAR_CODIGO_PARTICULAR",$codigo);
        return $this->db->update("telefono",$telefono);
    }

    public function Delete($id)
    {
        $this->db->where("ID_TELEFONO",$id);
        return $this->db->delete('telefono');
    }
}