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
                Add CSS Result
            </title>    
        </head>
        <body>
        <form action="../logout.php" method="post">
            <input type="submit" name="logout" id="logout" value="Logout">
        </form>
        <a href="../common.php">Back to Common</a><br>
            <?php
            require '../../Business/Template.php';

            $name = strip_tags($_POST['name']);
            $desc = strip_tags($_POST['desc']);
            $state = strip_tags($_POST['state']);
            $css = strip_tags($_POST['css']);
            $createdDate = date("Y-m-d");
            $modifiedDate = date("Y-m-d");

            $createdby = $_SESSION['id'];
            $modifiedBy = $_SESSION['id'];

            $template = new template($name, $desc, $state, $css, $createdDate, $createdby, $modifiedBy, $modifiedDate);
            $template->addTemplate();

            ?>
        </body>  
    </html>