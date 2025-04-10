<?php
class User {
    public $id;
    public $name;
    public $email;

    public function __construct($id, $name, $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }
}

class Librarian extends User {
    public function __construct($id, $name, $email) {
        parent::__construct($id, $name, $email);
    }

    public function addBook($library, $book) {
        $library->addBook($book);
    }

    public function removeBook($library, $bookTitle) {
        $library->removeBook($bookTitle);
    }
}

class Reader extends User {
    public $loans = [];

    public function __construct($id, $name, $email) {
        parent::__construct($id, $name, $email);
    }

    public function borrowBook($library, $bookTitle) {
        $loan = $library->loanBook($bookTitle, $this);
        if ($loan) {
            $this->loans[] = $loan;
        }
    }

    public function returnBook($library, $bookTitle) {
        $loanIndex = array_search($bookTitle, array_map(function($loan) {
            return $loan->book->title;
        }, $this->loans));
        
        if ($loanIndex !== false) {
            $loan = $this->loans[$loanIndex];
            $library->returnBook($loan);
            unset($this->loans[$loanIndex]);
        } else {
            echo "У вас немає книги \"$bookTitle}\", щоб її повернути.<br>";
        }
    }
}

class Book {
    public $title;
    public $author;
    public $isAvailable;

    public function __construct($title, $author) {
        $this->title = $title;
        $this->author = $author;
        $this->isAvailable = true;
    }
}

class Loan {
    public $book;
    public $reader;
    public $dueDate;

    public function __construct($book, $reader, $dueDate) {
        $this->book = $book;
        $this->reader = $reader;
        $this->dueDate = $dueDate;
    }
}

class Library {
    public $books = [];
    public $users = [];
    public $loans = [];

    public function addBook($book) {
        $this->books[] = $book;
        echo "Книга \"{$book->title}\" додана до бібліотеки.<br>";
    }

    public function removeBook($bookTitle) {
        $index = array_search($bookTitle, array_map(function($book) {
            return $book->title;
        }, $this->books));
        
        if ($index !== false) {
            if ($this->books[$index]->isAvailable) {
                unset($this->books[$index]);
                echo "Книга \"$bookTitle\" видалена з бібліотеки.<br>";
            } else {
                echo "Книгу \"$bookTitle\" не можна видалити, оскільки вона у позиченні.<br>";
            }
        } else {
            echo "Книгу \"$bookTitle\" не знайдено в бібліотеці.<br>";
        }
    }

    public function addUser($user) {
        $this->users[] = $user;
        echo "Користувач \"{$user->name}\" доданий до бібліотеки.<br>";
    }

    public function loanBook($bookTitle, $reader) {
        $book = $this->findBook($bookTitle);
        
        if ($book && $book->isAvailable) {
            $book->isAvailable = false;
            $dueDate = date('Y-m-d', strtotime('+14 days'));
            $loan = new Loan($book, $reader, $dueDate);
            $this->loans[] = $loan;
            echo "Книга \"$bookTitle\" видана читачу \"{$reader->name}\" до $dueDate.<br>";
            return $loan;
        } else {
            echo "Книга \"$bookTitle\" вже у позиченні або не знайдена.<br>";
            return null;
        }
    }

    public function returnBook($loan) {
        $index = array_search($loan, $this->loans);
        
        if ($index !== false) {
            $loan->book->isAvailable = true;
            unset($this->loans[$index]);
            echo "Книга \"{$loan->book->title}\" повернута читачем \"{$loan->reader->name}\".<br>";
        } else {
            echo "Позика не знайдена.<br>";
        }
    }

    public function checkOverdueLoans() {
        $today = date('Y-m-d');
        foreach ($this->loans as $loan) {
            if ($loan->dueDate < $today) {
                echo "Книга \"{$loan->book->title}\" прострочена! Взята читачем \"{$loan->reader->name}\".<br>";
            }
        }
    }

    private function findBook($bookTitle) {
        foreach ($this->books as $book) {
            if ($book->title === $bookTitle) {
                return $book;
            }
        }
        return null;
    }
}

$library = new Library();

$book1 = new Book("1984", "Джордж Орвелл");
$book2 = new Book("Убити пересмішника", "Гарпер Лі");
$library->addBook($book1);
$library->addBook($book2);

$librarian = new Librarian(1, "Вадім", "vadim@example.com");
$reader1 = new Reader(2, "Деніс", "denis@example.com");
$reader2 = new Reader(3, "Кіріл", "kiril@example.com");
$reader3 = new Reader(4, "Артем", "artem@example.com");

$library->addUser($librarian);
$library->addUser($reader1);
$library->addUser($reader2);
$library->addUser($reader3);

$book3 = new Book("Прекрасний новий світ", "Олдос Гакслі");
$librarian->addBook($library, $book3);

$reader1->borrowBook($library, "1984");

echo "Список книг у бібліотеці:<br>";
foreach ($library->books as $book) {
    echo "- {$book->title} ({$book->author}) " . ($book->isAvailable ? "Доступна" : "Не доступна") . "<br>";
}

$reader1->returnBook($library, "1984");

$library->checkOverdueLoans();
?>
