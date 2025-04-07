<?php

$host = "MySQL-8.2";
$dbname = "shop";
$username = "root";
$password = "";

try {
    $pdo=new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (Exception $e){
    echo "Помилка підключення" .  $e->getMessage();
}
$stmt=$pdo->query("SELECT id,name,price FROM products");
$products=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Список товарів</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h1>Список товарів :</h1>
<a href="add.php"><button>Додати товар</button></a>
<div id="product-list">
    <?php foreach ($products as $product) : ?>
    <div class="product">
        <a href="edit.php?id=<?= $product['id'] ?>">
        <strong><?php echo $product['name'] ?></strong>
        <strong><?php echo $product['price'] ?> грн </strong>
    </div>
    <?php endforeach; ?>
</div>
</body>
</html>