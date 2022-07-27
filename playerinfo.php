<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'cricketx');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
<html>
<head>
<link rel="icon" href="icons/cricket-2.png">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="playerinfostyle.css">
</head>
<body>
    <div class="form-details" style="margin-left:13%;margin-right:13%;">
    <form id  = "name-form" action="" method="POST">
        <!--<label>Enter the match code :</label>
        <br>
        <input type="text" name="match-code" placeholder="Enter-here..." required="required"/>
                                    <br>
                                    <br><br>-->
    <label>Add Team1 Player's Name : </label> 
				<br />
				<div id="playerdiv">
					<div class="form-group">
						<input type="text" name="player-name" placeholder="Enter here..." class="form-control" required="required" style="width:40%;"/>
					</div>
				</div> 
                <br>
                <button class="btn btn-primary" class="karo" name="save" ><span class="glyphicon glyphicon-save" ></span> Submit</button>                      
    </form>
    <a href="playerinfo2.php">Move to team2</a>
    <br>
    <br>
    <br>
    <div class  = "div2" style="margin-left:40%;margin-right:40%;"><a href="scoreboard.php" class="a2">Enter Scoreboard</a></div>
                                <br>
    <br>
    <div class  = "div2" style="margin-left:40%;margin-right:40%;"><a href="man-scoreboard.php" class="a2">Manipulate Scoreboard</a></div>
                                </div>
</body>

</html>
<script>
</script>
<?php
session_start();
if(ISSET($_POST['save'])){
        $code = $_SESSION['match-code'];
        //$_SESSION['match-code'] = $code;
        //$_SESSION['match-code'] = $code;
		$pname = $_POST['player-name'];
		mysqli_query($link, "INSERT INTO `player_details` VALUES('', '$pname', 1,'$code',0)") ;//or die(mysqli_error());
 
 
		header("location: playerinfo.php");
	}
?>