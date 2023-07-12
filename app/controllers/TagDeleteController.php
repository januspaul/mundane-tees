<?php
require_once dirname(__DIR__) . '/models/TagModel.php';
require dirname(__DIR__) . '/utils/session.php';

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    http_response_code(403);
    header('Location: page403.php');
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    http_response_code(403);
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['tagid'])) {
    $tagID = $_POST['tagid'];

    $tagModel = new TagModel($db);

    $existingTag = $tagModel->getTag($tagID);
    if ($existingTag) {
        $deleteResult = $tagModel->deleteTag($tagID);
        if ($deleteResult) {
            header("Location: gettag.php");
            exit;
        } else {
            $error = "Failed to delete tag.";
        }
    } else {
        http_response_code(404);
        $error = "Tag not found.";
    }
} else {
    $error = "Tag ID is missing.";
}

if (isset($error)) {
    echo $error;
}
