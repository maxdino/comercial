<?php

class Tipo_comprobante_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }

    public function tipo_comprobante()
    {
    	$this->db->select("tipo_comprobante.id_tipo_comprobante as id_tipo_comprobante,tipo_comprobante.descripcion as descripcion,estados.estados as estado");
        $this->db->from("tipo_comprobante");
        $this->db->join("estados",'tipo_comprobante.estado=estados.id_estados');
        $this->db->where("tipo_comprobante.estado",1);
        $this->db->order_by("id_tipo_comprobante",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array('descripcion' => strtoupper($this->input->post("tipo_comprobante")),
            'estado'		=> '1',
        );
        $this->db->insert("tipo_comprobante",$data);
        
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("tipo_comprobante");
        $this->db->where("id_tipo_comprobante",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$dato)
    {
        $data=  array('descripcion' => strtoupper($dato),
        );
        $this->db->where("id_tipo_comprobante",$id);
        $this->db->update("tipo_comprobante",$data);
    }

    public function eliminar()
    {
        $this->db->where("id_tipo_comprobante",$this->input->post("id"));
        $this->db->delete("tipo_comprobante");
    }


}

?>