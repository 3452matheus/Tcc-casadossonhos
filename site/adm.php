<?php
    session_start();//inicializando a session/sessao
    ;//limpa os ultimos registro da session
   
    if((!isset( $_SESSION['id']))AND (!isset($_SESSION['nome']))){
        $_SESSION['msg'] = "<p style='color:red'> Erro:Necessario realizar o login para acessar a página!</p>";
    header("Location:admin.php");
    }
   
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/footers/">
    <link rel="shortcut icon" href="imagens/img-site/icon/casa_1.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
</head>

<body style="text-transform: uppercase;background-color:#33ccff;">
    <!-- barra de navegação-->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <!--fim da  mensagem -->
        <!-- nome no canto da barra de nevegação -->
        <a class="col-sm-4 font-weight-bold text-primary"> A casa do Sonho</a>
        <!--fim nome no canto da de nevegação -->

        <b style="color:white">Administrador, <?php echo  $_SESSION['nome']; ?></b>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado"
            aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
               
                
                <li class="nav-item active">

                    <button class="btn btn-danger"><a href="sair2.php" style="color:aliceblue"> Sair </a> </button>
                </li>

            </ul>
        </div>
    </nav>

    <!-- fim  de navegação-->
    <!-- projeto-->
    <div class="h1 text-center">Administrador</div>
 <div class="container">
     <div class="row">
     <?php
          require './Conn.php';
          require './User.php';
          $list = new User();
          $result = $list->();
            ?>
      <div class="container">
          <div class="row">
            <?php
    // Itera sobre os dados usando foreach
    foreach ($result as $row) {
      extract($row);
      echo '
        <div class="col-md-4 mb-3 ">
          <div class="card bg-info">
         
            <div class="card-body">
            <img  src="imagens/'.$cdarquiteto_id.'/'.$nome_imagem.'" alt="imagens" height="340" width="320">
            <h6 class="card-title">nome do projeto:'.$projeto_nome.'</h6>
              <h6 class="card-title">Explicação:'.$texto.'</h6>
              <ul class="nav nav-pills card-header-pills">
              <li class="nav-item p-3">
            <h6>nome do arquiteto:'.$imagem_cda_nome.'</h6>
            </div>
          </div>
        </div>
        
        ';
      }
      ?>
         <hr>
     </div>
     <div class="alert alert-dark" style="text-align: center;" role="alert">
         <a class="col-sm-4 font-weight-bold text-primary"> A casa do Sonho</a>
     </div>
 </div>
 </div>

 <!-- <div class="alert alert-danger" style="text-align: center;" role="alert">
fim da pagina 
</div> -->
 <!-- footer  pagina  -->
 <div class="alert alert-primary" role="alert" style="text-align: center;">
     FIM DA PAGINA!

 </div>
 </div>
   ?>
        

<!-- fim explicao  -->
</body>

</html>
