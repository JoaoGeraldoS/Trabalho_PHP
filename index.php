<?php
session_start();
require "db.php";

$pedidos = $pdo->query("SELECT * FROM pedidos");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Lista de Pedidos</title>
</head>
<body>

    <section class="container">
        
        <div class="container-head">
            <h2>Lista de Pedidos</h2>
            <p><a href="adicionar/add_pedidos.php">Criar Pedido</a></p>
        </div>
        
        <?php
            if (isset($_SESSION['success_message'])) {
                echo '<p style="color: green; font-weight: bold; text-align: center;">' . htmlspecialchars($_SESSION['success_message']) . '</p>';
                unset($_SESSION['success_message']);
            }

            if (isset($_SESSION['error_message'])) {
                echo '<p style="color: red; font-weight: bold; text-align: center;">' . htmlspecialchars($_SESSION['error_message']) . '</p>';
                unset($_SESSION['error_message']);
            }
        ?>

        <?php foreach ($pedidos as $pedido): ?>
            <div class="pedido">
                

                <div class="btn">
                    <a href="editar/editar_pedido.php?id=<?php echo htmlspecialchars($pedido['id']); ?>" >Editar</a>
                    <a href="excluir/excluir_pedido.php?id=<?php echo htmlspecialchars($pedido['id']); ?>" >Excluir</a>
                </div>
                
                <h3>Pedido do Cliente: <?php echo htmlspecialchars($pedido["cliente"]); ?></h3>
                <p><strong>Itens:</strong> <?php echo htmlspecialchars($pedido["itens"]); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars($pedido["status"]); ?></p>
                <p><strong>Valor Total:</strong> R$ <?php echo number_format($pedido["valor_total"], 2, ',', '.'); ?></p>

            
                
            </div>
            
        <?php endforeach; ?>
    </section>

</body>
</html>
