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
			    Update and Delete Web Page
			</title>
		</head>
	<body>
    <form action="../logout.php" method="post">
        <input type="submit" name="logout" id="logout" value="Logout">
    </form>
    <a href="../common.php">Back to Common</a><br>
    <form name="getArticleUpdate" method="post" action="">
        Webpage Id to update: <input type="text" name="id" id="id" maxlength="11" required>
        <input type="submit" name="submit" id="submit">
    </form>

		<?php
        if(isset($_POST['submit'])){
        require "../../Business/WebPage.php";


        $w = WebPage::getWebPage($_POST['id']);

        ?>
    <fieldset>

        <legend>Web Page Information</legend>
        <form name="updateWebPage" method="post" action="updateWebPage.php" onsubmit="return validateWebPage();">
            ID: <?php echo $_POST['id'];?><br>
            Name: <input type="text" id="name" name="name" value='<?php echo $w->getName();?>' maxlength="45"><br>
            Description: <input type="text" name="desc" value='<?php echo $w->getDesc();?>' maxlength="100"><br>
            Alias: <input type="text" id="alias" name="alias" value='<?php echo $w->getAlias();?>' maxlength="45"><br>
            Created by: <?php echo $w->getCreatedby();?><br>
            Modified by: <?php echo $w->getModifiedby();?><br>
            <input type="hidden" name="createdby" value='<?php echo $w->getCreatedby();?>'>
            <input type="hidden" name="wID" value ='<?php echo $_POST['id'];?>'>
            <input type="submit" name="update" id="update">
        </form>
        <form name="deleteWebPage" method="post" action="deleteWebPage.php" onsubmit="return validateWebPageDelete();">
            <input type="hidden" name="wID" value ='<?php echo $_POST['id'];?>'>
            <input type=submit name="delete" value ="delete">
            </form>
        </fieldset>
<?php
}

		?>
	</body>
	</html>