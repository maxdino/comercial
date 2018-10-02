<?php

class Productos_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }

    public function productos()
    {
    	$this->db->select("p.id_productos as id_productos,p.descripcion as descripcion, p.id_marcas,p.id_categoria, p.id_material,p.fecha,p.stock_minimo as stock_minimo, p.fecha as fecha , m.descripcion as marcas , c.descripcion as categoria ,estados.estados as estado,p.estado as id_estado");
        $this->db->from("productos as p");
        $this->db->join("estados ",'p.estado=estados.id_estados');
        $this->db->join("marcas as m ",'p.id_marcas=m.id_marcas');
        $this->db->join("categoria as c ",'p.id_categoria=c.id_categoria');
        $this->db->order_by("p.id_productos",'desc');
        $r = $this->db->get();    
        return $r->result();
    }

    public function productos_ver($id)
    {
        $this->db->select("p.descripcion,p.stock_minimo,p.fecha,p.id_marcas,p.id_categoria,p.foto");
        $this->db->from("productos as p");
        $this->db->where("id_productos",$id);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function colores_ver($id)
    {
        $this->db->select("c.descripcion,c.codigo");
        $this->db->from("detalle_colores as d");
        $this->db->join("colores as c","d.id_colores=c.id_colores");
        $this->db->join("pack_colores as pa","d.id_pack_colores=pa.id_pack_colores");
        $this->db->join("productos as p","pa.id_pack_colores=p.id_pack_color");
        $this->db->where("p.id_productos",$id);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function tallas_ver($id)
    {
        $this->db->select("t.descripcion");
        $this->db->from("detalle_tallas as d");
        $this->db->join("tallas as t","d.id_tallas=t.id_tallas");
        $this->db->join("pack_tallas as pa","d.id_pack_tallas=pa.id_pack_tallas");
        $this->db->join("productos as p","pa.id_pack_tallas=p.id_pack_tallas");
        $this->db->where("p.id_productos",$id);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function editar($id)
    {
        $this->db->select("*");
        $this->db->from("productos");
        $this->db->where("id_productos",$id);
        $r = $this->db->get(); 
        return $r->result();
    }   

    public function almacen_productos($id)
    {
        $this->db->select("*");
        $this->db->from("almacen_productos as p");
        $this->db->join("almacen as a","p.id_almacen=a.id_almacen");
        $this->db->where("p.id_producto",$id);
        $r = $this->db->get(); 
        return $r->result();
    }  

    public function unidad_producto($id)
    {
        $this->db->select("*");
        $this->db->from("unidad_producto as p");
        $this->db->join("unidad_medida as u ","p.id_unidad_medida=u.id_unidad_medida");
        $this->db->where("p.id_producto",$id);
        $r = $this->db->get(); 
        return $r->result();
    } 

    public function inactivo($id)
    {
        $data=  array('estado' => '0',
    );
        $this->db->where("id_productos",$id);
        $this->db->update("productos",$data);
    }

    public function activo($id)
    {
        $data=  array('estado' => '1',
    );
        $this->db->where("id_productos",$id);
        $this->db->update("productos",$data);
    }

    public function eliminar()
    { 
        $this->db->where("id_productos",$this->input->post("id"));
        $this->db->delete("productos_colores"); 
        
        $this->db->where("id_productos",$this->input->post("id"));
        $this->db->delete("productos_tallas"); 

        $this->db->where("id_producto",$this->input->post("id"));
        $this->db->delete("unidad_producto"); 
        
        $this->db->where("id_producto",$this->input->post("id"));
        $this->db->delete("almacen_productos");
        
        $this->db->where("id_productos",$this->input->post("id"));
        $this->db->delete("productos");
        
    }

    public function pack_tallas()
    { 
        $this->db->select("*");
        $this->db->from("pack_tallas");
        $this->db->where("estado",1);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function unidad()
    { 
        $this->db->select("*");
        $this->db->from("unidad_medida");
        $r = $this->db->get(); 
        return $r->result();
    }

    public function marcas()
    { 
        $this->db->select("*");
        $this->db->from("marcas");
        $this->db->where("estado",1);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function categoria()
    { 
        $this->db->select("*");
        $this->db->from("categoria");
        $this->db->where("estado",1);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function material()
    { 
        $this->db->select("*");
        $this->db->from("material");
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

    public function pack_colores()
    { 
        $this->db->select("*");
        $this->db->from("pack_colores");
        $this->db->where("estado",1);
        $this->db->order_by("pack_colores","asc");
        $r = $this->db->get(); 
        return $r->result();
    }

    public function productos_editar($id)
    { 
        $this->db->select("*");
        $this->db->from("productos");
        $this->db->where("id_productos",$id);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function productos_tallas($id)
    { 
        $this->db->select("*");
        $this->db->from("productos_tallas");
        $this->db->where("id_productos",$id);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function productos_colores($id)
    { 
        $this->db->select("*");
        $this->db->from("productos_colores");
        $this->db->where("id_productos",$id);
        $r = $this->db->get(); 
        return $r->result();
    }

    public function productos_precio($id)
    { 
        $this->db->select("*");
        $this->db->from("unidad_producto as p");
        $this->db->join("unidad_medida as u ","p.id_unidad_medida=u.id_unidad_medida");
        $this->db->where("id_producto",$id);
        $r = $this->db->get(); 
        return $r->result();
    }

}

?>