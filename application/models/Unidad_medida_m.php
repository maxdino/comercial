<?php

class Unidad_medida_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }

    public function unidad_medida()
    {
    	$this->db->select("unidad_medida.id_unidad_medida ,unidad_medida.unidad_medida,unidad_medida.unidad ,estados.estados as estado");
        $this->db->from("unidad_medida  ");
        $this->db->join("estados  ",'unidad_medida.estado=estados.id_estados');
        $this->db->order_by("unidad_medida.id_unidad_medida",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array('unidad_medida' => strtoupper($this->input->post("unidad_medida")),
            'unidad' => $this->input->post("unidad"),
            'estado'		=> '1',
        );
        $this->db->insert("unidad_medida",$data);
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("unidad_medida");
        $this->db->where("id_unidad_medida",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$dato,$cantidad)
    {
        $data=  array('unidad_medida' => strtoupper($dato),
                      'unidad' => $cantidad,
        );
        $this->db->where("id_unidad_medida",$id);
        $this->db->update("unidad_medida",$data);
    }

    public function eliminar()
    { 
        $this->db->where("id_unidad_medida",$this->input->post("id"));
        $this->db->delete("unidad_medida");
    }


}

?>