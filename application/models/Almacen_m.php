<?php

class Almacen_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function almacen()
    {
    	$this->db->select("*");
        $this->db->from("almacen");
        $this->db->order_by("id_almacen",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array('almacen' => strtoupper($this->input->post("almacen")),
        );
        $this->db->insert("almacen",$data);
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("almacen");
        $this->db->where("id_almacen",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$dato)
    {
        $data=  array('almacen' => strtoupper($dato),
        );
        $this->db->where("id_almacen",$id);
        $this->db->update("almacen",$data);
    }

    public function eliminar()
    {
        
        $this->db->where("id_almacen",$this->input->post("id"));
        $this->db->delete("almacen");
    }


}

?>