<?php

require_once dirname(__DIR__) . '/models/TshirtModel.php';
require dirname(__DIR__) . '/utils/session.php';

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    http_response_code(403);
    header('Location: page403.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

$tshirtModel = new TshirtModel($db);
$tshirtId = $_GET['id'];
$tshirt = $tshirtModel->getTshirtById($tshirtId);

if (!$tshirt) {
    http_response_code(404);
    header('Location: page404.php');
    exit;
}


require_once dirname(__DIR__) . '/views/details.php';