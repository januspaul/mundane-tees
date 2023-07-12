<?php
require_once dirname(__DIR__) . '/models/TshirtModel.php';
require dirname(__DIR__) . '/utils/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
  $query = $_POST['search'];
  $errors = [];
  $pattern = '/^[a-zA-Z0-9\s]+$/';

  if (empty($query)) {
    $errors['query'] = "Input is empty";
  } else if (!preg_match($pattern, $query)) {
    $errors['query'] = "Input contains invalid characters";
  }

  if (empty($errors)) {
    $tshirtmodel = new TshirtModel($db);

    $searchtshirt = $tshirtmodel->searchTshirts($query);

    if ($searchtshirt) {
      $response = ['success' => true, 'results' => $searchtshirt];
    } else {
      $response = ['success' => false, 'errors' => 'failed to search'];
    }
  } else {
    $response = ['success' => false, 'errors' => $errors];
  }

  header('Content-Type: application/json');
  echo json_encode($response);
  exit();
}
require_once dirname(__DIR__) . '/views/searchresult.php';
