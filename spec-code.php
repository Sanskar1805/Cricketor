<?php
session_start();
$mcode = "x";
//$_SESSION['m-code'] = "CM";
if (isset($_POST['mcode-b'])) {
    $mcode = $_POST['mcode'];
    $_SESSION['m-code'] = $mcode;
    header("spec-code.php");
}

?>

<!DOCTYPE HTML>
<html>

<head>
<link rel="icon" href="icons/cricket-2.png">
    <title>ENTER CODE</title>
</head>

<body style="background-color:darkcyan">
    <form action="" method="POST">
        <div name="div1" style="vertical-align:center;text-align:center;margin-top:300px">
            <label style="font-size:100px;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ; color:antiquewhite">ENTER MATCH CODE</label>
            <br>
            <input type="text" name="mcode" style="width:500px;margin-bottom:10px">
            <br>
            <button name="mcode-b">ENTER</button>
            <br>
            <hr>
            <button type = "button" onclick="nextpage()" style="margin-top:10px">Enter ScoreBoard</button>
        </div>
    </form>
</body>

</html>

<script>
    function nextpage() {
        window.location.href = "scoreboardv.php";
    }
</script>