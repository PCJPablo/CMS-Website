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
<!DOCTYPE html>
    <html>
        <head>
            <script src="../validation.js"></script>
            <title>
                Add and Update User
            </title>
        </head>
        <body>
        <form action="../logout.php" method="post">
            <input type="submit" name="logout" id="logout" value="Logout">
        </form>
        <a href="../common.php">Back to Common</a><br>
            <form action="addUserToDb.php" method="post" onsubmit="return validate();">
                First Name:<input type="text" id="fName" name="fName" maxlength="45"><br>
                Last Name:<input type="text" id="lName" name="lName" maxlength="45"><br>
                User Name:<input type="text" id="uName" name="uName" maxlength="45"><br>
                Password:<input type="password" id="pwd" name="pwd" maxlength="128"><br>
                <input type="submit" id="submit" name="submit" value="add">
            </form>

            <form action="updateUserForm.php" method="post">

                User Name:<input type="text" id="uName" name="uName" maxlength="45"><br>
                Password:<input type="password" id="pwd" name="pwd" maxlength="128"><br>
                <input type="submit" id="submit" name="submit" value="update">

            </form>
        </body>
    </html>