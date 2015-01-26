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

<!-- Backend to insert content... -->
<!DOCTYPE html>
	<html>
		<head>
			<title>
			Insert Content Result
			</title>
		</head>
	<body>
    <form action="../logout.php" method="post">

        <input type="submit" name="logout" id="logout" value="Logout">
    </form>
    <a href="../common.php">Back to Common</a><br>
		<?php
        require '../../Business/ContentArea.php';

        $c = new ContentArea( strip_tags($_POST['alias']),strip_tags($_POST['desc']),strip_tags($_POST['name']),strip_tags($_POST['order']),$_SESSION['id'],$_SESSION['id'],$_SESSION['id']);
        $result=$c->save();

            echo "Rows affected " . $result;

		?>
	</body>
	</html>