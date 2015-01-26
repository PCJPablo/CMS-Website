<?php
//needs to require a data layer...
require_once __DIR__.'/../Data/dbcon.php';
class privilege
{
    private $loginName;
    private $adminRight;
    private $editorRight;
    private $authorRight;

    public function __construct($in_login,$in_admin,$in_editor,$in_author)
    {
        $this->loginName = $in_login;
        $this->adminRight = $in_admin;
        $this->editorRight = $in_editor;
        $this->authorRight = $in_author;
    }

    public function configure()
    {

        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();

        //fetches id of the person whose logging in...
        $myDataAccess->searchAdminPrivilege($this->loginName);
        $adminId = $myDataAccess->fetchAdminPrivilege();

        //*************************** default id until login id is established ************************
        $loggedInId = 1;
        $currentTime = gmdate('Y-m-d');

        if(!$adminId)
        {
            return "Please enter a valid user login.";
        }

        $result = "The following changes have been made to " . $this->loginName . ": ";

        if($this->adminRight == "true")
        {
            //need to determine if the person already has rights
            $myDataAccess->adminPrivilegeExists($adminId);

            while(!$adminRow = $myDataAccess->fetchAdminPrivilegeExists())
            {
                //Inserts the user administrator privilege of the person's id.
                $myDataAccess->addAdminPrivilege($adminId);

                //update user's last modified date ******** need to change modified by to variable of user logged in....,.... ***************
                $myDataAccess->updateModifiedPrivilege($currentTime ,$loggedInId, $adminId);
                $result = $result . "Administrator rights granted. ";
                break;
            }
        }
        else
        {
            //delete admin right
            $myDataAccess->adminPrivilegeExists($adminId);

            while($adminRow = $myDataAccess->fetchAdminPrivilegeExists())
            {
                //deleting admin...
                $myDataAccess->deleteAdminPrivilege($adminId);
                //update user's last modified date
                $myDataAccess->updateModifiedPrivilege($currentTime ,$loggedInId, $adminId);
                $result = $result . "Administrator rights revoked. ";
                break;
            }
        }

        if($this->editorRight == "true")
        {
            //need to determine if the person already has rights
            $myDataAccess->editorPrivilegeExists($adminId);

            while(!$editorRow = $myDataAccess->fetchEditorPrivilegeExists())
            {
                //Inserts the user editor privilege of the person's id.
                $myDataAccess->addEditorPrivilege($adminId);
                //update user's last modified date
                $myDataAccess->updateModifiedPrivilege($currentTime ,$loggedInId, $adminId);
                $result = $result . "Editor rights granted. ";
                break;
            }
        }
        else
        {
            //delete editor right
            $myDataAccess->editorPrivilegeExists($adminId);

            while($editorRow = $myDataAccess->fetchEditorPrivilegeExists())
            {
                //deleting editor...
                $myDataAccess->deleteEditorPrivilege($adminId);
                //update user's last modified date
                $myDataAccess->updateModifiedPrivilege($currentTime ,$loggedInId, $adminId);
                $result = $result . "Editor rights revoked. ";
                break;
            }
        }

        if($this->authorRight == "true")
        {
            //need to determine if the person already has rights
            $myDataAccess->authorPrivilegeExists($adminId);

            while(!$authorRow = $myDataAccess->fetchAuthorPrivilegeExists())
            {
                //Inserts the user author privilege of the person's id.
                $myDataAccess->addAuthorPrivilege($adminId);
                //update user's last modified date
                $myDataAccess->updateModifiedPrivilege($currentTime ,$loggedInId, $adminId);
                $result = $result . "Author rights granted.";
                break;
            }
        }
        else
        {
            //delete author right
            $myDataAccess->authorPrivilegeExists($adminId);

            while($AuthorRow = $myDataAccess->fetchAuthorPrivilegeExists())
            {
                //deleting author...
                $myDataAccess->deleteAuthorPrivilege($adminId);
                //update user's last modified date
                $myDataAccess->updateModifiedPrivilege($currentTime ,$loggedInId, $adminId);
                $result = $result . "Author rights revoked.";
                break;
            }
        }

        if($result == "The following changes have been made to " . $this->loginName . ": ")
        {
            $result = "No records were changed.";
        }
        return $result;

        $myDataAccess->closeDB();
    }
}
?>