<?php
require_once dirname(__DIR__) . '/models/TshirtModel.php';
require dirname(__DIR__) . '/utils/session.php';

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    http_response_code(403);
    header('Location: page403.php');
    exit;
} else {
    $role = $_SESSION['role'];

    $tshirtmodel = new TshirtModel($db);

    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $currentPage = max(1, $currentPage);

    $perPage = 5;
    $offset = ($currentPage - 1) * $perPage;

    $totalTshirts = $tshirtmodel->getTotalTshirts();
    $totalPages = ceil($totalTshirts / $perPage);

    if ($currentPage > $totalPages) {
        header("Location: tshirtlist.php?page=$totalPages");
        exit;
    }

    if ($role === 'admin') {
        $tshirtlist = $tshirtmodel->getTshirtsByPage($perPage, $offset);
    } elseif ($role === 'editor') {
        $userID = $_SESSION['user_id'];
        $tshirtlist = $tshirtmodel->getTshirtsByUserAndPage($userID, $perPage, $offset);
    }

    if (empty($tshirtlist)) {
        $errormessage = "No t-shirts found.";
    }

    require_once dirname(__DIR__) . '/views/tshirt/tshirtlist.php';
}
