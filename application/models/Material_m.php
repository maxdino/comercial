<?php

class Material_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function material()
    {
    	$this->db->select("*");
        $this->db->from("material");
        $this->db->order_by("id_material",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array('material' => strtoupper($this->input->post("material")),
        );
        $this->db->insert("material",$data);
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("material");
        $this->db->where("id_material",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$dato)
    {
        $data=  array('material' => strtoupper($dato),
        );
        $this->db->where("id_material",$id);
        $this->db->update("material",$data);
    }

    public function eliminar()
    {
        
        $this->db->where("id_material",$this->input->post("id"));
        $this->db->delete("material");
    }


}

?>