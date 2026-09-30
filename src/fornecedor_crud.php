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

//usada em fornecedores/inserir.php
function inserirFornecedor(PDO $conexao, string $nome):void {
    /* Sobre o recebimento de dados para o SQL no PDO, visando minimizar a chance de injeção de código SQL nocivo à parte de entradas de dados (no caso, formulário),
    devemos passar no comando SQL "parâmetros nomeados" (Named Parameters).
    Esse tipo de prática permite receber de forma segura/controlada os dados para a consulta. NUNCA passe os dados de forma direta  */

    // Passo 1: definir os parâmetros nomeados
  $sql = "INSERT INTO fornecedores (nome) VALUES(:nome)";

  //Passo 2: preparar o comando para execução 
  $consulta = $conexao->prepare($sql);

  //Passo 3: vincular o valor ao parâmetro nomeado 
  $consulta->bindValue(":nome", $nome);

  //Passo 4: executar a consulta/comando no banco
  $consulta->execute();
}

// Usada em fornecedores/editar.php
function buscarFornecedorPorId(PDO $conexao, int $id): array 
{
  // Comando SQL (atenção ao usar de parâmetro nomeado)
  $sql = "SELECT * FROM fornecedores WHERE id = :id";
   
  // Preparação da consulta
     $consulta = $conexao->prepare($sql);

  // Atribuição do valor recebido (em $id) ao parâmetro nomedo (:id)
  $consulta->bindValue(":id", $id);

  // Execução da consulta
   $consulta->execute();

  // Retorno dos dados como array associativo
  // ATENÇÃO: aqui usamos  fetch() por se tratar de um ÚNICO array (vetor)
  return $consulta->fetch();
}

// Usada em fornecedor/editar.php
function atualizarFornecedor(PDO $conexao, int $id, string $nome):void
{
  // Comando SQL
  $sql = "UPDATE fornecedores SET nome = :nome WHERE id = :id";

  // Preparar comando SQL
  $consulta = $conexao->prepare($sql);

  // Atribuir valores aos campos
  $consulta->bindValue(":nome", $nome);
  $consulta->bindValue(":id", $id);

  // Executar 
  $consulta->execute();
}

// Usada em fornecedores/excluir.php
function excluirFornecedor(PDO $conexao, int $id):void
{
  $sql = "DELETE FROM fornecedor WHERE id = :id";
  $consulta = $conexao->prepare($sql);
  $consulta->bindValue(":id", $id);
  $consulta->execute();
}