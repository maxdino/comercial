<?php

class Forma_pago_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function forma_pago()
    {
    	$this->db->select("f.id_forma_pago,f.descripcion,e.estados,f.estado");
        $this->db->from("forma_pago as f");
        $this->db->join("estados as e",'f.estado=e.id_estados');
        $this->db->order_by("id_forma_pago",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function agregar()
    {
    	$data=  array(
            'descripcion' => strtoupper($this->input->post("forma_pago")),
            'estado'		=> '1',
        );
        $this->db->insert("forma_pago",$data);
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("forma_pago");
        $this->db->where("id_forma_pago",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$dato)
    {
        $data=  array('descripcion' => strtoupper($dato),
    );
        $this->db->where("id_forma_pago",$id);
        $this->db->update("forma_pago",$data);
    }

    public function inactivo($id)
    {
        $data=  array('estado' => '0',
    );
        $this->db->where("id_forma_pago",$id);
        $this->db->update("forma_pago",$data);
    }

    public function activo($id)
    {
        $data=  array('estado' => '1',
    );
        $this->db->where("id_forma_pago",$id);
        $this->db->update("forma_pago",$data);
    }


}

?>