<?php
session_start();//inicializando a session/sessao
ob_start();
unset($_SESSION['id'],$_SESSION['nome']);//limpa os ultimos registro da session
$_SESSION['msg'] = "<p style='color:green'> Desconectado com sucesso!</p>";
header("Location:login.php");