  <?php
  require 'vendor/autoload.php';
  $reniecDni = new Tecactus\Reniec\DNI('DJq6wHc3b3Zf14eOuKNkEAQMM8RAVm4dJ03ztFAP');
  print_r($reniecDni->get('10388298', true));
  ?>