<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Хапай LOOK — Брендовий магазин</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes shake {
            0% {
                transform: translateX(0); /* Початкове положення */
            }
            25% {
                transform: translateX(-8px); /* Логотип труситься вліво */
            }
            50% {
                transform: translateX(8px); /* Логотип труситься вправо */
            }
            75% {
                transform: translateX(-8px); /* Логотип труситься знову вліво */
            }
        }

        .animate-shake {
            animation: shake 0.5s ease-in-out; /* Логотип труситься вліво-вправо */
        }

        .emoji {
            position: absolute;
            font-size: 2rem;
            animation: emojiFly 2s forwards;
        }

        @keyframes emojiFly {
            0% {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
            100% {
                transform: translateY(-50px) scale(1.5);
                opacity: 0;
            }
        }

        /* Збільшення верхнього відступу */
        header {
            padding-top: 18px; /* Збільшуємо відступ зверху */
        }

  /* Стиль для кнопок реєстрації і входу */
.auth-buttons {
    position: absolute;
    top: 59px;
    left: 93%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
}

/* Стиль для кнопок */
.auth-buttons button {
    padding: 8px 16px;
    background-color: transparent; /* Без фону */
    color: #4CAF50; /* Зелений текст */
    border: none; /* Без обводки */
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

/* Ефект при наведенні */
.auth-buttons button:hover {
    color: #45a049; /* Зміна кольору тексту при наведенні */
}

    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Верхнє меню -->
    <header class="bg-white shadow-md relative">
    <div class="flex items-center p-4">
    <!-- Логотип і назва -->
    <div class="flex items-center space-x-4">
        <img src="images/Logo.png" alt="Logo" id="logo" class="h-24 w-24 rounded-full cursor-pointer">
        <div id="text" class="text-2xl font-bold text-gray-900">
            <span class="text-purple-600">Хапай LOOK</span> — знайди свій стиль!
        </div>
    </div>


    <!-- Меню -->
<nav class="space-y-4 md:space-y-0 md:flex md:space-x-2 justify-center mx-auto ml-40">
    <!-- Перший блок -->
    <div class="flex flex-col space-y-2 md:space-y-0">
        <a href="#" class="text-gray-700 hover:text-blue-500">Жіночий одяг</a>
        <a href="#" class="text-gray-700 hover:text-blue-500">Чоловічий одяг</a>
    </div>

    <!-- Другий блок -->
    <div class="flex flex-col space-y-2 md:space-y-0">
        <a href="#" class="text-gray-700 hover:text-blue-500">Аксесуари</a>
        <a href="#" class="text-gray-700 hover:text-blue-500">Новинки</a>
    </div>

    <!-- Третій блок -->
    <div class="flex flex-col space-y-2 md:space-y-0">
        <a href="#" class="text-gray-700 hover:text-blue-500">Купити зараз</a>
        <a href="#" class="text-gray-700 hover:text-blue-500">Знижки</a>
    </div>

    <!-- Четвертий блок -->
    <div class="flex flex-col space-y-2 md:space-y-0">
        <a href="#" class="text-gray-700 hover:text-blue-500">Блог</a>
        <a href="#" class="text-gray-700 hover:text-blue-500">Про нас</a>
    </div>

    <!-- П'ятий блок -->
    <div class="flex flex-col space-y-2 md:space-y-0">
        <a href="#" class="text-gray-700 hover:text-blue-500">Мода весна-літо</a>
        <a href="#" class="text-gray-700 hover:text-blue-500">Нічні виходи</a>
    </div>

    <!-- Шостий блок -->
    <div class="flex flex-col space-y-2 md:space-y-0">
        <a href="#" class="text-gray-700 hover:text-blue-500">Стиль для бізнесу</a>
        <a href="#" class="text-gray-700 hover:text-blue-500">Класика</a>
    </div>
</nav>




        <!-- Кнопки реєстрації та входу -->
        <div class="auth-buttons">
            <button>Реєстрація</button>
            <button>Вхід</button>
        </div>
    </header>

    <!-- Сітка медіа-карток -->
    <main class="max-w-7xl mx-auto py-10 px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php for ($i = 1; $i <= 8; $i++): ?>
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

    <!-- Футер -->
    <footer class="bg-white shadow-inner mt-10">
        <div class="max-w-7xl mx-auto p-4 text-center text-sm text-gray-500">
            &copy; <?= date("Y") ?> Хапай LOOK. Всі права захищено.
        </div>
    </footer>

    <!-- Ваш JavaScript код -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const logo = document.getElementById("logo");
            if (logo) {
                logo.addEventListener("click", function() {
                    // Додати анімацію трусіння логотипу
                    this.classList.add("animate-shake");

                    // Вибір випадкових смайликів
                    const emojis = ["😊", "😍", "😎", "😂", "😜"];
                    const randomEmoji = emojis[Math.floor(Math.random() * emojis.length)];

                    // Створення елемента для смайлика
                    const emojiElement = document.createElement("span");
                    emojiElement.classList.add("emoji");
                    emojiElement.textContent = randomEmoji;

                    // Позиціювання смайлика поруч з логотипом
                    const logoPosition = this.getBoundingClientRect();
                    emojiElement.style.left = logoPosition.left + logoPosition.width / 2 - 22 + "px"; // Центруємо смайлик по горизонталі
                    emojiElement.style.top = logoPosition.top - 20 + "px"; // Ставимо смайлик трохи вище логотипу

                    // Додавання смайлика до тіла
                    document.body.appendChild(emojiElement);

                    // Видалити смайлик через 2 секунди
                    setTimeout(() => {
                        emojiElement.remove();
                    }, 2000); // Смайлик зникає через 2 секунди
                });
            }
        });
    </script>
</body>
</html>
