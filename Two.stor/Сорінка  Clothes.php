<?php
include('Php/bd.php'); 


$sql = "SELECT * FROM classic";
try {
    $stmt = $pdo->query($sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC); 
} catch (PDOException $e) {
    echo "Помилка при отриманні товарів: " . $e->getMessage();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];
    $user_id = 1;


    $sql = "INSERT INTO basket (product_id, quantity, image, user_id, created_at) VALUES (:product_id, :quantity, :image, :user_id, NOW())";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        echo "<script>alert('Товар додано до кошика!');</script>"; 
    } catch (PDOException $e) {
        echo "Помилка при додаванні товару до кошика: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <title>Хапай LOOK — Брендовий магазин</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="Style.css/style-0.css">
  <link rel="stylesheet" href="Style.css/style-1.css">
</head>
<body class="bg-gray-50 text-gray-800">
  <header class="flex flex-wrap items-center justify-between px-6 py-4 bg-white shadow-md">
    <div class="flex items-center space-x-4 mb-2 md:mb-0">
      <img src="images/Logo.png" alt="Logo" class="h-24">
      <span class="text-xl font-bold">Хапай LOOK</span>
    </div>
    <nav class="flex flex-wrap justify-end gap-x-4 gap-y-2 text-sm">
      <a href="#">Жіночий одяг</a>
      <a href="#">Чоловічий одяг</a>
      <a href="#">Класика</a>
      <a href="#">Нічні виходи</a>
      <a href="#">Стиль для бізнесу</a>
      <a href="#">Новинки</a>
      <a href="#">Знижки</a>
      <a href="#">Аксесуари</a>
      <a href="http://localhost/%D0%A5%D0%B0%D0%BF%D0%B0%D0%B9%20LOOK/Profile/PF.php#">Профіль</a>
      <a href="#">Про нас</a>
    </nav>
  </header>

  <main class="max-w-7xl mx-auto py-10 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($products as $product): ?>
        <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-300">
     
          <div class="image-slider" data-autoslide="true">
            <button class="slider-btn left">&#10094;</button>
            <button class="slider-btn right">&#10095;</button>
            <img src="images/default.jpg" alt="Фото товару 1" class="active">
            <img src="images/default.jpg" alt="Фото товару 2">
            <img src="images/default.jpg" alt="Фото товару 3">
          </div>
          <div class="p-4">
            <p class="text-gray-800 font-semibold text-lg mb-2"><?php echo htmlspecialchars($product['product_name']); ?></p>
            <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($product['description']); ?></p>
            <p class="text-gray-700 mb-4"><strong>Ціна:</strong> <?php echo htmlspecialchars($product['price']); ?> грн</p>
            <p class="text-gray-700 mb-4"><strong>Бренд:</strong> <?php echo htmlspecialchars($product['brand']); ?></p>
            <p class="text-gray-700 mb-4"><strong>Кількість на складі:</strong> <?php echo htmlspecialchars($product['stock_quantity']); ?></p>
            <p class="text-gray-700 mb-4"><strong>Дата створення:</strong> <?php echo htmlspecialchars($product['created_at']); ?></p>


            <form action="" method="POST">
              <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
              <button type="submit" name="add_to_cart" class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600 mb-4">
                Додати до кошика
              </button>

              <div class="mb-4">
                <label for="image" class="block text-gray-700">Оберіть зображення:</label>
                <select id="image" name="image" class="mt-1 block w-full text-gray-700 border border-gray-300 rounded-md">
                  <option value="image1.jpg">Фото 1</option>
                  <option value="image2.jpg">Фото 2</option>
                  <option value="image3.jpg">Фото 3</option>
                </select>
              </div>

              <div class="mb-4">
                <label for="quantity" class="block text-gray-700">Оберіть кількість:</label>
                <input type="number" id="quantity" name="quantity" min="1" max="10" value="1" class="mt-1 block w-full text-gray-700 border border-gray-300 rounded-md">
              </div>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>

  <section class="max-w-7xl mx-auto mt-10 grid grid-cols-1 md:grid-cols-2 gap-6 px-4">
    <div class="bg-white p-6 shadow rounded-lg h-48">
      <h3 class="font-bold text-lg mb-2">Спецпропозиція</h3>
      <p>Тут можна розмістити інформацію про акції або новинки.</p>
    </div>
    <div class="bg-white p-6 shadow rounded-lg h-48">
      <h3 class="font-bold text-lg mb-2">Останні новини</h3>
      <p>Оновлення брендів, нові колекції чи важливі оголошення.</p>
    </div>
  </section>

  <footer class="bg-white shadow-inner mt-10">
    <div class="max-w-7xl mx-auto p-4 text-center text-sm text-gray-500">
      &copy; <?= date("Y") ?> Хапай LOOK. Всі права захищено.
    </div>
  </footer>

  <script src="Script.js/script.js"></script>
</body>
</html>
