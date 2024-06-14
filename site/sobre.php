<?php
session_start(); // Inicializando a sessão
require './Conn.php';
require './User.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa do Sonho</title>
    <link rel="shortcut icon" href="imagens/img-site/icon/casa_1.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <style>
        body {
            text-transform: uppercase;
            background-color: #33ccff;
        }

        .navbar-brand {
            font-weight: bold;
            color: #fff;
        }

        .navbar-brand:hover {
            color: #ffcc00;
        }

        .nav-link {
            font-weight: bold;
            color: #fff !important;
        }

        .nav-link:hover {
            color: #ffcc00 !important;
        }

        .container h3 {
            color: #fff;
            text-align: center;
            margin-top: 20px;
        }

        .table-responsive {
            width: 100% !important;
            margin-top: 20px;
        }

        .table {
            border: 1px solid red;
            width: 50% !important;
            margin: auto;
            color: black;
            background-color: white;
        }

        .table-status {
            margin-bottom: 20px !important;
            text-align: center;
            color: black;
            background-color: white;
        }

        .developer-name {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">A Casa do Sonho</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link">Sobre Nós (Página Atual)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <?php if (isset($_SESSION['id']) && isset($_SESSION['nome'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Cadastro-Projetos</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-danger text-white" href="sair.php">Sair</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Main Content -->
    <div class="container">
        <h3>Sobre a Empresa</h3>
        <p class="text-center">
            <img src="./imagens/img-site/logo/logo.png" alt="Logo da Empresa" class="img-fluid">
        </p>
        <div class="table-responsive">
            <table class="table table-status">
                <thead>
                    <tr>
                        <th>Desenvolvedor</th>
                    </tr>
                </thead>
            </table>
            <table class="table">
                <tbody>
                    <tr>
                        <td class="developer-name">LILIAN CRISTINA DOS SANTOS COCCKI</td>
                    </tr>
                    <tr>
                        <td class="developer-name">MATHEUS RUFINO SILVA SANTO</td>
                    </tr>
                    <tr>
                        <td class="developer-name">PEDRO HENRIQUE SANTANA ALVES DE SOUZA</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Main Content -->

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-eMN0pRJ2G8qCboCpPnn9xHCjb4qEZTh8xlaEuhhx7/eo3Ai3XkqvqE4RvQXPwnyO" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-SKiCkyeq2kGMI5j/9KR7eAP87kWENQItAQ0AfH1J8mGicE2X1STYzQ4xkMJx5dkn" crossorigin="anonymous">
    </script>
</body>

</html>
