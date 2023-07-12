<?php
require_once dirname(__DIR__) . '/models/AuthModel.php';
require dirname(__DIR__) . '/utils/session.php';

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    http_response_code(403);
    header('Location: page403.php');
    exit;
} else {
    if ($_SESSION['role'] === 'admin') {
        $userModel = new UserModel($db);

        $perPage = 5;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $totalUsers = $userModel->getTotalUsers();
        $totalPages = ceil($totalUsers / $perPage);

        if ($currentPage < 1) {
            $currentPage = 1;
        } elseif ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }

        $userList = $userModel->getAllUsers($perPage, $currentPage);

        if (empty($userList)) {
            $errorMessage = "No users found.";
            exit;
        }

        require_once dirname(__DIR__) . '/views/user/userlist.php';
    } else {
        http_response_code(403);
        header("Location: page403.php");
        exit;
    }
}
