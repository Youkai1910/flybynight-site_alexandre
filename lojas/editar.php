<?php
require_once __DIR__ . "/../src/loja_crud.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(400);
    exit('ID da loja inválido.');
}

$loja = buscarLojaPorId($conexao, $id);
if (!$loja) {
    http_response_code(404);
    exit('Loja não encontrada.');
}

$nome = $loja['nome'];
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    if ($nome === '') {
        $erro = 'Informe o nome da loja.';
    } else {
        atualizarLoja($conexao, $id, $nome);
        header('Location: listar.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar loja - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'lojas';
    require __DIR__ . '/../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Editar loja</h2>
        <?php if ($erro !== ''): ?>
            <p><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        <form action="?id=<?= (int) $id ?>" method="post">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" maxlength="100" value="<?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>