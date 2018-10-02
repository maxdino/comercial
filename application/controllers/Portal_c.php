<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portal_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Portal_m');

	}


	public function index()
	{
		$this->load->view('portal/index');
	}

 

	public function autentificar()
	{
		$r = $this->Portal_m->comprobar();
		if($r)
		{
			$_SESSION["personal"] = $r[0]->nombre;
			$_SESSION["apellido"] = $r[0]->apellido;
			$_SESSION["user"] = $r[0]->nick;
			$_SESSION["id_usuario"] = $r[0]->id_usuario;
			$_SESSION["idperfil"] = $r[0]->id_perfil_usuario;
			$_SESSION["foto"] = $r[0]->foto;
			redirect("Principal_c","refresh");
			
		}
		else
		{
			redirect("Portal_c","refresh");
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */