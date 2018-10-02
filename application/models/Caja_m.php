<?php

class Caja_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function caja()
    {
    	$this->db->select("caja.id_caja as id_caja,caja.descripcion as descripcion,estados.estados as estado,estados.id_estados as id_estado");
        $this->db->from("caja");
        $this->db->join("estados",'caja.estado=estados.id_estados');
        $this->db->order_by("id_caja",'desc');

        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array('descripcion' => strtoupper($this->input->post("caja")),
            'estado'		=> '1',
        );
        $this->db->insert("caja",$data);
        
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("caja");
        $this->db->where("id_caja",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$dato)
    {
        $data=  array('descripcion' => strtoupper($dato),
    );
        $this->db->where("id_caja",$id);
        $this->db->update("caja",$data);
    }

    public function inactivo($id)
    {
        $data=  array('estado' => '0',
    );
        $this->db->where("id_caja",$id);
        $this->db->update("caja",$data);
    }

    public function activo($id)
    {
        $data=  array('estado' => '1',
    );
        $this->db->where("id_caja",$id);
        $this->db->update("caja",$data);
    }


}

?>