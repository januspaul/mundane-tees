<?php
require_once dirname(__DIR__) . '/models/AuthModel.php';
require dirname(__DIR__) . '/utils/session.php';

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    http_response_code(403);
    header('Location: page403.php');
    exit;
} else {
    if ($_SESSION['role'] === 'admin') {
        $usermodel = new UserModel($db);

        $userid = isset($_POST['userid']) ? $_POST['userid'] : '';

        $errors = [];
        if (empty($userid)) {
            $errors[] = "User ID cannot be empty";
        }

        if (empty($errors)) {
            $existingUser = $usermodel->getUserById($userid);
            if (!$existingUser) {
                $errors[] = "User not found.";
            }
        }

        if (empty($errors)) {
            $deleteuser = $usermodel->deleteUser($userid);

            if ($deleteuser) {
                header("Location: getusers.php");
                exit;
            } else {
                $errors[] = "Failed to delete user.";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
    } else {
        http_response_code(403);
        header("Location: page403.php");
        exit;
    }
}
