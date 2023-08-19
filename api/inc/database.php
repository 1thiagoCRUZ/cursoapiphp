<?php
class DataBase{

    //Função usada apenas para consultas usando o SELECT
    public function consultaSelect($query, $parameters = null, $debug = true, $close_connection = true){

        $results = null;

        //fazendo a conexão
        $conexao = new PDO(
            'mysql :host='.DB_SERVER.
            ';dbname='.DB_NAME.
            ';'.DB_USERNAME, 
            DB_PASSWORD,
            array(PDO::ATTR_PERSISTENT => true)
        );

            if($debug){
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            }

            //executando
            try{
                if($parameters != null){
                    $gestor = $conexao->prepare($query);
                    $gestor->execute($parameters);
                    $results = $gestor->fetchAll(PDO::FETCH_ASSOC);
                }else {
                    $gestor = $conexao->prepare($query);
                    $gestor->execute();
                    $results = $gestor->fetchAll(PDO::FETCH_ASSOC);
                }
            } catch (PDOException $e){
                return false;
            }

            //fechando a conexão
            if($close_connection){
                $conexao = null;
            }
            return $results;
    }

    //=============================================================================

    //Faz consultas e as operações de Insert, Update, Delete
    public function consultaIUD($query, $parameters = null, $debug = true, $close_connection = true){
        //conexão
        $conexao = new PDO(
            'mysql :host='.DB_SERVER.
            ';dbname='.DB_NAME.
            ';'.DB_USERNAME, 
            DB_PASSWORD,
            array(PDO::ATTR_PERSISTENT => true));

            //executando
            $conexao->beginTransaction();
            try {
                if($parameters != null){
                    $gestor = $conexao->prepare($query);
                    $gestor->execute($parameters);
                } else{
                    $gestor = $conexao->prepare($query);
                    $gestor->execute();
                }
                $conexao->commit();
            } catch (PDOException $e){
                $conexao->rollBack();
                return false;
            }

            //fechando a conexão
            if($close_connection){
                $conexao = null;
            }
            return true;
    }
}
?>