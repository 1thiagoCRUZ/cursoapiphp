<?php

class ApiResponse{
    private $data;
    private $metodosAvaliados = ['GET', 'POST'];
    //======================================================

    //Iniciação de resposta
    public function __construct(){
        $this->data = [];
    }
    //======================================================

    public function check_method($method){
        //Checando se é um método válido
        return in_array($method, $this->metodosAvaliados);
    }
    //======================================================

    public function set_method($method){
        //definindo o método
        $this->data['method'] = $method;
    }
    //======================================================

    public function get_method(){
        //retornando o método GET
        return $this->data['method'];
    }
    //======================================================

    public function set_endpoint($endpoint){
        //definindo o endpoint
        $this->data['endpoint'] = $endpoint;
    }

    public function get_endpoint(){
        //retornando current request endpoint definido acima
        return $this->data['endpoint'];
    }
    //======================================================

    public function add_to_data($key, $value){
        //Adicionando nova key ao data
        $this->data[$key] = $value;
    }


    public function api_request_error($message = ''){

        $data_error = [
            'status' => 'ERROR',
            'message' => $message
        ];

        $this->data['status'] = $data_error;
        $this->send_response();
    }
    //======================================================

    public function send_api_status(){
        $this->data['status'] = 'SUCESSO';
        $this->data['message'] = 'API is running ok!';
        $this->send_response();
    }
    //======================================================

    public function send_response(){
        header("Content-Type:application/json");
        echo json_encode($this->data);
        die(1);
    }
}

?>