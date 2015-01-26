<?php
require 'isLoggedIn.php';
if(checkIfLoggedIn()){
    header("location:authorLogin.php");
}
//checkAdmin();
//checkAuthor();



session_start();
session_destroy();
header("location:authorLogin.php");

?>