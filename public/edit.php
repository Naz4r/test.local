<?php
$pdo = new PDO("mysql:host=MySQL-8.2;dbname=shop", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id']  ? $_GET['id'] : null;
if (!$id) exit("ID не вказано");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ? WHERE id = ?");
    $stmt->execute([$name, $price, $id]);

    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$product) exit("Товар не знайдено");
?>

<h2>Редагувати товар</h2>
<form method="post">
    Назва: <input type="text" name="name" value="<?= $product['name']?>" required><br>
    Ціна: <input type="number" name="price" value="<?= $product['price'] ?>" required><br>
    <button type="submit">Зберегти</button>
</form>
<a href="index.php">← Назад</a>
