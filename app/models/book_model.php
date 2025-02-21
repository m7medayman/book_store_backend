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
            "publication_year"=>$publication,
            "stock"=>$stock
        );
        $this ->db->add_query($book,self::table_name);
    
    }
    public function fetchAllBooks(){
        $books= $this->db->query("SELECT * FROM books ");
        return $books;

    }
    public function deleteBook(string $isbn){
        $n= $this->db->query("DELETE FROM books WHERE isbn='$isbn'");
        return $n;
    }
    public function updateBook(string $isbn,string $title,int $stock ,float $price, int $publication){
        $update= $this->db->query("UPDATE books SET title='$title', price=$price, publication_year=$publication,stock=$stock WHERE isbn='$isbn'
        ");
        return $update;
    }
    
}
?>