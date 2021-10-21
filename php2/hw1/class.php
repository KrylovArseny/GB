<?php
class Product
{
    public $id;
    public $article;
    public $category;
    public $title;
    public $price;

    public function __construct($article, $category, $title, $count, $price)
    {
        $this->article = $article;
        $this->category = $category;
        $this->title = $title;
        $this->count = $count;
        $this->price = $price;
    }

    public function view()
    {
        echo "
            <hr><h2>Карточка товара</h2>
            <b>Артикул:</b> $this->article<br>
            <b>Категория:</b> $this->category<br>
            <b>Наименование:</b> $this->title<br>
            <b>Количество на складе:</b> $this->count шт.<br>
            <b>Цена:</b> $this->price <br>
        ";
    }

    // Списание товара со склада
    public function removeFromStock($number)
    {
        echo "<hr><h2>Списание со склада</h2>";
        if (($this->count - $number) < 0) {
            echo "<b>Недостаточное количество товара на складе для списания: $number шт.!</b><br>";
        } else {
            $this->count -= $number;
            echo "<b>Списание товара $this->title в количестве $number шт. выполнено успешно!</b><br>";
        }
        echo "<b>Остаток на складе:</b> $this->count шт.<br>";
        
    }

}

// Уцененый товар (брак)
class Discount extends Product
{
    public $sale;

    function __construct($article, $category, $title, $count, $price, $sale)
    {
        parent::__construct($article, $category, $title, $count, $price);
        $this->sale = $sale;
        $this->newprice = $price - $sale;
        
    }

    public function view()
    {
        parent::view();
        echo "
            <b>скидка:</b> $this->sale<br>
            <b>Новая цена</b> $this->newprice<br>
        ";
    }
}

$good1 = new Product(1, "Неттопы", "Lenovo ThinkCentre M710q",
    4, 500);
$good1->view();
$good1->removeFromStock(2);
$good1->view();


$good2 = new Discount(1, "Sale", "Lenovo ThinkCentre M710q",
    4, 500, 100);
$good2->view();
$good2->removeFromStock(2);
$good2->view();