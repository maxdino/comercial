<?php

class Categoria_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function categoria()
    {
    	$this->db->select("categoria.id_categoria as id_categoria,categoria.descripcion as descripcion,estados.estados as estado");
        $this->db->from("categoria");
        $this->db->join("estados",'categoria.estado=estados.id_estados');
        $this->db->where("categoria.estado",1);
        $this->db->order_by("id_categoria",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array('descripcion' => strtoupper($this->input->post("categoria")),
            'estado'		=> '1',
        );
        $this->db->insert("categoria",$data);
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("categoria");
        $this->db->where("id_categoria",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$dato)
    {
        $data=  array('descripcion' => strtoupper($dato),
        );
        $this->db->where("id_categoria",$id);
        $this->db->update("categoria",$data);
    }

    public function eliminar()
    {
        
        $this->db->where("id_categoria",$this->input->post("id"));
        $this->db->delete("categoria");
    }


}

?>