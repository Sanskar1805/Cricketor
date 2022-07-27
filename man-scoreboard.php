<?php
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'cricketx');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$code = $_SESSION['match-code'];
$tname = 1;
$t2name = 2;
$btsmn1name = "";
$btsmn2name = "";
$bowlername = "";
$stmt = mysqli_query($link, "SELECT * FROM `player_details` WHERE flag = 1 and code = '$code'");
while ($row = mysqli_fetch_array($stmt)) {
    $btsmn1name = $row['pname'];
}

$stmt4 = mysqli_query($link, "SELECT * FROM `player_details` WHERE flag = 2 and code = '$code'");
while ($row4 = mysqli_fetch_array($stmt4)) {
    $btsmn2name = $row4['pname'];
}

$stmt6 = mysqli_query($link, "SELECT * FROM `player_details` WHERE flag = 3 and code = '$code'");
while ($row6 = mysqli_fetch_array($stmt6)) {
    $bowlername = $row6['pname'];
}

if (isset($_POST['batsman1-b'])) {
    $btsmn1 = $_POST['batsman1'];
    mysqli_query($link, "UPDATE `player_details` SET flag=0 WHERE flag = 1 and code='$code'");
    mysqli_query($link, "UPDATE `player_details` SET flag = 1 WHERE pname= '$btsmn1' and code='$code' ");
    header("man-scoreboard.php");
}
if (isset($_POST['batsman2-b'])) {
    $btsmn2 = $_POST['batsman2'];
    mysqli_query($link, "UPDATE `player_details` SET flag=0 WHERE flag = 2 and code='$code'");
    mysqli_query($link, "UPDATE `player_details` SET flag = 2 WHERE pname= '$btsmn2' and code='$code' ");
    header("man-scoreboard.php");
}
if (isset($_POST['bowler-b'])) {
    $bwlr = $_POST['bowler'];
    mysqli_query($link, "UPDATE `player_details` SET flag=0 WHERE flag = 3 and code='$code'");
    mysqli_query($link, "UPDATE `player_details` SET flag = 3 WHERE pname= '$bwlr' and code='$code' ");
    header("man-scoreboard.php");
}
if (isset($_POST['team_name-b'])) {
    /*$tname = $_POST['team_name'];
    if ($tname == 1) {
        $t2name = 2;
    } else {
        $t2name = 1;
    }*/
    mysqli_query($link, "UPDATE `team_score` SET bat_flag =  0 WHERE bat_flag = 1 and code = '$code' ");
    mysqli_query($link, "INSERT INTO `team_score` VALUES('',0,'$tname','$code',0,0,1)");
    //mysqli_query($link,"UPDATE `team_score` SET bat_flag = 1 WHERE team='$tname' and code = '$code'");
    header("man-scoreboard.php");
}

$fts7 = "";
$stmt7 = mysqli_query($link, "SELECT * FROM `bowler_stat` WHERE bname = '$bowlername' and code = '$code'");
while ($row7 = mysqli_fetch_array($stmt7)) {
    $fts7 = $row7['bname'];
}

$fts2 = 0;
$fts5 =  0;
$stmt5 = mysqli_query($link, "SELECT * FROM `team_score` WHERE team = $tname and code = '$code'");
while ($row5 = mysqli_fetch_array($stmt5)) {
    $fts5 = $row5['team'];
}
if (isset($_POST['team_score-b'])) {
    $teamscore = $_POST['team_score'];
    if ($fts5 == 0) {
        mysqli_query($link, "INSERT INTO `team_score` VALUES('',$teamscore,'$tname','$code',0,0,1)");
        //mysqli_query($link,"UPDATE `team_score` SET bat_flag =  0 WHERE bat_flag = 1 and code = '$code' ");
        // mysqli_query($link,"UPDATE `team_score` SET bat_flag = 1 WHERE team='$tname' and code = '$code'");
        $fts2 = 1;
        /*
        if($fts7 == $bowlername){
            mysqli_query($link,"UPDATE `bowler_stat` SET runs = runs + $teamscore WHERE bname = '$bowlername' and code = '$code' ");
            mysqli_query($link,"UPDATE `bowler_stat` SET balls = balls + 1 WHERE bname = '$bowlername' and code = '$code' ");
        }else{
            mysqli_query($link,"INSERT INTO bowler_stat VALUES('',$teamscore ,$t2name,1,'$code',0,'$bowlername') ");
        }*/
    } else {
        /*if($fts7 == $bowlername){
            mysqli_query($link,"UPDATE `bowler_stat` SET runs = runs + $teamscore WHERE bname = '$bowlername' and code = '$code' ");
            mysqli_query($link,"UPDATE `bowler_stat` SET balls = balls + 1 WHERE bname = '$bowlername' and code = '$code' ");
        }else{
            mysqli_query($link,"INSERT INTO bowler_stat VALUES('',$teamscore ,$t2name,1,'$code',0,'$bowlername') ");
        }*/
        mysqli_query($link, "UPDATE `team_score` SET score = score + $teamscore WHERE team = $tname  and code = '$code'");
    }
    header("man-scoreboard.php");
}
$fts =  "";
$stmt2 = mysqli_query($link, "SELECT * FROM `player_score` WHERE pname = '$btsmn1name' and code = '$code'");
while ($row2 = mysqli_fetch_array($stmt2)) {
    $fts = $row2['pname'];
}
if (isset($_POST['p1_score-b'])) {
    $p1score = $_POST['p1_score'];
    if ($fts == $btsmn1name) {
        mysqli_query($link, "UPDATE `player_score` SET balls = balls + 1 WHERE pname = '$btsmn1name' ");
        mysqli_query($link, "UPDATE `player_score` SET score = score + $p1score WHERE pname = '$btsmn1name' ");
        mysqli_query($link, "UPDATE `team_score` SET score = score + $p1score WHERE team = $tname  and code = '$code'");
        mysqli_query($link, "UPDATE `team_score` SET balls = balls + 1 WHERE team = $tname  and code = '$code'");
        if ($fts7 == $bowlername) {
            mysqli_query($link, "UPDATE `bowler_stat` SET runs = runs + $p1score WHERE bname = '$bowlername' and code = '$code' ");
            mysqli_query($link, "UPDATE `bowler_stat` SET balls = balls + 1 WHERE bname = '$bowlername' and code = '$code' ");
        } else {
            mysqli_query($link, "INSERT INTO bowler_stat VALUES('',$p1score ,$t2name,1,'$code',0,'$bowlername') ");
        }
    } else {
        mysqli_query($link, "INSERT INTO `player_score` VALUES('',$p1score,'$tname',0,1,'$code','$btsmn1name')");
        if ($fts2 = 0) {
            mysqli_query($link, "INSERT INTO `team_score` VALUES('',$p2score,'$tname','$code',0,0,1)");
            //mysqli_query($link,"UPDATE `team-score` SET bat_flag =  0 WHERE bat_flag = 1 and code = '$code' ");
            //mysqli_query($link,"UPDATE `team_score` SET bat_flag = 1 WHERE team='$tname' and code = '$code'");
        } else {
            mysqli_query($link, "UPDATE `team_score` SET score = score + $p1score WHERE team = $tname  and code = '$code'");
            mysqli_query($link, "UPDATE `team_score` SET balls = balls + 1 WHERE team = $tname  and code = '$code'");
        }

        if ($fts7 == $bowlername) {
            mysqli_query($link, "UPDATE `bowler_stat` SET runs = runs + $p1score WHERE bname = '$bowlername' and code = '$code' ");
            mysqli_query($link, "UPDATE `bowler_stat` SET balls = balls + 1 WHERE bname = '$bowlername' and code = '$code' ");
        } else {
            mysqli_query($link, "INSERT INTO bowler_stat VALUES('',$p1score ,$t2name,1,'$code',0,'$bowlername') ");
        }
    }
    header("man-scoreboard.php");
}

$fts3 =  "";
$stmt3 = mysqli_query($link, "SELECT * FROM `player_score` WHERE pname = '$btsmn2name' and code = '$code'");
while ($row3 = mysqli_fetch_array($stmt3)) {
    $fts3 = $row3['pname'];
}


if (isset($_POST['p2_score-b'])) {
    $p2score = $_POST['p2_score'];
    if ($fts3 == $btsmn2name) {
        mysqli_query($link, "UPDATE `player_score` SET balls = balls + 1 WHERE pname = '$btsmn2name' ");
        mysqli_query($link, "UPDATE `player_score` SET score = score + $p2score WHERE pname = '$btsmn2name' ");
        mysqli_query($link, "UPDATE `team_score` SET score = score + $p2score WHERE team = $tname  and code = '$code'");
        mysqli_query($link, "UPDATE `team_score` SET balls = balls + 1 WHERE team = $tname  and code = '$code'");
        if ($fts7 == $bowlername) {
            mysqli_query($link, "UPDATE `bowler_stat` SET runs = runs + $p2score WHERE bname = '$bowlername' and code = '$code' ");
            mysqli_query($link, "UPDATE `bowler_stat` SET balls = balls + 1 WHERE bname = '$bowlername' and code = '$code' ");
        } else {
            mysqli_query($link, "INSERT INTO bowler_stat VALUES('',$p2score ,$t2name,1,'$code',0,'$bowlername') ");
        }
    } else {
        mysqli_query($link, "INSERT INTO `player_score` VALUES('',$p2score,'$tname',0,1,'$code','$btsmn2name')");
        if ($fts2 = 0) {
            mysqli_query($link, "INSERT INTO `team_score` VALUES('',$p2score,'$tname','$code',0,0,1)");
            //mysqli_query($link,"UPDATE `team-score` SET bat_flag =  0 WHERE bat_flag = 1 and code = '$code' ");
            //mysqli_query($link,"UPDATE `team_score` SET bat_flag = 1 WHERE team='$tname' and code = '$code'");
        } else {
            mysqli_query($link, "UPDATE `team_score` SET score = score + $p2score WHERE team = $tname  and code = '$code'");
            mysqli_query($link, "UPDATE `team_score` SET balls = balls + 1 WHERE team = $tname  and code = '$code'");
        }

        if ($fts7 == $bowlername) {
            mysqli_query($link, "UPDATE `bowler_stat` SET runs = runs + $p2score WHERE bname = '$bowlername' and code = '$code' ");
            mysqli_query($link, "UPDATE `bowler_stat` SET balls = balls + 1 WHERE bname = '$bowlername' and code = '$code' ");
        } else {
            mysqli_query($link, "INSERT INTO bowler_stat VALUES('',$p2score ,$t2name,1,'$code',0,'$bowlername') ");
        }
    }
    header("man-scoreboard.php");
}

if (isset($_POST['team-out-b'])) {
    mysqli_query($link, "UPDATE `team_score` SET flag = 1 where team = $tname and code = '$code'");
    header("man-scoreboard.php");
}

if (isset($_POST['p1-out-b'])) {
    mysqli_query($link, "UPDATE `player_score` SET flag = 1 where pname = '$btsmn1name' and code = '$code'");
    mysqli_query($link, "UPDATE `bowler_stat` SET wickets=wickets + 1 WHERE bname = '$bowlername' and code= '$code' ");
    mysqli_query($link, "UPDATE `bowler_stat` SET balls=balls + 1 WHERE bname = '$bowlername' and code= '$code' ");
    mysqli_query($link, "UPDATE `team_score` SET balls = balls + 1 WHERE team = $tname and code='$code'");
    header("man-scoreboard.php");
}

if (isset($_POST['p2-out-b'])) {
    mysqli_query($link, "UPDATE `bowler_stat` SET wickets=wickets + 1 WHERE bname = '$bowlername' and code= '$code' ");
    mysqli_query($link, "UPDATE `bowler_stat` SET balls=balls + 1 WHERE bname = '$bowlername' and code= '$code' ");
    mysqli_query($link, "UPDATE `player_score` SET flag = 1 where pname='$btsmn2name' and code = '$code'");
    mysqli_query($link, "UPDATE `team_score` SET balls = balls + 1 WHERE team = $tname and code='$code'");
    header("man-scoreboard.php");
}

if (isset($_POST['balls-add'])) {
    mysqli_query($link, "UPDATE `bowler_stat` SET balls=balls + 1 WHERE bname = '$bowlername' and code= '$code' ");
    mysqli_query($link, "UPDATE `team_score` SET balls = balls + 1 WHERE team = $tname and code='$code'");
}

if (isset($_POST['run-out-b'])) {
    mysqli_query($link, "UPDATE `player_score` SET flag = 1 where pname = '$btsmn1name' and code = '$code'");
}

if (isset($_POST['run-out-b2'])) {
    mysqli_query($link, "UPDATE `player_score` SET flag = 1 where pname = '$btsmn2name' and code = '$code'");
}

if (isset($_POST['win'])) {
    mysqli_query($link, "UPDATE `team_score` SET flag = 2 WHERE team = $tname and code='$code'");
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="icons/cricket-2.png">
    <title>score manipulator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="welcomestyle.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="man-scorestyle.css" />
    <link rel="stylesheet" type="text/css" href="man-scorestyle2.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <style>
        #block1,
        #block2 {
            vertical-align: top;
            display: inline-block;
        }

        .overall {
            margin-left: 5%;
            margin-right: 5%;

        }
    </style>
</head>

<body style="background-color:beige;color:#1B2430;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">
    <form action="" method="POST">
        <div class="upp">
            <div class="upperdiv">
                <label style="font-family:fantasy;font-size:40px">Current Batting Team : Team1</label>
                <br>
                <!--<input type="number" name="team_name">-->
                <button name="team_name-b" class="btn btn-outline-dark">Start</button>
                <br>
                <a class="anch" style="text-decoration:dotted;color:darkgray;font-weight:bolder" href="man-scoreboard2.php">Move to team2</a>
            </div>
            <div class="upperdiv">
                <label>Enter batsman 1 : </label>
                <br>
                <input type="text" name="batsman1">
                <button name="batsman1-b" class="btn btn-outline-dark">Enter</button>
            </div>

            <div class="upperdiv">
                <label>Enter batsman 2 : </label>
                <br>
                <input type="text" name="batsman2">
                <button name="batsman2-b" class="btn btn-outline-dark">Enter</button>
            </div>
            <div class="upperdiv">
                <label>Enter bowler : </label>
                <br>
                <input type="text" name="bowler">
                <button name="bowler-b" class="btn btn-outline-dark">Enter</button>
            </div>
        </div>
    </form>
    <form action="" method="POST">
        <div class="row" style="text-align:center">
            <div class="col-lg-6">
                <div class="subadd" style="margin-bottom: 3%;">
                    <label>Add Team'score : </label>
                    <br>
                    <select type="number" name="team_score" id="">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="6">6</option>
                    </select>
                    <button name="team_score-b" class="btn btn-outline-success"><span></span>ADD</button>
                    <button name="team-out-b" class="btn btn-danger" onclick="tout()">All Out</button>
                </div>
                <div class="subadd" style="margin-bottom: 3%;">
                    <label>Add Player1's score :</label>
                    <br>
                    <select type="number" name="p1_score" id="">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="6">6</option>
                    </select>
                    <button name="p1_score-b" class="btn btn-outline-success"><span></span>ADD</button>
                    <button name="p1-out-b" class="btn btn-danger" onclick="p1out()">Out</button>
                </div>
                <div class="subadd" style="margin-bottom: 3%;">
                    <label>Add Player2's score :</label>
                    <br>
                    <select type="number" name="p2_score" id="">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="6">6</option>
                    </select>
                    <button name="p2_score-b" class="btn btn-outline-success"><span></span>ADD</button>
                    <button name="p2-out-b" class="btn btn-danger" onclick="p2out()">Out</button>
                </div>
                <div class="subadd" style="margin-bottom: 3%;">
                    <button name="win" class="btn btn-primary">TEAM WIN</button>
                </div>
            </div>
            <div class="col-lg-6">
                <!--<div class="subadd" style="margin-bottom:25px ; text-align:center">
                    <label>Add Over:</label>
                    <button><span></span>ADD</button>
                </div>-->
                <div class="subadd" style="margin-bottom: 3%;">
                    <label>Add ball :</label>
                    <button name="balls-add" class="btn btn-outline-success"><span></span>ADD</button>
                </div>
                <div class="subadd" style="margin-bottom: 3%;">
                    <p>batsman1 RUNOUT : </p>
                    <button name="run-out-b" class="btn btn-danger" onclick="p1out()">RUN OUT</button>
                </div>
                <div class="subadd" style="margin-bottom:3%;">
                    <p>batsman2 RUNOUT : </p>
                    <button name="run-out-b2" class="btn btn-danger" onclick="p2out()">RUN OUT</button>
                </div>


                <div class="subadd" style="margin-bottom: 3%;">
                    <a style="text-decoration:dotted;color:darkgray;font-weight:bolder" href="scoreboard.php">ENTER SCOREBOARD</a>
                </div>
            </div>
        </div>


    </form>
</body>

</html>


<script>
    function p1out() {
        alert("ENTER NEXT PLAYER 1");
    }

    function p2out() {
        alert("ENTER NEXT PLAYER 2");
    }

    function tout() {
        alert("ENTER NEXT Batting Team");
    }
</script>