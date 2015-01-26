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
            <script type="text/javascript" src="../validation.js"></script>
            <title>
                Add CSS
            </title>    
        </head>
        <body>
        <form action="../logout.php" method="post">
            <input type="submit" name="logout" id="logout" value="Logout">
        </form>
        <a href="../common.php">Back to Common</a><br>
            <?php
                
            ?>

            <form action="addCSS.php" method="post" onsubmit="return validateCSS();">
                Name: <input type="text" id="name" name="name" maxlength="45"><br>
                Description: <input type="text" id="desc" name="desc" maxlength="100"><br>
                Active State: <input type="text" id="state" name="state" maxlength="1"><br>
                CSS: <input type="text" id="css" name="css" maxlength="800"><br>
                <input type="submit" id="submit" name="submit">
            </form>
        </body>  
    </html>