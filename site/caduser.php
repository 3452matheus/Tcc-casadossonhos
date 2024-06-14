<?php
    session_start(); // Inicializando a sessão
    ob_start(); // Limpa os últimos registros da sessão
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa do Sonho</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" href="imagens/img-site/icon/casa_1.ico" type="image/x-icon">
    <style>
        body {
            text-transform: uppercase;
        }
        .navbar-brand {
           
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
                    <a class="nav-link font-weight-bold">Cadastro </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sobre.php">Sobre Nós</a>
                </li>
                <?php if (isset($_SESSION['id']) && isset($_SESSION['nome'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Cadastro-Projetos</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-danger">
                            <a href="sair.php" style="color: aliceblue; text-decoration: none;">Sair</a>
                        </button>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Main Content -->
    <div class="container mt-5 pt-5">
        <div class="h1 text-center">Cadastrar do Arquiteto</div>
        <div class="form-container shadow-lg p-3 mb-5 bg-white rounded">
            <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
            ?>
            <form action="" method="post">
                <!-- Nome -->
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite seu Nome" required>
                </div>
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Digite seu E-mail" required>
                </div>
                <!-- CAU -->
                <div class="mb-3">
                    <label for="cau" class="form-label">CAU</label>
                    <input type="number" name="cau" id="cau" class="form-control" placeholder="Digite seu CAU" required>
                </div>
                <!-- Senha -->
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" placeholder="Digite sua Senha" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Salvar" name="salvar">
            </form>
        </div>
    </div>
    <!-- End Main Content -->

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
        // var_dump($formData);
        $insertUser = new User();
        $insertUser->formData = $formData;
        $valor = $insertUser->insert();

        if ($valor) {
            $_SESSION['msg'] = "<p style='color:green'>Registro cadastrado com sucesso!</p>";
            header("Location: login.php");
        } else {
            $_SESSION['msg'] = "<p style='color:red'>Ocorreu um erro!</p>";
        }
    }
?>
