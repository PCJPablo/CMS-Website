<?php
require 'isLoggedIn.php';
checkIfLoggedIn();
checkAdmin();
//checkAuthor();
checkEditor();

?>
<form action="logout.php" method="post">
    <input type="submit" name="logout" id="logout" value="Logout">
</form>