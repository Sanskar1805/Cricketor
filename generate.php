<?php
session_start();
// Include config file
require_once "generateconfig.php";
 
// Define variables and initialize with empty values
$team1 = $team2 = "";
$team1_err = $team2_err =$players_err=$overs_err= "";
 $players=  0;
 $overs = 0;
 $code="";
 $code_err = "";
 $toss = 0;
 $toss_err="";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["team1"]))){
        $team1_err = "Please enter the name of team1";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["team1"]))){
        $team1_err = "Team name can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM match_details WHERE team1 = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_team1);
            
            // Set parameters
            $param_team1 = trim($_POST["team1"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $team1_err = "This team name is already taken.";
                } else{
                    $team1 = trim($_POST["team1"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    if(empty(trim($_POST["team2"]))){
        $team2_err = "Please enter the name of team2";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["team2"]))){
        $team2_err = "Team name can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM match_details WHERE team2 = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_team2);
            
            // Set parameters
            $param_team2 = trim($_POST["team2"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $team2_err = "This team name is already taken.";
                } else{
                    $team2 = trim($_POST["team2"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    if(empty(trim($_POST["players"]))){
        $overs_err = "Please enter the number of players";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["players"]))){
        $overs_err = "Players can only contain letters, numbers, and underscores.";
    } else{
        $players = trim($_POST["players"]);
        // Prepare a select statement
       /* $sql = "SELECT id FROM match_details WHERE team2 = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_team2);
            
            // Set parameters
            $param_team2 = trim($_POST["team2"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $team2_err = "This team name is already taken.";
                } else{
                    $team2 = trim($_POST["team2"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }*/
    }
    if(empty(trim($_POST["overs"]))){
        $overs_err = "Please enter the number of overs";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["overs"]))){
        $overs_err = "overs can only contain letters, numbers, and underscores.";
    } else{
        $overs = trim($_POST["overs"]);
    }

    if(empty(trim($_POST["toss"]))){
        $toss_err = "Please enter who won the toss";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["toss"]))){
        $toss_err = "Toss can only contain a number";
    } else{
        $toss = trim($_POST["toss"]);
    }

    if(empty(trim($_POST["code"]))){
        $code_err = "Please enter the match code";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["code"]))){
        $code_err = "match code can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM match_details WHERE code = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_code);
            
            // Set parameters
            $param_code = trim($_POST["code"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $code_err = "This code is already taken.";
                } else{
                    $code = trim($_POST["code"]);
                    $_SESSION['match-code'] = $code;
                }
            } else{
                $_SESSION['match-code'] = NULL;
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    /*
    // Validate password
    if(empty(trim($_POST["team2"]))){
        $password_err = "Please enter a team name...";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    */
    // Check input errors before inserting in database
    if(empty($team1_err) && empty($team2_err) &&empty($code_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO match_details (team1, team2  ,players,overs,code,toss) VALUES (?, ? , ? , ?, ?,?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssiisi", $param_team1, $param_team2 , $param_players , $param_overs,$param_code,$param_toss);
            
            // Set parameters
            $param_team1 = $team1;
            $param_team2 = $team2; // Creates a password hash
            $param_players = $players;
            $param_overs = $overs;  
            $param_code = $code;     
            $param_toss = $toss;    
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: playerinfo.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    
    // Close connection
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="icons/cricket-2.png">
    <link rel="stylesheet" type="text/css" href="generatestyle.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Enter Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body class="bdy">
    <div class="wrapper">
        <h2>Welcome Player</h2>
        <p>Please Enter the following details...</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Enter the name of Team 1 : </label>
                <input class="inp" type="text" name="team1" class="form-control <?php echo (!empty($team1_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $team1; ?>">
                <span class="invalid-feedback"><?php echo $team1_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Enter the name of Team 2 : </label>
                <input class="inp" type="text" name="team2" class="form-control <?php echo (!empty($team2_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $team2; ?>">
                <span class="invalid-feedback"><?php echo $team2_err; ?></span>
            </div>
            <div class ="form-group">
                <label>Number of Players : </label>
                <input class="inp" type="number" name="players" class="form-control" value="<?php echo $players; ?>">
                <!--<span class="invalid-feedback"><?php echo $players_err; ?></span>-->
            </div>
            <div class ="form-group">
                <label>Number of Overs : </label>
                <select class="inp" type="number" name="overs" class="form-control" >
                    <option value=5 >5</option>
                    <option value=10 >10</option>
                    <option value=20 >20</option>
                    <option value=50 >50</option>
                </select>
               <!-- <span class="invalid-feedback"><?php echo $overs_err; ?></span>-->
            </div>
            <div class="form-group">
                <label>Generate a Match Code : </label>
                <input class="inp" type="text" name="code" class="form-control <?php echo (!empty($code_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $code; ?>">
                <span class="invalid-feedback"><?php echo $code_err; ?></span>
            </div>
            <div class="form-group">
                <label>Who won the toss ? </label>
                <select name="toss" class="inp" type = "number" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </div>
            <!--<div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control ">
                <span class="invalid</span>
            </div>-->
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>    
</body>
</html>