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
<!-- front end update content page... -->
<!DOCTYPE html>
	<html>
		<head>
            <script type="text/javascript" src="../validation.js"></script>
			<title>
			Update Content
			</title>
		</head>
        <form action="../logout.php" method="post" >
            <input type="submit" name="logout" id="logout" value="Logout">
        </form>
        <a href="../common.php">Back to Common</a><br>
        <form name="getContentUpdate" method="post" action="">
            Content area Id to update: <input type="text" name="id" id="uid" maxlength="11" required>
            <input type="submit" name="submit" id="submit">
        </form>
        <form name="getContentUpdate" method="post" action="deleteContent.php" onsubmit="return validateContentDelete();">
            Content area Id to delete: <input type="text" name="id" id="did" maxlength="11" required>
            <input type="submit" name="submit" id="submit">
        </form>

        <?php
        if(isset($_POST['submit'])){
            require "../../Business/ContentArea.php";

            $c = ContentArea::getContent($_POST['id']);
            ?>

            <form name="updateContent" method="post" action="updateContent.php" onsubmit="return validateContentArea();">
                Content ID: <?php echo $_POST['id'];?>
                Name: <input type="text" name="name" id="name" value='<?php echo $c->getCname();?>' maxlength="45"><br>
                Alias: <input type="text" name="alias" id="alias" value='<?php echo $c->getAlias();?>' maxlength="45"><br>
                Description: <input type="text" name="cDesc" value='<?php echo $c->getCdesc();?>' maxlength="100"><br>
                Order: <input type="text" name="order" id="order" value='<?php echo $c->getCorder();?>' maxlength="11"><br>

                <input type="hidden" name="cID" value ='<?php echo $_POST['id'];?>'>
                <input type="submit" name="update" id="update">
            </form>




        <?php
        }//endif

        ?>
        </body>
	</body>
	</html>