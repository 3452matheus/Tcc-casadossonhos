<?php
    class User extends Conn {
        //Atributos da classe
        public object $conn;
        public array $formData;
        public int $id;
         //lista os arquiteto cadratados 
        public function list() :array {
            $this->conn = $this->conectar();
            $query = "SELECT u.* FROM cdarquiteto u ORDER BY nome";
            $result = $this->conn->prepare($query);
            $result->execute();
            $retorno = $result->fetchAll();
            //var_dump($retorno);
            return $retorno;
        }
        
       //lista de projeto na tela do inicio utilizado tabela relacionada em card 
        public function listImagesAndProjects() : array {
            $this->conn = $this->conectar();
            $query = "  SELECT p.id, p.nome, p.texto, i.nome_imagem, i.cda_nome, a.cau
        FROM projetos p
        LEFT JOIN imagens i ON p.id = i.idprojeto
        LEFT JOIN cdarquiteto a ON p.id_arquiteto = a.id";
            
            $result = $this->conn->prepare($query);
            $result->execute();
            $retorno = $result->fetchAll();
            return $retorno;
        }
      //fim-lista de projeto na tela do inicio utilizado tabela relacionada em card 
        


        //Só colocar a tipagem "bool", se no servidor tiver o php 8, caso contrario nao coloca.
        //inserindo os dados do arquiteto com senha criptografada 
        public function insert(): bool {
            $this->conn = $this->conectar();
            $senha_cripto = password_hash($this->formData['senha'],PASSWORD_DEFAULT);
            $query = "INSERT INTO cdarquiteto (nome,email,cau,senha) VALUES (:nome,:email,:cau,:senha)";
            $add_user = $this->conn->prepare($query);
            $add_user->bindParam(':nome', $this->formData['nome']);
            $add_user->bindParam(':email', $this->formData['email']);
            $add_user->bindParam(':cau', $this->formData['cau']);
            $add_user->bindParam(':senha',$senha_cripto);
            $add_user->execute();

            if ($add_user->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
           //fim-inserindo os dados do arquiteto com senha criptografada 

       
       
        
            //inserido os projetos e colocando diretametna na sua pasta 
            public function projeto(){
                $this->conn = $this->conectar();
                $cdarquiteto_id = $_SESSION['id'];
                var_dump($cdarquiteto_id);
                $query = "INSERT INTO projetos (nome,texto,id_arquiteto) VALUES (:nome,:texto,:id_arquiteto)";
                $add_user = $this->conn->prepare($query);
                $add_user->bindParam(':nome', $this->formData['nome']);
                $add_user->bindParam(':texto', $this->formData['texto']);
                $add_user->bindParam(':id_arquiteto',$cdarquiteto_id  );
                $add_user->execute();
              
                if ($add_user->rowCount()) {
                
                    $cdarquiteto_id = $this->conn->lastInsertId();
                    $cda_nome = $_SESSION['nome'];
                    $diretorio = "imagens/$cdarquiteto_id/";
                       
                    mkdir($diretorio,0755);
    
                    $arquivo = $_FILES['imagens'];
    
                    for($cont = 0; $cont < count($arquivo['name']);$cont++){
    
                        $nome_arquivo = $arquivo['name'][$cont];
                       
                     
                        $destino = $diretorio . $arquivo['name'][$cont];
    
                        if(move_uploaded_file($arquivo['tmp_name'][$cont],$destino )){
                            $query = "INSERT INTO imagens (nome_imagem,idprojeto,cda_nome) VALUES (:nome_imagem,:idprojeto,:cda_nome) ";
                            $add_user = $this->conn->prepare($query);
                            $add_user->bindParam(':nome_imagem',$nome_arquivo );
                            $add_user->bindParam(':idprojeto',$cdarquiteto_id);
                            $add_user->bindParam(':cda_nome',$cda_nome);
                            if( $add_user->execute()){
                                $_SESSION['msg'] = "<p style='color:green'>Projeto cadastrado com sucesso!</p>";
                            }else{
                                $_SESSION['msg'] = "<p style='color:red'>Ocorreu Erro!</p>";
                            }
                            $_SESSION['msg'] = "<p style='color:green'>foto cadastrado com sucesso!</p>";
                        }else{
                           $_SESSION['msg'] = "<p style='color:red'>Ocorreu Erro!</p>";
                      }
                   
                    }
                    if ($add_user->rowCount() > 0) {
                        return true;
                    } else {
                        return false;
                    }
                    }
             
                  
                }
            //fim-inserido os projetos e colocando diretametna na sua pasta 
        
        //login do  arquiteto 
        public function login(){
            $this->conn = $this->conectar();
            $query_usuario = "SELECT id,nome, email, senha FROM cdarquiteto 
            WHERE email =:email   LIMIT 1 ";
            $result_usuario = $this->conn->prepare($query_usuario);
            $result_usuario->bindParam(':email', $this->formData['email'],PDO::PARAM_STR); 
            $result_usuario->execute();
            if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                //var_dump($row_usuario);
                if(password_verify($this->formData['senha'], $row_usuario['senha'])){
                    $_SESSION['id'] = $row_usuario['id'];
                    $_SESSION['nome'] = $row_usuario['nome'];
                    header("Location:dashboard.php");
                  
                }else{
                   $_SESSION['msg'] = "<p style='color:red'> Erro:Usuario ou senha invalida</p>";
                }
            }else{
                $_SESSION['msg'] = "<p style='color:red'> Erro:Usuario ou senha invalida</p>";
            }
        }  
        //fim-login do  arquiteto 
  
         //login do  admin
        public function login2(){
            $this->conn = $this->conectar();
            $query_usuario = "SELECT id,nome,senha FROM adm
            WHERE nome =:nome  LIMIT 1 ";
            $result_usuario = $this->conn->prepare($query_usuario);
            $result_usuario->bindParam(':nome', $this->formData['nome'],PDO::PARAM_STR); 
            $result_usuario->execute();
            if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                var_dump($row_usuario);
               if(password_verify($this->formData['senha'], $row_usuario['senha'])){
                    $_SESSION['id'] = $row_usuario['id'];
                    $_SESSION['nome'] = $row_usuario['nome'];
                    header("Location:adm.php");
                  
                }else{
                   $_SESSION['msg'] = "<p style='color:red'> Erro:Usuario ou senha invalida</p>";
                }
            }else{
                $_SESSION['msg'] = "<p style='color:red'> Erro:Usuario ou senha invalida</p>";
           }
        }  


         //visualizar a tebela de castrado 
        public function view() {
            $this->conn = $this->conectar();
            $query = "SELECT * FROM cdarquiteto WHERE id = :id LIMIT 1";
            $result = $this->conn->prepare($query);
            $result->bindParam(':id', $this->id);
            $result->execute();
            $retorno = $result->fetch();
            return $retorno;
        }
        //fim visualizar a tebela de castrado 
        
        //editar a tabela de cadrastro do arquiteto 
        public function edit() : bool {
            $this->conn = $this->conectar();
            $query = "UPDATE cdarquiteto SET nome = :nome, email = :email, cpf = :cpf WHERE id = :id";
            $result = $this->conn->prepare($query);
            $result->bindParam(':nome', $this->formData['nome']);
            $result->bindParam(':email', $this->formData['email']);
            $result->bindParam(':cpf', $this->formData['cpf']);
            $result->bindParam(':id', $this->formData['id']);
            $result->execute();

            if ($result->rowCount()) {
                return true;
            } else {
                return false;
            }
        }
       //fim-editar a tabela de cadrastro do arquiteto
       
       //função para delatar o cadrastro do arquiteto 
        public function delete() : bool{
            $this->conn = $this->conectar();
            $query = "DELETE FROM cdarquiteto WHERE id = :id LIMIT 1";
            $result = $this->conn->prepare($query);
            $result->bindParam(':id', $this->id);
            $value = $result->execute();
            return $value;
        }
            //fim-função para delatar o cadrastro do arquiteto 
    }
    
    