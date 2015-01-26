<?php

require_once __DIR__.'/../Data/dbcon.php';

class User {

    private $id;
    private $firstName;
    private $lastName;
    private $userName;
    private $pwd;
    private $salt;
    private $createdDate;
    private $modifiedDate;
    private $createdBy;
    private $modifiedBy;

    public function __construct($firstName, $lastName, $userName, $pwd, $salt, $createdDate, $modifiedDate,$createdBy, $modifiedBy){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->pwd = $pwd;
        $this->salt = $salt;
        $this->createdDate = $createdDate;
        $this->modifiedDate = $modifiedDate;
        $this->createdBy = $createdBy;
        $this->modifiedBy = $modifiedBy;
    }

    public function getID(){
        return $this->id;
    }

    public function setID($in_id){
        $this->id = $in_id;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function setFirstName($in_firstName){
        $this->firstName = $in_firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function setLastName($in_lastName){
        $this->lastName = $in_lastName;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function getPwd(){
        return $this->pwd;
    }

    public function getSalt(){
        return $this->salt;
    }

    public static function retrieveUser($search){
        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();

        $myDataAccess->searchUsers($search);
        $row=$myDataAccess->fetchUsers();

        $currentUser = new self($myDataAccess->fetchUserFirstName($row), $myDataAccess->fetchUserLastName($row),$myDataAccess->fetchUserName($row),$myDataAccess->fetchUserPwd($row),
            $myDataAccess->fetchUserSalt($row),$myDataAccess->fetchUserCreatedDate($row),$myDataAccess->fetchUserModifiedDate($row),$myDataAccess->fetchUserCreatedBy($row),$myDataAccess->fetchUserModifiedBy($row));
        $currentUser->setID($myDataAccess->fetchUserID($row));
        $myDataAccess->closeDB();
        return $currentUser;


    }

    public static function retrieveSome($start,$count, $search)
    {
        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();
        if(empty($search)){
            $myDataAccess->selectUsers($start,$count);
        }
        else{
            $myDataAccess->searchUsers($search);
        }

        while($row = $myDataAccess->fetchUsers())
        {
            $currentUser = new self($myDataAccess->fetchUserFirstName($row),
                $myDataAccess->fetchUserLastName($row),  $myDataAccess->fetchUserName($row),
                $myDataAccess->fetchUserPwd($row),  $myDataAccess->fetchUserSalt($row), $myDataAccess->fetchUserCreatedDate($row),
                $myDataAccess->fetchUserModifiedDate($row), $myDataAccess->fetchUserCreatedBy($row), $myDataAccess->fetchUserModifiedBy($row));
            $currentUser->id = $myDataAccess->fetchUserID($row);
            $arrayOfUserObjects[] = $currentUser;
        }

        $myDataAccess->closeDB();

        return $arrayOfUserObjects;
    }

    public function addUser()
    {
        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->addUser($this->firstName,$this->lastName, $this->userName, $this->pwd, $this->salt, $this->createdDate, $this->modifiedDate, $this->createdBy, $this->modifiedBy);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";

    }

    public static function update($firstName, $lastName, $userName, $pwd, $salt,$modifyDate, $modifiedBy){

        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->updateUser($firstName, $lastName, $userName, $pwd, $salt, $modifyDate, $modifiedBy);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";
    }

    public function delete($id){

        $myDataAccess =new DataAccess();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->deleteActor($id);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";
    }

    public static function getUserPrivileges($id){
        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();

        $myDataAccess->getPrivileges($id);

        while($row = $myDataAccess->fetchUsers()){
            $p = $myDataAccess->fetchPrivileges($row);
            $pResult[]= $p;
        }

        return $pResult;
    }
} 