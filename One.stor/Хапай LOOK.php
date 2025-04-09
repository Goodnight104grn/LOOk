<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <title>Хапай LOOK — Брендовий магазин</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="Style.css\style.css">
</head>

<body class="bg-gray-50 text-gray-800">

 
  <header class="flex flex-wrap items-center justify-between px-6 py-4 bg-white shadow-md">
 
    <div class="flex items-center space-x-4 mb-2 md:mb-0">
      <img src="images\Logo.png" alt="Logo" class="h-24">
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
      <a href="#">Купити зараз</a>
      <a href="#">Про нас</a>
    </nav>
  </header>

  
  <main class="max-w-7xl mx-auto py-10 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php for ($i = 1; $i <= 6; $i++): ?>
        <div class="bg-white shadow rounded-lg overflow-hidden">
          <img src="images/<?= $i ?>.jpg" alt="Товар <?= $i ?>" class="w-full h-48 object-cover">
          <div class="p-4">
            <h2 class="text-lg font-semibold">Назва товару <?= $i ?></h2>
            <p class="text-sm text-gray-600">Короткий опис брендової речі.</p>
          </div>
        </div>
      <?php endfor; ?>
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

</body>
</html>
