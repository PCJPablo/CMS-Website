<?php
require '../isLoggedIn.php';
if(checkIfLoggedIn() == false){
    header("location:../adminLogin.php");
}
//checkAdmin();
//checkAuthor();
if(checkAdmin() == false){
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

        //Admin status...
        if(isset($_POST['Administrator']) &&
            $_POST['Administrator'] == 'Yes')
        {
            $admin = "true";
        }
        else
        {
            $admin = "false";
        }
        //Editor status...
        if(isset($_POST['Editor']) &&
            $_POST['Editor'] == 'Yes')
        {
            $editor = "true";
        }
        else
        {
            $editor = "false";
        }
        //Author status...
        if(isset($_POST['Author']) &&
            $_POST['Author'] == 'Yes')
        {
            $author = "true";
        }
        else
        {
            $author = "false";
        }

        if(!empty($_POST['user']))
        {
            require("../../Business/privilege.php");
            $newPrivilege = new privilege(strip_tags($_POST['user']),$admin,$editor,$author);
            $result = $newPrivilege->configure(strip_tags($_POST['user']),$admin,$editor,$author);
        }
        else
        {
            $result = "No changes were made.";
        }

        echo $result;
		?>
	</body>
	</html>