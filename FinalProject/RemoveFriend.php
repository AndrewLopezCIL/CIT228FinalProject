<?php
     session_start();
     $conn = mysqli_connect('localhost','lisabalbach_lopez82','CIT190134','lisabalbach_Lopez');
     $username = mysqli_real_escape_string($conn, $_SESSION['username']);
     $friendsUsername = mysqli_real_escape_string($conn, $_POST['friendsUsername']);

          $getFriends = "SELECT * FROM friends WHERE username = '$username' AND friendUsername = '$friendsUsername'";
          $getFriendsQuery = mysqli_query($conn, $getFriends);
          $getFriendsResults = mysqli_num_rows($getFriendsQuery);
          $userFirst = 'false';
          $friendFirst = 'false';
          if($getFriendsResults < 1){
               // if friend sets don't exist in the friends table 
                    $userFirst = 'false';
               //    header('Location: RemoveFriendForm.php');
                    $getFriends2 = "SELECT * FROM friends WHERE username = '$friendsUsername' AND friendUsername = '$username'";
                    $getFriendsQuery2 = mysqli_query($conn, $getFriends2);
                    $getFriendsResults2 = mysqli_num_rows($getFriendsQuery2); 
                    if($getFriendsResults2 < 1){
                    // if friend sets don't exist in the friends table

                    $_SESSION['UserNotOnFriendsList']='true';
                    $friendFirst = 'false';
                      header('Location: RemoveFriendForm.php');
                    
               }
               else{ 
                    $friendFirst = 'true';
                    $deleteFriendFirst = "DELETE FROM friends WHERE username='$friendsUsername' AND friendUsername='$username'";
                    if(mysqli_query($conn, $deleteFriendFirst)){
                         $_SESSION['FriendRemoved'] = 'true';
                         header('Location: RemoveFriendForm.php');
                    }
                    else{
                         $_SESSION['RemoveFriendFailed']='true';
                         header('Location: RemoveFriendForm.php');
                    }
               }
          }
          else{
               
               $userFirst = 'true';
               $deleteUserFirst = "DELETE FROM friends WHERE username='$username' AND friendUsername='$friendsUsername'";
               if(mysqli_query($conn, $deleteUserFirst)){
                    $_SESSION['FriendRemoved'] = 'true';
                    header('Location: RemoveFriendForm.php');
               }
               else{
                    $_SESSION['RemoveFriendFailed']='true';
                    header('Location: RemoveFriendForm.php');
               }

          }
          
         

?>