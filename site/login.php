<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa do Sonho</title>
    <link rel="shortcut icon" href="imagens/img-site/icon/casa_1.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            text-transform: uppercase;
        }
        .navbar-brand {
            font-weight: bold;
            color: #ffcc00;
        }
        .navbar-brand:hover {
            color: #ffc107;
        }
        .nav-link {
          
            color: #ffffff !important;
        }
        .nav-link:hover {
            color: #ffc107 !important;
        }
        .form-container {
            border: 1px solid #28a745;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            background-color: #ffffff;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="index.php">A Casa do Sonho</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                <a class="nav-link font-weight-bold">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="caduser.php">Cadastro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sobre.php">Sobre Nós</a>
                </li>
                <li class="nav-item">
                    <?php if (isset($_SESSION['id']) && isset($_SESSION['nome'])): ?>
                        <a class="nav-link" href="dashboard.php">Cadastro-Projetos</a>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <?php if (isset($_SESSION['id']) && isset($_SESSION['nome'])): ?>
                        <button class="btn btn-danger">
                            <a href="sair.php" style="color: aliceblue; text-decoration: none;">Sair</a>
                        </button>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Main Content -->
    <div class="container mt-5 pt-5">
        <div class="h1 text-center">Login do Arquiteto</div>
        <div class="form-container shadow-lg p-3 mb-5 bg-white rounded">
            <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
            ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Digite seu email"
                        value="<?php if (isset($formData['email'])) { echo $formData['email']; } ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Senha</label>
                    <input type="password" class="form-control" name="senha" placeholder="Digite sua senha"
                        value="<?php if (isset($formData['senha'])) { echo $formData['senha']; } ?>">
                </div>
                <input type="submit" class="btn btn-primary" value="Acessar" name="SandLogin">
            </form>
        </div>
    </div>
    <!-- End Main Content -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <!-- End Scripts -->
</body>

</html>
<?php
require './Conn.php';
require './User.php';

$formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($formData['SandLogin'])) {
    $insertUser = new User();
    $insertUser->formData = $formData;
    $insertUser->login();
}
?>
