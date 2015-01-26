<?php
require '../isLoggedIn.php';
if(checkIfLoggedIn() == false){
    header("location:../adminLogin.php");
}
//checkAdmin();
//checkAuthor();
if(checkAdmin() == false){
    header("location:../common.php");
}
?>
<html>
<head>
    <h3>User Permission Management</h3>
</head>
<body>
<form action="../logout.php" method="post">
    <input type="submit" name="logout" id="logout" value="Logout">
</form>
<a href="../common.php">Back to Common</a><br>
<form method="post" action="setPrivilege.php">
    <fieldset>
        <legend>User Permissions</legend>
        Enter login name: <input type="text" name="user" required maxvalue="45"><br>
        Administrator: <input type="checkbox" name="Administrator" value="Yes" /><br>
        Editor: <input type="checkbox" name="Editor" value="Yes" /><br>
        Author: <input type="checkbox" name="Author" value="Yes" />
    </fieldset><br>
    <input type="submit" name="Update Permissions" value="Submit" />
    <input type="hidden" name="posted" value="yes" />
</form>

</body>
</html>