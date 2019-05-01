<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        Final Project
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css">
</head>
<body style="background-image: Url('media/BlackBackground.jpg'); background-repeat: repeat;"> 
    <header>
    <?php 
    if($_SESSION['loggedin']==='true'){ header('Location: home.php');}
     if($_SESSION['displayedFailedAuth'] === 'false'){echo '<div style="background-color:#FF6961; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">Authentication Failed!</span></div>'; $_SESSION['displayedFailedAuth'] = 'true';}
   ?>
        <div> 
        
        <a href = "SignUpForm.php" class="btn btn4" style="float:right;">Sign Up</a>
        <?php 
        if($_SESSION['loggedin'] !== "true"){
            echo '<a href = "LoginForm.php" class="btn btn4" style="float:right;">Login</a>';
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
         ?></div>
        <br><hr><br>
    </header> 
    <div class="middle">
        <a href = "home.php" class="btn btn4">Home</a>
        <a href = "managecontacts.php" class="btn btn4">Manage Account</a> 
        <a href = "Citations.php" class="btn btn4">Citations</a>
    </div> 
    <div style="text-align:center; margin:auto; background-color:darkgray; padding:15px;">
    <form method="POST" action = "Login.php"> 
        <h3>Username or Email: </h3>
        <input type="text" name="username" placeholder="example@email.com" style="text-align:center; height:25px;"/>
        <h3>Password: </h3>
        <input type="password" name="password" placeholder="***********" style="text-align:center; height:25px;"/> 
      
        <br><br><button type="submit" name="submit" style="width:100px; height: 30px;">Log In</button>
    </form>
    </div>
</body> 
</html>