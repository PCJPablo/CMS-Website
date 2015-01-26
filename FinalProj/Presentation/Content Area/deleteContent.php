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
<!-- Backend to delete content... -->
<!DOCTYPE html>
	<html>
		<head>
			<title>
			Delete Content Result
			</title>
		</head>
	<body>
    <form action="../logout.php" method="post">
        <input type="submit" name="logout" id="logout" value="Logout">
    </form>
    <a href="../common.php">Back to Common</a><br>
		<?php
            $id=$_POST['id'];



            require "../../Business/ContentArea.php";

            $result = ContentArea::delete($id);

            echo 'Rows affected: ' . $result;
		?>
	</body>
	</html>