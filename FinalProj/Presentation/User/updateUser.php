<form action="../logout.php" method="post">
    <input type="submit" name="logout" id="logout" value="Logout">
</form>
<a href="../common.php">Back to Common</a><br>
<title>Update Results</title>
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

    require '../../Business/User.php';
    $salt = rand(2000, 9999);

    $firstName = strip_tags($_POST['fName']);
    $lastName = strip_tags($_POST['lName']);
    $loginName = strip_tags($_POST['uName']);
    $pwd = crypt($_POST['pwd'], $salt);
    $modifyDate = date("Y-m-d");
    $modifiedBy = $_SESSION['id'];

    User::update($firstName, $lastName, $loginName, $pwd, $salt,$modifyDate, $modifiedBy);
