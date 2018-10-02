<?php

class Serie_documento_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function serie_documento()
    {
    	$this->db->select("s.id_serie_documento,s.serie,s.numero,s.max_numero,e.estados,t.descripcion as tipo");
        $this->db->from("serie_documento as s");
        $this->db->join("tipo_comprobante as t ",'s.id_tipo_comprobante=t.id_tipo_comprobante');
        $this->db->join("estados as e ",'s.estado=e.id_estados');
        $this->db->order_by("s.id_serie_documento",'desc');

        $r = $this->db->get();    
        return $r->result();
    }

    public function tipo_comprobante()
    {
        $this->db->select("*");
        $this->db->from("tipo_comprobante");
        $r = $this->db->get(); 
        return $r->result();
    } 

    public function agregar()
    {
        if ($this->input->post("numero_co")<$this->input->post("max_numero")) {
            $es=1;
        }else{
            $es=0;
        }
    	$data=  array(
            'serie'	=> $this->input->post("serie"), 
            'numero'  => $this->input->post("numero_co"), 
            'max_numero'  => $this->input->post("max_numero"), 
            'id_tipo_comprobante'  => $this->input->post("tipo_comprobante"), 
            'estado'  => $es,           
        );
        $this->db->insert("serie_documento",$data);
        
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("caja");
        $this->db->where("id_caja",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function modificar($id,$serie,$numero,$max,$tipo)
    {
        if ($numero<$max) {
            $es=1;
        }else{
            $es=0;
        }
        $data=  array(
            'serie' => $serie,
            'numero' => $numero,
            'max_numero' => $max,
            'id_tipo_comprobante' => $tipo,
            'estado'  => $es,
    );
        $this->db->where("id_serie_documento",$id);
        $this->db->update("serie_documento",$data);
    }

}

?>