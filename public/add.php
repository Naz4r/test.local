<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = new PDO("mysql:host=MySQL-8.2;dbname=shop", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = $_POST['name'];
    $price = $_POST['price'];

    $error = null;
    if (!is_numeric($price) || $price < 0) {
        $error = "Ціна повинна бути додатнім числом!";
    }else{
        $price = (float)$price;
        echo "<p style='color: green;'>Товар успішно збережено!</p>";
    }


    if ($error) {
        echo "<p style='color: red;'>$error</p>";
        exit;
    }


    $stmt = $pdo->prepare("INSERT INTO products (name, price) VALUES (?, ?)");
    $stmt->execute([$name, $price]);

    header("Location: index.php");
    exit;
}
?>

<h2>Додати товар</h2>
<form method="post">
    Назва: <input type="text" name="name" required><br>
    Ціна: <input type="number" name="price" min="1" required><br>
    <button type="submit">Додати</button>
</form>
<a href="index.php">← Назад</a>
