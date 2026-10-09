<?php
// fornecedores/excluir.php
require_once "../src/fornecedor_crud.php";
$id = $_GET['id'];
excluirProduto($conexao, $id);
header("location:listar.php");
exit;