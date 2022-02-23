<?php

session_start();
unset($_SESSION['s_username']);
unset($_SESSION['b_user']);
unset($_SESSION['cart']);
//session_destroy();
header("Location:index.php");
die();
?>;