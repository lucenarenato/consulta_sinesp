<?php

require 'vendor/autoload.php';

use Sinesp\Sinesp;

$veiculo = new Sinesp;

try {
    $veiculo->buscar('NEP-9502');
    if ($veiculo->existe()) {
        print_r($veiculo->dados());
        echo 'O ano do veiculo eh ' , $veiculo->anoModelo, PHP_EOL;
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
