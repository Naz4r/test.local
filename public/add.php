<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = new PDO("mysql:host=MySQL-8.2;dbname=shop", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = $_POST['name'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("INSERT INTO products (name, price) VALUES (?, ?)");
    $stmt->execute([$name, $price]);

    header("Location: index.php");
    exit;
}
?>

<h2>Додати товар</h2>
<form method="post">
    Назва: <input type="text" name="name" required><br>
    Ціна: <input type="number" name="price" required><br>
    <button type="submit">Додати</button>
</form>
<a href="index.php">← Назад</a>
