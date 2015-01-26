<form action="../logout.php" method="post">
    <input type="submit" name="logout" id="logout" value="Logout">
</form>
<title>Add User Result</title>
<a href="../common.php">Back to Common</a><br>
<?php
require '../isLoggedIn.php';
if(checkIfLoggedIn() == false){
    header("location:../adminLogin.php");
}
checkAdmin();
checkAuthor();
if(checkAdmin() == false){
    header("location:../common.php");
}

    require '../../Business/User.php';

    $salt = time();
    $firstName = strip_tags($_POST['fName']);
    $lastName = strip_tags($_POST['lName']);
    $loginName = strip_tags($_POST['uName']);
    $pwd = crypt($_POST['pwd'], '$6$rounds=3000$'.$salt);
    $createdDate = date("Y-m-d");
    $modifiedDate = date("Y-m-d");
    $createdBy = $_SESSION['id'];
    $modifiedBy = $_SESSION['id'];


    $user = new User($firstName, $lastName, $loginName, $pwd, $salt, $createdDate, $modifiedDate, $createdBy, $modifiedBy);
    $user->addUser();
