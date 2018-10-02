<?php

class Tipo_movimiento_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function tipo()
    {
    	$this->db->select("*");
        $this->db->from("tipo_movimiento as t");
        $this->db->join("estados",'t.estado=estados.id_estados');
        $this->db->order_by("id_tipo_movimiento",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array('descripcion' => strtoupper($this->input->post("tipo_movimiento")),
            'estado'		=> '1',
        );
        $this->db->insert("tipo_movimiento",$data);
        
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("tipo_movimiento");
        $this->db->where("id_tipo_movimiento",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$dato)
    {
        $data=  array('descripcion' => strtoupper($dato),
    );
        $this->db->where("id_tipo_movimiento",$id);
        $this->db->update("tipo_movimiento",$data);
    }

    public function inactivo($id)
    {
        $data=  array('estado' => '0',
    );
        $this->db->where("id_tipo_movimiento",$id);
        $this->db->update("tipo_movimiento",$data);
    }

    public function activo($id)
    {
        $data=  array('estado' => '1',
    );
        $this->db->where("id_tipo_movimiento",$id);
        $this->db->update("tipo_movimiento",$data);
    }


}

?>