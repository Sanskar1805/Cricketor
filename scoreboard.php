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
$batteam = 0;
$bowlteam = 0;
$stmt = mysqli_query($link, "SELECT * FROM `team_score` WHERE code = '$code' and bat_flag = 1 ");
while ($rows = mysqli_fetch_array($stmt)) {
    $batteam = $rows['team'];
    if ($batteam == 1) {
        $bowlteam = 2;
    } else {
        $bowlteam  = 1;
    }
}
$teambatting = "";
$teambowling = "";
$stmt = mysqli_query($link, "SELECT * FROM `match_details` WHERE code='$code' ");
while ($rows = mysqli_fetch_array($stmt)) {
    if ($batteam == 1) {
        $teambatting = $rows['team1'];
        $teambowling = $rows['team2'];
    } else if ($batteam == 2) {
        $teambatting = $rows['team2'];
        $teambowling = $rows['team1'];
    }
}
$teamscore = 0;
$balls =  0;
$overs = 0;
$balls_in_c_over = 0;
$stmt  = mysqli_query($link, "SELECT * FROM `team_score` WHERE code='$code' and team = $batteam ");
while ($rows = mysqli_fetch_array($stmt)) {
    $teamscore = $rows['score'];
    $balls = $rows['balls'];
    $overs = floor($balls / 6);
    $balls_in_c_over = $balls % 6;
}
$teamscore2 = 0;
$balls2 = 0;
$overs2 = 0;
$balls_in_c_over2 = 0;
$stmt  = mysqli_query($link, "SELECT * FROM `team_score` WHERE code='$code' and team = $bowlteam ");
while ($rows = mysqli_fetch_array($stmt)) {
    $teamscore2 = $rows['score'];
    $balls2 = $rows['balls'];
    $overs2 = floor($balls2 / 6);
    $balls_in_c_over2 = $balls2 % 6;
}

$stmt = mysqli_query($link, "SELECT * FROM `player_score` WHERE code='$code' and team = $batteam and flag = 1 ");
$wickets = 0;
while ($rows = mysqli_fetch_array($stmt)) {
    $wickets = $wickets + 1;
}

$stmt = mysqli_query($link, "SELECT * FROM `player_score` WHERE code='$code' and team = $bowlteam and flag = 1 ");
$wickets2 = 0;
while ($rows = mysqli_fetch_array($stmt)) {
    $wickets2 = $wickets2 + 1;
}

$stmt = mysqli_query($link, "SELECT * FROM `player_details` WHERE code='$code' and team = $batteam and flag = 1 ");
$batsman1 = "";
while ($rows = mysqli_fetch_array($stmt)) {
    $batsman1 = $rows['pname'];
}

$stmt = mysqli_query($link, "SELECT * FROM `player_details` WHERE code='$code' and team = $batteam and flag = 2 ");
$batsman2 = "";
while ($rows = mysqli_fetch_array($stmt)) {
    $batsman2 = $rows['pname'];
}

$stmt = mysqli_query($link, "SELECT * FROM `player_details` WHERE code='$code' and team = $bowlteam and flag = 3 ");
$bowler = "";
while ($rows = mysqli_fetch_array($stmt)) {
    $bowler = $rows['pname'];
}

$stmt = mysqli_query($link, "SELECT * FROM `player_score` WHERE code='$code' and team = $batteam and pname='$batsman1' ");
$batsman1_runs = 0;
$batsman1_balls =  0;
while ($rows = mysqli_fetch_array($stmt)) {
    $batsman1_runs = $rows['score'];
    $batsman1_balls = $rows['balls'];
}

$stmt = mysqli_query($link, "SELECT * FROM `player_score` WHERE code='$code' and team = $batteam and pname='$batsman2' ");
$batsman2_runs = 0;
$batsman2_balls = 0;
while ($rows = mysqli_fetch_array($stmt)) {
    $batsman2_runs = $rows['score'];
    $batsman2_balls = $rows['balls'];
}

$stmt = mysqli_query($link, "SELECT * FROM `bowler_stat` WHERE code='$code' and team = $bowlteam and bname='$bowler' ");
$bowler_runs = 0;
$bowler_balls = 0;
$bowler_wickets = 0;
$bowler_overs = 0;
$bowler_cbo  = 0;
while ($rows = mysqli_fetch_array($stmt)) {
    $bowler_runs = $rows['runs'];
    $bowler_balls = $rows['balls'];
    $bowler_wickets = $rows['wickets'];
    $bowler_overs = floor($bowler_balls / 6);
    $bowler_cbo = $bowler_balls % 6;
}

$stmt  = mysqli_query($link, "SELECT * FROM `player_score` WHERE code = '$code' and team = '$batteam'");
$nbat = 0;
while ($rows = mysqli_fetch_array($stmt)) {
    $nbat = $nbat + 1;
}

$batsman_runs = 0;
$batsman_balls =  0;
$batsman_name = "";
$batsman_strike_rate = 0;
?>

<!DOCTYPE HTML>
<html>

<head>
    <link rel="icon" href="icons/cricket-2.png">
    <title>scoreboard</title>
    <meta name="viewport" content="width= device-width , initial-scale = 1.0">
    <meta http-equiv="refresh" content="10">
    <link rel="stylesheet" type="text/css" href="scoreboardvstyle.css">
    <!--<p><//?php echo $batteam  ?></p>-->
</head>

<body>
    <div style="text-align:center ;margin-top:30px">
        <a style="text-align:center;margin-top:30px;font-family: fantasy ;font-size:20px;color:darkblue" href="man-scoreboard.php">MANIPULATE SCOREBOARD</a>
    </div>
    <h1><?php echo $teambatting ?> VS <?php echo $teambowling ?>
    </h1>
    <div id="upperdiv" style="text-align:center">
        <!--<p><//?php echo $code ?></p>-->
        <h2>Batting team : </h2>
        <p><?php echo $teambatting ?></p>
        <hr>
        <h2>Bowling team : </h2>
        <p><?php echo $teambowling ?></p>
        <hr>
        <h2>Current Score : </h2>
        <p><?php echo $teambatting ?> - <?php echo $teamscore ?> / <?php echo $wickets ?></p>
        <p><?php echo $teambowling ?> - <?php echo $teamscore2 ?>/<?php echo $wickets2 ?> Overs : <?php echo $overs2 ?>.<?php echo $balls_in_c_over2 ?></p>
        <hr>
        <h2>Overs : </h2>
        <p><?php echo $overs ?> over <?php echo $balls_in_c_over ?> balls</p>
        <hr>
        <h2>Currently Batting : </h2>
        <p><?php echo $batsman1 ?> - <?php echo $batsman1_runs ?>(<?php echo $batsman1_balls ?>)</p>
        <p><?php echo $batsman2 ?> - <?php echo $batsman2_runs ?>(<?php echo $batsman2_balls ?>)</p>
        <hr>
        <h2>Currently Bowling : </h2>
        <p><?php echo $bowler ?> - <?php echo $bowler_runs ?> / <?php echo $bowler_wickets ?></p>
        <p>overs : <?php echo $bowler_overs ?>.<?php echo $bowler_cbo ?></p>
    </div>
    <script>
        var nforbat = <?php echo $nbat ?>;
    </script>
    <div id="big2" class="bat1" style="padding-left : 100px;text-align : center ; margin-left : auto ; margin-right : auto">
        <h2 style="font-family:Verdana, Geneva, Tahoma, sans-serif;font-size : 30px"><?php echo $teambatting ?></h2>
        <div class="block1">
            <table class="table1" id="batscoretable" style="text-align : center; margin-left:auto ; margin-right : auto">
                <tr>
                    <th>NAME</th>
                    <th>SCORE</th>
                    <th>BALLS</th>
                    <th>STRIKE RATE</th>
                </tr>
                <?php $stmt = mysqli_query($link, "SELECT * FROM `player_score` WHERE code='$code' and team = $batteam");
                while ($rows = mysqli_fetch_array($stmt)) {
                    echo "<tr>";
                    echo "<td>";
                    echo $batsman_name = $rows['pname'];
                    echo "</td>";
                    echo "<td>";
                    echo $batsman_runs = $rows['score'];
                    echo "</td>";
                    echo "<td>";
                    echo $batsman_balls = $rows['balls'];
                    echo "</td>";
                    echo "<td>";
                    echo $batsman_strike_rate = round(($batsman_runs / $batsman_balls) * 100, 2);
                    echo "</td>";

                    echo "</tr>";
                }

                ?>
            </table>
        </div>
        <div class="block2">
            <table class="table1" style="text-align : center ;margin-left: auto ; margin-right: auto">
                <tr>
                    <th>Name</th>
                    <th>Wickets</th>
                    <th>Runs</th>
                    <th>Overs</th>
                    <th>Economy</th>
                </tr>
                <?php $stmt = mysqli_query($link, "SELECT * FROM `bowler_stat` WHERE code='$code' and team = $batteam");
                while ($rows = mysqli_fetch_array($stmt)) {
                    echo "<tr>";
                    echo "<td>";
                    echo $batsman_name = $rows['bname'];
                    echo "</td>";
                    echo "<td>";
                    echo $batsman_runs = $rows['wickets'];
                    echo "</td>";
                    echo "<td>";
                    echo $batsman_balls = $rows['runs'];
                    echo "</td>";
                    echo "<td>";
                    $overs_demo = floor($rows['balls'] / 6);
                    $balls_demo = $rows['balls'] % 6;
                    echo $overs_demo;
                    echo ".";
                    echo $balls_demo;
                    echo "</td>";
                    echo "<td>";
                    if ($overs_demo ==  0) {
                        echo 0;
                    } else {
                        $economy = round($rows['runs'] / $overs_demo, 2);
                        echo $economy;
                    }
                    echo "</td>";

                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <div id="big1" class="bat1" style="padding-right : 100px;text-align : center ; margin-left : auto ; margin-right : auto">
        <h2 style="font-family:Verdana, Geneva, Tahoma, sans-serif;font-size : 30px"><?php echo $teambowling ?> </h2>
        <div class="block1">
            <table class="table1" id="batscoretable" style="text-align : center; margin-left:auto ; margin-right : auto">
                <tr>
                    <th>NAME</th>
                    <th>SCORE</th>
                    <th>BALLS</th>
                    <th>STRIKE RATE</th>
                </tr>
                <?php $stmt = mysqli_query($link, "SELECT * FROM `player_score` WHERE code='$code' and team = $bowlteam");
                while ($rows = mysqli_fetch_array($stmt)) {
                    echo "<tr>";
                    echo "<td>";
                    echo $batsman_name = $rows['pname'];
                    echo "</td>";
                    echo "<td>";
                    echo $batsman_runs = $rows['score'];
                    echo "</td>";
                    echo "<td>";
                    echo $batsman_balls = $rows['balls'];
                    echo "</td>";
                    echo "<td>";
                    echo $batsman_strike_rate = round(($batsman_runs / $batsman_balls) * 100, 2);
                    echo "</td>";

                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div class="block2" style="margin-bottom : 100px">
            <table class="table1" style="text-align : center ;margin-left: auto ; margin-right: auto">
                <tr>
                    <th>Name</th>
                    <th>Wickets</th>
                    <th>Runs</th>
                    <th>Overs</th>
                    <th>Economy</th>
                </tr>
                <?php $stmt = mysqli_query($link, "SELECT * FROM `bowler_stat` WHERE code='$code' and team = $bowlteam");
                while ($rows = mysqli_fetch_array($stmt)) {
                    echo "<tr>";
                    echo "<td>";
                    echo $batsman_name = $rows['bname'];
                    echo "</td>";
                    echo "<td>";
                    echo $batsman_runs = $rows['wickets'];
                    echo "</td>";
                    echo "<td>";
                    echo $batsman_balls = $rows['runs'];
                    echo "</td>";
                    echo "<td>";
                    $overs_demo = floor($rows['balls'] / 6);
                    $balls_demo = $rows['balls'] % 6;
                    echo $overs_demo;
                    echo ".";
                    echo $balls_demo;
                    echo "</td>";
                    echo "<td>";
                    if ($overs_demo ==  0) {
                        echo 0;
                    } else {
                        $economy = round($rows['runs'] / $overs_demo, 2);
                        echo $economy;
                    }
                    echo "</td>";

                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>