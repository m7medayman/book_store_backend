<?php
class Book_model {

    private $db;
    private const table_name="books";
    public function __construct(){
        $this->db=DbHelper::getInstance();
        
        
    }
    public function addBook(string $isbn,string $title,int $stock ,float $price, int $publication){
        $book= array(
            "isbn"=>$isbn,
            "title"=>$title,
            "price"=>$price,
            "publication_year"=>$publication
        );
        $this ->db->add_query($book,self::table_name);
    
    }
    public function fetchAllBooks(){
        $books= $this->db->query("SELECT * FROM books ");
        return $books;

    }
}
?>