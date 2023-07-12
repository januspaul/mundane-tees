<?php
require_once dirname(__DIR__) . '/models/AuthModel.php';
require dirname(__DIR__) . '/utils/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $errors = [];

    if (empty($username)) {
        $errors[] = "Username cannot be empty.";
    }
    if (!preg_match('/^[a-zA-Z][a-zA-Z0-9_]*$/', $username)) {
        $errors[] = "Username contains invalid characters.";
    }

    if (empty($password)) {
        $errors[] = "Password cannot be empty.";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password cannot be less than 8 characters.";
    }

    if (empty($errors)) {
        $authModel = new UserModel($db);
        $user = $authModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['Password'])) {
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['role'] = $user['Role'];
            $_SESSION['authenticated'] = true;

            $response = ['success' => true];
        } else {
            $response = ['success' => false, 'errors' => ['Invalid username or password.']];
        }
    } else {
        $response = ['success' => false, 'errors' => $errors];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
require_once dirname(__DIR__) . '/views/user/login.php';
