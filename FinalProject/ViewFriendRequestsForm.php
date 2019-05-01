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
          if($_SESSION['UserAlreadyOnFriendsList'] === 'true'){echo '<div style="background-color:#DAA520; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">User entered is already on friends list!</span></div>'; $_SESSION['UserAlreadyOnFriendsList'] = 'false';} 
          if($_SESSION['FailedToAddToFriends'] === 'true'){echo '<div style="background-color:#DAA520; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">Could not add to friends!</span></div>'; $_SESSION['FailedToAddToFriends'] = 'false';} 
          if($_SESSION['FailedToRemoveRequest'] === 'true'){echo '<div style="background-color:#FF6961; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">Failed to Remove Friend Request</span></div>'; $_SESSION['FailedToRemoveRequest'] = 'false';} 
          if($_SESSION['FriendRequestNotFound'] === 'true'){echo '<div style="background-color:#FF6961; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">Friend Request Not Found!</span></div>'; $_SESSION['FriendRequestNotFound'] = 'false';} 
          if($_SESSION['FriendAdded'] === 'true'){echo '<div style="background-color:#90EE90; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">Friend Added!</span></div>'; $_SESSION['FriendAdded'] = 'false';} 
          if($_SESSION['FriendRejected'] === 'true'){echo '<div style="background-color:#FF6961; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">Friend Request Rejected!</span></div>'; $_SESSION['FriendRejected'] = 'false';} 
          if($_SESSION['CouldNotBeRejected'] === 'true'){echo '<div style="background-color:#FF6961; text-align:center; margin:auto; padding:5px;"><span style="font-weight: bold; font-size: 1.3em; color:white;">Friend Request Could Not Be Rejected!</span></div>'; $_SESSION['CouldNotBeRejected'] = 'false';} 
        
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
<section>
        <div id="manageRequests" style="background-color:lightgray;text-align:center; margin:auto;border:3px solid darkgray; border-radius: 4px; color:green; font-weight: bold; padding: 35px; overflow:auto;">
        <form method="POST" action="ViewFriendRequests.php">
        <span style="color:black;font-weight:bold; text-align:center;">Enter Friend's Username or <br>Click existing ones to fill.</span><br><br>
        <input id="requestedUser" type='text' name='friendsUsername' placeholder="Someone That Requested" style="text-align:center;"/>       
        <br><br><input type="submit" name="Accept" value="Accept" style="color:green;"/>  <input type="submit" name="Reject" value="Reject" style="color:red;"/>
    </form>    
    <hr>
    <div id="friendRequests" style="background-color:lightgray;text-align:center; float:right; color:green; font-weight: bold; padding: 35px; overflow:auto;">
    <span style="color:darkgreen font-size: 1.7em;"><u>Friend Requests</u></span> 
    
   <?php 
  
   $conn = mysqli_connect('localhost','lisabalbach_lopez82','CIT190134','lisabalbach_Lopez');
   $username = mysqli_real_escape_string($conn, $_SESSION['username']);
   $getFriends = "SELECT * FROM friendrequests WHERE requestReceiver = '$username'";
   $getFriendsQuery = mysqli_query($conn, $getFriends);
   $getFriendsResults = mysqli_num_rows($getFriendsQuery);
   
   if($getFriendsResults < 1){
       //No friend requests found
       echo '<p style="font-weight:bold; color:black; background-color:darkgray; padding:8px; border:3px solid darkgray; border-radius:5px;">No friend requests found.</p>';
   }
   else{
       //Friend requests found 
       $idNumber = 0;
       $ids = "Friend".$idNumber;
       while($rows = mysqli_fetch_assoc($getFriendsQuery)){
             
           //echo '<br><br><span id="'.$ids.'" style="color:black">'.$rows['requestSender'].'</span><button onclick="acceptFriendRequest('.$ids.')" style="color:green;">Accept</button>  <button onclick="rejectFriendRequest('.$ids.')" style="color:red;">Reject</button>';
           //echo '<form method="POST" action='.htmlspecialchars($_SERVER['PHP_SELF']).'> 
           $sender = mysqli_real_escape_string($conn, $rows['requestSender']);
           $userExists = "SELECT * FROM users WHERE username = '$sender'";
           $userQuery = mysqli_query($conn, $userExists);
           $userResults = mysqli_num_rows($userQuery);
           if($userResults < 1){
            $deleteUserRequest = "DELETE FROM friendrequests WHERE requestSender = '$sender' OR requestReceiver='$sender'";
            if(mysqli_query($deleteUserRequest)){
                //successful
            }
            else{
                //couldn't delete request
            }
           }
           else{
           echo '<br><br><span style="color:black; background-color:darkgray; cursor:pointer; padding:5%;border-radius:5px;">'.$rows['requestSender'].'</span>'; 
           }
        }  
   } 
  
 
   ?>
    </div>
    </div>
    </section>
    <script>
       var spans = document.getElementsByTagName('span');
        for(i=0;i<spans.length;i++)
            spans[i].addEventListener('click', function(){
               document.getElementById('requestedUser').value = this.innerHTML;
               console.log(this.innerHTML);
               
            });
        
 
        </script>
</body> 
</html>