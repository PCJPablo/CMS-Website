<?php

function checkIfLoggedIn(){
    session_start();
    if(empty($_SESSION['LoginUser']) || empty($_SESSION['LoginPwd'])){
        return false;
       // header("location:adminLogin.php");
    }
    return true;
}

function checkAdmin(){


    if(!$_SESSION['admin']){
       // echo ("You lack admin privileges, please consult an admin");
        return false;
       // header("refresh:3;url=common.php");
    }

    return true;
}

function checkAuthor(){

    if(!$_SESSION['author']){
        //echo ("You lack author privileges, please consult an admin");
        return false;
       // header("refresh:3;url=common.php");
    }
    return true;
}

function checkEditor(){

    if(!$_SESSION['editor']){
       // echo("You lack editor privileges, please consult an admin");
        return false;
        //header("refresh:3;url=common.php");
    }
    return true;
}