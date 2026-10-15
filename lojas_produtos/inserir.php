<?php
<<<<<<< Updated upstream
require_once "../src/loja_produto_crud.php";
require_once "../src/loja_crud.php";
require_once "../src/produto_crud.php";
=======

require_once "../src/loja_produto_crud.php";
>>>>>>> Stashed changes

$lojas_produtos = buscarLojasProdutos($conexao);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $loja = $_POST['loja'];
    $produto = $_POST['produto'];
    $estoque = filter_input(INPUT_POST, 'estoque', FILTER_VALIDATE_INT);

    if ($estoque === false || $estoque < 0) {
        http_response_code(400);
        exit('Estoque inválido.');
    }

inserirLojaProduto($conexao, $lojas, $produtos, $estoque);
header("Location: loja_produto_crud.php" );
exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar produto a uma loja - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'lojas_produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Adicionar produto a uma loja</h2>
        <!-- Modelo visual: os campos não são enviados nem persistidos. -->
        <form action="" method="post">

            <div>
                <label for="loja">Loja:</label>
                <select name="loja" id="loja" required>
                    <option value="">Selecione</option>
                    <?php foreach ($lojas as $loja): ?>
                        <option value="<?= $loja['id'] ?>"><?= $loja['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="produto">Produto:</label>
                <select name="produto" id="produto" required>
                    <option value="">Selecione</option>
                    <?php foreach ($produtos as $produto): ?>
                        <option value="<?= $produto['id'] ?>"><?= $produto['nome_produto'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="estoque">Estoque:</label>
                <input type="number" name="estoque" id="estoque" min="0" step="1" required>
            </div>
            <button type="submit">Salvar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>