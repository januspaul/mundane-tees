<?php
require_once dirname(__DIR__) . '/models/TshirtModel.php';
require_once dirname(__DIR__) . '/models/TagModel.php';
require dirname(__DIR__) . '/utils/session.php';

$presetSizes = array("xxs", "xs", "s", "m", "l", "xl", "xxl");
$presetSleeves = array("Short", "Long");
$presetStyles = array("Casual", "Formal", "Sporty");
$presetNeckShapes = array("Round", "VNeck", "CrewNeck");
$presetSexes = array("Male", "Female", "Unisex");
$tagmodel = new TagModel($db);
$tags = $tagmodel->getAllTags();

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    http_response_code(403);
    header('Location: page403.php');
    exit;
} else {
    if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'editor') {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $size = $_POST['size'] ?? '';
            $sleeve = $_POST['sleeve'] ?? '';
            $style = $_POST['style'] ?? '';
            $neckshape = $_POST['neckshape'] ?? '';
            $sex = $_POST['sex'] ?? '';
            $name = $_POST['name'] ?? '';
            $datecreated = date('Y-m-d H:i:s') ?? '';
            $userid = $_SESSION['user_id'] ?? '';
            $tshirttag = $_POST['tags'] ?? [];
            $itemcode = md5($userid . $size . $sleeve . $style . $neckshape . $sex . $name . $datecreated . $userid) ?? '';

            $errors = [];

            if (!in_array($size, $presetSizes)) {
                $errors['size'] = "Invalid size selected.";
            }
            if (!in_array($sleeve, $presetSleeves)) {
                $errors['sleeve'] = "Invalid sleeve selected.";
            }
            if (!in_array($style, $presetStyles)) {
                $errors['style'] = "Invalid style selected.";
            }
            if (!in_array($neckshape, $presetNeckShapes)) {
                $errors['neckshape'] = "Invalid neck shape selected.";
            }
            if (!in_array($sex, $presetSexes)) {
                $errors['sex'] = "Invalid sex selected.";
            }

            if (empty($size)) {
                $errors['size'] = "Size cannot be empty.";
            }

            if (empty($sleeve)) {
                $errors['sleeve'] = "Sleeve cannot be empty.";
            }

            if (empty($style)) {
                $errors['style'] = "Style cannot be empty.";
            }

            if (empty($neckshape)) {
                $errors['neckshape'] = "Neckshape cannot be empty.";
            }

            if (empty($sex)) {
                $errors['sex'] = "Sex cannot be empty.";
            }

            if (empty($name)) {
                $errors['name'] = "Name cannot be empty.";
            }

            if (empty($datecreated)) {
                $errors['datecreated'] = "Date created cannot be empty.";
            }

            if (empty($userid)) {
                $errors['userid'] = "User ID cannot be empty.";
            }

            if (empty($itemcode)) {
                $errors['itemcode'] = "Item code cannot be empty.";
            }

            if (!empty($_FILES['image']['tmp_name'])) {
                $image = $_FILES['image'];
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                $fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

                if (!in_array($fileExtension, $allowedExtensions)) {
                    $errors['image'] = "Invalid file format. Only JPG, JPEG, and PNG files are allowed.";
                }

                if (empty($errors)) {
                    $imageDirectory = DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR;
                    $imagePath = $_SERVER['DOCUMENT_ROOT'] . $imageDirectory . $name . '.' . $fileExtension;
                    $imageWebPath = $imageDirectory . $name . '.' . $fileExtension;
                    move_uploaded_file($image['tmp_name'], $imagePath);
                }
            } else {
                $imageWebPath = 'images/placeholder.jpg';
            }

            if (empty($errors)) {
                $tshirtmodel = new TshirtModel($db);

                $addtshirt = $tshirtmodel->addTshirt($size, $sleeve, $style, $neckshape, $sex, $name, $itemcode, $imageWebPath, $datecreated, $userid);

                if ($addtshirt) {

                    $lastinsertedID = $db->lastInsertId();

                    foreach ($tshirttag as $tagID) {
                        $tshirtmodel->addTagToShirt($tagID, $lastinsertedID);
                    }

                    $response = ['success' => true];
                } else {
                    $response = ['success' => false, 'errors' => "Failed to add t-shirt."];
                }
            } else {
                $response = ['success' => false, 'errors' => $errors];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
        require_once dirname(__DIR__) . '/views/tshirt/tshirtadd.php';
    } else {
        http_response_code(403);
        header("Location: page403.php");
    }
}
