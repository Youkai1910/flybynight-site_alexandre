<?php
require_once __DIR__ . "/../src/loja_crud.php";
$nome = '';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    if ($nome === '') {
        $erro = 'Informe o nome da loja.';
    } else {
        inserirLoja($conexao, $nome);
        header("Location: listar.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar loja - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'lojas';
    require __DIR__ . '/../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Cadastrar loja</h2>
        <?php if ($erro !== ''): ?>
            <p><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        <form action="" method="post">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" maxlength="100" value="<?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <button type="submit">Salvar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>