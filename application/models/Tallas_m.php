<?php

class Tallas_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }

    public function tallas()
    {
    	$this->db->select("tallas.id_tallas as id_tallas,tallas.descripcion as descripcion ,estados.estados as estado");
        $this->db->from("tallas  ");
        $this->db->join("estados  ",'tallas.estado=estados.id_estados');
        $this->db->order_by("tallas.id_tallas",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array('descripcion' => strtoupper($this->input->post("tallas")),
            'estado'		=> '1',
        );
        $this->db->insert("tallas",$data);
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("tallas");
        $this->db->where("id_tallas",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$dato)
    {
        $data=  array('descripcion' => strtoupper($dato),
        );
        $this->db->where("id_tallas",$id);
        $this->db->update("tallas",$data);
    }

    public function eliminar()
    { 
        $this->db->where("id_tallas",$this->input->post("id"));
        $this->db->delete("tallas");
    }


}

?>