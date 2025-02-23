<?php
require_once __DIR__ . '/../app/controllers/AddingController.php';
require_once __DIR__ . '/../app/controllers/home_controller.php';
require_once __DIR__ . '/../app/controllers/update_controller.php';
require_once __DIR__ . '/../app/controllers/authentication_contoller.php'; 
 $addController=new AddingController();
$updateController=new UpdateController();
$homeController=new HomeController();
$authController= new AuthenticationController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Content-Type: application/json");

    // Read the raw input
    $rawInput = file_get_contents("php://input");
    $data = json_decode($rawInput, true);

    if (isset($data["addForm"])) {
        $addController->addBook($data["addForm"]);
        exit; // Stop execution after handling the request
    }
    if(isset($data["signup_form"])){
        $user_data= $data["signup_form"];
        $authController->signup($user_data["user"],$user_data["password"]);
        exit;    
    }
    if(isset($data["login_form"])){
        $user_data= $data["login_form"];
        $authController->login($user_data["user"],$user_data["password"]);
        exit;    
    }
    

    if (isset($data["updateForm"])) {
        $updateController->updateBook($data["updateForm"]);
        exit; // Stop execution after handling the request
    }
    if (isset($data["get_books"])) {
        $homeController->fetchAllBooks();
        exit; // Stop execution after handling the request
    } 
    if (isset($data["delete_isbn"])) {
        $homeController->deleteBook($data["delete_isbn"]);
        exit; // Stop execution after handling the request
    }
     else {
        echo json_encode(["message" => "Invalid request"]);
        exit;
    }
}
if (isset($_GET['page'])) {
$page = $_GET['page'];
$isUser=$authController->checkAuth();
$page =redirect($page,$isUser);
  get_page($page);
} else {
    header("Location: index.php?page=home_page");
    exit();
} 


function redirect($page,$isUser){
if($isUser){
    if($page=="login_page" || $page=="signup_page"){
        $page='home_page';
        header("Location: index.php?page=$page");
        exit();
    }
}else{
    if(!($page == "login_page" || $page == "signup_page" )){
        $page="login_page";
        header(header: "Location: index.php?page=$page");
        exit();
    }
   
}
return $page;



    // if(!$isUser&& ($page!="login_page" && $page!="signup_page")){
    //     $page='login_page';
    //     header("Location: index.php?page=$page");
    // exit(); 
    // }
    // if(($page==="login_page" || $page==="signup_page")&& $isUser ){
    //     $page='home_page';
    //     header("Location: index.php?page=$page");
    //     exit();
    // }
    // return $page;
}
function get_page($page){
    global $addController, $updateController, $homeController, $authController;


    switch ($page) {
        case 'add_page':
        $addController->showPage();
            break;
        case 'home_page':
            $homeController->showPage();
            break;
        case 'update_page':
            $updateController->showPage();
            break;
        case 'login_page':
                $authController->showLoginPage();
                break;
        case 'signup_page':
                    $authController->showSignupPage();
                    break;      
        default:
        header("Location: index.php?page=home_page");
        exit();
    }
}

?>