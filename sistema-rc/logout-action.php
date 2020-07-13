<?php 

require_once 'config.php';

if (isset($_SESSION['loggedInUserId'])) {
    unset($_SESSION['loggedInUserId']);
    unset($_SESSION['loggedInUserName']);
}

header('Location: login.php');
exit;
