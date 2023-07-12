<?php require_once '../app/utils/session.php';

if (!$_SESSION['authenticated']) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ccc0c5013b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <nav class="navbar sticky-top" style="background-color: black;">
        <div class="container-fluid">
            <div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="btn btn-sm" href="dashboard.php?search=&page=1"><i class="fa-solid fa-house fa-md" style="color: whitesmoke;"></i>
                            <h5 style="color: whitesmoke;">Home</h5>
                        </a>
                    </li>
                    <?php if ($_SESSION['role'] === 'admin') : ?>
                        <li class="nav-item">
                            <a class="btn btn-sm" id="tshirtsLink" href="gettshirt.php?page=1"><i class="fa-solid fa-shirt fa-md" style="color: whitesmoke;"></i>
                                <h5 style="color: whitesmoke;">Shirts</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-sm" href="getusers.php?page=1" id="usersLink"><i class="fa-solid fa-user fa-md" style="color: whitesmoke;"></i>
                                <h5 style="color: whitesmoke;">Users</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-sm" href="gettag.php" id="usersLink"><i class="fa-solid fa-tags fa-md" style="color: whitesmoke;"></i>
                                <h5 style="color: whitesmoke;">Tags</h5>
                            </a>
                        </li>
                    <?php elseif ($_SESSION['role'] === 'editor') : ?>
                        <li class="nav-item">
                            <a class="btn btn-sm" id="tshirtsLink" href="gettshirt.php?page=1"><i class="fa-solid fa-shirt fa-md" style="color: whitesmoke;"></i>
                                <h5 style="color: whitesmoke;">Shirts</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-sm" href="gettag.php" id="usersLink"><i class="fa-solid fa-tags fa-md" style="color: whitesmoke;"></i>
                                <h5 style="color: whitesmoke;">Tags</h5>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="ms-auto">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="btn btn-sm" href="logout.php"><i class="fa-solid fa-right-from-bracket fa-md" style="color: whitesmoke;"></i>
                            <h5 style="color: whitesmoke;">Logout</h5>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>