<?php
require_once "../src/loja_crud.php";
require_once "../src/produto_crud.php";
require_once "../src/loja_produto_crud.php";

$lojas = buscarLojas($conexao);
$produtos = buscarProdutos($conexao);

$lojaIdAntiga = filter_input(INPUT_GET, 'loja_id', FILTER_VALIDATE_INT);
$produtoIdAntigo = filter_input(INPUT_GET, 'produto_id', FILTER_VALIDATE_INT);

if (
    $lojaIdAntiga === false || $lojaIdAntiga === null || $lojaIdAntiga <= 0 ||
    $produtoIdAntigo === false || $produtoIdAntigo === null || $produtoIdAntigo <= 0
) {
    http_response_code(400);
    exit('Identificação do vínculo inválida.');
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lojaId = filter_input(INPUT_POST, 'loja', FILTER_VALIDATE_INT);
    $produtoId = filter_input(INPUT_POST, 'produto', FILTER_VALIDATE_INT);
    $estoque = filter_input(INPUT_POST, 'estoque', FILTER_VALIDATE_INT);

    if (
        $lojaId === false || $lojaId === null || $lojaId <= 0 ||
        $produtoId === false || $produtoId === null || $produtoId <= 0 ||
        $estoque === false || $estoque === null || $estoque < 0
    ) {
        http_response_code(400);
        exit('Dados inválidos.');
    }

    atualizarLojaProduto($conexao, $lojaIdAntiga, $produtoIdAntigo, $lojaId, $produtoId, $estoque);

    header("Location: listar.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar produto em uma loja - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'lojas_produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Editar produto em uma loja</h2>
        <!-- Modelo visual: os campos não são enviados nem persistidos. -->
        <!-- Os campos serão preenchidos com os dados do registro selecionado. -->
        <form action="" method="post">

            <div>
                <label for="loja">Loja:</label>
                <select name="loja" id="loja" required>
                    <option value="">Selecione</option>
                    <!-- As opções serão preenchidas com os registros do banco de dados. -->
                    <?php

                    foreach ($lojas as $loja): ?>
                        <option value="<?= (int) $loja['id'] ?>">
                            <?= htmlspecialchars($loja['nome'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="produto">Produto:</label>
                <select name="produto" id="produto" required>
                    <option value="">Selecione</option>
                    <!-- As opções serão preenchidas com os registros do banco de dados. -->
                    <?php
                    foreach ($produtos as $produto): ?>
                        <option value="<?= (int) $produto['id'] ?>">
                            <?= htmlspecialchars($produto['nome_produto'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="estoque">Estoque:</label>
                <input type="number" name="estoque" id="estoque" min="0" step="1" required>
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>