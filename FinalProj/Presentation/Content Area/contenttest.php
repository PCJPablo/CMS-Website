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
<!-- Inserting content via post... -->
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="../validation.js"></script>
    <title>
        Insert Content
    </title>
</head>
<body>
<form action="../logout.php" method="post">
    <input type="submit" name="logout" id="logout" value="Logout">
</form>
<a href="../common.php">Back to Common</a><br>
<form id="form1" action="insertContent.php" method="post" onsubmit="return validateContentArea();">
    name:<input type="text" name="name" id="name" maxlength="45"><br>
    alias:<input type="text" name="alias" id="alias" maxlength="45"><br>
    order:<input type="text" name="order" id="order" maxlength="11"><br>
    desc:<input type="text" name="desc" id="desc" maxlength="100"><br>
    <input type="submit" name="insert" id="insert" value="insert"><br>
</form>

</body>
</html>