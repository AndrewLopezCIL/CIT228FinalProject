<?php
session_start();

session_destroy();
session_start();
$_SESSION['DisplayedLoggedOutMessage'] = 'false';

header('Location: home.php');
?>