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
			    Delete Web Page Result
			</title>
		</head>
	<body>
    <form action="../logout.php" method="post">
        <input type="submit" name="logout" id="logout" value="Logout">
    </form>
    <a href="../common.php">Back to Common</a><br>
		<?php


        $id= strip_tags($_POST['wID']);


        require "../../Business/WebPage.php";

        $result = WebPage::deleteWebPage($id);

        echo $result;
		?>
	</body>
	</html>