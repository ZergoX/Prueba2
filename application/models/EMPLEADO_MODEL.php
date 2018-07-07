<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class empleado_model extends CI_Model {
    
    public function __construct()
	{
        parent::__construct();
        $this->load->database();                   
    } 

    public function Add($empleado)
    {   
        return $this->db->insert("empleado",$empleado);
    }

    public function All()
    {
        return $this->db->get('empleado')->result_array();
    }

    public function Deshabilitar_Habilitar($rut,$empleado)
    {
        $this->db->where("RUT_EMPLEADO",$rut);
        $this->db->update("empleado",$empleado);
    }

    public function GetRut($rut)
    {
        $this->db->where("RUT_EMPLEADO",$rut);
        return $this->db->get('empleado')->result_array();
    }
       
    public function GetRutAndPass($rut,$pass)
    {
        $this->db->where('RUT_EMPLEADO',$rut);
        $this->db->where('PASSWORD_EMPLEADO',$pass);
        return $this->db->get('empleado')->result_array();
    }

    public function TypeRol($rut,$rol)
    {
        $this->db->where('RUT_EMPLEADO',$rut);
        $this->db->where('ROL',$rol);
        return $this->db->get('empleado')->result_array();
    }

    public function GetStatusAccount($rut,$estado)
    {
        $this->db->where('RUT_EMPLEADO',$rut);
        $this->db->where('ESTADO_EMPLEADO',$estado);
        return $this->db->get('empleado')->result_array();
    }

}