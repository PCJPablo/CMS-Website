<?php
require 'isLoggedIn.php';
if(checkIfLoggedIn() == false){
header("location:adminLogin.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Common</title>
</head>
<body>
<form action="logout.php" method="post">
    <input type="submit" name="logout" id="logout" value="Logout">
</form>
<fieldset>
    <legend>Forms</legend>
    <a href="Article/insertArticleForm.php">Insert Article Form</a><br>
    <a href="Article/articleUpdateForm.php">Update Article Form</a><br><br>

    <a href="Content%20Area/contenttest.php">Insert Content</a><br>
    <a href="Content%20Area/contentUpdateForm.php">Update and Delete Content</a><br><br>

    <a href="CSS/addCSSForm.php">Add CSS</a><br>
    <a href="CSS/updateCSSForm.php">Update CSS Form</a><br>
    <a href="CSS/deleteCSSForm.php">Delete CSS Form</a><br><br>

    <a href="Privilege/userprivilege.php">Privilege Create, Update and Delete</a><br><br>

    <a href="articleStats.php">View article creation stats</a>
    <a href="User/addNewUser.php">Add New User/Update User</a><br><br>

    <a href="WebPage/insertWebPageForm.php">Insert Webpage</a><br>
    <a href="WebPage/updateWebPageForm.php">Update and Delete Webpage</a><br>

</fieldset><br>

</body>
</html>