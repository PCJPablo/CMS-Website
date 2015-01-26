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
            <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
            <script>tinymce.init({selector:'textarea'});</script>
			<title>
			    Update Article
			</title>
		</head>
	<body>
    <form action="../logout.php" method="post">
        <input type="submit" name="logout" id="logout" value="Logout" onsubmit="return validateArticle();">
    </form>
    <a href="../common.php">Back to Common</a><br>
        <form name="getArticleUpdate" method="post" action="" >
            Article Id to update: <input type="text" name="id" id="id" maxlength="11"><br>
            <input type="submit" name="submit" id="submit">
            </form>

		<?php
        if(isset($_POST['submit'])){
            require "../../Business/Article.php";
            require "../../Business/ContentArea.php";
            require "../../Business/WebPage.php";

            $a = Article::getArticle($_POST['id']);
            $wp=WebPage::getAllWebPageIDs();
            $c=ContentArea::getAllContent();
            ?>

            <form name="updateArticle" method="post" action="updateArticle.php" onsubmit="return validateArticle();">
                Article ID: <?php echo $_POST['id'];?><br>
                Name: <input type="text" id="name" name="name" value='<?php echo strip_tags($a->getAname());?>' maxlength="45"><br>
                Title: <input type="text" id="title" name="title" value='<?php echo strip_tags($a->getAtitle());?>' maxlength="45"><br>
                Description: <input type="text" id="aDesc" name="aDesc" value='<?php echo strip_tags($a->getAdesc());?>' maxlength="100"><br><br>
                <textarea name="html"><?php echo $a->getHtml();?></textarea><br>
                Page: <select name="page" id="page">
                    <?php
                    foreach($wp as $fwid){
                        ?>
                    <option value="<?php echo $fwid?>" <?php if($fwid==$a->getPage()) echo "selected" ?>><?php echo $fwid?></option>

               <?php

                    }
                    ?>
                    </select><br>
                Content Area: <select name="content" id="area">
                    <?php
                    foreach($c as $ca){
                        ?>
                        <option value="<?php echo $ca->getIdcontenarea()?>" <?php if($ca->getIdcontenarea()==$a->getContentarea()) echo "selected" ?>><?php echo $ca->getIdcontenarea()?></option>

                    <?php

                    }
                    ?>
                </select><br>
                Appear on All pages: <select name="all" id="allpages">
                    <option value="0" <?php if($a->getAllpages()==0) echo "selected"?>>0</option>
                        <option value="1" <?php if($a->getAllpages()==1) echo "selected"?>>1</option>
                </select>
                <br>
                <input type="hidden" id="aID" name="aID" value ='<?php echo $_POST['id'];?>'>
                <input type="submit" name="update" id="update" >
            </form>




        <?php
        }//endif

		?>
	</body>
	</html>