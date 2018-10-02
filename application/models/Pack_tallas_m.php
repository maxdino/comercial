<?php

class Pack_tallas_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }

    public function pack()
    {
    	$this->db->select("p.id_pack_tallas as id_pack_tallas,p.pack_tallas as pack_tallas,estados.estados as estado,p.estado as id_estado");
        $this->db->from("pack_tallas as p");
        $this->db->join("estados",'p.estado=estados.id_estados');
        $this->db->order_by("id_pack_tallas",'desc');

        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array('pack_tallas' => strtoupper($this->input->post("tallas")),
            'estado'		=> '1',
        );
        $this->db->insert("pack_tallas",$data);
        
    }

    public function ver_pack_tallas($id)
    {
        $this->db->select("*");
        $this->db->from("pack_tallas");
        $this->db->where("id_pack_tallas",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function detalle_tallas($id)
    {
        $this->db->select("*");
        $this->db->from("detalle_tallas");
        $this->db->where("id_pack_tallas",$id);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function modificar($id,$dato)
    {
        $data=  array('pack_tallas' => strtoupper($dato),
        );
        $this->db->where("id_pack_tallas",$id);
        $this->db->update("pack_tallas",$data);
    }

    public function eliminar()
    {
        $this->db->where("id_pack_tallas",$this->input->post("id"));
        $this->db->delete("pack_tallas");
    }

    public function tallas()
    { 
        $this->db->select("*");
        $this->db->from("tallas");
        $this->db->where("estado",1);
        $this->db->order_by("descripcion","asc");
        $r = $this->db->get(); 
        return $r->result();
    }

    public function inactivo($id)
    {
        $data=  array('estado' => '0',
    );
        $this->db->where("id_pack_tallas",$id);
        $this->db->update("pack_tallas",$data);
    }

    public function activo($id)
    {
        $data=  array('estado' => '1',
    );
        $this->db->where("id_pack_tallas",$id);
        $this->db->update("pack_tallas",$data);
    }


}

?>