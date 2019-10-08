# SimFrete
Api de integração com SimFrete

## Instalação
```composer require bdti/sim-frete```


## Uso
````php
<?php

require "vendor/autoload.php";

$wsEmp = "YOUR_EMP";
$wsUsr = "YOUR_USER";
$wsPwd = "YOUR_PASS";

$api = new \BDTI\SimFrete\Api($wsEmp, $wsUsr, $wsPwd);

$ocorrencias = $api->track('123');

var_dump($ocorrencias);
````
