<?php

class ApiLogic{

    private $endpoint;
    private $params;

    //----------------------------
    public function __construct($endpoint, $params = null){
        //definindo as propriedades da classe/objeto
        $this->endpoint = $endpoint;
        $this->params = $params;
    }
    
    public function endpoint_exists(){
         //Checando se o endpoint é um método válido

         return method_exists($this, $this->endpoint); //o method_exists permite pesquisar se existe um método dentro de uma classe ou um objeto
    }

    //-----------------------------
    // ENDPOINTS
    //-----------------------------
    public function status(){
        return [
            'status' => 'SUCESSO',
            'message' => 'API is running ok!'
        ];
    }

    //-------------------------------
    public function get_all_clients(){

        //retornando os usuarios cadastrados no banco de dados

        $db = new DataBase();
        $results = $db->consultaSelect("SELECT * FROM users");

        return [
            'status' => 'SUCESSO',
            'message' => '',
            'results' => $results,
            ];
    }


}
?>