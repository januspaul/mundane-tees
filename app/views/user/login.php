<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>

<body>
    <div class="video-container d-none d-md-block">
        <video src="images/login-background.mp4" autoplay loop muted>
            Your browser does not support video playback.
        </video>
    </div>
    <div class="container">
        <div class="row justify-content-center text-center pt-5">
            <h1 class="display-1 text-styling">LOGIN</h1>
            <div class="col-sm-6">
                <form id="login-form" class="login-form">
                    <div class="mb-3 p-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" />
                    </div>
                    <div class="mb-3 p-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-lg text-styling p-2">Log In</button>
                    </div>
                </form>
                <div id="error-message" class="alert alert-danger mt-5" role="alert" style="display: none;"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/login.js"></script>
</body>

</html>