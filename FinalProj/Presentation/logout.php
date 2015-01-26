<?php
require 'isLoggedIn.php';
if(checkIfLoggedIn()){
    header("location:../adminLogin.php");
}
//checkAdmin();
//checkAuthor();



session_start();
session_destroy();
header("location:adminLogin.php");

?>