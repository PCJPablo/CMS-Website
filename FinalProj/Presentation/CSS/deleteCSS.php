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
                Delete CSS Result
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

            $result = "";

            //if(!empty($_POST['id'])){

                $templateArray = Template::retrieveSome(0, 10, $id);
                foreach($templateArray as $template):

                    $result = $template->delete($id);
                endforeach;
           // }

            ?>
        </body>  
    </html>