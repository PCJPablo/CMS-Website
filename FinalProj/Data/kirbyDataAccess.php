<?php
require_once '../kirbyData/pdo.php';
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