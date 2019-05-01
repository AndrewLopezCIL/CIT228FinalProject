<?php 
session_start();
$dontRun = 'false';
if($_POST['currentUsername'] !== $_SESSION['username']){
    $_SESSION['UsernameMismatch'] = 'true';
    $dontRun='true';
    header('Location: UpdateUsernameForm.php');
}
if($dontRun ==='false'){
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "Snowboard1!";
$dbName = "gamesale";
    $conn = mysqli_connect('localhost','lisabalbach_lopez82','CIT190134','lisabalbach_Lopez');
if(!$conn){
    die('Could not connect: '. mysqli_error());
}
else{
$newUser = mysqli_real_escape_string($conn, $_POST['newUsername']); 
$username = mysqli_real_escape_string($conn, $_POST['currentUsername']); 
$userCheckQuery = "SELECT * FROM users WHERE username = '$newUser'";
$checkResult = mysqli_query($conn,$userCheckQuery);
$checkResultCheck = mysqli_num_rows($checkResult);
$usernameFound;
if($checkResultCheck < 1){
     //Did not find new username
     $usernameFound = 'false'; 
     echo "USERNAME FOUND USERNAME FOUND USERNAME FOUND USERNAME FOUND USERNAME FOUND";
}
else{
    $usernameFound = 'true'; 
    echo "USERNAME NOT FOUND USERNAME NOT FOUND USERNAME NOT FOUND";
    }

    if($usernameFound==='false'){
        $query = "UPDATE users SET username = '$newUser' WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die('Could not update username!'.mysqli_error());
        }
        else{
            $_SESSION['UsernameChanged'] = 'true';
            $_SESSION['username'] = $_POST['newUsername'];
            header('Location: UpdateUsernameForm.php');
        }
    }

    if($usernameFound==='true'){
        $_SESSION['UsernameChanged'] = 'false'; 
    $_SESSION['UsernameTaken'] = 'true';
    header('Location: UpdateUsernameForm.php');
    }
}
}
?>