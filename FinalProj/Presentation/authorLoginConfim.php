<?php
session_start();

ob_start();

// $db = mysqli_connect("localhost","root","inet2005", "mydb");
//if(!$db){
//    echo die('Could not connect to the database: ' . mysqli_error($db));
// }

$loginUser = $_POST['loginName'];
$loginPwd = $_POST['pwd'];

$loginUser = stripslashes($loginUser);
$loginPwd = stripslashes($loginPwd);
//$loginUser = mysqli_real_escape_string($db, $loginUser);
//$loginPwd = mysqli_real_escape_string($db, $loginPwd);
//$sqlStatement = "SELECT salt FROM user u   WHERE u.loginName = '$loginUser'";

require_once "../Business/User.php";
$u = User::retrieveUser($loginUser);

//$result = mysqli_query($db, $sqlStatement);
//$row=mysqli_fetch_assoc($result);

$loginPwd = crypt($loginPwd,'$6$rounds=3000$'.$u->getSalt());
//    $pwd = crypt("paulgothreau");
//    $sqlStatement = "INSERT INTO user(firstname, lastname,loginname, password, salt) VALUES ('Paul', 'Gothreau', 'paulgothreau', '$pwd', 'pepper');";
//    mysqli_query($db, $sqlStatement);

//$sqlStatement = "SELECT * FROM user u  inner JOIN userprivilege  up on u.iduser = up.User_idUser WHERE u.loginName = '$loginUser' and u.password = '$loginPwd' and (up.Privilege_idPrivilege = 1 or up.Privilege_idPrivilege = 2 or up.Privilege_idPrivilege = 3) group by u.iduser;";
//"SELECT * FROM user  INNER JOIN userprivilege WHERE loginName = '$loginUser' and password = '$loginPwd' and Privilege_idPrivilege = 1";

//$result = mysqli_query($db, $sqlStatement);
//$count = mysqli_num_rows($result);
//mysqli_close($db);

if($loginUser==$u->getUserName() && $loginPwd==$u->getPwd()){
    $_SESSION['LoginUser'] = $loginUser;
    $_SESSION['LoginPwd'] = $loginPwd;
    $_SESSION['admin']=false;
    $_SESSION['editor']=false;
    $_SESSION['author']=false;

    $id = $u->getID();
    $_SESSION['id']=$id;
    $p = User::getUserPrivileges($id);
    for($i=0;$i<count($p);$i++){
        if($p[$i]==1){
            $_SESSION['admin']=true;
        }
        elseif($p[$i]==2){
            $_SESSION['editor']=true;
        }
        elseif($p[$i]==3){
            $_SESSION['author']=true;
        }

    }

    header("location:index.php");
}
else{
    ?>
    <p>Wrong Username or Password</p><br>
    <a href="adminLogin.php">Try Again</a>

<?php
}
ob_end_flush();