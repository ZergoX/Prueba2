<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class resultado_analisis_model extends CI_Model {
    
    public function __construct()
	{
        parent::__construct();
        $this->load->database();                   
    } 
}