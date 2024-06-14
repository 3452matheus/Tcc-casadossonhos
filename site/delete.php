<?php
    //guarda valores em memoria, p/ poder acessar em qq pág. do site
    session_start();
    ob_start();
    //Receber o id da URL
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    //Verificar se o id possui valor
    if (!empty($id)) {
        //Incluir os arquivos
        require './Conn.php';
        require './User.php';
        //Instanciar a classe e criar o objeto
        $deleteUser = new User();
        //Enviar o id para o atributo da classe User
        $deleteUser->id = $id;
        //Instanciar o metodo apagar
        $value = $deleteUser->delete();

        if ($value) {
            $_SESSION['msg'] = 
            "<p style='color: green;'>Usuário apagado com sucesso!</p>";
            header("Location: index.php");
        } else {
            $_SESSION['msg'] = 
            "<p style='color: #f00;'>Erro: Usuário não apagado com sucesso!</p>";
            header("Location: index.php");
        }
    } else {
        $_SESSION['msg'] = 
        "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
        header("Location: index.php");
    }