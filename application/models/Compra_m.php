<?php

class Compra_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }

    public function compra()
    {
    	$this->db->select("c.id_compra as id_compra,t.descripcion as tipo_comprobante,c.fecha , c.subtotal , p.descripcion , c.nro_factura , estados.estados ");
        $this->db->from("compra as c");
        $this->db->join("proveedor as p ",'c.id_proveedor=p.id_proveedor');
        $this->db->join("tipo_comprobante as t ",'c.id_tipo_comprobante=t.id_tipo_comprobante');
        $this->db->join("estados ",'c.estado=estados.id_estados');
        $this->db->order_by("c.id_compra",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("compra");
        $this->db->where("id_compra",$id);
        $r = $this->db->get(); 
        return $r->result();
    }  

    public function almacen()
    {
        $this->db->select("*");
        $this->db->from("almacen");
        $r = $this->db->get(); 
        return $r->result();
    } 

    public function validar_producto($p,$a)
    {
        $this->db->select("*");
        $this->db->from("almacen_productos");
        $this->db->where("id_producto",$p);
        $this->db->where("id_almacen",$a);
        $r = $this->db->get(); 
        return $r->result();
    }  

    public function modificar($id,$dato)
    {
        $data=  array('descripcion' => strtoupper($dato),
        );
        $this->db->where("id_compra",$id);
        $this->db->update("compra",$data);
    }

    public function eliminar()
    { 
        $this->db->where("id_compra",$this->input->post("id"));
        $this->db->delete("compra");
    }

    public function proveedor()
    { 
        $this->db->select("*");
        $this->db->from("proveedor");
        $this->db->where("estado",1);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function unidad()
    { 
        $this->db->select("*");
        $this->db->from("unidad_medida");
        $this->db->where("estado",1);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function tipo_comprobante()
    { 
        $this->db->select("*");
        $this->db->from("tipo_comprobante");
        $this->db->where("estado",1);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function colores()
    { 
        $this->db->select("*");
        $this->db->from("colores");
        $this->db->where("estado",1);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function compra_editar($id)
    { 
        $this->db->select("*");
        $this->db->from("compra");
        $this->db->where("id_compra",$id);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function compra_tallas($id)
    { 
        $this->db->select("*");
        $this->db->from("compra_tallas");
        $this->db->where("id_compra",$id);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function compra_colores($id)
    { 
        $this->db->select("*");
        $this->db->from("compra_colores");
        $this->db->where("id_compra",$id);
        $r = $this->db->get(); 
        return $r->result();
    }

 
}

?>