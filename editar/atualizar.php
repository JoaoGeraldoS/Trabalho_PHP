<?php
require "../db.php";

$id      = $_POST['id'];
$status    = $_POST['status'];

$pdo->prepare("UPDATE pedidos SET status = ? WHERE id = ?")
    ->execute([$status, $id]);

header("Location: ../index.php");

?>