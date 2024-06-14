<?php
    session_start();//inicializando a session/sessao
    ob_start();//limpa os ultimos registro da session

    if ((!isset($_SESSION['id'])) && (!isset($_SESSION['nome']))) {
        $_SESSION['msg'] = "<p style='color:red'>Erro: Necessário realizar o login para acessar a página!</p>";
        header("Location:login.php");
        exit();
    }
   
    
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa do Sonho</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/footers/">
    <link rel="shortcut icon" href="imagens/img-site/icon/casa_1.ico" type="image/x-icon">
    <style>
        body {
            text-transform: uppercase;
        }

        .navbar-brand {
            font-weight: bold;
            color: #ffcc00;
        }

        .nav-link {
            color: #fff !important;
        }

        .nav-link:hover {
            color: #ffcc00 !important;
        }

        .btn-danger a {
            color: #fff !important;
            text-decoration: none;
        }

        .btn-danger a:hover {
            color: #ffcc00 !important;
        }

        .container h1 {
            margin-top: 20px;
            color: #fff;
        }

        .form-group label {
            color: #fff;
        }

        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>

<body >
    <!-- barra de navegação-->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">A Casa do Sonho</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Lista de Projetos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sobre.php">Sobre Nós</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-danger"><a href="sair.php">Sair</a></button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="text-white">
            Bem Vindo, <?php echo $_SESSION['nome']; ?>
        </div>
    </nav>

    <!-- fim  de navegação-->
    <!-- projeto-->
    <div class="container">
        <h1 class="text-center">Projetos</h1>
         <?php
         if (isset($_SESSION['msg'])) {
             echo $_SESSION['msg'];
             unset($_SESSION['msg']); }
        ?>
         <div class="h1 text-center">cadrastar o meu projetos</div>
        <div class=" border border-success shadow-lg p-3 mb-5 bg-white rounded">

            <form action="" method="post" enctype="multipart/form-data">
                <!-- foto do projeto -->
                <div class="form-group">
                    <label for="exampleFormControlFile1">ensira foto do projeto</label>
                    <input type="file" name="imagens[]" class="form-control-file" multiple="multiple"
                        id="exampleFormControlFile1">
                </div> 
                <!-- fim foto  -->
                <!-- nome -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Nome do projeto</span>
                    </div>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome do projeto"
                        aria-label="nome" aria-describedby="basic-addon1">
                </div>
                <!-- fim nome -->
                <!-- explicao -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">explicação do projeto </span>
                    </div>
                    <textarea type="text" class="form-control" name="texto" class="form-control"
                        placeholder="Explicar sobre seu projeto" id="text" rows="3"></textarea>
                </div>

                <!-- fim explicao  -->

                <input type="submit" class="btn btn-primary" value="Salvar" name="salvar">
            </form>
        </div>
    </div>
    <br></br>
<!-- tabela  
        <div class="container"style="text-align:center">
        <div class="" >
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                                <tr>
                                    <td ><b>panel de controle</b> </td>
                                    <td>                                   
                                        <a class="btn btn-success" href="view.php?id=<?php echo $id;?>">meu projeto ja feito</a>
                                        
                                    </td>
                                </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 fim explicao  -->
</body>

</html>
<?php
    /* Código para Cadastrar */
    require './Conn.php';
    require './User.php';
   
    $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
   
   
    if (!empty($formData['salvar'])) {
       
        $insertUser = new User();
        $insertUser->formData = $formData;
        $valor = $insertUser->projeto();
       
        if ($valor) {
            $_SESSION['msg'] = "<p style='color:green'>Registro cadastrado com sucesso!</p>";
            header("Location: index.php");
        } else {
            $_SESSION['msg'] = "<p style='color:red'>Ocorreu um erro!</p>";
        }
    }
   
?>