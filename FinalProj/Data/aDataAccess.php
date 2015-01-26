<?php

require_once 'databaseStatements.php';

abstract class aDataAccess{
    private static $m_DataAcess;

    public static function getInstance(){
        if(self::$m_DataAcess == null){
            self::$m_DataAcess = new dataAccess();
        }
        return self::$m_DataAcess;
    }

    public abstract function connectToDB();

    public abstract function closeDB();

    public abstract function fetchUsers();

    public abstract function fetchUserID($row);

    public abstract function fetchUserFirstName($row);

    public abstract function fetchUserLastName($row);

    public abstract function fetchUserName($row);

    public abstract function fetchUserPwd($row);

    public abstract function fetchUserSalt($row);

    public abstract function fetchUserCreatedDate($row);

    public abstract function selectUsers($start, $count);

    public abstract function searchUsers($search);

    public abstract function addUser($firstName, $lastName, $loginName, $pwd, $salt, $createdDate);

    public abstract function updateUser($firstName, $lastName, $loginName, $pwd, $modifyDate);

    public abstract function addTemplate($name, $desc, $activestate, $css, $creationDate, $createdBy, $modifiedBy, $modifiedDate);

    public abstract function fetchTemplateID($row);

    public abstract function fetchTemplateName($row);

    public abstract function fetchTemplateDesc($row);

    public abstract function fetchTemplateState($row);

    public abstract function fetchTemplateCSS($row);

    public abstract function fetchTemplateCreatedDate($row);

    public abstract function fetchTemplateCreatedBy($row);

    public abstract function fetchTemplateModifiedBy($row);

    public abstract function fetchTemplateModifiedDate($row);

    public abstract function selectTemplate($start, $count);

    public abstract function searchTemplate($search);

    public abstract function deleteTemplate($id);

    public abstract function fetchTemplate();

    public abstract function updateTemplate($id, $name, $desc, $state, $css, $modifyDate);

    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    public abstract function searchAdminPrivilege($user);

    public abstract function addAdminPrivilege($admin);

    public abstract function adminPrivilegeExists($adminId);

    public abstract function addEditorPrivilege($admin);

    public abstract function editorPrivilegeExists($adminId);

    public abstract function addAuthorPrivilege($admin);

    public abstract function authorPrivilegeExists($adminId);

    public abstract function deleteAdminPrivilege($adminId);

    public abstract function deleteEditorPrivilege($adminId);

    public abstract function deleteAuthorPrivilege($adminId);

    public abstract function updateModifiedPrivilege($currentTime ,$loggedInId, $adminId);

    public abstract function addWebPage($addRow, $name, $desc, $alias, $time, $loggedInId);

    public abstract function searchWebPage();

    public abstract function searchNameWebPagePrivilege($search);
}