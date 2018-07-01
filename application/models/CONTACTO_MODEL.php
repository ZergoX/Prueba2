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
}