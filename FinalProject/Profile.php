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
          if($_SESSION['UserNotFound'] === 'true'){echo '<div style="background-color:#FF6961; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">User entered does not exist</span></div>'; $_SESSION['UserNotFound'] = 'false';}
          if($_SESSION['UserNotOnFriendsList'] === 'true'){echo '<div style="background-color:#DAA520; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">User entered is not a friend!</span></div>'; $_SESSION['UserNotOnFriendsList'] = 'false';} 
          if($_SESSION['FriendRequestSent'] === 'true'){echo '<div style="background-color:#DAA520; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">Friend Request Sent!</span></div>'; $_SESSION['FriendRequestSent'] = 'false';} 
          if($_SESSION['RemoveFriendFailed'] === 'true'){echo '<div style="background-color:#FF6961; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">Removal of Friend Failed!</span></div>'; $_SESSION['RemoveFriendFailed'] = 'false';} 
          if($_SESSION['FriendRemoved'] === 'true'){echo '<div style="background-color:#FF6961; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">Friend Removed!</span></div>'; $_SESSION['FriendRemoved'] = 'false';} 
     
     ?>
        <a href = "SignUpForm.php" class="btn btn4" style="float:right;">Sign Up</a>
        <?php 
        if($_SESSION['loggedin'] !== "true"){
            $_SESSION['NotLoggedIn']= 'true';
            header('Location: managecontacts.php');
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
            <div id="manageRequests" style="background-color:lightgray;text-align:center; margin:auto;border:3px solid darkgray; border-radius: 4px; color:black; font-weight: bold; padding: 35px; overflow:auto;">
                <h2><u>Your Profile</u></h2>
                <?php
                $conn = mysqli_connect('localhost','lisabalbach_lopez82','CIT190134','lisabalbach_Lopez');
                $getUsername = mysqli_real_escape_string($conn, $_SESSION['username']);
                $getUserData = "SELECT * FROM users WHERE username = '$getUsername'";
                $getUserDataQuery = mysqli_query($conn, $getUserData);
                $getUserDataQueryResults = mysqli_num_rows($getUserDataQuery);
                if($getUserDataQueryResults < 1){
                    //Login message
                    header('Location: LoginForm.php');
                }
                else{
                    $email = ''; $username='';$firstName='';$lastName = '';
                    $xml = "<AccountInformation>";
                    while($row = mysqli_fetch_assoc($getUserDataQuery)){
                        if($row['username'] === $_SESSION['username']){
                            $xml .= "<Account>";
                            $email = $row['email'];
                            $xml .= "<Email>".$email."</Email>";
                            $username = $row['username'];
                            $xml .="<Username>".$username."</Username>";
                            $firstName = $row['firstName'];
                            $xml .="<FirstName>".$firstName."</FirstName>";
                             $lastName = $row['lastName'];
                             $xml .="<LastName>".$lastName."</LastName>";
                             $xml.="</Account>";
                          
                            break;
                        }
                    }
                    $xml.="</AccountInformation>";
                    $sxe = new SimpleXMLElement($xml);
                    $sxe->asXML("Accounts.xml"); 
                } 

                $xmlList = simplexml_load_file("Accounts.xml") or die("Error: Cannot create xml object");
                foreach($xmlList->Account as $acc){
                    $getEmail = $acc->Email;
                    $getUsername = $acc->Username;
                    $getFirstName = $acc->FirstName;
                    $getLastName = $acc->LastName;
                    echo '<div style="margin:auto;">';
                    echo '<p style=" padding:10px;background-color:darkgray; border: 3px solid gray; border-radius:4px; font-weight:bold;">Email: '.$getEmail.'</p>';
                    echo '<p style="  padding:10px;background-color:darkgray; border: 3px solid gray; border-radius:4px; font-weight:bold;">Username: '.$getUsername.'</p>';
                    echo '<p style="   padding:10px;background-color:darkgray; border: 3px solid gray; border-radius:4px; font-weight:bold;">First Name: '.$getFirstName.'</p>';
                    echo '<p style="   padding:10px; background-color:darkgray; border: 3px solid gray; border-radius:4px; font-weight:bold;">Last Name: '.$getLastName.'</p>';
                    echo '</div>';
                    
                }
                ?>                     
            </div> 
        </section>
        
</body> 
</html>