<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class analisis_muestras_model extends CI_Model {
    
    public function __construct()
	{
        parent::__construct();
        $this->load->database();                   
    } 

    public function Add($muestra)
    {
        $this->db->insert('analisis_muestras',$muestra);
    }

    public function GetByCodigo($codigo,$type)
    {
        $this->db->where('PARTICULAR_CODIGO_PARTICULAR',$codigo);
        $this->db->where('Tipo_analisis',$type);
        return $this->db->get('analisis_muestras')->result_array();
    }

    public function getNameByCodigo($codigo)
    {
        $this->db->where('ID_ANALISIS_MUESTRAS',$codigo);
        return $this->db->get('analisis_muestras')->result_array();
    }
    
    public function All($rut)
    {
        $this->db->where('RUT_EMPLEADO_RECIBE',$rut);
        return $this->db->get('analisis_muestras')->result_array();
    }

    public function AllAnalisisParticular($estado)
    {
        //SELECT * FROM particular P JOIN analisis_muestras A ON (A.PARTICULAR_CODIGO_PARTICULAR = P.CODIGO_PARTICULAR) where a.ESTADO_MUESTRA like 'PROCESAR';

        $this->db->select('a.ID_ANALISIS_MUESTRAS,a.FECHA_RECEPCION,a.PARTICULAR_CODIGO_PARTICULAR,a.EMPRESA_CODIGO_EMPRESA,a.RUT_EMPLEADO_RECIBE,a.TIPO_ANALISIS,a.ESTADO_MUESTRA,p.RUT_PARTICULAR')->
        from('analisis_muestras a')->
        join('particular p','a.PARTICULAR_CODIGO_PARTICULAR = p.CODIGO_PARTICULAR')->
        where('a.ESTADO_MUESTRA',$estado)->
        group_by('a.ID_ANALISIS_MUESTRAS');
        return $this->db->get('analisis_muestras')->result_array();
    }

    public function AllAnalisisEmpresa($estado)
    {
        //SELECT * FROM particular P JOIN analisis_muestras A ON (A.PARTICULAR_CODIGO_PARTICULAR = P.CODIGO_PARTICULAR) where a.ESTADO_MUESTRA like 'PROCESAR';

        $this->db->select('a.ID_ANALISIS_MUESTRAS,a.FECHA_RECEPCION,a.PARTICULAR_CODIGO_PARTICULAR,a.EMPRESA_CODIGO_EMPRESA,a.RUT_EMPLEADO_RECIBE,a.TIPO_ANALISIS,a.ESTADO_MUESTRA,p.RUT_PARTICULAR')->
        from('analisis_muestras a')->
        join('particular p','a.PARTICULAR_CODIGO_PARTICULAR = p.CODIGO_PARTICULAR')->
        where('a.ESTADO_MUESTRA',$estado)->
        group_by('a.ID_ANALISIS_MUESTRAS');
        return $this->db->get('analisis_muestras')->result_array();
    }

    public function update($codigo,$analisis)
    {
        $this->db->where('ID_ANALISIS_MUESTRAS',$codigo);
        return $this->db->update('analisis_muestras',$analisis);
    }
}