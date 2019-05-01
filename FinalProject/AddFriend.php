<?php
     session_start();
    
    $conn = mysqli_connect('localhost','lisabalbach_lopez82','CIT190134','lisabalbach_Lopez');
    $friendsUsername = mysqli_real_escape_string($conn, $_POST['friendsUsername']);
    $LoggedinUsername = mysqli_real_escape_string($conn, $_SESSION['username']);
    $addingSelf = 'false';
    $duplicate = 'false';
    if($_SESSION['username'] === $friendsUsername || strtolower($_SESSION['username']) === strtolower($_POST['friendsUsername'])){
        $userDupToString = strtolower($LoggedinUsername);
        $friendDupToString = strtolower($friendsUsername); 
            $_SESSION['TriedAddingSelf']='true';
            $addingSelf = 'true';
            header('Location: AddFriendForm.php'); 
    }
    $checkFriend = "SELECT * FROM friends WHERE username = '$LoggedinUsername' AND friendUsername='$friendsUsername' OR username='$friendsUsername' AND friendUsername='$LoggedinUsername'";
    $checkFriendQuery = mysqli_query($conn, $checkFriend);
    $checkFriendResults = mysqli_num_rows($checkFriendQuery);
    if($checkFriendResults < 1){
        //No Friend Relationship Found
        if($addingSelf === 'false'){

            $checkRequestDuplicate = "SELECT * FROM friendrequests WHERE requestSender = '$LoggedinUsername' AND requestReceiver = '$friendsUsername'";
            $checkRequestDuplicateQuery = mysqli_query($checkRequestDuplicate);
            $checkRequestDuplicateResult = mysqli_num_rows($checkRequestDuplicateQuery);
            if($checkRequestDuplicateResult < 1){
                $duplicate = 'false'; 
            }
            else{
                $duplicate = 'true';
                header('Location: AddFriendForm.php');
            }
            if($duplicate === 'false'){
            $checkFriendExists = "SELECT * FROM users WHERE username = '$friendsUsername'";
            $checkFriendExistsQuery = mysqli_query($conn, $checkFriendExists);
            $resultCheck = mysqli_num_rows($checkFriendExistsQuery);
        
            //No results inside of database
            if($resultCheck < 1){
                // display error message / could not log in message
               $_SESSION['UserNotFound'] = 'true';
               header('Location: AddFriendForm.php');
            }else{
                    //If the user that is trying to be added is in the database 
                    //Then check if they're on the Logged in user's friends list
        
                    $getLoggedinUserID= "SELECT * FROM users WHERE username = '$LoggedinUsername'";
                    $getLoggedinUserIDQuery = mysqli_query($conn, $getLoggedinUserID);
                    $getLoggedinUserIDResults = mysqli_num_rows($getLoggedinUserIDQuery);
        
                    if($getLoggedinUserIDResults < 1){
                        //Not found 
                        header('Location: AddFriendForm.php');
                    }//requestID requestStatuts, requestSender, requestReceiver
                    else{
        
                        $checkFriendsList = "SELECT * FROM friends WHERE username = '$LoggedinUsername' AND friendUsername = '$friendsUsername'";
                        $checkFriendsQuery = mysqli_query($conn, $checkFriendsList);
                        $FriendsResults = mysqli_num_rows($checkFriendsQuery);
                        if($FriendsResults < 1){
                            //Relationship not found, send friend request
                            $status = mysqli_real_escape_string($conn, 'Pending');
                            $sendFriendRequest = "INSERT INTO friendrequests(requestStatus, requestSender, requestReceiver) VALUES('$status','$LoggedinUsername','$friendsUsername')";
                         
                            if(mysqli_query($conn, $sendFriendRequest)){
                             $_SESSION['FriendRequestSent'] = 'true';
                            header('Location: AddFriendForm.php');
                            }
                            else{
                                $_SESSION['FriendRequestFailed'] = 'true';
                                header('Location: AddFriendForm.php');
                            }
                        
        
                        }
                        else{
                            //Relationship found, don't send friend request and output redirection with error message to AddFriendForm page
                            $_SESSION['UserAlreadyOnFriendsList'] = 'true';
                            header('Location: AddFriendForm.php');
                        }
                         
                    }
                }
            }
        }

    }else{
        //Relationship found
        $_SESSION['UserAlreadyOnFriendsList']='true';
        header('Location: AddFriendForm.php');
    }

    
     
?>