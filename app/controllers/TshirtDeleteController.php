<?php
require_once dirname(__DIR__) . '/models/TshirtModel.php';
require dirname(__DIR__) . '/utils/session.php';

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    http_response_code(403);
    header('Location: page403.php');
    exit;
} else {
    if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'editor') {

        $tshirtid = isset($_POST['tshirtid']) ? $_POST['tshirtid'] : '';
        $errors = [];

        if (empty($tshirtid)) {
            $errors[] = "Tshirt ID cannot be empty.";
        }
        if (!is_numeric($tshirtid)) {
            $errors[] = "Tshirt ID must be a numeric value.";
        }

        if (empty($errors)) {
            $tshirtmodel = new TshirtModel($db);
            $deletetshirt = $tshirtmodel->deleteTshirt($tshirtid);

            if ($deletetshirt) {
                header("Location: gettshirt.php");
                exit;
            } else {
                $errors[] = "Failed to delete the T-shirt.";
            }
        }

        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        http_response_code(403);
        header("Location: page403.php");
    }
}
