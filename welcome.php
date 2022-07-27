<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/ff138b9600.js" crossorigin="anonymous"></script>
    <script src="http://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link rel="icon" href="icons/cricket-2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="welcomestyle.css?v=<?php echo time(); ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Foundation:wght@500&display=swap" rel="stylesheet">
    <title>Cricketor</title>
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
    <style>
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <h1 id="h1tag" style="margin-left:9%;margin-right:76%;">CRICKETOR <i class="icon fa-solid fa-baseball"></i></h1>
    <div class="main">
        <div class="row">
            <div class="nwcls col-lg-6">
                <div class="c-design">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="cric11.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="cric2.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="cric6.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

            </div>
            <div class="y2 col-lg-6">
                <h2 class="my-5">Hey, <b><?php echo htmlspecialchars($_SESSION["username"]); ?> !</b><br> Welcome to the original cricket scoring platform <span class="x">CRICKETOR</span>
                </h2>
            </div>
        </div>
        <div class="up">
            <!--<span><img class="iconic" src="icons/cricket.png" alt="batsman-icon"></span>-->
            <div class="row" style="margin-bottom:15%;">
                <div class="col-lg-6" style="padding-left:24%;"><button class="btn btn-dark btn-lg"><a class="b1" href="generate.php"><i class="fa-regular fa-keyboard"></i> Create a scoreboard</a></button></div>
                <div class="col-lg-6" style="padding-right:39%;"><button class="btn btn-outline-light btn-lg"><a class="b2" href="spec-code.php"><i class="fa-solid fa-glasses"></i> Spectate</a></button></div>
            </div>
        </div>
    </div>
</body>

</html>