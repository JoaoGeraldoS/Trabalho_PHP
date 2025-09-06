<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="add_style.css">
    <title>Document</title>
</head>
<body>

    <section class="container">

        <div class="container-head">
            <h2>Novo Item</h2>
        </div>

        <form action="salvar.php" method="post">
            <input type="hidden" name="tipo" value="item">

            <label for="nome" class="itens-cardapio cliente-itens">Nome: </label>
            <input type="text" name="nome" placeholder="Nome" class="entrada">
            <label for="preco" class="itens-cardapio cliente-itens">Preço: </label>
            <input type="number" name="preco" step="0.01" placeholder="Preço" class="entrada">
            
            <div id="container-buttons">
                <button class="btn">Registrar</button>
                <a href="../index.php" class="btn back">Cancelar</a>
            </div>

            <?php
                session_start();
                if (isset($_SESSION['error_message'])) {
                    echo '<p style="color: red; font-weight: bold; text-align: center;">' . htmlspecialchars($_SESSION['error_message']) . '</p>';
                    unset($_SESSION['error_message']); 
                }
            ?>
        </form>
    </section>
</body>
</html>