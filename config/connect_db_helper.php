<?php
declare(strict_types=1);
class DbHelper{
    private static ?DbHelper $instance = null;
    public static function getInstance(): DbHelper {
        if (self::$instance === null) {
            self::$instance = new DbHelper();
        }
        return self::$instance;
    }
    private string $user;
    private string $password;
    const  dataBase='mysql:host=localhost;dbname=test;charset=utf8mb4';
    public $dbh;
    public function __construct(
       string $user="root", string $password="" 
    ){
        $this->user=$user;
        $this->password=$password;
        try{
        $this->dbh = new PDO( self::dataBase, $this->user,$this->password);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        
        } catch(PDOException $e){
            die("Connection failed: " . $e->getMessage());
        }

    }
    // the query list to add to will be associative array with key and value 
    public function add_query( array $query_list , string $table_name){
        try {
            //code...
            $columns=implode(",",array_keys($query_list));
            $placeholders=":".implode(", :",array_keys($query_list)); // will be the same of names but with ":" before the name
            $sql="INSERT INTO $table_name ($columns) VALUES ($placeholders)";
            $stmt = $this->dbh->prepare($sql);
          foreach ($query_list as $key => $value) {
            $stmt->bindValue(":".$key,$value);
          }
          $stmt->execute();
        } catch (PDOException $e) {
            //throw $th;
            

            throw $e;
        }

    }
    public function query(string $query) {
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->execute();
    
            // Check if the query was a DELETE, UPDATE, or INSERT
            if (preg_match('/^\s*(DELETE|UPDATE|INSERT)\s/i', $query)) {
                return $stmt->rowCount(); // Return the number of affected rows
            }
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return fetched data for SELECT queries
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    // public function query_() {
    //     try {
    //         //code...
    //         // $columns=implode(",",array_keys($query_list));
    //         // $placeholders=":".implode(", :",array_keys($query_list)); // will be the same of names but with ":" before the name
    //     $q=array();           
    //         foreach() 
    //         $sql="INSERT INTO $table_name ($columns) VALUES ($placeholders)";
    //         $stmt = $this->dbh->prepare($sql);
    //       foreach ($query_list as $key => $value) {
    //         $stmt->bindValue(":".$key,$value);
    //       }
    //       $stmt->execute();
    //     } catch (PDOException $e) {
    //         //throw $th;
            

    //         throw $e;
    //     }

    // }
}
?>