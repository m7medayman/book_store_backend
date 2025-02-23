<?php
require_once __DIR__ ."/../models/auth_model.php";
 class AuthenticationController {

private $model;
    public function __construct() {
        session_start();
        $this->model = new AuthModel();
    }public function showLoginPage(){
      require_once __DIR__ ."/../views/auth/login_page.php";
  }
  public function showSignupPage(){
   require_once __DIR__ ."/../views/auth/signup_page.php";
}
 public function login(string $user_name, string $password){
   try {
      //code...
      $user= $this->model->login($user_name,$password);
      if(!empty($user)){
         $this->setUser($user);
         header("Content-Type: application/json");
         echo json_encode(array("message"=>"success"));
      }
      else{
         header("Content-Type: application/json");
         echo json_encode(array("message"=>"something went wrong "));
      }
   } catch (\Throwable $th) {
      //throw $th;
      echo json_encode(array("message"=> $th->getMessage()));
   }
}
 public function logout(){
 try {
   //code...
   if($this->checkAuth()){
      $this->clearUser();
    }
 } catch (\Throwable $th) {
   //throw $th;
   echo json_encode(array("message"=> $th->getMessage()));
 }
 }
 public function signup(string $user_name, string $password){
try {
   //code...
   $user= $this->model->singup($user_name,$password);
   if(!empty($user)){
      $this->setUser($user);
      header("Content-Type: application/json");
      echo json_encode(array("message"=>"success"));
   }
   else{
      header("Content-Type: application/json");
      echo json_encode(array("message"=>"something went wrong"));
   }
} catch (\Throwable $th) {
   //throw $th;
   echo json_encode(array("message"=> $th->getMessage()));
}
 }
 public function checkAuth(){
    // return true if user is logged in
    return isset($_SESSION["user"]);
 }
public function getUser(){
    return $_SESSION["user"];

 }
 private function setUser($user){
    $_SESSION["user"] = $user;
 }
private function clearUser(){
    unset($_SESSION["user"]);
 }
// public function isAdmin(){
//     return $this->isLoggedIn() && $this->getUser()["role"] == "admin";
//  }
// public function isUser(){
//     return $this->isLoggedIn() && $this->getUser()["role"] == "user";
//  }
  
}
?>