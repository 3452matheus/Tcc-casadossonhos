<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrossel de Imagens</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<?php
require './Conn.php';
require './User.php';

$list = new User();
$result = $list->listImagesAndProjects();
$projects = [];

foreach ($result as $row) {
    $projects[$row['id']]['nome'] = $row['nome'];
    $projects[$row['id']]['texto'] = $row['texto'];
    $projects[$row['id']]['cda_nome'] = $row['cda_nome'];
    $projects[$row['id']]['imagens'][] = [
        'nome_imagem' => $row['nome_imagem']
    ];
}
?>

<div class="container">
    <div class="row">
        <?php foreach ($projects as $project_id => $project): ?>
            <div class="col-md-4 mb-3">
                <div class="card bg-info">
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
                        <h6>Nome do arquiteto: <?php echo $project['cda_nome']; ?></h6>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
