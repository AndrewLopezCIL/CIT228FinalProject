<?php
     session_start();
//Run validation to check whether or not the friend to add is real
          $conn = mysqli_connect('localhost','lisabalbach_lopez82','CIT190134','lisabalbach_Lopez');
          $username = mysqli_real_escape_string($conn, $_SESSION['username']);
          $friendusername = mysqli_real_escape_string($conn, $_POST['friendsUsername']);
          $friendReal = "SELECT * FROM users WHERE username = '$friendusername'";
          $friendRealQuery = mysqli_query($conn, $friendReal);
          $friendRealResults = mysqli_num_rows($friendRealQuery);
          if($friendRealResults < 1){
               //Friend isn't found
               $_SESSION['UserNotFound']='true';
               echo $_POST['Accept'].' '. $_POST['Reject'];
               header('Location: ViewFriendRequestsForm.php');

          }
          else{
     if(isset($_POST['Accept'])){
          
          $acceptUser = "SELECT * FROM friendrequests WHERE requestReceiver = '$username' AND requestSender = '$friendusername'";
          $acceptUserQuery = mysqli_query($conn, $acceptUser);
          $acceptUserResults = mysqli_num_rows($acceptUserQuery);

          if($acceptUserResults < 1){
               //No request found
               $_SESSION['FriendRequestNotFound'] = 'true';
               header('Location: ViewFriendRequestsForm.php');
          }
          else{
               //Request found
               while($rows = mysqli_fetch_assoc($acceptUserQuery)){
                 
               $checkFriendship = "SELECT * FROM friends WHERE username = '$username' AND friendUsername = '$friendusername' OR username = '$friendusername' AND friendUsername = '$username'";
               $checkFriendShipQuery = mysqli_query($conn, $checkFriendship);
               $checkFriendShipResults = mysqli_num_rows($checkFriendShipQuery);
               if($checkFriendShipResults < 1){
                    //No friendship found 
                    $addFriend = "INSERT INTO friends(username,friendUsername) VALUES('$username', '$friendusername')";
                   if(mysqli_query($conn, $addFriend)){
                        //Successful 
                        $acceptUser = "DELETE FROM friendrequests WHERE requestReceiver = '$username' AND requestSender = '$friendusername' OR requestReceiver = '$friendusername' AND requestSender = '$username'";
                        if($acceptUserQuery = mysqli_query($conn, $acceptUser)){
                       
                     //Success message
                        $_SESSION['FriendAdded']='true';
                        header('Location: ViewFriendRequestsForm.php');
                    } 
                    else{
                         // Failed to remove friend requests -- Redirect with error message
                         $_SESSION['FailedToRemoveRequest'] = 'true';
                         header('Location: ViewFriendRequestsForm.php');
                    }
                        //Old Success
                   } 
                   else{
                        //INSERT into the friends table failed
                        $_SESSION['FailedToAddToFriends']='true';
                        header('Location: ViewFriendRequestsForm.php');
                   }
               }
               else{
                    //Friendship found
                    $_SESSION['UserAlreadyOnFriendsList']='true';
                    header('Location: ViewFriendRequestsForm.php');
               }
                }  
          }
          echo "User Accepted";
     }
     if(isset($_POST['Reject'])){
          $getFriendRequests = "SELECT * FROM friendrequests WHERE requestReceiver = '$username' AND requestSender = '$friendusername'";
          $getFriendRequestsQuery = mysqli_query($conn, $getFriendRequests);
          $getFriendRequestsResults = mysqli_num_rows($getFriendRequestsQuery);
          if($getFriendRequestsResults < 1){
               //No requests found
               $_SESSION['FriendRequestNotFound'] = 'true';
               header('Location: ViewFriendRequests.php');
          }else{
          $removeFriendRequest = "DELETE FROM friendrequests WHERE requestSender = '$friendusername' AND requestReceiver='$username'";
               if(mysqli_query($conn, $removeFriendRequest)){
                    $_SESSION['FriendRejected'] = 'true';
                    header('Location: ViewFriendRequestsForm.php');
               }
               else{
                    echo "User could not be rejected!";
                    $_SESSION["CouldNotBeRejected"]="true";
                    header('Location: ViewFriendRequestsForm.php');
               }
          }
          
     }}
?>