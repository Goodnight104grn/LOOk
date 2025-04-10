<?php
$host = 'localhost';
$dbname = 'хапай_look';
$username = 'root';
$password = '9876543210';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if (isset($_GET['delete_id'])) {
        $basketId = intval($_GET['delete_id']);
        $stmt = $pdo->prepare("DELETE FROM basket WHERE basket_id = :basket_id");
        $stmt->bindParam(':basket_id', $basketId, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Не вдалося видалити товар']);
        }
        exit();
    }
} catch (PDOException $e) {
    echo '<p class="text-red-500">Помилка підключення: ' . $e->getMessage() . '</p>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Хапай LOOK</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" href="Style.css/style-0.css">
</head>
<body class="bg-gray-100">


  <header class="flex flex-wrap items-center justify-between p-4 bg-white shadow-md relative z-10">
    <div class="flex items-center gap-4">
      <img src="images/Logo.png" alt="Logo" id="logo" class="w-24 h-24 rounded-full cursor-pointer transition-transform hover:scale-110">
      <span class="text-xl font-bold text-gray-800">Хапай <span class="text-purple-700">LOOK</span></span>
    </div>
    <nav class="hidden md:grid grid-cols-6 gap-4 mt-4">
      <a href="#" class="text-gray-700 font-semibold hover:text-blue-600 hover:scale-105 transition-all">Жіночий одяг</a>
      <a href="#" class="text-gray-700 font-semibold hover:text-blue-600 hover:scale-105 transition-all">Чоловічий одяг</a>
      <a href="#" class="text-gray-700 font-semibold hover:text-blue-600 hover:scale-105 transition-all">Класика</a>
      <a href="#" onclick="toggleSidebar()" class="text-gray-700 font-semibold hover:text-blue-600 hover:scale-105 transition-all">Кошик</a>
      <a href="#" class="text-gray-700 font-semibold hover:text-blue-600 hover:scale-105 transition-all">Про нас</a>
    </nav>
  </header>


  <div id="basketSidebar" class="fixed top-[calc(27.6%-130px)] right-[-396px] w-[351px] h-[calc(100%-110px)] bg-gray-50 overflow-y-auto transition-all duration-300 p-5 shadow-lg z-20">
    <h2 class="text-lg font-bold mb-4">Стиль Корзина</h2>
    <div id="basketItems">
    <?php
      $stmt = $pdo->prepare("SELECT 
          basket.basket_id,
          basket.quantity,
          basket.image,
          basket.user_id,
          basket.created_at,
          classic.product_name,
          classic.price,
          classic.brand
        FROM basket
        LEFT JOIN classic ON basket.product_id = classic.id");
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo '<div id="basket-item-' . $row['basket_id'] . '" class="basket-item border border-gray-300 p-3 mb-3 bg-white rounded-lg transition-transform hover:scale-105 hover:shadow-md">';
          echo '<img src="' . htmlspecialchars($row['image']) . '" alt="Товар" class="w-16 h-16 float-right ml-3 rounded-md">';
          echo '<div class="text-gray-800"><strong>' . htmlspecialchars($row['product_name']) . '</strong> — ' . htmlspecialchars($row['price']) . ' грн</div>';
          echo '<div class="text-sm text-gray-600">Кількість: ' . htmlspecialchars($row['quantity']) . '</div>';
          echo '<div class="text-sm text-gray-600">Бренд: ' . htmlspecialchars($row['brand']) . '</div>';
          echo '<div class="text-sm text-gray-500">Користувач: ' . htmlspecialchars($row['user_id']) . '</div>';
          echo '<div class="text-xs text-gray-500">Дата: ' . htmlspecialchars($row['created_at']) . '</div>';
          echo '<div class="mt-2 space-x-2">';
          echo '<button onclick="alert(\'Перегляд ID ' . $row['basket_id'] . '\')" class="bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition-colors">Переглянути</button>';
          echo '<button onclick="deleteItem(' . $row['basket_id'] . ')" class="bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition-colors">Видалити</button>';
          echo '</div>';
          echo '</div>';
      }
    ?>
    </div>
  </div>
  <script src="Script.js/script.js"></script>


  <script>
    (function() {
    console.log("Поточний браузер: " + window.clientInformation.userAgent);
})();

const students = [
    { firstName: 'Alice', lastName: 'Johnson', grade: 75 },
    { firstName: 'Bob', lastName: 'Smith', grade: 85 },
    { firstName: 'Charlie', lastName: 'Brown', grade: 90 },
    { firstName: 'David', lastName: 'Davis', grade: 60 },
    { firstName: 'Eve', lastName: 'Miller', grade: 92 }
];

const foundStudent = students.find(student => student.grade > 80);
console.log(foundStudent);

function multiplyAll(...numbers) {
    return numbers.reduce((total, num) => total * num, 1);
}

console.log(multiplyAll(2, 3, 4));
console.log(multiplyAll(1, 5, 7, 9));

let uniqueSet = new Set([1, 2, 3, 4, 5, 5, 6, 7, 7, 8]);
console.log(uniqueSet);

for (let value of uniqueSet) {
    console.log(value);
}

let person = {
    age: 30,
    getAge: function() {
        console.log(this.age);
    }
};

let child = {
    age: 5
};

let boundGetAge = person.getAge.bind(child);
boundGetAge();

function createGreeting(greeting) {
    return function(name) {
        console.log(greeting + ", " + name + "!");
    };
}

let sayHello = createGreeting("Привіт щось   бажаєш купти");
sayHello("Іван");

let sayGoodDay = createGreeting("Доброго дня, ні дякую не сьогодні");
sayGoodDay("Марія");

  </script>
</body>
</html>





