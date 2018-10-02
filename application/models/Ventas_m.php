<?php

class Ventas_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function ventas()
    {
    	$this->db->select("*");
        $this->db->from("venta as v");
        $this->db->join("cliente as c","c.id_cliente=v.id_cliente");
        $this->db->order_by("v.id_venta",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function ventas_editar($id)
    {
        $this->db->select("*");
        $this->db->from("venta as v");
        $this->db->where("v.id_venta",$id);
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

    public function almacen()
    {
        $this->db->select("*");
        $this->db->from("almacen");
        $r = $this->db->get(); 
        return $r->result();
    }

    public function clientes()
    {
     return $r = $this->db->query("select * from (cliente as c ) WHERE c.ruc!='' ORDER BY c.nombre asc")->result();
 }

}

?>