<?php

class Personal_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }


    public function personal()
    {
    	$this->db->select("*");
        $this->db->from("usuario");
        $this->db->order_by("id_usuario",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function perfil()
    {
        $this->db->select("*");
        $this->db->from("perfil_usuario");
        $this->db->order_by("id_perfil_usuario",'asc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array('id_perfil_usuario' => $this->input->post("perfil"),
                      'nombre' => strtoupper($this->input->post("nombre")),
                      'nick' => $this->input->post("nick"),
                      'clave' => $this->input->post("clave"),
        );
        $this->db->insert("usuario",$data);
        
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("perfil_usuario");
        $this->db->where("id_perfil_usuario",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$nombre,$perfil,$nick,$clave)
    {
        $data=  array('nombre' => strtoupper($nombre),
                      'id_perfil_usuario' => $perfil,
                      'nick' => $nick,
                      'clave' => $clave,
        );
        $this->db->where("id_usuario",$id);
        $this->db->update("usuario",$data);
    }

}

?>