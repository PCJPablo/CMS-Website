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
            Delete CSS Form
        </title>
    </head>
    <body>
    <form action="../logout.php" method="post">
        <input type="submit" name="logout" id="logout" value="Logout">
    </form>
    <a href="../common.php">Back to Common</a><br>
        <form method="post" action="deleteCSS.php">
            CSS Id: <input type="text" name="id" id="id" maxlength="11" required><br>
            <input type="submit" id="submit" name="submit">
        </form>
    <?php

    ?>

    </body>
</html>