<?php

class Concepto_movimiento_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function concepto()
    {
    	$this->db->select("c.id_concepto_movimiento,c.descripcion,t.descripcion as tipo,e.estados,c.estado");
        $this->db->from("concepto_movimiento as c");
        $this->db->join("tipo_movimiento as t",'c.id_tipo_movimiento=t.id_tipo_movimiento');
        $this->db->join("estados as e",'t.estado=e.id_estados');
        $this->db->order_by("id_concepto_movimiento",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function tipo()
    {
        $this->db->select("*");
        $this->db->from("tipo_movimiento");
        $this->db->order_by("id_tipo_movimiento",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array(
            'descripcion' => strtoupper($this->input->post("concepto_movimiento")),
            'id_tipo_movimiento' => $this->input->post("tipo"),
            'estado'		=> '1',
        );
        $this->db->insert("concepto_movimiento",$data);
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("concepto_movimiento");
        $this->db->where("id_concepto_movimiento",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$dato,$tipo)
    {
        $data=  array('descripcion' => strtoupper($dato),
            'id_tipo_movimiento' => $tipo
    );
        $this->db->where("id_concepto_movimiento",$id);
        $this->db->update("concepto_movimiento",$data);
    }

    public function inactivo($id)
    {
        $data=  array('estado' => '0',
    );
        $this->db->where("id_concepto_movimiento",$id);
        $this->db->update("concepto_movimiento",$data);
    }

    public function activo($id)
    {
        $data=  array('estado' => '1',
    );
        $this->db->where("id_concepto_movimiento",$id);
        $this->db->update("concepto_movimiento",$data);
    }


}

?>