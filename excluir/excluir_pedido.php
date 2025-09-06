<?php
session_start();
require "../db.php";

$id = $_GET['id'] ?? null;

if (empty($id)) {
    $_SESSION['error_message'] = "ID do pedido não fornecido.";
    header("Location: ../index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT status FROM pedidos WHERE id = ?");
$stmt->execute([$id]);

$linha = $stmt->fetch();

if ($linha) {
    if ($linha["status"] === "Cancelado" || $linha["status"] === "Entregue") {
        $pdo->prepare("DELETE FROM pedidos WHERE id = ?")->execute([$id]);
        $_SESSION['success_message'] = "Pedido excluído com sucesso!";
        
    } else {
        $_SESSION['error_message'] = "Pedido PENDENTE não pode ser apagado!";
        $_SESSION['error_order_id'] = $id; 
    } 
} else {
    $_SESSION['error_message'] = "Pedido não encontrado.";
}

header("Location: ../index.php");
exit();
?>