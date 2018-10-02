<?php

class Pack_colores_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }

    public function pack()
    {
    	$this->db->select("p.id_pack_colores as id_pack_colores,p.pack_colores as pack_colores,estados.estados as estado,p.estado as id_estado");
        $this->db->from("pack_colores as p");
        $this->db->join("estados",'p.estado=estados.id_estados');
        $this->db->order_by("id_pack_colores",'desc');

        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array('pack_colores' => strtoupper($this->input->post("colores")),
            'estado'		=> '1',
        );
        $this->db->insert("pack_colores",$data);
        
    }

    public function ver_pack_colores($id)
    {
        $this->db->select("*");
        $this->db->from("pack_colores");
        $this->db->where("id_pack_colores",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function detalle_colores($id)
    {
        $this->db->select("*");
        $this->db->from("detalle_colores");
        $this->db->where("id_pack_colores",$id);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function modificar($id,$dato)
    {
        $data=  array('pack_colores' => strtoupper($dato),
        );
        $this->db->where("id_pack_colores",$id);
        $this->db->update("pack_colores",$data);
    }

    public function eliminar()
    {
        $this->db->where("id_pack_colores",$this->input->post("id"));
        $this->db->delete("pack_colores");
    }

    public function colores()
    { 
        $this->db->select("*");
        $this->db->from("colores");
        $this->db->where("estado",1);
        $this->db->order_by("descripcion","asc");
        $r = $this->db->get(); 
        return $r->result();
    }

    public function inactivo($id)
    {
        $data=  array('estado' => '0',
    );
        $this->db->where("id_pack_colores",$id);
        $this->db->update("pack_colores",$data);
    }

    public function activo($id)
    {
        $data=  array('estado' => '1',
    );
        $this->db->where("id_pack_colores",$id);
        $this->db->update("pack_colores",$data);
    }


}

?>