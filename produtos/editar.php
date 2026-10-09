<?php
//produtos/editar

/* Exercicios */

// 1) importar os arquivos de função de fornecedores e produtos
require_once "../src/produto_crud.php";
require_once "../src/fornecedor_crud.php";

// 2) Capturar e guardar o id do produto que será carregado/atualizado
$id = $_GET['id'];

// 3) Chamar a função buscarFornecedores e receber  a lista de fornecedores (guarde em uma variavel chamada $fornecedores)
$fornecedores = buscarFornecedores($conexao);

// 4) Chamar a função buscarProdutoId e receber os dados (guarde em uma variavel chamada $produto)
$produto = buscarProdutoPorId($conexao, $id);

// PARTE 2
 
// 1) Detectar o acionamento do formulário de atualização
 if($_SERVER["REQUEST_METHOD"] === "POST"){
// 2) Capturar os dados do formulário
 $nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$quantidade = $_POST['quantidade'];
$fornecedor = $_POST['fornecedor'];
// 3) Chamar a função atualizarProduto e passar os dados pra ela
 atualizarProduto($conexao, $id, $nome, $descricao, $preco, $quantidade, $fornecedor);
// 4) Redirecionar para a página listar produtos
 header("Location: listar.php");
exit;
}
// 5) Testar: tente atualizar dados de pelo menos 3 produtos
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar produto - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Editar produto</h2>
        <!-- Parte 1 -->
        <!-- 5) Exibir os dados do produto em cada  campo do formulário 
           No caso dos campos input, use o atributo value.
           No caso do campo textarea, coloque o valor dentro da tag.-->
           
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $produto['id']?>">
            <div>
                <label for="nome">Nome:</label>
                <input value="<?= $produto['nome']?>" type="text" name="nome" id="nome" maxlength="100" required >
            </div>
            <div>
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="5"><?= $produto['descricao'] ?></textarea>
            </div>
            <div>
                <label for="preco">Preço:</label>
                <input value="<?= $produto['preco']?>"type="number" name="preco" id="preco" min="0" step="0.01" required>
            </div>
            <div>
                <label for="quantidade">Quantidade:</label>
                <input value="<?= $produto['quantidade']?>"type="number" name="quantidade" id="quantidade" min="0" step="1" required>
            </div>
            <div>
                <label for="fornecedor">Fornecedor:</label>
                <select name="fornecedor" id="fornecedor" required>
                    <option value="">Selecione</option>
                    <!-- PARTE 1 -->
                     <!-- 6) DESAFIO 
                      6.1) Usando foreach, acessa os $fornecedores e mostre na tag <option> os nomes de cada fornecedor. 
                        No atributo value, coloque o id de cada fornecedor.
                     6.2) 0 fornecedor daquele produto que está sendo exibido
                        já DEVE VIR SELECIONADO. Programe os recursos para isso acontecer. -->
                        <?php foreach($fornecedores as $fornecedor): ?>
                        <option <?= $fornecedor["id"] === $produto["fornecedor_id"] ? 'selected' : '' ?> value="<?= $fornecedor['id'] ?>"> 
                            <?= $fornecedor['nome'] ?> 
                        </option> 
                    <?php endforeach ?>
                </select>
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>