<?php
require_once __DIR__ . "/../src/loja_crud.php";
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(400);
    exit('ID da loja inválido.');
}

excluirLoja($conexao, $id);
header("Location: listar.php");
exit();