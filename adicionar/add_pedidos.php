<?php
session_start();
require "../db.php";

$itens = $pdo->query("SELECT * from cardapio");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="add_style.css">
    <title>Cadastro de Produtos</title>
</head>
<body>

    <section class="container">
        <div class="container-head">
            <h2>Cadastrar Pedido</h2>
            <p><a href="add_itens.php">Registrar itens</a></p>
        </div>

        <form action="salvar.php" method="post">
            <input type="hidden" name="tipo" value="pedido">

            <div id="container-cliente">
                <label for="cliente" class="cliente-itens">Cliente:</label>
                <input type="text" name="cliente" placeholder="Cliente" class="entrada">
            </div>

            <h3>Itens do Cardápio:</h3>
            <?php foreach ($itens as $item): ?>
                <label class="itens-cardapio">
                    <input type="checkbox" name="itens[]" value="<?= $item['nome'] ?>" id="check">
                    <?= $item['nome'] ?> - R$ <?= number_format($item['preco'], 2, ',', '.') ?>
                </label><br>
            <?php endforeach; ?>

            <div id="container-buttons">
                <button class="btn">Registrar</button>
                <a href="../index.php" class="btn back">Cancelar</a>
            </div>
            <?php
                if (isset($_SESSION['error_message'])) {
                    echo '<p style="color: red; font-weight: bold; text-align: center;">' . htmlspecialchars($_SESSION['error_message']) . '</p>';
                    unset($_SESSION['error_message']); // Limpa a mensagem após a exibição
                }
            ?>
        </form>

        

    </section>
</body>
</html>