<?php
    session_start();//inicializando a session/sessao
    ob_start();//limpa os ultimos registro da session
   
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagens/img-site/icon/casa_1.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/footers/">
    <title>CASA DO SONHO</title>
    <style>
        .imagem {
            width: 50%;
            height: 50%;
        }

        .navbar-brand {
            font-weight: bold;
            color: #00f;
        }

        .carousel-inner img {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card {
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card-body {
            padding: 15px;
        }

        .alert {
            margin-top: 20px;
            border-radius: 10px;
        }

        footer {
            margin-top: 30px;
            padding: 10px 0;
            background-color: #f8f9fa;
            text-align: center;
        }
    </style>
</head>

<body style="text-transform: uppercase;">


    <!-- nav bar -barra de navegação -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark ">
        <!-- mensagem -->
          <!-- nome no canto da barra de navegação -->
        <a class="navbar-brand" href="#">A casa do Sonho</a>
        <!-- fim nome no canto da de navegação -->
        
        

        <!--menu da barra de navegação  -->
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link font-weight-bold">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sobre.php">sobre nos</a>
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

    <br></br>
    <!-- jumbotron  -->
    <!-- especificar o site e pouco do site  -->

    <div class="container mt-5 pt-5">
        <?php
        if (isset($_SESSION['msg'])) {//pergunto se tem valor dentro da session
         echo $_SESSION['msg'];//exibe o conteudo da session
        unset($_SESSION['msg']);//mata a session 
      }
       ?>

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>

            </ol>
            <div class="">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" class="imagens" src="imagens/monique/12.jpg" alt="1 slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" class="imagens" src="imagens/monique/2.jpg" alt="2 slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" class="imagens" src="imagens/monique/6.jpg" alt="3 slide">
                    </div>


                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    
        <br></br>
        <!-- card -->
        <!-- informação e foto da planta baixa  -->

        <?php
require './Conn.php';
require './User.php';

$list = new User([]);
$result = $list->listImagesAndProjects();
$projects = [];

foreach ($result as $row) {
    $projects[$row['id']]['nome'] = $row['nome'];
    $projects[$row['id']]['texto'] = $row['texto'];
    $projects[$row['id']]['cau'] = $row['cau'];
    $projects[$row['id']]['cda_nome'] = $row['cda_nome'];
    $projects[$row['id']]['imagens'][] = [
        'nome_imagem' => $row['nome_imagem']];
}
?>

<div class="container">
    <div class="row">
        <?php foreach ($projects as $project_id => $project): ?>
            <div class="col-md-4 mb-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <div id="carouselProject<?php echo $project_id; ?>" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($project['imagens'] as $index => $imagem): ?>
                                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                        <img src="imagens/<?php echo $project_id . '/' . $imagem['nome_imagem']; ?>" class="d-block w-100" alt="...">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselProject<?php echo $project_id; ?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselProject<?php echo $project_id; ?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <h6 class="card-title mt-2">Nome do projeto: <?php echo $project['nome']; ?></h6>
                        <h6 class="card-title">Explicação: <?php echo $project['texto']; ?></h6>
                        <h6 class="card-title">nome do arquiteto: <?php echo $project['cda_nome']; ?></h6>
                        <h6 class="card-title">CAU: <?php echo $project['cau']; ?></h6>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
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
        <!-- footer fim da pagina  -->





























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