<?php

class Portal_m extends CI_Model {

   	public function __construct()
    {
        parent::__construct();

    }

    public function comprobar()
    {
    	$data["nick"] = $this->input->post("nick");
    	$data["clave"] = $this->input->post("pass");
    	$res = $this->db->get_where("usuario",$data);
        
    	return $res->result();
    }
}

?>