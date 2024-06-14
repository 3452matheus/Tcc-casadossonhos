<?php
    session_start();//inicializando a session/sessao
    ob_start();//limpa os ultimos registro da session
    //Receber o id do usuario
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>casa do sonho</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <a class="btn btn-primary mt-5 mb-4" href="index2.html">Listar</a>
        <a class="btn btn-primary mt-5 mb-4" href="caduser.php">Cadastrar</a>
        <div class="h1 text-center">Editar Usuário</div>
        <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            /* Código para Editar */
            require './Conn.php';
            require './User.php';
            $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            //so entra se voce apertar o botao editar
            if (!empty($formData['editar'])) {
                $user = new User();
                $user->formData = $formData;
                $valor = $user->edit();//chama o metodo edit da classe User;

                if ($valor) {
                    $_SESSION['msg'] = "<p style='color:green'>Registro alterado com sucesso!</p>";
                    header("Location: index.php");
                } else {
                    $_SESSION['msg'] = "<p style='color:red'>Ocorreu Erro!</p>";
                }
            }

            //Verifica se o id possui valor
            if (!empty($id)) {
                $viewUser = new User();
                $viewUser->id = $id;
                $valueuser = $viewUser->view();
                extract($valueuser);
        ?>
                <form name="EditUser" action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $id?>" readonly>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Nome</span>
                        </div>
                        <input type="text" name="nome" id="nome" value="<?php echo $nome?>" 
                        class="form-control" placeholder="Nome" 
                        aria-label="nome" aria-describedby="basic-addon1" require>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">E-mail</span>
                        </div>
                        <input type="text" name="email" id="email" 
                        value="<?php echo $email?>" class="form-control" 
                        placeholder="Digite seu e-mail" aria-label="email" 
                        aria-describedby="basic-addon1" require>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">CPF</span>
                        </div>
                        <input type="text" name="cpf" id="cpf" 
                        value="<?php echo $cpf?>" class="form-control" 
                        placeholder="Digite seu CPF" aria-label="cpf" 
                        aria-describedby="basic-addon1" require>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Editar" name="editar">
                </form>
        <?php
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
                header("Location: index.html");
            }
        ?>
    </div>
    
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>