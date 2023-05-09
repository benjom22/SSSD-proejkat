
<?php

require "vendor/autoload.php";

$openapi = \OpenApi\Generator::scan(['C:/Bitnami/wampstack-8.1.2-01/apache2/htdocs/sssd-2023-20002226/api']);

header('Content-Type: application/json');
echo $openapi->toJson();


?>