<?php

//Dependências
require_once(dirname(__FILE__) . '/inc/config.php');
require_once(dirname(__FILE__) . '/inc/api_response.php');
require_once(dirname(__FILE__) . '/inc/api_logic.php');
require_once(dirname(__FILE__) . '/inc/database.php');


//Instância da ApiResponse
$api_response = new ApiResponse();

//Checando o método e ve se ele é válido
if(!$api_response->check_method($_SERVER['REQUEST_METHOD'])){
    //enviando a mensagem de erro
    $api_response->api_request_error('Método inválido!!');
}

//Definindo o metodo na request
$api_response->set_method($_SERVER['REQUEST_METHOD']);
$params = null;
if($api_response->get_method() == 'GET'){
    $api_response->set_endpoint($_GET['endpoint']);
    $params = $_GET;
} 
else if($api_response->get_method() == 'POST'){
    $api_response->set_endpoint($_POST['endpoint']);
    $params = $_POST;
}

// ---------------------------------------------
// Preparando a lógica da API
$api_logic = new ApiLogic($api_response->get_endpoint(), $params);

// ---------------------------------------------
// Checar se o endpoint existe
if(!$api_logic->endpoint_exists()){
    $api_response->api_request_error('Endpoint inexistente: '. $api_response->get_endpoint());
}

// Fazendo a requisição a api_logic
$result = $api_logic->{$api_response->get_endpoint()}(); //Buscando o nome do endpoint colocando dentro da função e executando o método pedido
$api_response->add_to_data('data', $result);

$api_response->send_response();

// $api_response->send_api_status();
 
?>