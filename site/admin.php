<?php
    session_start();//inicializando a session/sessao
    ob_start();//limpa os ultimos registro da session
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>casa do sonho</title>
    <link rel="shortcut icon" href="imagens/img-site/icon/casa_1.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body style="text-transform: uppercase;">
    <!-- nav bar -barra de navegação -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <!-- mensagem -->

        <!--fim da  mensagem -->
        <!-- nome no canto da barra de nevegação -->
        <a class="col-sm-4 font-weight-bold text-primary" href="index.php"> A casa do Sonho</a>
        <!--fim nome no canto da de nevegação -->

        <!--menu da barra de navegação  -->
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
                
              
            <li class="nav-item">
                    <a class="nav-link" href="cadadm.php">cadrastro Administrador</a>
                </li>
              

            </ul>

        </div>
    </nav>
    <!-- fim da barra de menu -->
    <br></br>
    <div class="h1 text-center">login Administrador</div>
    <div class="container ">
        <div class=" border border-success shadow-lg p-3 mb-5 bg-white rounded">
            <?php
    if (isset($_SESSION['msg'])) {
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
     }

   ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="exampleInputEmail1">nome</label>
                    <input type="texto" class="form-control" name="nome" aria-describedby="emailHelp"
                        placeholder="Digite seu email"
                        value="<?php if(isset($formData['nome'])){echo $formData['email'];}?>">

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">senha</label>
                    <input type="password" class="form-control" name="senha" placeholder="DIgite sua senha"
                        value="<?php if(isset($formData['senha'])){echo $formData['senha'];}?>">
                </div>

                <input type="submit" class="btn btn-primary" value="Acessar" name="SandLogin">
            </form>
        </div>

    </div>






























    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
require './Conn.php';
require './User.php';
$formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
      if(!empty($formData['SandLogin'])){
        //var_dump($formData);
        $insertUser = new User();
       $insertUser->formData = $formData;
       $insertUser->login2();
       

}
?>