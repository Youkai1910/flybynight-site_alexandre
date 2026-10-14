<?php
require_once "conecta.php";

// Busca todos os registros de relacionamento entre lojas e produtos.
function buscarLojasProdutos(PDO $conexao): array
{
$sql = "SELECT
            lojas_produtos.loja_id,
            lojas_produtos.produto_id,
            produtos.nome AS nome_produto,
            lojas_produtos.estoque,
            lojas.nome AS nome_loja
        FROM lojas_produtos JOIN lojas
        ON lojas.id = lojas_produtos.loja_id
        JOIN produtos ON produtos.id = lojas_produtos.produto_id
        ORDER BY nome_produto";
    $consulta = $conexao->query($sql);

    // Retorna todos os resultados em formato de array.
    return $consulta->fetchAll();
}

// Insere um novo vínculo entre uma loja e um produto com estoque inicial.
function inserirLojaProduto(
    PDO $conexao,
    string $lojaId,
    string $produtoId,
    int $estoque   
): bool{ //bool é o tipo booleano apenas true ou false ele representa uma resposat binária
    $sql = "INSERT INTO lojas_produtos (loja_id, produto_id, estoque)
            VALUES (:loja_id, :produto_id, :estoque)";
            
$consulta = $conexao->prepare($sql);

    // Executa a inserção e retorna true/false conforme sucesso.
    return $consulta->execute([
        ":loja_id" => $lojaId,
        ":produto_id" => $produtoId,
        ":estoque" => $estoque
    ]);
   
}
// Buscando uníco relacionamento loja/produto
function buscarLojasProdutosPorId(PDO $conexao, int $lojaId, int $produtoId): ?array 
// a ? significa em PHP que pode retornar a função array ou null quando não encontrar nada
{
    $sql = "SELECT * FROM lojas_produtos WHERE loja_id = :loja_id AND produto_id = :produto_id";
    $consulta = $conexao->prepare($sql);
    $consulta->execute([
        ':loja_id' => $lojaId,
        ':produto_id' => $produtoId
    ]);
    // Retorna o registro ou null se não existir.
    return $consulta->fetch() ?: null;
}
// Atualiza os dados de um relacionamento
function atualizarLojaProduto(
    PDO $conexao,
    int $lojaIdAntiga,
    int $produtoIdAntigo,
    int $lojaId,
    int $produtoId,
    int $estoque
): bool {
    $sql = "UPDATE lojas_produtos
            SET loja_id = :loja_id,
                produto_id = :produto_id,
                estoque = :estoque
             WHERE loja_id = :loja_id_antiga
              AND produto_id = :produto_id_antigo";

    $consulta = $conexao->prepare($sql);

   // Atualiza e retorna true caso consiga alterar, false 
    return $consulta->execute([
        ':loja_id' => $lojaId,
        ':produto_id' => $produtoId,
        ':estoque' => $estoque,
        ':loja_id_antiga' => $lojaIdAntiga,
        ':produto_id_antigo' => $produtoIdAntigo
    ]);
}
// Remove o vínculo entre uma loja e um produto
function excluirLojaProduto(PDO $conexao, int $lojaId, int $produtoId): bool
{
    $sql = "DELETE FROM lojas_produtos
            WHERE loja_id = :loja_id
              AND produto_id = :produto_id";

    $consulta = $conexao->prepare($sql);

  // Deleta o registro e retorna true/false
    return $consulta->execute([
        ':loja_id' => $lojaId,
        ':produto_id' => $produtoId
    ]);
}
