<?php 
    session_start();
    ob_start();
 

    //Receber o id do usuario
    $id = filter_input(INPUT_GET,"i.id", FILTER_SANITIZE_NUMBER_INT);
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RRSECCO - CRUD</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <a class="btn btn-primary mt-5" href="index.php">Listar</a>
        <a class="btn btn-primary mt-5" href="caduser.php">Cadastrar</a><br><br>
        <div class="h1 text-center">Detalhes do Usuário</div>
        <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }

            //verificar se o id possui valor
            if (!empty($id)) {
                //Incluir os arquivos
                require './Conn.php';
                require './User.php';
                $viewUser = new User();//Instanciar a classe e criar o objeto
                $viewUser->id = $id;//Enviando o id para o atributo id da classe User
                //Instanciando o metodo visualizar
                $valueUser = $viewUser->view2();//chamando o método view da class User
                extract($valueUser);//extraindo os dados
                echo "<div class='col-sm-12 display-5'>";
                echo "<span><b>ID:</b> $id </span><br>";
                echo "<span><b>Nome:</b> $nome </span><br>";
               
               
                echo "</div>";
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>
                                        Erro: Usuário não encontrado!
                                    </p>";
                header("Location: index.php");
            }
        ?>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>