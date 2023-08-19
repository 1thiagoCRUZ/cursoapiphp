<?php

//Dependencias
require_once('inc/config.php');
require_once('inc/api_functions.php');



// $results = api_request('status', 'GET');
// print_r($results);

$results = api_request('get_all_clients', 'GET');
// echo '<pre>';
// print_r($results);

foreach($results['data']['results'] as $client){
    echo $client['nome'] . ' - ' . $client['email'];
}
?>