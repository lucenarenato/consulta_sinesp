# Consulta de Placas - Sinesp

Script PHP que realiza consulta em massa de placas no Sinesp - Sistema Nacional de Informações de Segurança Pública (http://sinesp.gov.br).

# SINESP Client [![PyPI Version](https://img.shields.io/pypi/v/sinesp-client.svg)](https://pypi.python.org/pypi/sinesp-client)

SINESP Client torna possível a consulta da base de dados do SINESP Cidadão sem a necessidade do preenchimento de captchas ou algum outro tipo de autenticação.



## O que é o SINESP

SINESP Cidadão é uma base de dados pública de veículos brasileiros. É muito útil para identificar carros ou motos roubados ou suspeitos.

### Requisitos:
- PHP 5.4 ou superior;
- cURL;
- libxml / XML.

### Como usar:
  - Clone este repositório:
    ```sh
    $ git clone https://github.com/VitorSavedra/consultaPlacaSinesp.git
    ```
  - Instale as dependências:
    ```sh
    $ composer install
    $ composer require chapeupreto/sinesp
    ```
  - Insira as placas a serem consultas em 'raw_file.txt', separadas por linha;
  - Execute 'getVehicleFromFile.php':
    ```sh
    $ php getVehiclesFromFile.php
    ```

### Funcionamento: 
Após executar o script, os resultados serão exibidos no terminal e salvos em dois arquivos, onde:

- bad_file.csv - Resultados de placas **não** encontradas;
- good_file.csv - Resultados de placas encontradas.

### Limites:
Não encontrei em qualquer site e nem mesmo obtive resposta do Sinesp quanto à limites na API. Na prática, encontrei bloqueios após ~60 requisições por minuto.

### Agradecimentos:
Agradecimentos ao @chapeupreto, @victor-torres e seus contribuidores por disponibilizar as APIs necessárias para este script.

### Informações
https://libraries.io/packagist/chapeupreto%2Fsinesp
SINESP Cidadão é uma base de dados pública de veículos brasileiros muito útil para identificar carros ou motos roubados ou suspeitos.

### Informações Disponíveis
Se um veículo com a placa especificada for encontrado, o servidor irá retornar com as seguintes informações:

codigoRetorno: código de retorno da consulta
mensagemRetorno: mensagem de retorno da consulta
codigoSituacao: código da situação do veículo
situacao: mensagem da situação do veículo
modelo: modelo do veículo
marca: marca do veículo
cor: cor do veículo
ano: ano de fabricação do veículo
anoModelo: ano do modelo do veículo
placa: placa consultada
data: data e hora da consulta
uf: estado ou unidade federativa do veículo
municipio: município ou cidade do veículo
chassi: chassi do veículo
dataAtualizacaoCaracteristicasVeiculo: data atualização das características do veículo
dataAtualizacaoRouboFurto: data atualização de informações sobre roubo ou furto
dataAtualizacaoAlarme:
Essas informações estarão disponíveis por meio de um array associativo ou como atributo do objeto.

Utilização
Abaixo um exemplo simples e geral de utilização da biblioteca:
```sh
<?php

require 'vendor/autoload.php';

use Sinesp\Sinesp;

$veiculo = new Sinesp;

try {
    $veiculo->buscar('GWW-6471');
    if ($veiculo->existe()) {
        print_r($veiculo->dados());
        echo 'O ano do veiculo eh ' , $veiculo->anoModelo, PHP_EOL;
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
```
O método buscar() deve ser o primeiro método a ser invocado. Esse método é empregado para localizar informações do veiculo com a placa informada.

Após a chamada ao método buscar(), o método dados() irá retornar um array associativo contendo todas as informações do veículo.

Ainda, ao invés de utilizar todo o array retornado pelo método dados(), pode-se também recuperar uma informação isoladamente acessando-a como atributo do objeto:

echo 'O municipio do veiculo é ', $veiculo->municipio;

- Renato Lucena 2019


