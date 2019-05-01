<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        Final Project
    </title>
    <style>
    .btns {
        border: none;
        outline: none;
        padding: 10px 16px;
        background-color: #f1f1f1;
        cursor: pointer;
        font-size: 18px;
}
.divs{
    display:none;
}
.activeDivs{ 
        display: block;
}
    .active, .btns:hover {
        background-color: #666;
        color: white;
        display: block;
    }
    a {
       text-decoration: none;
    }
    a:visited{
        color:black; 
    }
    .links{
        text-align:center; 
        background-color: lightgray;
        border: 4px solid lightgray;
        border-radius:5px;
        color: black;
        padding: 4px; 
    }
    .visited a:visited{
        color:black;
    }
    .visited a{
         margin:5px;
    }
    .visited:hover{
        background-color:darkgray;
    }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css">
</head>
<body style="background-image: Url('media/BlackBackground.jpg'); background-repeat: repeat;"> 
    <header>
    <div> 
        <?php
          if($_SESSION['UsernameMismatch'] === 'true'){echo '<div style="background-color:#FF6961; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">Incorrect Current Username</span></div>'; $_SESSION['UsernameMismatch'] = 'false';}
          if($_SESSION['UsernameChanged'] === 'true'){echo '<div style="background-color:#DAA520; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">Username Changed!</span></div>'; $_SESSION['UsernameChanged'] = 'false';}
          if($_SESSION['UsernameTaken'] === 'true'){echo '<div style="background-color:#FF6961; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">Sorry, the username you chose is taken. Please try again.</span></div>'; $_SESSION['UsernameTaken'] = 'false';}
        
        ?>
        <a href = "SignUpForm.php" class="btn btn4" style="float:right;">Sign Up</a>
        <?php 
        if($_SESSION['loggedin'] !== "true"){
            echo '<a href = "LoginForm.php" class="btn btn4" style="float:right;">Login</a>';
            $_SESSION['NotLoggedIn']= 'true';
            header('Location: managecontacts.php');
        }
        else{if($_SESSION['loggedin'] === "true"){ echo '<a href = "Logout.php" class="btn btn4" style="float:right;">Logout</a>'; }}
        ?> <br> <a href = "home.php"> <h1 style="text-align:center; margin-block-start:3%;">Friendship</h1></a>
        <?php
         if($_SESSION['loggedin'] === 'true'){
            echo '<div style="float:right; border: 3px solid white; border-radius:5px;width:15%; height:.24%; background-color:white; text-align:right;"><span style="color:darkgray; overflow:auto; font-weight:bold; padding:6px;">Logged in as: '.$_SESSION['username'].'</span></div>';
         }
         else{
            echo '<div style="float:right; border: 3px solid white; border-radius:5px;width:15%; height:.24%; background-color:white; text-align:right;"><span style="color:darkgray; overflow:auto; font-weight:bold; padding:6px;">Currently Not Logged In </span></div>';
         }
         ?>
        </div>
        <br><hr><br>
    </header> 
<nav>
    <div class="middle">
        <a href = "home.php" class="btn btn4">Home</a>
        <a href = "managecontacts.php" class="btn btn4">Manage Account</a> 
        <a href = "Citations.php" class="btn btn4">Citations</a>
    </div>  
</nav>
    <!--<div style="text-align:center; margin:auto; background-color:darkgray; padding:15px;"> -->
        <br><br>
        <section>
        <div id="manageRequests" style="background-color:lightgray;text-align:center; margin:auto;border:3px solid darkgray; border-radius: 4px; color:green; font-weight: bold; padding: 35px; overflow:auto;">
            <h4>Please enter your old username<br>before submitting to confirm changes.<br>(case sensitive)!</h4>
                <hr>
                <form method="POST" action="UpdateUsername.php"> 
                <span style=" color:black;">Current Username</span><br>
                <input type="text" name="currentUsername" placeholder="<?php echo $_SESSION['username']; ?>" required/><br>
                 <br><span style=" color:black;">New Username</span>
                 <br><input type="text" name="newUsername" placeholder="New Username" required/><br><br>
                 <input type="submit" name="Submit"/>
                </form>
                <hr>
                <br>
                <br>
            </div> 
        </section>
</body> 
</html>