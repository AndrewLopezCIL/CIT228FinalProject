<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        Login
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css">
</head>
<body style="background-image: Url('media/BlackBackground.jpg'); background-repeat: repeat;"> 
    <header>
    <div style="display:inline-block; margin: 10px;"> 
        <?php 
        if($_SESSION['loggedin'] !== "true"){
            echo '<a href = "LoginForm.php" class="btn btn4">Login</a>';
        }
        else{if($_SESSION['loggedin'] === "true"){ echo '<a href = "Logout.php" class="btn btn4">Logout</a>'; }}

        if($_POST['password'] !== $_POST['passwordVerification']){
            $_SESSION['failedSignUp'] = 'true';
            header('Location: SignUpForm.php');
        }
        else{if($_POST['password'] === $_POST['passwordVerification']){$_SESSION['failedSignUp'] = 'false';}}
        ?></div>  
        <a href = "home.php"> <h1 style="text-align:center;">Final Project Games</h1></a>

        <hr><br>
    </header> 
    <div class="middle">
        <a href = "home.php" class="btn btn4">Home</a> 
        <a href = "managecontacts.php" class="btn btn4">Manage Account</a> 
        <a href = "Citations.html" class="btn btn4">Citations</a>
    </div> 
    <p style="color:white;font-weight: bold; text-align: center; ">Welcome to my final project website
    </p>
    <section>
    <?php 
   
    function couldNotLogIn(){
        echo '<div style="background-color:red; border: 10px solid darkred; font-weight: bold; font-size: 1.35em; padding: 10px; text-align:center; margin:auto; text-decoration:none;"><p>Could not log in. <a href = "LoginForm.php" style="color:darkred;">Please try again.</a></p></div>'; 
    }
 
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    
    $usernameFound = 'false';
    $emailFound = 'false';

    $sqlConnect = mysqli_connect('localhost','lisabalbach_lopez82','CIT190134','lisabalbach_Lopez');
    $uid = mysqli_real_escape_string($sqlConnect, $_POST['username']);
    $uemail = mysqli_real_escape_string($sqlConnect, $_POST['email']);
    $pass_w = mysqli_real_escape_string($sqlConnect, $_POST['password']);
    
    $sqlacc = "SELECT * FROM users WHERE username = '$uid'";
    $result = mysqli_query($sqlConnect, $sqlacc);
    $resultCheck = mysqli_num_rows($result);
    //Username wasn't found in the database
    if($resultCheck < 1){
        // display error message / could not log in message
        $usernameFound = 'false';
       
 
    }
    else{

        $usernameFound = 'true'; 
    }

    $sqlacc = "SELECT * FROM users WHERE email = '$uemail'";
    $result = mysqli_query($sqlConnect, $sqlacc);
    $resultCheck = mysqli_num_rows($result);
    // email wasn't found in database
    if($resultCheck < 1){
        // display error message / could not log in message
        $emailFound = 'false';
           
    }
    else{
        $emailFound = 'true';
    } 
    if($emailFound === 'false'){
        //Signup
        if($usernameFound === 'false'){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $signupQuery = "INSERT INTO users (email, username, pass, firstName, lastName) VALUES ('$uemail', '$uid', '$hashedPassword', '$firstName', '$lastName')";
        //Not running through the if statement query
        if(mysqli_query($sqlConnect, $signupQuery)){ 
       
            if($_SESSION['loggedin'] !== 'true'){
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['firstName'] = $firstName;
                $_SESSION['lastName'] = $lastName;
                $_SESSION['loggedin'] = 'true';   
                $_SESSION['displayedAuthMessage'] = 'false';  
                header('Location: home.php');
            }
            else{
                $_SESSION['AccountCreated']='true';
                header('Location: home.php');
            }
            header('LocationL home.php');
        } 
    }
        else{
            die(mysqli_error());
           // couldNotLogIn();

        }
    }
    else{
       // couldNotLogIn();
    }

    ?>
    </section>
</body> 
</html>