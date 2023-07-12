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

        $tagid = isset($_GET['tagid']) ? $_GET['tagid'] : '';

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tagid = $_POST['tagid'] ?? '';
            $tagname = $_POST['tagname'] ?? '';

            $errors = [];

            if (empty($tagname)) {
                $errors[] = "Tag Name cannot be empty";
            }
            
            if (empty($errors)) {
                $edittag = $tagmodel->updateTag($tagid, $tagname);

                if ($edittag) {
                    $response = ['success' => true];
                } else {
                    $response = ['success' => false, 'errors' => "Failed to edit tag."];
                }
            } else {
                $response = ['success' => false, 'errors' => $errors];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

        $tag = $tagmodel->getTag($tagid);
        if (empty($tag)) {
            echo "Tag not found.";
            exit;
        }

        require_once dirname(__DIR__) . '/views/tag/tagedit.php';
    } else {
        http_response_code(403);
        header("Location: page403.php");
    }
}
