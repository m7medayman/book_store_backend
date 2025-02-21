<?php
require_once __DIR__ . '/../app/controllers/AddingController.php';
require_once __DIR__ . '/../app/controllers/home_controller.php';
require_once __DIR__ . '/../app/controllers/update_controller.php';
$addController=new AddingController();
$updateController=new UpdateController();
$homeController=new HomeController();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Content-Type: application/json");

    // Read the raw input
    $rawInput = file_get_contents("php://input");
    $data = json_decode($rawInput, true);

    if (isset($data["addForm"])) {
        $addController->addBook($data["addForm"]);
        exit; // Stop execution after handling the request
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
    switch ($_GET['page']) {
        case 'add_page':
            $addController->showPage();
            break;
        case 'home_page':
            $homeController->showPage();
            break;
        case 'update_page':
            $updateController->showPage();
            break;
        default:
        $homeController->showPage();
            break;
    }
} else {
    $homeController->showPage();
}

?>