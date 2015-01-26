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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
</head>
<body>
<form action="../logout.php" method="post">
    <input type="submit" name="logout" id="logout" value="Logout">
</form>
<a href='../index.php?page=<?php echo $_POST["idwebpage"]; ?>'>back</a><br>
<?php


$result = "";


require("../../Business/Article.php");

$newArticle = new Article( strip_tags($_POST['name']),
    strip_tags($_POST['title']),
    strip_tags($_POST['desc']),
    $_POST['html'],
    strip_tags($_POST['page']),
    strip_tags($_SESSION['id']),
    strip_tags($_SESSION['id']),
    strip_tags($_POST['area']),
    strip_tags($_POST['allpages']));

$result = $newArticle->Save();

?>
<h1><?php echo $result; ?></h1>
</body>
</html>