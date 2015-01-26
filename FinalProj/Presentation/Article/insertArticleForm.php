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
            <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
            <script>tinymce.init({selector:'textarea'});</script>
            <script type="text/javascript" src="../validation.js"></script>

            <title>
                Insert Article
			</title>
		</head>
	<body>
    <?php
    require "../../Business/WebPage.php";
    require "../../Business/ContentArea.php";
    $wp=WebPage::getAllWebPageIDs();
    $c=ContentArea::getAllContent();
    ?>
    <form action="../logout.php" method="post">
        <input type="submit" name="logout" id="logout" value="Logout">
    </form>
    <a href="../common.php">Back to Common</a><br>
    <form id="form1" action="insertArticle.php" method="post" onsubmit="return validateArticle();">
        name:<input type="text" name="name" id="name" maxlength="45"><br>
        title:<input type="text" name="title" id="title" maxlength="45"><br>
        desc:<input type="text" name="desc" id="desc" maxlength="100"><br>
        <textarea name="html" id="html"></textarea><br>

        Page: <select name="page" id="page">
            <?php
            foreach($wp as $fwid){
                ?>
                <option value="<?php echo $fwid?>"><?php echo $fwid?></option>

            <?php

            }
            ?>
        </select><br>


        Content Area: <select name="area" id="area">
            <?php
            foreach($c as $ca){
                ?>
                <option value="<?php echo $ca->getIdcontenarea()?>" ><?php echo $ca->getIdcontenarea()?></option>

            <?php

            }
            ?>
        </select><br>
        Appear on All pages: <select name="allpages" id="allpages">
            <option value="0" >0</option>
            <option value="1" >1</option>
        </select>
        <br>
        <input type="submit" name="insert" id="insert">
        <input type="hidden" id="id" value="0">

    </form>


	</body>
	</html>