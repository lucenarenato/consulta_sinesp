<?php
require 'vendor/autoload.php';

use Sinesp\Sinesp;

$placas = file('raw_file.txt', FILE_IGNORE_NEW_LINES);
$placasAnalise = count($placas);

echo '
______________________________________________________________________________' . "\n\n" . 
'================== SCRIPT - CONSULTA DE DADOS DE VEÍCULOS ===================' . "\n\n" . 
'PLACAS A SEREM ANALISADAS: ' . $placasAnalise . "\n\n" . 'Iniciando script...' . "\n\n";

  $placasAnalisadas = 0;
  $placasValidas = 0;
  $placasInvalidas = 0;

  foreach($placas as $placa) {
    $veiculo = new Sinesp;

    try {
    $veiculo->buscar($placa);
    
      if ($veiculo->existe()) {
        //print_r($veiculo->dados());
        echo 'Analisando placa: ' . $placa . " ┐ \n";
        echo '                           ├── Modelo: ' . $veiculo->modelo . "\n";
        echo '                           ├── Marca: ' . $veiculo->marca . "\n";
        echo '                           ├── Cor: ' . $veiculo->cor . "\n";
        echo '                           ├── Ano de fabricação: ' . $veiculo->ano . "\n";
        echo '                           ├── Ano do modelo: ' . $veiculo->anoModelo . "\n";
        echo '                           ├── Estado: ' . $veiculo->uf . "\n";        
        echo '                           ├── Município: ' . $veiculo->municipio . "\n";
        echo '                           └── Chassi: ' . $veiculo->chassi . "\n\n";

        file_put_contents('good_file.csv', 
          $placa . ',' . 
          $veiculo->codigoRetorno . ',' . 
          $veiculo->codigoSituacao . ',' . 
          $veiculo->situacao . ',' . 
          $veiculo->modelo . ',' . 
          $veiculo->marca . ',' . 
          $veiculo->cor . ',' . 
          $veiculo->ano . ',' . 
          $veiculo->anoModelo . ',' . 
          $veiculo->uf . ',' . 
          $veiculo->municipio . ',' .  
          $veiculo->chassi . ',' . 
          date("Y-m-d H:i:s") . 
          "\n", FILE_APPEND);

        $placasAnalisadas++;
        $placasValidas++;
      }
    
    } catch (\Exception $e) {
    echo $e->getMessage();
    file_put_contents('bad_file.csv', 
      $placa . ',' . 
      date("Y-m-d H:i:s") . 
      "\n", FILE_APPEND); 

    $placasAnalisadas++;
    $placasInvalidas++;
    }
    //sleep(60);
  }

$placasValidasArquivo = count(file('good_file.csv'))-1;
$placasInvalidasArquivo = count(file('bad_file.csv'))-1;

echo "\n" . 'TOTAL DE PLACAS ANALISADAS NESTE LOTE: ' . $placasAnalisadas . "\n";
echo 'TOTAL DE PLACAS VÁLIDAS NESTE LOTE: ' . $placasValidas . "\n";
echo 'TOTAL DE PLACAS INVÁLIDAS NESTE LOTE: ' . $placasInvalidas . "\n";
echo 'TOTAL DE PLACAS VÁLIDAS NO ARQUIVO: ' . $placasValidasArquivo . "\n";
echo 'TOTAL DE PLACAS INVÁLIDAS NO ARQUIVO: ' . $placasInvalidasArquivo . "\n";
echo "_____________________________________\n\n";
echo "Dados de placas VÁLIDAS inseridos em 'good_file.csv'.\n";
echo "Dados de placadas INVÁLIDAS inseridos em 'bad_file.csv.'";
