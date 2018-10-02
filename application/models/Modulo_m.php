<?php

class Modulo_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }


    public function modulo()
    {
    	$this->db->select("*");
        $this->db->from("modulo as m");
        $this->db->join("estados as e","m.estado=e.id_estados");
        $this->db->order_by("id_modulo",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function modulo_ver($id)
    {
        $this->db->select("*");
        $this->db->from("modulo as m");
        $this->db->join("estados as e","m.estado=e.id_estados");
        $this->db->where("id_modulo",$id);
        $this->db->order_by("id_modulo",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function modulo_padre()
    {
        $this->db->select("*");
        $this->db->from("modulo");
        $this->db->where("id_padre",'0');
        $this->db->order_by("id_modulo",'asc');
        $r = $this->db->get();    
        return $r->result();
    }    

    public function agregar()
    {
        if ($this->input->post("modulo_padre")=='0') {
            $modulo_padre='MODULO_PADRE';
            $url='#';
        }else{
            $this->db->select("*");
            $this->db->from("modulo");
            $this->db->where("id_modulo",$this->input->post("modulo_padre"));
            $r = $this->db->get()->row(); 
            $modulo_padre=$r->nombre;
            $url=$this->input->post("url");
        }

    	$data=  array('nombre' => strtoupper($this->input->post("modulo")),
                      'id_padre' => $this->input->post("modulo_padre"),
                      'modulo_padre' => strtoupper($modulo_padre),
                      'url' => $url,
                      'icono' => $this->input->post("icono"),
                      'estado' => '1',
        );
        $this->db->insert("modulo",$data);
        
    }

    public function modificar($id,$modulo,$padre,$url,$icono)
    {
        if ($padre=='0') {
            $modulo_padre='MODULO_PADRE';
            $url_dir='#';
        }else{
            $this->db->select("*");
            $this->db->from("modulo");
            $this->db->where("id_modulo",$padre);
            $r = $this->db->get()->row(); 
            $modulo_padre=$r->nombre;
            $url_dir=$url;

        }

        $data=  array('nombre' => strtoupper($modulo),
                      'id_padre' => $padre,  
                      'modulo_padre' => strtoupper($modulo_padre),
                      'url' => $url_dir,
                      'icono' => $icono,

        );
        $this->db->where("id_modulo",$id);
        $this->db->update("modulo",$data);
    }

    public function inactivo($id)
    {
        $data=  array('estado' => '0',
    );
        $this->db->where("id_modulo",$id);
        $this->db->update("modulo",$data);
    }

    public function activo($id)
    {
        $data=  array('estado' => '1',
    );
        $this->db->where("id_modulo",$id);
        $this->db->update("modulo",$data);
    }

}

?>