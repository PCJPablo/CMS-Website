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
<!-- Update article for author... -->
<!DOCTYPE html>
<html>
<head>
    <title>
        Update Article
    </title>
</head>
<body>
<form action="../logout.php" method="post">
    <input type="submit" name="logout" id="logout" value="Logout">
</form>
<a href='../index.php?page=<?php echo $_POST["idwebpage"]; ?>'>back</a><br>
<?php
$name= strip_tags($_POST['name']);
$title= strip_tags($_POST['title']);
$desc= strip_tags($_POST['aDesc']);
$html= $_POST['html'];
$page= strip_tags($_POST['page']);
$id=strip_tags($_POST['aID']);
$content=strip_tags($_POST['content']);
$all=strip_tags($_POST['all']);
$user = $_SESSION['id'];


require "../../Business/Article.php";
//HARDCODED USER, CHANGE BEFORE MARKING!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$result = Article::update($id,$name,$title, $desc,$html,$page,$user,$content,$all);

echo 'Rows affected: ' . $result;
?>
</body>
</html>