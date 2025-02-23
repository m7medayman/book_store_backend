<?php
class AuthModel{
    
    private $db;
    private const table_name="auth";
    public function __construct(){
        $this->db=DbHelper::getInstance();
        
            }

            public function singup(string $user , string $passwrod){
               $response= $this->db->query("
                INSERT INTO auth (user_name, user_password)
VALUES ('$user', SHA2('$passwrod',512));
                ");
                return $response;
}
public function login(string $user ,string $password){
    $response= $this->db->query("SELECT * FROM ".self::table_name." WHERE user_name='$user'AND user_password=SHA2('$password',512)");  
    return $response;
}
}
?>