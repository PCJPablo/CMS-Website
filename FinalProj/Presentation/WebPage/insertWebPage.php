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
			Insert Web Page Results
			</title>
		</head>
	<body>
    <form action="../logout.php" method="post">
        <input type="submit" name="logout" id="logout" value="Logout">
    </form>
    <a href="../common.php">Back to Common</a><br>
		<?php
        require("../../Business/WebPage.php");



        $alias= strip_tags($_POST['alias']);
        $createdby= $_SESSION['id'];
        $modifiedby=$_SESSION['id'];;
        $desc= strip_tags($_POST['desc']);
        $name= strip_tags($_POST['name']);

        $newWebPage = new WebPage($alias, $createdby,$modifiedby,$desc,$name);

        $result = $newWebPage->addWebPage();
        echo $result;
		?>


	</body>
	</html>