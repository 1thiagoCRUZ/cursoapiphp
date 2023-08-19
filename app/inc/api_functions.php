<?php


//Definindo o GET como padrão
function api_request($endpoint, $method = 'GET', $variaveis = []){

    //iniciando o curl client
    $client = curl_init();

    curl_setopt($client, CURLOPT_RETURNTRANSFER, true); //vai retornar resposta em formato de string

    //definindo a url inicial
    $url = API_BASE_URL;

    //Se o request for do tipo GET
        //Vai construir a URL com a query string completa
    if($method == 'GET'){
        $url .= "?endpoint=$endpoint";
        if(!empty($variaveis)){
            $url .= "&" . http_build_query($variaveis);
        }
    }

    //Se o request for do tipo POST
        //Vai manter a URL BASE mas vai adicionar ao request as variaveis através do POSTFIELDS
    if($method == 'POST'){
        $variaveis = array_merge(['endpoint'=> $endpoint], $variaveis);
        curl_setopt($client, CURLOPT_POSTFIELDS, $variaveis);
    }

    curl_setopt($client, CURLOPT_URL, $url);

    $response = curl_exec($client);
    return json_decode($response, true);

}

?>