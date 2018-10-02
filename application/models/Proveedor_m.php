<?php

class Proveedor_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function proveedor()
    {
    	$this->db->select("p.id_proveedor ,p.descripcion,p.direccion,p.correo ,p.ruc,p.empresa,departamentos.departamentos ,estados.estados as estado,,p.estado as id_estado");
        $this->db->from("proveedor as p");
        $this->db->join("estados",'p.estado=estados.id_estados');
        $this->db->join("departamentos",'p.id_departamentos=departamentos.id_departamentos');
        $this->db->order_by("id_proveedor",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function proveedor_editar($id)
    {
        $this->db->select("*");
        $this->db->from("proveedor as p");
        $this->db->where("p.id_proveedor",$id);
        $r = $this->db->get(); 
        return $r->result();
    } 

    public function telefono_editar($id)
    {
        $this->db->select("*");
        $this->db->from("telefono");
        $this->db->where("id_proveedor",$id);
        $r = $this->db->get(); 
        return $r->result();
    }    

    public function modificar($id,$dato)
    {
        $data=  array('descripcion' => strtoupper($dato),
    );
        $this->db->where("id_proveedor",$id);
        $this->db->update("proveedor",$data);
    }

    public function eliminar()
    {
        $this->db->where("id_proveedor",$this->input->post("id"));
        $this->db->delete("proveedor");
    }

    public function departamentos()
    {
        $this->db->select("*");
        $this->db->from("departamentos");
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function provincias_ver()
    {
        $this->db->select("*");
        $this->db->from("provincias");
        $r = $this->db->get(); 
        return $r->result();
    }

    public function distritos_ver()
    {
        $this->db->select("*");
        $this->db->from("distritos");
        $r = $this->db->get(); 
        return $r->result();
    }

    public function provincias($id)
    {
        $this->db->select("*");
        $this->db->from("provincias");
        $this->db->where("id_departamentos",$id);
        $r = $this->db->get(); 
        return $r->result();
    } 

    public function proveedor_ver($id)
    {
        $this->db->select("p.descripcion,p.empresa,p.foto,p.direccion,p.correo,d.departamentos,pro.provincias, di.distritos");
        $this->db->from("proveedor as p");
        $this->db->join("departamentos as d","p.id_departamentos=d.id_departamentos");
        $this->db->join("provincias as pro","d.id_departamentos = pro.id_departamentos and p.id_provincias = pro.id_provincias" );
        $this->db->join("distritos as di","pro.id_provincias = di.id_provincias AND p.id_distritos = di.id_distritos");
        $this->db->where("id_proveedor",$id);
        $r = $this->db->get(); 
        return $r->result();
    }
     public function telefono_ver($id)
    {
        $this->db->select("*");
        $this->db->from("telefono");
        $this->db->where("id_proveedor",$id);
        $r = $this->db->get(); 
        return $r->result();
    }       
     public function validar_celular($id)
    {
        $this->db->select("*");
        $this->db->from("telefono");
        $this->db->where("tipo_telefono","2");
        $this->db->where("id_proveedor",$id);
        $r = $this->db->get(); 
        return $r->result();
    }  
    public function validar_telefono($id)
    {
        $this->db->select("*");
        $this->db->from("telefono");
        $this->db->where("tipo_telefono","1");
        $this->db->where("id_proveedor",$id);
        $r = $this->db->get(); 
        return $r->result();
    }  

    public function inactivo($id)
    {
        $data=  array('estado' => '0',
    );
        $this->db->where("id_proveedor",$id);
        $this->db->update("proveedor",$data);
    }

    public function activo($id)
    {
        $data=  array('estado' => '1',
    );
        $this->db->where("id_proveedor",$id);
        $this->db->update("proveedor",$data);
    }

}

?>