<?php

class Colores_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }

    public function colores()
    {
    	$this->db->select("colores.id_colores as id_colores,colores.descripcion as descripcion,estados.estados as estado");
        $this->db->from("colores");
        $this->db->join("estados",'colores.estado=estados.id_estados');
        $this->db->where("colores.estado",1);
        $this->db->order_by("id_colores",'desc');

        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array('descripcion' => strtoupper($this->input->post("colores")),
            'codigo' => $this->input->post("codigo"),
            'estado'		=> '1',
        );
        $this->db->insert("colores",$data);
        
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("colores");
        $this->db->where("id_colores",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$dato,$codigo)
    {
        $data=  array('descripcion' => strtoupper($dato),
            'codigo' => $codigo,
        );
        $this->db->where("id_colores",$id);
        $this->db->update("colores",$data);
    }

    public function eliminar()
    {
        $this->db->where("id_colores",$this->input->post("id"));
        $this->db->delete("colores");
    }


}

?>