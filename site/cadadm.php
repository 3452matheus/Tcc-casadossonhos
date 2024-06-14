<?php
    session_start();//inicializando a session/sessao
    ob_start();//limpa os ultimos registro da session
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>casa do sonho</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" href="imagens/img-site/icon/casa_1.ico" type="image/x-icon">
</head>

<body style="text-transform: uppercase;">
    <!-- nav bar -barra de navegação -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <!-- mensagem -->
        <?php
        if (isset($_SESSION['msg'])) {//pergunto se tem valor dentro da session
         echo $_SESSION['msg'];//exibe o conteudo da session
        unset($_SESSION['msg']);//mata a session 
      }
   ?>
        <!--fim da  mensagem -->
        <!-- nome no canto da barra de nevegação -->
        <a class="col-sm-4 font-weight-bold text-primary"> A casa do Sonho</a>
        <!--fim nome no canto da de nevegação -->

        <!--menu da barra de navegação  -->
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link font-weight-bold">cadrastro(Pagina atual) </a>
                </li>
                
                
                <li class="nav-item">
                    <a class="nav-link" href="loginadm.php">login Administrador</a>
                </li>
                <li class="nav-item">
                    <?php
       if (isset($_SESSION['id']) && isset($_SESSION['nome'])) {
    // Usuário está conectado
    echo '<a class="nav-link" href="dashboard.php">cadastro-projetos</a>';
} 
?>
                </li>
                <li class="nav-item">
                    <?php
       if (isset($_SESSION['id']) && isset($_SESSION['nome'])) {
    // Usuário está conectado
    echo ' <button class="btn btn-danger"  ><a href="sair.php" style="color:aliceblue"> Sair </a> </button>  ';
} 
?>
                </li>

            </ul>

        </div>
    </nav>
    <!-- fim da barra de menu -->
    <br><br>
    <div class="h1 text-center">Cadastrar Do Arquiteto</div>
    <div class="container ">
        <div class=" border border-success shadow-lg p-3 mb-5 bg-white rounded">
            <form action="" method="post">
                <!-- nome -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Nome</span>
                    </div>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite seu Nome"
                        aria-label="nome" aria-describedby="basic-addon1" require>
                </div>

               
                <!-- senha -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">SENHA</span>
                    </div>
                    <input type="number" name="senha" id="senha" class="form-control" placeholder="Digite seu senha"
                        aria-label="senha" aria-describedby="basic-addon1" require>
                </div>
                <input type="submit" class="btn btn-primary" value="Salvar" name="salvar">
            </form>
        </div>

        <!-- Bootstrap JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>

</html>
<?php
    /* Código para Cadastrar */
    require './Conn.php';
    require './User.php';
   
    $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
   
   
    if (!empty($formData['salvar'])) {
        //var_dump($formData);
        $insertUser = new User();
        $insertUser->formData = $formData;
        $valor = $insertUser->insert();
       
        if ($valor) {
            $_SESSION['msg'] = "<p style='color:green'>Registro cadastrado com sucesso!</p>";
            header("Location: admin.php");
        } else {
            $_SESSION['msg'] = "<p style='color:red'>Ocorreu Erro!</p>";
        }
    }
?>