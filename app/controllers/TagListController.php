<?php
require_once dirname(__DIR__) . '/models/TagModel.php';
require dirname(__DIR__) . '/utils/session.php';

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    http_response_code(403);
    header('Location: page403.php');
    exit;
} else {
    if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'editor') {
        $tagmodel = new TagModel($db);

        $taglist = $tagmodel->getAllTags();

        if (empty($taglist)) {
            $errormessage = "No tags found.";
        }

        require_once dirname(__DIR__) . '/views/tag/taglist.php';
    } else {
        http_response_code(403);
        header("Location: page403.php");
    }
}
