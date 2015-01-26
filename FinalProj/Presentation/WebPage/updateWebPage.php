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
			
			</title>
		</head>
	<body>
    <form action="../logout.php" method="post">
        <input type="submit" name="logout" id="logout" value="Logout">
    </form>
    <a href="../common.php">Back to Common</a><br>
    <?php


    $id= strip_tags($_POST['wID']);
    $name= strip_tags($_POST['name']);
    $desc= strip_tags($_POST['desc']);
    $alias= strip_tags($_POST['alias']);


    require "../../Business/WebPage.php";
    $result = WebPage::updateWebPage($id, $name,$desc,$alias,$_SESSION['id']);

    echo 'Rows affected: ' . $result;
    ?>
	</body>
	</html>