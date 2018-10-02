<?php

class Perfil_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }


    public function perfil()
    {
    	$this->db->select("*");
        $this->db->from("perfil_usuario as p");
        $this->db->join("estados as e","p.estado=e.id_estados");
        $this->db->order_by("id_perfil_usuario",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array('descripcion' => strtoupper($this->input->post("perfil")),
            'estado'		=> '1',
        );
        $this->db->insert("perfil_usuario",$data);
        
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("perfil_usuario");
        $this->db->where("id_perfil_usuario",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$dato)
    {
        $data=  array('descripcion' => strtoupper($dato),
        );
        $this->db->where("id_perfil_usuario",$id);
        $this->db->update("perfil_usuario",$data);
    }

    public function inactivo($id)
    {
        $data=  array('estado' => '0',
    );
        $this->db->where("id_perfil_usuario",$id);
        $this->db->update("perfil_usuario",$data);
    }

    public function activo($id)
    {
        $data=  array('estado' => '1',
    );
        $this->db->where("id_perfil_usuario",$id);
        $this->db->update("perfil_usuario",$data);
    }

}

?>