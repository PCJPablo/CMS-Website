<?php
require '../isLoggedIn.php';
if(checkIfLoggedIn() == false){
    header("location:../adminLogin.php");
}
//checkAdmin();
//checkAuthor();
if(checkAuthor() == false){
    header("location:../common.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
    <script>tinymce.init({selector:'textarea'});</script>
    <title>
        Update Article
    </title>
</head>
<body>
<form action="../logout.php" method="post">
    <input type="submit" name="logout" id="logout" value="Logout">
</form>
<a href='../index.php?page=<?php echo $_POST['idwebpage'] ?>'>back</a><br>


<?php

    require "../../Business/Article.php";
    require "../../Business/ContentArea.php";
    require "../../Business/WebPage.php";
    $webPageID = $_POST['idwebpage'];
    $a = Article::getArticle($_POST['idarticle']);
    $wp=WebPage::getAllWebPageIDs();
    $c=ContentArea::getAllContent();
    ?>

    <form name="updateArticle" method="post" action="updateAuthorArticle.php" onsubmit="return validateArticle();">
        Article ID: <?php echo $_POST['idarticle'];?><br>
        Name: <input type="text" name="name" value='<?php echo strip_tags($a->getAname());?>' maxlength="45"><br>
        Title: <input type="text" name="title" value='<?php echo strip_tags($a->getAtitle());?>' maxlength="45"><br>
        Description: <input type="text" name="aDesc" value='<?php echo strip_tags($a->getAdesc());?>' maxlength="100"><br><br>
        <textarea name="html"><?php echo $a->getHtml();?></textarea><br>
        Page: <select name="page">
            <?php
            foreach($wp as $fwid){
                ?>
                <option value="<?php echo $fwid?>" <?php if($fwid==$a->getPage()) echo "selected" ?>><?php echo $fwid?></option>

            <?php

            }
            ?>
        </select><br>
        Content Area: <select name="content">
            <?php
            foreach($c as $ca){
                ?>
                <option value="<?php echo $ca->getIdcontenarea()?>" <?php if($ca->getIdcontenarea()==$a->getContentarea()) echo "selected" ?>><?php echo $ca->getIdcontenarea()?></option>

            <?php

            }
            ?>
        </select><br>
        Appear on All pages: <select name="all">
            <option value="0" <?php if($a->getAllpages()==0) echo "selected"?>>0</option>
            <option value="1" <?php if($a->getAllpages()==1) echo "selected"?>>1</option>
        </select>
        <br>
        <input type="hidden" name="aID" value ='<?php echo $_POST['idarticle'];?>'>
        <input type="hidden" name="idwebpage" value="<?php echo $webPageID?>">
        <input type="submit" name="update" id="update">
    </form>





</body>
</html>