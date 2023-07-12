<?php
require_once dirname(__DIR__) . '/models/TshirtModel.php';
require dirname(__DIR__) . '/utils/session.php';

$presetSizes = array("xxs", "xs", "s", "m", "l", "xl", "xxl", "");
$presetSleeves = array("Short", "Long", "");
$presetStyles = array("Casual", "Formal", "Sporty", "");
$presetNeckShapes = array("Round", "VNeck", "CrewNeck", "");
$presetSexes = array("Male", "Female", "Unisex", "");

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    http_response_code(403);
    header('Location: page403.php');
    exit;
} else {
    $tshirtModel = new TshirtModel($db);

    $perPage = 6;

    if (isset($_GET['search'])) {
        $searchQuery = $_GET['search'] ? $_GET['search'] : '';
        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $currentPage = max(1, $currentPage);
        $sizeFilter = isset($_GET['size']) ? $_GET['size'] : '';
        $styleFilter = isset($_GET['style']) ? $_GET['style'] : '';
        $sleeveFilter = isset($_GET['sleeve']) ? $_GET['sleeve'] : '';
        $neckshapeFilter = isset($_GET['neckshape']) ? $_GET['neckshape'] : '';
        $sexFilter = isset($_GET['sex']) ? $_GET['sex'] : '';
        $errors = [];

        if (!in_array($sizeFilter, $presetSizes)) {
            $errors['size'] = 'Invalid size selected';
        }
        if (!in_array($styleFilter, $presetStyles)) {
            $errors['style'] = 'Invalid style selected';
        }
        if (!in_array($sleeveFilter, $presetSleeves)) {
            $errors['sleeve'] = 'Invalid sleeve selected';
        }
        if (!in_array($neckshapeFilter, $presetNeckShapes)) {
            $errors['neckshape'] = 'Invalid neckshape selected';
        }
        if (!in_array($sexFilter, $presetSexes)) {
            $errors['sex'] = 'Invalid sex selected';
        }
        if (!preg_match('/^[a-zA-Z0-9\s]*$/', $searchQuery)) {
            $errors['searchquery'] = "Input contains invalid characters.";
        }
        if (empty($errors)) {
            $tshirtData = $tshirtModel->searchTshirts($searchQuery, $currentPage, $perPage, $sizeFilter, $styleFilter, $sleeveFilter, $neckshapeFilter, $sexFilter);
            $tshirtList = $tshirtData['results'];
            $totalTshirts = $tshirtData['total'];
        }
    } else {
        
        $totalTshirts = $tshirtModel->getTotalTshirts();
        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $currentPage = max(1, $currentPage);
        $currentPage = min($currentPage, ceil($totalTshirts / $perPage));
        $offset = ($currentPage - 1) * $perPage;
        $tshirtList = $tshirtModel->getTshirtsByPage($perPage, $offset);
    }

    if (isset($_GET['ajax'])) {
        $response = [
            'success' => true,
            'tshirts' => $tshirtList,
        ];
        echo json_encode($response);
        exit;
    }

    require_once dirname(__DIR__) . '/views/dashboard.php';
}
