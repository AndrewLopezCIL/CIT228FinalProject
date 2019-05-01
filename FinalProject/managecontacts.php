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
    #manageRequests a:visited{
        color:black;
    }
    #manageRequests a{
         margin:5px;
         color:black;
    }
    #manageRequests:hover{
        background-color:black;
    }

    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css">
</head>
<body style="background-image: Url('media/BlackBackground.jpg'); background-repeat: repeat;"> 
    <header>
    <div> 
        <?php
        if($_SESSION['NotLoggedIn'] === 'true'){
            echo '<div style="background-color:#FF6961; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">Currently Not Logged In!</span></div>'; $_SESSION['NotLoggedIn'] = 'false';
         }  
         ?>
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
        <div id="manageRequests" style="background-color:darkgray;text-align:center;opacity:0.55; margin:auto;border: 5px solid gray; border-radius:5px;  color:black; font-weight: bold; padding: 35px; overflow:auto;">
             <br><br>
                <a href ="Profile.php" class="links" >Profile</a>
                <br><br><br>
                <a href ="UpdateUsernameForm.php" class="links" >Change Username</a>
                <br><br><br>
                <a href ="ViewFriendsList.php" class="links" >View Friends List</a>
                <br><br><br>
                <a href ="ViewFriendRequestsForm.php" class="links"> Friend Requests</a>
                <br><br><br>
                <a href ="AddFriendForm.php" class="links" >Add Friend</a>
                <br> <br><br>
                <a href ="RemoveFriendForm.php" class="links" >Remove Friend</a>
                <br><br><br>
            </div> 
        </section>
</body> 
</html>