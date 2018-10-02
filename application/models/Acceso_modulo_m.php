<?php

class Acceso_modulo_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }


    public function perfil()
    {
    	$this->db->select("*");
        $this->db->from("perfil_usuario");
        $this->db->order_by("descripcion",'asc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function modulo_padre()
    {
        $this->db->select("*");
        $this->db->from("modulo");
        $this->db->where("id_padre",'0');
        $this->db->order_by("nombre",'asc');
        $r = $this->db->get();    
        return $r->result();
    }    

    public function modulo($id)
    {
        $this->db->select("*");
        $this->db->from("modulo");
        $this->db->where("id_padre",$id);
        $this->db->order_by("nombre",'asc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function perfil_modulo($id)
    {
        $this->db->select("*");
        $this->db->from("permisos");
        $this->db->where("id_perfil_usuario",$id);
        $r = $this->db->get();    
        return $r->result();
    }

}

?>