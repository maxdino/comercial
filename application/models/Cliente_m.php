<?php

class Cliente_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function cliente()
    {
    	$this->db->select("c.id_cliente ,c.nombre,c.direccion ,c.dni,c.ruc,c.fecha");
        $this->db->from("cliente as c");
        $this->db->order_by("id_cliente",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function cliente_editar($id)
    {
        $this->db->select("*");
        $this->db->from("cliente as c");
        $this->db->where("c.id_cliente",$id);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function departamentos()
    {
        $this->db->select("*");
        $this->db->from("departamentos");
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function provincias_ver()
    {
        $this->db->select("*");
        $this->db->from("provincias");
        $r = $this->db->get(); 
        return $r->result();
    }

    public function distritos_ver()
    {
        $this->db->select("*");
        $this->db->from("distritos");
        $r = $this->db->get(); 
        return $r->result();
    }

    public function provincias($id)
    {
        $this->db->select("*");
        $this->db->from("provincias");
        $this->db->where("id_departamentos",$id);
        $r = $this->db->get(); 
        return $r->result();
    } 

}

?>