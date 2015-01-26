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

<!-- Backend to update Content pages... -->
<!DOCTYPE html>
	<html>
		<head>
			<title>
			Update Content Result
			</title>
		</head>
	<body>
    <form action="../logout.php" method="post">
        <input type="submit" name="logout" id="logout" value="Logout">
    </form>
    <a href="../common.php">Back to Common</a><br>
    <?php

        //Strip tags for security
        $name= strip_tags($_POST['name']);
        $alias= strip_tags($_POST['alias']);
        $desc= strip_tags($_POST['cDesc']);
        $order= strip_tags($_POST['order']);
        $id= strip_tags($_POST['cID']);
        $user= strip_tags($_SESSION['id']);



        require "../../Business/ContentArea.php";

        //echoing results of updated content page...
        $result = ContentArea::update($id,$name,$alias,$order, $desc,$user);

        echo 'Rows affected: ' . $result;
    ?>
	</body>
	</html>