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
			Insert Web Page
			</title>
		</head>
	<body>
    <form action="../logout.php" method="post">
        <input type="submit" name="logout" id="logout" value="Logout">
    </form>
    <a href="../common.php">Back to Common</a><br>
    <legend>Web Page Information</legend>
    <form name="insetWebPage" method="post" action="insertWebPage.php" onsubmit="return validateWebPage();">

        Name: <input type="text" name="name" id="name" maxlength="45"><br>
        Description: <input type="text" name="desc" id="desc" maxlength="100"><br>
        Alias: <input type="text" name="alias" id="alias" maxlength="45"><br>
        <input type="submit" name="update" id="update" >
    </form>

		<?php

		?>
	</body>
	</html>