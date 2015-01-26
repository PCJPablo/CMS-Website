<?php
require '../isLoggedIn.php';
if(checkIfLoggedIn() == false){
    header("location:../adminLogin.php");
}
//checkAdmin();
if(checkAuthor()==false){
    header("location:../common.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
    <script>tinymce.init({selector:'textarea'});</script>

    <title>
        a
    </title>
</head>
<body>
<?php
require "../../Business/ContentArea.php";
require "../../Business/WebPage.php";
$webPageID = $_POST['idwebpage'];
$c=ContentArea::getAllContent();
$wp=WebPage::getAllWebPageIDs();

?>
<form action="../logout.php" method="post">
    <input type="submit" name="logout" id="logout" value="Logout">
</form>
<a href='../index.php?page=<?php echo $webPageID ?>'>back</a><br>
<form id="form1" action="insertAuthorArticle.php" method="post" onsubmit="return validateArticle();">
    name:<input type="text" name="name" id="name"><br>
    title:<input type="text" name="title" id="title"><br>
    desc:<input type="text" name="desc" id="desc"><br>
    <textarea name="html" id="html"></textarea><br>

    Page: <select name="page">
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
        <option value="1">1</option>
    </select><br>
    <input type="hidden" name="idwebpage" value="<?php echo $webPageID?>">
    <input type="submit" name="insert" id="insert">


</form>


</body>
</html>