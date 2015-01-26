<?php session_start();

require_once '../Business/Article.php';
require_once '../Business/ContentArea.php';
require_once '../Business/Template.php';
require_once '../Business/WebPage.php';
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    //Connecting to the database...
//    $dbConnection = mysqli_connect("localhost","backEnd", "paulgoth","mydb");
//    if (!$dbConnection)
//    {
//        die('Could not connect to the Sakila Database: ' .
//            $dbConnection->connect_errno);
//    }


    //Setting the CSS Style for the page...
    //$cssStyle = mysqli_query($dbConnection,"SELECT * FROM css WHERE activestate = 1");
    $cssStyle = Template::getActiveCSS();
//    if(!$cssStyle)
//    {
//        die('Could not retrieve css style from the mydb Database: ' . mysqli_error($db));
//    }
//    while ($rowCss = mysqli_fetch_assoc($cssStyle))
//    {
//        echo '<style>' . $rowCss['css'] . '</style>';
//    }

    ?><style><?php echo $cssStyle->getCSS();?></style><?php
    //Done setting style for activate css...
    if(isset($_GET['page'])){
        $page=$_GET['page'];
        $webPage = WebPage::getWebPage($_GET['page']);//mysqli_query($dbConnection,"SELECT * FROM webpage WHERE idwebpage = '$page';");
//        if(!$result){
//            die("ERROR!!!!!");
//        }
        //$row = mysqli_fetch_assoc($result);
    }
    else{
        $webPage = WebPage::getNextWebPage();
//        $page=2;
//        $result = mysqli_query($dbConnection,"SELECT * FROM webpage WHERE idwebpage LIKE 2;");
//        if(!$result){
//            die("ERROR!!!!!");
//        }
//        $row = mysqli_fetch_assoc($result);
    }
    ?>
    <title>
        <?php echo $webPage->getName(); ?>
    </title>
</head>
<body>
<?php if(isset($_SESSION['editor'])){?>
<form action="authorLogout.php" method="post">
    <input type="submit" name="logout" id="logout" value="Logout">
</form>
<?php }
    else{
        ?>
<form action="authorLogin.php" method="post">
    <input type="submit" name="login" id="login" value="Login">
</form>

<?php }?>
<?php
$webPages =WebPage::getAllWebPages();

//$result = mysqli_query($dbConnection,"SELECT * FROM webpage;");
?>
<nav>
    <?php
//while($row=mysqli_fetch_assoc($result)){
    foreach($webPages as $aPage){
    ?>

        <a href='index.php?page=<?php echo $aPage->getId(); ?>'><?php echo $aPage->getName(); ?></a>

<?php

}
    if(isset($_GET['page'])){
        $page = WebPage::getWebPage($_GET['page']);
    }
    else{
        $_GET['page']=$webPages[0]->getId();
    $page = WebPage::getWebPage($webPages[0]->getId());
    }

?>
    </nav>
<?php if(isset($_SESSION['editor'])){if($_SESSION['editor']==true){?>
<form action="Article/authorInsertArticleForm.php" method="post">
    <input type="hidden" name="idwebpage" value="<?php echo$_GET['page']?>">
    <input type="submit" name="aInsert" value="Add Article">
</form>
<?php }}?>
<header>
    <h1><?php echo $page->getName(); ?></h1>
</header>
<section>
    <?php

    // BUILD OUR PAGE CONTENT
    // obtain/receive all content areas ($areaArray)
    // get them in ORDER
    // every page gets all content areas (they may be empty)
    // so I do not need to tie to current page
    $divResult = ContentArea::getAllContent();//mysqli_query($dbConnection,"SELECT * FROM content;");
    //$areaArray = mysqli_fetch_assoc($result);
    foreach($divResult as $content)
    {
    // all of our content areas are DIVs
    ?><div id=<?php echo $content->getAlias();?>>
        <?php
        // obtain/receive all articles ($articleArray)
        // for the current page (or for all pages)
        // and for the current area
        // in REVERSE ORDER of creation date
        $currentRow = $content->getIdcontenarea();
        $articleResult = Article::getArticleFromContent($currentRow, $_GET['page']);
        if ($articleResult){
        foreach($articleResult as $article)
        {
        ?><article id = '<?php echo $article->getATitle();?>'>
            <?php
            //echo "<article id='$article->getAlias()'>";
            echo $article->getHtml();

            ?>
            <?php if(isset($_SESSION['editor'])){if($_SESSION['editor']==true){?>
            <form action="Article/authorUpdateArticleForm.php" method="post">
                <input type="hidden" name="idwebpage" value="<?php echo$_GET['page']?>">
                <input type="hidden" name="idarticle" value="<?php echo $article->getIdarticles()?>">
                <input type="submit" name="aUpdate" value="Update">
                </form>


            <form action="Article/authorRemoveArticle.php" method="post">
                <input type="hidden" name="idwebpage" value="<?php echo$_GET['page']?>">
                <input type="hidden" name="idarticle" value="<?php echo $article->getIdarticles()?>">
                <input type="submit" name="aRemove" value="Remove">
            </form>
            <?php }}?>
            </article><?php
        }
        }
            ?></div><?php
            }
            ?>
</section>

</body>
</html>