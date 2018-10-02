<?php

class Cierre_caja_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function cierre()
    {
    	$this->db->select("s.id_sesion_caja,u.nombre,u.apellido,s.fecha_entrada,s.fecha_salida,s.monto_inicial,s.monto_cierre,c.descripcion");
        $this->db->from("sesion_caja as s");
        $this->db->join("caja as c ",'s.id_caja=c.id_caja');
        $this->db->join("usuario as u ",'s.id_usuario=u.id_usuario');
        $this->db->order_by("id_sesion_caja",'desc');

        $r = $this->db->get();    
        return $r->result();
    }

    public function caja()
    {
        $this->db->select("*");
        $this->db->from("caja");
        $r = $this->db->get(); 
        return $r->result();
    } 

    public function agregar()
    {
    	$data=  array(
            'fecha_salida'	=> date('Y-m-d H:i:s'),            
        );
        $this->db->where("id_sesion_caja",$this->input->post("id"));
        $this->db->update("sesion_caja",$data);
        
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("caja");
        $this->db->where("id_caja",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$dato)
    {
        $data=  array('descripcion' => strtoupper($dato),
    );
        $this->db->where("id_caja",$id);
        $this->db->update("caja",$data);
    }

    public function inactivo($id)
    {
        $data=  array('estado' => '0',
    );
        $this->db->where("id_caja",$id);
        $this->db->update("caja",$data);
    }

    public function activo($id)
    {
        $data=  array('estado' => '1',
    );
        $this->db->where("id_caja",$id);
        $this->db->update("caja",$data);
    }


}

?>