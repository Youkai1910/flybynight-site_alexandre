<?php
require_once "../src/loja_produto_crud.php";

$lojaId = $_GET['loja_id'] ?? 0;
$produtoId = $_GET['produto_id'] ?? 0;

excluirLojasProdutos($conexao, $lojaId, $produtoId);

header('Location: listar.php');
exit;
