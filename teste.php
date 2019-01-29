<?php
  // Desenvolvido Para fins EDUCATIVOS.
  // Criado em 12/11/2014
  // Contato: putyoe@hotmail.com
  $placa   = 'NEP9502';
  $token = hash_hmac('sha1', $placa, 'shienshenlhq', false);
  $request = '<?xml version="1.0" encoding="utf-8" standalone="yes" ?>'
          . '<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" '
          . 'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" '
          . 'xmlns:xsd="http://www.w3.org/2001/XMLSchema" >'
          . '<soap:Header>'
          . '<dispositivo>GT-S1312L</dispositivo>'
          . '<nomeSO>Android</nomeSO>'
          . '<versaoAplicativo>1.1.1</versaoAplicativo><versaoSO>4.1.4</versaoSO>'
          . '<aplicativo>aplicativo</aplicativo><ip>177.206.169.90</ip>'
          . '<token>'.$token.'</token>'
          . '<latitude>-3.6770324</latitude><longitude>-38.6791411</longitude></soap:Header><soap:Body><webs:getStatus xmlns:webs="http://soap.ws.placa.service.sinesp.serpro.gov.br/"><placa>'.$placa.'</placa></webs:getStatus></soap:Body></soap:Envelope>';


  $header = array(
    "Content-type: application/x-www-form-urlencoded; charset=UTF-8",
    "Accept: text/plain, */*; q=0.01",
    "Cache-Control: no-cache",
    "Pragma: no-cache",
    "x-wap-profile: http://wap.samsungmobile.com/uaprof/GT-S7562.xml",
    "Content-length: ".strlen($request),
    "User-Agent: Mozilla/5.0 (Linux; U; Android 4.1.4; pt-br; GT-S1162L Build/IMM76I) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30",
  );

  $soap_do = curl_init();
  curl_setopt($soap_do, CURLOPT_URL, "https://sinespcidadao.sinesp.gov.br/sinesp-cidadao/ConsultaPlacaNovo" );
  curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
  curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
  curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($soap_do, CURLOPT_POST,           true );
  curl_setopt($soap_do, CURLOPT_POSTFIELDS, $request);
  curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $header);
  $res = curl_exec($soap_do);
  if($res === false)
  {
    $err = 'Curl erro: ' . curl_error($soap_do);
    curl_close($soap_do);
    print $err;
  }
  else
  {
    echo $res;
    curl_close($soap_do);
    print 'Ocorreu um erro...';
  }


