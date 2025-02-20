<?php
require_once __DIR__ ."/../../config/connect_db_helper.php";
require_once __DIR__ ."/../models/book_model.php";
class AddingController{
private $modle;
public function __construct(){
    $this->modle = new Book_model();
}
public function showAddPage(){
    require_once __DIR__ ."/../views/adding_book/page.php";
}
public function addBook(string $isbn,string $title,int $stock ,float $price, int $publication){
    try {
        //code...
        $this->modle->addBook($isbn, $title, $stock, $price, $publication);
    } catch (\Throwable $th) {
        //throw $th;
    }

}
}
?>