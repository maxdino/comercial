<?php

class Marcas_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }

    public function marcas()
    {
    	$this->db->select("marcas.id_marcas as id_marcas,marcas.descripcion as descripcion,estados.estados as estado");
        $this->db->from("marcas");
        $this->db->join("estados",'marcas.estado=estados.id_estados');
        $this->db->where("marcas.estado",1);
        $this->db->order_by("id_marcas",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array('descripcion' => strtoupper($this->input->post("marcas")),
            'estado'		=> '1',
        );
        $this->db->insert("marcas",$data);
        
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("marcas");
        $this->db->where("id_marcas",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$dato)
    {
        $data=  array('descripcion' => strtoupper($dato),
        );
        $this->db->where("id_marcas",$id);
        $this->db->update("marcas",$data);
    }

    public function eliminar()
    {
        $this->db->where("id_marcas",$this->input->post("id"));
        $this->db->delete("marcas");
    }


}

?>