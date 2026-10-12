<?php
require_once "../src/loja_produto_crud.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método não permitido.');
}

$lojaId = filter_input(INPUT_POST, 'loja_id', FILTER_VALIDATE_INT);
$produtoId = filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);

if (
    $lojaId === false || $lojaId === null || $lojaId <= 0 ||
    $produtoId === false || $produtoId === null || $produtoId <= 0
) {
    http_response_code(400);
    exit('Identificação do vínculo inválida.');
}

$excluiu = excluirLojaProduto($conexao, $lojaId, $produtoId);

if (!$excluiu) {
    http_response_code(500);
    exit('Não foi possível excluir o vínculo.');
}

header('Location: listar.php');
exit;