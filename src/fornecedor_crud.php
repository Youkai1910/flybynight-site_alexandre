<?php
// src/fornecedor_crud.php

//todas as funções criadas neste arquivo precisarão do script de conexão
require_once "conecta.php";

// fornecedores/lista.php
function buscarFornecedores(PDO $conexao): array{

    // Montando o comando SQL para a consulta
     $sql = "SELECT * FROM fornecedores ORDER BY nome";

     //execultar o comando
     $consulta = $conexao->query($sql);

     // Retornando o resultado como um array associativo
     return $consulta->fetchAll();
}