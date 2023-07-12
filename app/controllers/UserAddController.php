<?php
require_once dirname(__DIR__) . '/models/AuthModel.php';
require dirname(__DIR__) . '/utils/session.php';

$presetRoles = array("viewer", "editor" , "admin");

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    http_response_code(403);
    header('Location: page403.php');
    exit;
} else {
    if ($_SESSION['role'] === 'admin') {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? '';
            $errors = [];

            $usermodel = new UserModel($db);

            $existingUser = $usermodel->getUserByUsername($username);

            if ($existingUser) {
                $errors[] = "Username already exists";
            } 
            if (empty($username)) {
                $errors[] = "Username cannot be empty";
            } 
            if (empty($password)) {
                $errors[] = "Password cannot be empty";
            } 
            if (empty($role)) {
                $errors[] = "Role cannot be empty";
            } 
            if (!preg_match('/^[a-zA-Z][a-zA-Z0-9_]*$/', $username)) {
                $errors[] = "Username must start with an alphabet, and must only contain alphanumeric characters and underscores.";
            }
            if (strlen($password) < 8) {
                $errors[] = "Password must be 8 characters or more";
            }
            if (!in_array($role, $presetRoles)) {
                $errors[] = "Invalid role selected.";
            }

            if (empty($errors)) {
                $usermodel = new UserModel($db);

                $adduser = $usermodel->addUser($username, $password, $role);

                if ($adduser) {
                    $response = ['success' => true];
                } else {
                    $response = ['success' => false, 'error' => "Failed to add user."];
                }
            } else {
                $response = ['success' => false, 'errors' => $errors];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

        require_once dirname(__DIR__) . '/views/user/useradd.php';
    } else {
        http_response_code(403);
        header("Location: page403.php");
    }
}
