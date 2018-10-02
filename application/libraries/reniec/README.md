# CONSULTA [RENIEC]
Obten los Nombres y apellidos de una Persona a partir de su Nro de DNI o CUI de cuidados Peruanos. puedes ver una demo [aqui].
### Metodo de Uso
```sh
<?php
    require ("./src/autoload.php");

    $reniec = new \Reniec\Reniec();
	
	$dni = "00000000";
	
    $persona = $reniec->search( $dni );
	
	if( $persona->success != false ) // si la busqueda es exitosa
	{
		echo "DNI: " . $persona->result->DNI . "-" . $persona->result->CodVerificacion . "<br>";
		echo "Nombre: " . $persona->result->Nombre . "<br>";
		echo "Apellido Paterno: " . $persona->result->Paterno . "<br>";
		echo "Apellido Materno: " . $persona->result->Materno . "<br>";
	}
	else // en caso de no encontrar resultados
	{
		echo $persona->msg;
	}
?>
```

### Instalacion mediante composer
```sh
	composer require -o "jossmp/reniec"
```

```sh
<?php
    require ("./vendor/autoload.php");
    ...
?>
```

[RENIEC]: <https://cel.reniec.gob.pe/valreg/valreg.do>
[aqui]: <https://demos.geekdev.ml/reniec/>
