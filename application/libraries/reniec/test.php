<?php
	require ("./src/autoload.php");
	//require ("./vendor/autoload.php");
	
	$persona = new \Reniec\Reniec();
	$dni="45154521";
	var_dump( $persona->search($dni) );
	
	// ---------- json
	echo $persona->search($dni, true);
	
	// ---------- 
	$yo = $persona->searchReniec( $dni );
	if($yo!=false)
	{
		$Nombre 			= $yo["Nombre"];
		$Paterno 			= $yo["Paterno"];
		$Materno 			= $yo["Materno"];
		$dni 				= $yo["DNI"];
		$CodVerificacion 	= $yo["CodVerificacion"];
	}
?>
