<?php
session_start();
require  "../db.php";
require "../Status.php";

$tipo = $_POST['tipo'] ?? '';

if ($tipo === "item") {
    $nome  = trim($_POST['nome']);
    $preco = floatval($_POST['preco']);

     if ($nome !== "" && $preco > 0) {
        $stmt = $pdo->prepare("INSERT INTO cardapio (nome, preco) VALUES (?, ?)");
        $stmt->execute([$nome, $preco]);

    } else {
        $_SESSION['error_message'] = "Erro ao adicionar item. Verifique os dados.";

        header("Location: add_itens.php");
        exit();
    }

} elseif ($tipo === "pedido") {
   
    $cliente = trim($_POST['cliente']);
    $itensEntrada = $_POST['itens'];

    if (empty($cliente) || empty($itensEntrada)) {
        $_SESSION['error_message'] = "O campo Cliente e os Itens não podem estar vazios.";
    
        header("Location: add_pedidos.php");
        exit(); 
    }

    if (is_array($itensEntrada)) {
        $itens = $itensEntrada;
        
    } else {
        $itens = array_map('trim', explode(",", $itensEntrada));
    }


    $total = 0;
    foreach ($itens as $item) {
        $stmt = $pdo->prepare("SELECT preco FROM cardapio WHERE nome = ?");
        $stmt->execute([$item]);
        if ($row = $stmt->fetch()) {
            $total += $row['preco'];
        }
    }

    $status = Status::PENDENTE->value;

    
    $stmt = $pdo->prepare("INSERT INTO pedidos (cliente, status, itens, valor_total) VALUES (?, ?, ?, ?)");
    $stmt->execute([$cliente, $status, implode(", ", $itens), $total]);
}

header("Location: ../index.php");
exit();
?>