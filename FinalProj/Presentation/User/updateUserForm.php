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
                Update User
            </title>    
        </head>
        <body>
        <form action="../logout.php" method="post">
            <input type="submit" name="logout" id="logout" value="Logout">
        </form>
        <a href="../common.php">Back to Common</a><br>
        <?php
        require '../../Business/User.php';

        $firstName;
        $lastName;

        $loginName = strip_tags($_POST['uName']);

            $userArray = User::retrieveSome(0, 10, $loginName);
            foreach($userArray as $user):
                $firstName = $user->getFirstName();
                $lastName = $user->getLastName();

            endforeach;

        ?>

        <form action="updateUser.php" method="post" onsubmit="return validate();">
            First Name:<input type="text" id="fName" name="fName" value="<?php echo $firstName ?>" maxlength="45" ><br>
            Last Name:<input type="text" id="lName" name="lName" value="<?php echo $lastName ?>" maxlength="45"><br>
            User Name:<input type="text" id="uName" name="uName" value="<?php echo $loginName ?>" maxlength="45"><br>
            Password:<input type="password" id="pwd" name="pwd" maxlength="128"><br>
            <input type="submit" id="submit" name="submit">

        </form>

        </body>  
    </html>