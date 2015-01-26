<?php

require_once '../kirbyData/kirbyDataAccess.php';
class database {

    private $dbConnection;
    private $result;
    private $stmt;

    // aDataAccess methods
    public function connectToDB(){
        try{
            $this->dbConnection = new PDO("mysql:host=localhost;dbname=mydb", "root", "inet2005");
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $ex){
            die('Could not connect to the Database via PDO' .$ex->getMessage());
        }
    }

    public  function closeDB(){
        $this->dbConnection = null;
    }

    //find user id
    public function searchAdminPrivilege($user)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("SELECT iduser FROM user WHERE loginname = :user");
            $this->stmt->bindParam(':user', $user, PDO::PARAM_STR);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error searching id of user in privileges: ' . $ex->getMessage());
        }
    }

    public function fetchAdminPrivilege()
    {
        try
        {
            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            return $this->result['iduser'];
        }
        catch(PDOException $ex)
        {
            die('Error fetching admin privilege: ' . $ex->getMessage());
        }
    }

    //admin checks...
    public function adminPrivilegeExists($adminId)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("SELECT user_iduser FROM userprivilege WHERE Privilege_idPrivilege = 1 AND user_iduser = :admin");
            $this->stmt->bindParam(':admin', $adminId, PDO::PARAM_STR);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error finding out if admin privilege exists: ' . $ex->getMessage());
        }
    }

    public function fetchAdminPrivilegeExists()
    {
        try
        {
            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            return $this->result;
        }
        catch(PDOException $ex)
        {
            die('Error fetching if admin privilege exists: ' . $ex->getMessage());
        }
    }

    public function addAdminPrivilege($adminId)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("INSERT INTO userprivilege (Privilege_idPrivilege, User_idUser) VALUES (1, :admin)");
            $this->stmt->bindParam(':admin', $adminId, PDO::PARAM_INT);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error adding admin privileges: ' . $ex->getMessage());
        }
    }

    //Editor checks...
    public function fetchEditorPrivilegeExists()
    {
        try
        {
            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            return $this->result;
        }
        catch(PDOException $ex)
        {
            die('Error fetching if the editor privilege exists: ' . $ex->getMessage());
        }
    }

    public function addEditorPrivilege($adminId)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("INSERT INTO userprivilege (Privilege_idPrivilege, User_idUser) VALUES (2, :admin)");
            $this->stmt->bindParam(':admin', $adminId, PDO::PARAM_INT);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error adding editor privilege: ' . $ex->getMessage());
        }
    }

    public function editorPrivilegeExists($adminId)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("SELECT user_iduser FROM userprivilege WHERE Privilege_idPrivilege = 2 AND user_iduser = :admin");
            $this->stmt->bindParam(':admin', $adminId, PDO::PARAM_STR);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error finding out if the editor privilege exists: ' . $ex->getMessage());
        }
    }

    //Author checks...
    public function fetchAuthorPrivilegeExists()
    {
        try
        {
            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            return $this->result;
        }
        catch(PDOException $ex)
        {
            die('Error fetching if the author exists: ' . $ex->getMessage());
        }
    }

    public function addAuthorPrivilege($adminId)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("INSERT INTO userprivilege (Privilege_idPrivilege, User_idUser) VALUES (3, :admin)");
            $this->stmt->bindParam(':admin', $adminId, PDO::PARAM_INT);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error adding author privilege: ' . $ex->getMessage());
        }
    }

    public function authorPrivilegeExists($adminId)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("SELECT user_iduser FROM userprivilege WHERE Privilege_idPrivilege = 3 AND user_iduser = :admin");
            $this->stmt->bindParam(':admin', $adminId, PDO::PARAM_STR);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error finding author privilege: ' . $ex->getMessage());
        }
    }

    //if admin exists delete...
    public function deleteAdminPrivilege($adminId)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("DELETE FROM userprivilege WHERE Privilege_idPrivilege = 1 AND User_idUser = :admin");
            $this->stmt->bindParam(':admin', $adminId, PDO::PARAM_INT);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error deleting admin privilege: ' . $ex->getMessage());
        }
    }

    public function deleteEditorPrivilege($adminId)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("DELETE FROM userprivilege WHERE Privilege_idPrivilege = 2 AND User_idUser = :admin");
            $this->stmt->bindParam(':admin', $adminId, PDO::PARAM_INT);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error deleting editor privilege: ' . $ex->getMessage());
        }
    }

    public function deleteAuthorPrivilege($adminId)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("DELETE FROM userprivilege WHERE Privilege_idPrivilege = 3 AND User_idUser = :admin");
            $this->stmt->bindParam(':admin', $adminId, PDO::PARAM_INT);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error deleting author privilege: ' . $ex->getMessage());
        }
    }

    public function updateModifiedPrivilege($currentTime ,$loggedInId, $adminId)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("UPDATE user SET modifieddate = :currentTime, modifiedBy = :loggedInId WHERE iduser = :admin;");
            $this->stmt->bindParam(':loggedInId', $loggedInId, PDO::PARAM_INT);
            $this->stmt->bindParam(':admin', $adminId, PDO::PARAM_INT);
            $this->stmt->bindParam(':currentTime', $currentTime, PDO::PARAM_STR);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error updating modified date on privilege: ' . $ex->getMessage());
        }
    }

    //********************************************************* WEBPAGE STUFF **********************************************************************
    //note my desc is name adesc

    public function searchWebPage($id)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("SELECT * FROM webpage WHERE idwebpage=:id");
            $this->stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error retrieving webpage: ' . $ex->getMessage());
        }
    }

    public function fetchWebPage(){
        $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $this->result;
    }


public function fetchWebPageAlias($row){

        return $row['alias'];

}

    public function fetchWebPageCreatedBy($row){

        return $row['createdby'];

    }

    public function fetchWebPageModifiedBy($row){

        return $row['modifiedby'];

    }


    public function fetchWebPageDesc($row){

        return $row['desc'];

    }

    public function fetchWebPageName($row){

        return $row['name'];

    }

    public function fetchWebPageId($row){

        return $row['idwebpage'];

    }


//
//    public function fetchWebPageExists()
//    {
//        try
//        {
//            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
//            return $this->result;
//        }
//        catch(PDOException $ex)
//        {
//            die('Error fetching webpage results: ' . $ex->getMessage());
//        }
//    }

    public function addWebPage($name, $desc, $alias, $time, $loggedInId)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("INSERT INTO webpage (webpage.name,webpage.desc,alias,creationdate,modifieddate,createdby,modifiedby) VALUES (:wname,:wdesc,:alias,:wtime,:wtime,:loggedInId,:loggedInId)");
            $this->stmt->bindParam(':wname', $name, PDO::PARAM_STR);
            $this->stmt->bindParam(':wdesc', $desc, PDO::PARAM_STR);
            $this->stmt->bindParam(':alias', $alias, PDO::PARAM_STR);
            $this->stmt->bindParam(':wtime', $time, PDO::PARAM_STR);
            $this->stmt->bindParam(':loggedInId', $loggedInId, PDO::PARAM_INT);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error adding a webpage: ' . $ex->getMessage());
        }
    }

//    public function searchNameWebPagePrivilege($search)
//    {
//        try
//        {
//            $this->stmt = $this->dbConnection->prepare("SELECT * FROM webpage WHERE idwebpage = :search OR name = :search");
//            $this->stmt->bindParam(':search', $search, PDO::PARAM_STR);
//            $this->stmt->execute();
//        }
//        catch(PDOException $ex)
//        {
//            die('Error retrieving webpage search details: ' . $ex->getMessage());
//        }
//    }
//
//    public function fetchSearchWebPageNamePrivilege($searchSelect)
//    {
//        try
//        {
//            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
//            return $this->result[$searchSelect];
//        }
//        catch(PDOException $ex)
//        {
//            die('Error fetching webpage results: ' . $ex->getMessage());
//        }
//    }

    public function updateWebPage($id,$name,$desc,$alias,$currentTime,$modifiedby)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("UPDATE webpage SET webpage.name = :name, webpage.desc = :desc, alias = :alias,  modifieddate = :modifieddate, modifiedby = :modifiedby WHERE idwebpage = :id");
            $this->stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $this->stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $this->stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
            $this->stmt->bindParam(':alias', $alias, PDO::PARAM_STR);
            $this->stmt->bindParam(':modifieddate', $currentTime, PDO::PARAM_STR);
            $this->stmt->bindParam(':modifiedby', $modifiedby, PDO::PARAM_INT);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error updating webpage search details: ' . $ex->getMessage());
        }
    }

    public function deleteWebPage($id)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("DELETE FROM webpage WHERE idwebpage = :id");
            $this->stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error delete webpage search details: ' . $ex->getMessage());
        }
    }
}

?>