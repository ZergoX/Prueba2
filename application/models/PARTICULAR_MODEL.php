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

    public function GetAllPhone($codigo)
    {
        $this->db->select('tel.NUMERO_TELEFONO,par.RUT_PARTICULAR,par.NOMBRE_PARTICULAR,par.DIRECCION_PARTICULAR,par.EMAIL_PARTICULAR, tel.PARTICULAR_CODIGO_PARTICULAR,tel.ID_TELEFONO')->
        from('telefono tel')->
        join('particular par','tel.PARTICULAR_CODIGO_PARTICULAR = par.CODIGO_PARTICULAR')->
        where("tel.PARTICULAR_CODIGO_PARTICULAR",$codigo)->
        group_by("tel.PARTICULAR_CODIGO_PARTICULAR");
        return $this->db->get('telefono')->result_array();
    }

    public function GetRutAndPass($rut,$pass)
    {
        $this->db->where('RUT_PARTICULAR',$rut);
        $this->db->where('PASSWORD_PARTICULAR',$pass);
        return $this->db->get('particular')->result_array();
    }

    public function GetStatusAccount($rut,$estado)
    {
        $this->db->where('ESTADO_PARTICULAR',$estado);
        $this->db->where('RUT_PARTICULAR',$rut);
        return $this->db->get('particular')->result_array();
    }
}