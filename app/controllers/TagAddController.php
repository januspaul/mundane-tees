<?php
require_once dirname(__DIR__) . '/models/TagModel.php';
require dirname(__DIR__) . '/utils/session.php';

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    http_response_code(403);
    header('Location: page403.php');
    exit;
} else {
    if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'editor') {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $tagName = $_POST['tagname'] ?? '';

            $errors = [];


            if (empty($errors)) {
                $tagmodel = new TagModel($db);

                $addtag = $tagmodel->createTag($tagName);

                if ($addtag) {
                    $response = ['success' => true];
                } else {
                    $response = ['success' => false, 'errors' => "Failed to add tag."];
                }
            } else {
                $response = ['success' => false, 'errors' => $errors];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
        require_once dirname(__DIR__) . '/views/tag/tagadd.php';
    } else {
        http_response_code(403);
        header("Location: page403.php");
    }
}
