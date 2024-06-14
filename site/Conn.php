<?php
    abstract class Conn {
        public string $db = "mysql";
        public string $host = "localhost";
        public string $user = "root";
        public string $pass = "";
        public string $dbname = "site";
        public int $port = 3306;
        public object $connect;

        public function conectar() {
            try {
                //Conexao sem a porta
                $this->connect = new PDO($this->db . ':host=' . 
                $this->host . ';dbname='. $this->dbname, $this->user, 
                $this->pass);
                
                //echo "<span style='color:red'>Conexão com banco de dados realizado com sucesso</span>";
                return $this->connect;
            } catch (Exception $err) {
                die('Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador adm@empresa.com');
               
               
               //echo "Erro: Conexão com banco de dados não realizado com sucesso! Erro gerado: " . $err->getMessage();
            }
        }
    }