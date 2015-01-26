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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
    <form action="../logout.php" method="post">
        <input type="submit" name="logout" id="logout" value="Logout">
    </form>
    <a href="../common.php">Back to Common</a><br>
        <?php

       // !empty($_POST['name'])
       // !empty($_POST['title'])
       // !empty($_POST['desc'])
       // !empty($_POST['html'])
       // !empty( $_POST['page'])
       // !empty($_POST['id'])
       // !empty($_POST['area'])
       // !empty($_POST['allpages'])

            $result = "";


                require("../../Business/Article.php");

                $newArticle = new Article( strip_tags($_POST['name']),
                    strip_tags($_POST['title']),
                    strip_tags($_POST['desc']),
                    $_POST['html'],
                    strip_tags($_POST['page']),
                    strip_tags($_SESSION['id']),
                    strip_tags($_SESSION['id']),
                    strip_tags($_POST['area']),
                    strip_tags($_POST['allpages']));

                $result = $newArticle->Save();

        ?>
<h1><?php echo $result; ?></h1>
<a href="insertArticleForm.php">Back to Display</a>
</body>
</html>