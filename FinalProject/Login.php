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
        <a href = "SignUpForm.php" class="btn btn4">Sign Up</a>
        <?php 
        if($_SESSION['loggedin'] !== "true"){
            echo '<a href = "LoginForm.php" class="btn btn4">Login</a>';
        }
        else{if($_SESSION['loggedin'] === "true"){ echo '<a href = "Logout.php" class="btn btn4">Logout</a>'; }}
        ?></div>  
        <a href = "home.php"> <h1 style="text-align:center;">Final Project Games</h1></a>

        <hr><br>
    </header> 
    <div class="middle">
        <a href = "home.php" class="btn btn4">Home</a>
        <a href = "Game1.html" class="btn btn4">Rush</a>
        <a href = "Game2.html" class="btn btn4">Order</a>
        <a href = "Game3.html" class="btn btn4">Dash</a>
        <a href = "Citations.html" class="btn btn4">Citations</a>
    </div> 
    <p style="color:white;font-weight: bold; text-align: center; ">Welcome to my final project website
    </p>
    <section>
    <?php 
    function couldNotLogIn(){
       $_SESSION['displayedFailedAuth'] = 'false';
       header('Location: LoginForm.php');
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sqlConnect = mysqli_connect('localhost','lisabalbach_lopez82','CIT190134','lisabalbach_Lopez');
    $uid = mysqli_real_escape_string($sqlConnect, $_POST['username']);
    $pass_w = mysqli_real_escape_string($sqlConnect, $_POST['password']);

    $sqlacc = "SELECT * FROM users WHERE username = '$uid' OR email = '$uid'";
    $result = mysqli_query($sqlConnect, $sqlacc);
    $resultCheck = mysqli_num_rows($result);
    //No results inside of database
    if($resultCheck < 1){
        // display error message / could not log in message
        couldNotLogIn();
           
    }
    else{

        if($rows = mysqli_fetch_assoc($result)){
            if(password_verify($password, $rows['pass'])){
                //LOG IN 
                $_SESSION['username'] = $rows['username'];
                $_SESSION['email'] = $rows['email'];
                $_SESSION['firstName'] = $rows['firstName'];
                $_SESSION['lastName'] = $rows['lastName'];
                $_SESSION['id'] = $rows['id'];
                $_SESSION['loggedin'] = 'true';
                $_SESSION['displayedAuthMessage'] = 'false';
                $_SESSION['NotLoggedIn']='false';
                header("Location: home.php");
            }
            else{
                //Display Cannot Log In
                couldNotLogIn();
            }
        }

    }

    ?>
    </section>
</body> 
</html>