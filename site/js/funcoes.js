function confirmacaoExclusaoUser(id){
    var resposta = confirm("Deseja remover esse registro?");
    if (resposta == true) {
		  window.location.href = "deletar.php?id=" + id;
    }
}