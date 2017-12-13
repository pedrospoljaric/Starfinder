<?php
class Magus{
    private $servername;
    private $username;
    private $password;
    private $database;

    private $conn;

    # CONSTRUTOR/DESTRUTOR
    function __construct($servername, $username, $password, $database){
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->conn = null;
    }

    function __destruct(){
        $this->conn->close();
    }
    
    # FUNCOES DE EXPANÇÃO DO MYSQLI
    function bind_params(&$stmt, $parameters){
        $a_params[] = array();
        $a_params[0] = "";

        $params_type = "";
        for($i=0; $i < count($parameters); $i++){
            //armazena os ponteiros das variaveis, pq a chamda de funcao precisa de ponteiros parece
            $a_params[] = & $parameters[$i];
            $param = $parameters[$i];

            if(is_numeric($param))
                if(gettype($param) == "integer")
                    $params_type .= "i";
                else
                    $params_type .= "d";
            else if(is_bool($param))
                $params_type .= "i";
            else if(is_string($param))
                $params_type .= "s";
        }
        //o primeiro item do array tem que ser os tipos
        $a_params[0] = &$params_type;
        
        # só pra testar
        //echo '<pre>'; var_dump($a_params); echo '</pre>';
        
        //chama a funcao bind_param, passando os argumentos dela por meio de um array
        call_user_func_array(array($stmt, 'bind_param'), $a_params);
    }

    # FUNCOES DE MANIPULACAO DO BANCO
    function connect(){
        // Create connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } 
    }

    function execute($query, $parameters){
        $return = array();

        // prepare and bind
        $stmt = $this->conn->prepare($query);
        if($parameters != null)
            $this->bind_params($stmt, $parameters);

        $stmt->execute();

        if (preg_match('/SELECT/',strtoupper($query))){

            $result = $stmt->get_result();
    
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $return[] = $row;
                }
            }

        }else if (preg_match('/INSERT/', strtoupper($query))){

            $return["id"] = $this->conn->insert_id;

        }else if (preg_match('/DELETE/', strtoupper($query)) || preg_match('/UPDATE/', strtoupper($query))){

            $return["affected_rows"] = $this->conn->affected_rows;

        }


        $stmt->close();
        return $return;
    }

}

?>