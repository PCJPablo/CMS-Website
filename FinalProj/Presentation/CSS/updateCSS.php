<?php
require '../isLoggedIn.php';
if(checkIfLoggedIn() == false){
    header("location:../adminLogin.php");
}
//checkAdmin();
//checkAuthor();
if(checkEditor() == false){
    header("location:../common.php");
}
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>
                Update CSS Result
            </title>    
        </head>
        <body>
        <form action="../logout.php" method="post">
            <input type="submit" name="logout" id="logout" value="Logout">
        </form>
        <a href="../common.php">Back to Common</a><br>
            <?php

            require '../../Business/Template.php';

            $id = strip_tags($_POST['id']);
            $name = strip_tags($_POST['name']);
            $desc = strip_tags($_POST['desc']);
            $state = strip_tags($_POST['state']);
            $css = strip_tags($_POST['css']);
            $modifyDate = strip_tags(date("Y-m-d"));
            $modifiedBy = strip_tags($_SESSION['id']);

            Template::update($id, $name, $desc, $state, $css, $modifyDate,$modifiedBy);


            ?>
        </body>  
    </html>