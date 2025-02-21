<?php
require_once __DIR__ ."/../../config/connect_db_helper.php";
require_once __DIR__ ."/../models/book_model.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
class UpdateController{
private $modle;
public function __construct(){
    $this->modle = new Book_model();
}
public function showPage(){
    require_once __DIR__ ."/../views/update_book/page.php";
}
public function updateBook(array $data){
    try {
        //code...
        $this->modle->updateBook($data["isbn"], $data["title"], $data["stock"], $data["price"], $data["year"]);
        echo json_encode(array("message"=>"success"));
    } catch (\Throwable $th) {
        //throw $th;
        echo json_encode(array("message"=> $th->getMessage()));
    }

}
}
?>