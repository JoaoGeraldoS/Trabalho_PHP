<?php
require "../db.php";
require "../Status.php";

$id = $_GET["id"];
$stmt = $pdo->prepare("Select * from pedidos where id= ?");
$stmt->execute([$id]);

$linha_resultado = $stmt->fetch();
if (!$linha_resultado) {
    die("PEDIDO NÃO ENCONTRADO!");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="editar_style.css">
    <title>Document</title>
</head>

<body>
    <section class="container">
     
        <div class="container-head">
            <h2>Editar produto</h2>
        </div>
        <form action="atualizar.php" method="post">
            <input type="hidden" name="id" value="<?= $linha_resultado['id'] ?>">
            <label class="cliente-itens">Status:</label><br>
            
            <?php foreach (Status::cases() as $status): ?>
                <div class="container-radio">
                    <input type="radio" 
                    id="status_<?= $status->value ?>" 
                    name="status" 
                    value="<?= $status->value ?>"
                    <?= ($status->value == $linha_resultado['status']) ? 'checked' : '' ?>>
                    <label for="status_<?= $status->value ?>"><?= $status->value ?></label><br>
                </div>
            <?php endforeach; ?>

            <div id="container-buttons">
                <button class="btn">Registrar</button>
                <button href="../index.php" class="btn">Cancelar</button>
            </div>
        </form>
    </section>
</body>

</html>