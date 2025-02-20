<?php
require_once __DIR__ . '/../app/controllers/AddingController.php';

$addController=new AddingController();

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'add_page':
            $addController->showAddPage();
            break;
        case 'about':
            $aboutController->showAboutPage();
            break;
        default:
        $addController->showAddPage();
            break;
    }
} else {
    $addController->showAddPage();
}
?>