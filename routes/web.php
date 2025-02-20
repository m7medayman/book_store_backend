<?php
require_once __DIR__ . '/../app/controllers/AddingController.php';
require_once __DIR__ . '/../app/controllers/home_controller.php';
$addController=new AddingController();
$homeController=new HomeController();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Content-Type: application/json");

    // Read the raw input
    $rawInput = file_get_contents("php://input");
    $data = json_decode($rawInput, true);

    if (isset($data["addForm"])) {
        $addController->addBook($data["form"]);
        exit; // Stop execution after handling the request
    }
    if (isset($data["get_books"])) {
        $homeController->fetchAllBooks();
        exit; // Stop execution after handling the request
    } 
     else {
        echo json_encode(["message" => "Invalid request"]);
        exit;
    }
}
if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'add_page':
            $addController->showPage();
            break;
        case 'about':
            $aboutController->showAboutPage();
            break;
        default:
        $addController->showPage();
            break;
    }
} else {
    $homeController->showPage();
}

?>