<?php
class HomeController {
    private $modle;
public function __construct(){
    $this->modle = new Book_model();
}
public function showPage(){
    require_once __DIR__ ."/../views/home/page.php";
}
public function fetchAllBooks(){
    try {
        //code...
$rawData=$this->modle->fetchAllBooks();
$response = [
    "message" => "success",
    "books" => $rawData
];
header("Content-Type: application/json");
echo json_encode($response);

    } catch (\Throwable $th) {
        //throw $th;
        echo json_encode(array("message"=> $th->getMessage()));
    }
}
public function deleteBook($isbn){
    try {
        //code...
       $rowNum= $this->modle->deleteBook($isbn);
        $response = [
            "message" => "success",
            "row" => $rowNum
        ];
        header("Content-Type: application/json");
        echo json_encode($response);

    } catch (\Throwable $th) {
        //throw $th;
        // header("Content-Type: application/json");
        echo json_encode(array("message"=> $th->getMessage()));
    }
}
}

?>