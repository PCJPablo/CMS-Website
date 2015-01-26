<?php
if(!isset($_SESSION)){
    session_start();
}

class DataAccess
{
    private $dbConnection;
    private $result;
    private $stmt;

    // aDataAccess methods
    public function connectToDB()
    {

        try
        {
            if((isset($_SESSION['author']) && ($_SESSION['author']==true)) ||(isset($_SESSION['admin']) && ($_SESSION['admin']==true)) ||(isset($_SESSION['editor']) && ($_SESSION['editor']==true))){
            if($_SESSION['author']){
                $this->dbConnection = new PDO("mysql:host=localhost;dbname=mydb","frontEnd", "paulgoth");
            }
            if($_SESSION['admin'] || $_SESSION['editor']){
                $this->dbConnection = new PDO("mysql:host=localhost;dbname=mydb","backEnd", "paulgoth");
            }
            }
            else{
                $this->dbConnection = new PDO("mysql:host=localhost;dbname=mydb","login", "paulgoth");
            }


            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $ex)
        {
            die('Could not connect to the SQLite Database via PDO: ' . $ex->getMessage());
        }
    }

    public function closeDB()
    {
        // set a PDO connection object to null to close it
        $this->dbConnection = null;
    }

    public function selectArticle($id){
        $this->stmt = $this->dbConnection->prepare("SELECT * FROM articles WHERE idarticles = :id;");
        $this->stmt->bindParam(':id',$id,PDO::PARAM_INT);

        $this->stmt->execute();

    }

    public function selectAllArticle($id){
        $this->stmt = $this->dbConnection->prepare("SELECT * FROM articles;");

        $this->stmt->execute();

    }

    public function fetchArticle(){
        $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $this->result;
    }

    public function fetchArticleID($row){
        return $row['idarticles'];
    }

    public function fetchArticleName($row){
        return $row['aname'];
    }

    public function fetchArticleTitle($row){
        return $row['atitle'];
    }


    public function fetchArticleDesc($row){
        return $row['adesc'];
    }


    public function fetchArticlehtml($row){
        return $row['html'];
    }


    public function fetchArticlePage($row){
        return $row['page'];
    }

    public function fetchArticleContentArea($row){
        return $row['contentarea'];
    }

    public function fetchArticleAllPages($row){
        return $row['allpages'];
    }

    public function fetchArticleCreatedDate($row){
        return $row['createddate'];
    }

    public function removeArticleFromPage($id){
        $this->stmt = $this->dbConnection->prepare("UPDATE articles SET page=null, allpages=0 WHERE idarticles =:id");
        $this->stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $this->stmt->execute();

        return $this->stmt->rowCount();
    }

    public function selectArticleFromContent($row, $page){

        $this->stmt = $this->dbConnection->prepare("SELECT * FROM articles a INNER JOIN  content co ON a.contentarea=co.idcontenarea WHERE a.contentarea= :row AND a.page= :page ORDER BY a.modifieddate;");
        $this->stmt->bindParam(':row', $row, PDO::PARAM_INT);
        $this->stmt->bindParam(':page', $page, PDO::PARAM_INT);
        $this->stmt->execute();

    }

    public function insertArticle($name, $title, $desc, $html, $page, $id, $area, $allpages){
        $date = date('Y-m-d');

        $this->stmt = $this->dbConnection->prepare("INSERT INTO articles (aname, atitle, adesc, html, createddate, modifieddate, page,createdby,modifiedby,contentarea,allpages)
         VALUES (:aname,:atitle,:adesc,:html,:adate,:adate,:page,:userid,:userid,:contentarea,:allpages)");
        $this->stmt->bindParam(':aname', $name, PDO::PARAM_STR);
        $this->stmt->bindParam(':atitle', $title, PDO::PARAM_STR);
        $this->stmt->bindParam(':adesc', $desc, PDO::PARAM_STR);
        $this->stmt->bindParam(':html', $html, PDO::PARAM_STR);
        $this->stmt->bindParam(':page', $page, PDO::PARAM_INT);
        $this->stmt->bindParam(':userid', $id, PDO::PARAM_INT);
        $this->stmt->bindParam(':contentarea', $area, PDO::PARAM_INT);
        $this->stmt->bindParam(':allpages', $allpages, PDO::PARAM_INT);
        $this->stmt->bindParam(':adate',$date, PDO::PARAM_STR);

        $this->stmt->execute();

        return $this->stmt->rowCount();

    }

    public function updateArticle($id, $name, $title, $desc, $html, $page, $userid, $area, $allpages){
        $date = date('Y-m-d');
        $this->stmt = $this->dbConnection->prepare("UPDATE articles SET aname=:aname, atitle=:atitle, adesc=:adesc, html=:html,
                                                    modifieddate=:adate, page=:page,modifiedby=:userid,contentarea=:contentarea,allpages=:allpages
         WHERE idarticles = :idarticles");
        $this->stmt->bindParam(':aname', $name, PDO::PARAM_STR);
        $this->stmt->bindParam(':atitle', $title, PDO::PARAM_STR);
        $this->stmt->bindParam(':adesc', $desc, PDO::PARAM_STR);
        $this->stmt->bindParam(':html', $html, PDO::PARAM_STR);
        $this->stmt->bindParam(':page', $page, PDO::PARAM_INT);
        $this->stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $this->stmt->bindParam(':contentarea', $area, PDO::PARAM_INT);
        $this->stmt->bindParam(':allpages', $allpages, PDO::PARAM_INT);
        $this->stmt->bindParam(':adate',$date, PDO::PARAM_STR);
        $this->stmt->bindParam(':idarticles',$id, PDO::PARAM_STR);

        $this->stmt->execute();

        return $this->stmt->rowCount();

    }




    public function insertContent($name,$alias,$desc,$order,$id){
        $date = date('Y-m-d');
        $this->stmt = $this->dbConnection->prepare("INSERT INTO content (cname, alias, corder, cdesc, createddate, modifieddate, createdby,modifiedby)
         VALUES (:cname,:alias,:corder,:cdesc,:cdate,:cdate,:userid,:userid)");
        $this->stmt->bindParam(':cname', $name, PDO::PARAM_STR);
        $this->stmt->bindParam(':alias', $alias, PDO::PARAM_STR);
        $this->stmt->bindParam(':corder', $order, PDO::PARAM_INT);
        $this->stmt->bindParam(':cdesc', $desc, PDO::PARAM_STR);
        $this->stmt->bindParam(':userid', $id, PDO::PARAM_INT);
        $this->stmt->bindParam(':cdate',$date, PDO::PARAM_STR);

        $this->stmt->execute();

        return $this->stmt->rowCount();

    }

    public function updateContent($cid,$name,$alias,$desc,$order,$id){
        $date = date('Y-m-d');
        $this->stmt = $this->dbConnection->prepare("UPDATE content  set cname=:cname, alias=:alias, corder=:corder, cdesc=:cdesc, modifieddate=:cdate,modifiedby=:userid WHERE idcontenarea=:idcontent");
        $this->stmt->bindParam(':idcontent', $cid, PDO::PARAM_STR);
        $this->stmt->bindParam(':cname', $name, PDO::PARAM_STR);
        $this->stmt->bindParam(':alias', $alias, PDO::PARAM_STR);
        $this->stmt->bindParam(':corder', $order, PDO::PARAM_INT);
        $this->stmt->bindParam(':cdesc', $desc, PDO::PARAM_STR);
        $this->stmt->bindParam(':userid', $id, PDO::PARAM_INT);
        $this->stmt->bindParam(':cdate',$date, PDO::PARAM_STR);

        $this->stmt->execute();

        return $this->stmt->rowCount();

    }

    public function deleteContent($id){
        $this->stmt = $this->dbConnection->prepare("DELETE FROM content WHERE idcontenarea=:id; UPDATE articles set contentarea=0 WHERE contentarea=:id;");
        $this->stmt->bindParam(':id',$id,PDO::PARAM_INT);

       // $this->stmt->execute();

       // $this->stmt = $this->dbConnection->prepare("UPDATE articles set contentarea=0 WHERE contentarea=:id;");
       // $this->stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $this->stmt->execute();

        return $this->stmt->rowCount();

    }

    public function selectContent($id){
        $this->stmt = $this->dbConnection->prepare("SELECT * FROM content WHERE idcontenarea = :id;");
        $this->stmt->bindParam(':id',$id,PDO::PARAM_INT);

        $this->stmt->execute();

    }

    public function selectAllContent(){
        $this->stmt = $this->dbConnection->prepare("SELECT * FROM content ORDER BY corder ASC;");

        $this->stmt->execute();

    }

    public function fetchContent(){
        $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $this->result;
    }

    public function fetchContentID($row){
        return $row['idcontenarea'];
    }

    public function fetchContentName($row){
        return $row['cname'];
    }

    public function fetchContentAlias($row){
        return $row['alias'];
    }

    public function fetchContentDesc($row){
        return $row['cdesc'];
    }

    public function fetchContentOrder($row){
        return $row['corder'];
    }

    public function fetchContentCreatedBy($row){
        return $row['createdby'];
    }

    public function fetchContentModifiedBy($row){
        return $row['modifiedby'];

    }

//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    public function selectUsers($start, $count){

        try{
            $this->stmt = $this->dbConnection->prepare('SELECT * FROM user ORDER by iduser desc LIMIT :start, :count');
            $this->stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $this->stmt->bindParam(':count', $count, PDO::PARAM_INT);

            $this->stmt->execute();
        }
        catch(PDOException $ex){
            die('Could not select records from Database via PDO' . $ex->getMessage());
        }

    }

    public  function fetchUsers(){
        try{
            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            return $this->result;
        }
        catch(PDOException $ex){
            die('Could not retrieve from Database via PDO: ' . $ex->getMessage());
        }
    }

    public  function fetchUserID($row){
        return $row['iduser'];
    }

    public  function fetchUserFirstName($row){
        return $row['firstname'];
    }


    public  function fetchUserLastName($row){
        return $row['lastname'];
    }

    public function fetchUserName($row){
        return $row['loginname'];
    }

    public function fetchUserPwd($row){
        return $row['password'];
    }

    public function fetchUserSalt($row){
        return $row['salt'];
    }

    public function fetchUserCreatedDate($row){
        return $row['creationdate'];
    }

    public function fetchUserCreatedBy($row){
        return $row['createdby'];
    }

    public function fetchUserModifiedDate($row){
        return $row['modifieddate'];
    }

    public function fetchUserModifiedBy($row){
        return $row['modifiedby'];
    }

    public function addUser($firstName, $lastName, $loginName, $pwd, $salt, $createdDate, $modifiedDate,$createdBy, $modifiedBy){

        try{
            $this->stmt = $this->dbConnection->prepare('INSERT INTO user(firstname, lastname,loginname, password, salt, creationdate, modifieddate, createdby, modifiedby)
            VALUES (:firstName, :lastName, :loginName, :pwd, :salt, :createdDate, :modifiedDate, :createdBy, :modifiedBy)');
            $this->stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
            $this->stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
            $this->stmt->bindParam(':loginName', $loginName, PDO::PARAM_STR);
            $this->stmt->bindParam(':pwd', $pwd, PDO::PARAM_STR);
            $this->stmt->bindParam(':salt', $salt, PDO::PARAM_STR);
            $this->stmt->bindParam(':createdDate', $createdDate, PDO::PARAM_STR);
            $this->stmt->bindParam(':modifiedDate', $modifiedDate, PDO::PARAM_STR);
            $this->stmt->bindParam(':createdBy', $createdBy, PDO::PARAM_INT);
            $this->stmt->bindParam(':modifiedBy', $modifiedBy, PDO::PARAM_INT);

            $this->stmt->execute();
            return $this->stmt->rowCount();
        }
        catch(PDOException $ex){
            die('Could not insert record into the Database via PDO: ' . $ex->getMessage());
        }
    }

    public function searchUsers($search){
        try{
            $this->stmt = $this->dbConnection->prepare
                ("SELECT * FROM user WHERE loginname LIKE '%$search%' OR iduser = '$search';");
            $this->stmt->bindParam(':search', $search, PDO::PARAM_STR);
            $this->stmt->execute();

        }
        catch(PDOException $ex){
            die('Could not search' . $ex->getMessage());
        }
    }


    public function updateUser($firstName, $lastName, $loginName, $pwd, $salt, $modifyDate, $modifiedBy){
        try{
            $this->stmt = $this->dbConnection->prepare('UPDATE mydb.user SET firstname = :firstName, lastname = :lastName,
            loginname = :loginName, password = :pwd, salt = :salt, modifieddate = :modifyDate, modifiedby = :modifiedBy WHERE loginname = :loginName;');
            $this->stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
            $this->stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
            $this->stmt->bindParam(':loginName', $loginName, PDO::PARAM_STR);
            $this->stmt->bindParam(':pwd', $pwd, PDO::PARAM_STR);
            $this->stmt->bindParam(':salt', $salt, PDO::PARAM_INT);
            $this->stmt->bindParam(':modifyDate', $modifyDate, PDO::PARAM_STR);
            $this->stmt->bindParam(':modifiedBy', $modifiedBy, PDO::PARAM_INT);

            $this->stmt->execute();
            return $this->stmt->rowCount();
        }
        catch(PDOException $ex){
            die('Could not update record into the Database via PDO: ' . $ex->getMessage());
        }
    }

    public function selectRecentTemplate(){
        $this->stmt=$this->dbConnection->prepare('SELECT idcss from css order by idcss desc limit 0,1');
        $this->stmt->execute();
    }


    public function addTemplate($name, $desc, $activestate, $css,$creationDate, $createdBy, $modifiedBy, $modifiedDate){

        try{

            $this->stmt = $this->dbConnection->prepare('INSERT INTO css(css.name, css.desc, activestate, css, creationdate, createdby, modifiedby, modifiedDate )
            VALUES (:name, :desc,  :activestate,:css, :creationDate, :createdBy, :modifiedBy, :modifiedDate)');
            $this->stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $this->stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
            $this->stmt->bindParam(':activestate', $activestate, PDO::PARAM_INT);
            $this->stmt->bindParam(':css', $css, PDO::PARAM_STR);
            $this->stmt->bindParam(':creationDate', $creationDate, PDO::PARAM_STR);
            $this->stmt->bindParam(':createdBy', $createdBy, PDO::PARAM_INT);
            $this->stmt->bindParam(':modifiedBy', $modifiedBy, PDO::PARAM_INT);
            $this->stmt->bindParam(':modifiedDate', $modifiedDate, PDO::PARAM_STR);

            $this->stmt->execute();
            //$r=$this->fetchArticle();
            //if($activestate==1){
               //$id= fetchTemplateID($r);
               // $this->resetTemplate($modifiedDate,$modifiedBy);
           // }
            return $this->stmt->rowCount();
        }
        catch(PDOException $ex){
            die('Could not insert record into the Database via PDO: ' . $ex->getMessage());
        }
    }

    public  function fetchTemplateID($row){
        return $row['idcss'];
    }

    public  function fetchTemplateName($row){
        return $row['name'];
    }

    public  function fetchTemplateDesc($row){
        return $row['desc'];
    }

    public  function fetchTemplateState($row){
        return $row['activestate'];
    }

    public  function fetchTemplateCSS($row){
        return $row['css'];
    }

    public  function fetchTemplateCreatedDate($row){
        return $row['creationdate'];
    }

    public  function fetchTemplateCreatedBy($row){
        return $row['createdby'];
    }

    public  function fetchTemplateModifiedBy($row){
        return $row['modifiedby'];
    }

    public function fetchTemplateModifiedDate($row){
        return $row['modifieddate'];
    }

    public function selectTemplate($start, $count){

        try{
            $this->stmt = $this->dbConnection->prepare('SELECT * FROM css ORDER by idcss desc LIMIT :start, :count');
            $this->stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $this->stmt->bindParam(':count', $count, PDO::PARAM_INT);

            $this->stmt->execute();
        }
        catch(PDOException $ex){
            die('Could not select records from Database via PDO' . $ex->getMessage());
        }

    }

    public function searchTemplate($search){
        try{
            $this->stmt = $this->dbConnection->prepare
                ("SELECT * FROM css WHERE idcss LIKE '%$search%';");
            $this->stmt->bindParam(':search', $search, PDO::PARAM_STR);
            $this->stmt->execute();

        }
        catch(PDOException $ex){
            die('Could not search' . $ex->getMessage());
        }
    }

    public  function deleteTemplate($id){
        try{
            $this->stmt = $this->dbConnection->prepare('DELETE FROM css WHERE idcss = :id');
            $this->stmt->bindParam(':id', $id, PDO::PARAM_STR);

            $this->stmt->execute();
            return $this->stmt->rowCount();
        }
        catch(PDOException $ex){
            die('Could not delete record into Database via PDO: ' . $ex->getMessage());
        }

    }

    public  function fetchTemplate(){
        try{
            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            return $this->result;
        }
        catch(PDOException $ex){
            die('Could not retrieve from Database via PDO: ' . $ex->getMessage());
        }
    }

    public function updateTemplate($id, $name, $desc, $state, $css, $modifyDate, $modifiedBy){

        try{

            $this->stmt = $this->dbConnection->prepare('UPDATE css SET css.name = :name, css.desc = :desc,
            activestate = :state, css = :css, modifieddate = :modifyDate, modifiedby = :modifiedBy WHERE idcss = :id;');
            $this->stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $this->stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $this->stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
            $this->stmt->bindParam(':state', $state, PDO::PARAM_INT);
            $this->stmt->bindParam(':css', $css, PDO::PARAM_STR);
            $this->stmt->bindParam(':modifyDate', $modifyDate, PDO::PARAM_STR);
            $this->stmt->bindParam(':modifiedBy', $modifiedBy, PDO::PARAM_STR);

            $this->stmt->execute();
            return $this->stmt->rowCount();
        }
        catch(PDOException $ex){
            die('Could not insert record into the Database via PDO: ' . $ex->getMessage());
        }
    }

    public function resetTemplate($modifyDate, $modifyBy,$id){




        $this->stmt = $this->dbConnection->prepare('UPDATE css SET
            activestate = 0, modifieddate = :modifyDate, modifiedby = :modifiedBy WHERE idcss != :id;');
        $this->stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $this->stmt->bindParam(':modifyDate', $modifyDate, PDO::PARAM_STR);
        $this->stmt->bindParam(':modifiedBy', $modifyBy, PDO::PARAM_STR);
        $this->stmt->execute();
    }

    public function getActiveCSS(){
        try{
            $this->stmt = $this->dbConnection->prepare
                ("SELECT * FROM css WHERE activestate = 1;");

            $this->stmt->execute();
            return $this->stmt->rowCount();

        }
        catch(PDOException $ex){
            die('Could not search' . $ex->getMessage());
        }
    }

    ///!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

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

    public function getAllWebPages(){

        try
        {
            $this->stmt = $this->dbConnection->prepare("SELECT * FROM webpage");

            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error retrieving webpage: ' . $ex->getMessage());
        }
    }

    public function fetchNextWebPage(){

        try
        {
            $this->stmt = $this->dbConnection->prepare("SELECT * FROM webpage ORDER BY idwebpage DESC LIMIT 0,1");

            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Error retrieving webpage: ' . $ex->getMessage());
        }
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

    public function selectAllWebPageIDS(){
        $this->stmt=$this->dbConnection->prepare("SELECT idwebpage FROM webpage");
        $this->stmt->execute();


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

    public function getPrivileges($id){
        try{
            $this->stmt =$this->dbConnection->prepare('SELECT * from userprivilege WHERE User_idUser=:id');
            $this->stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $this->stmt->execute();
        }
        catch(PDOException $ex){
            die('Could not insert record into the Database via PDO: ' . $ex->getMessage());
        }

    }

    public function fetchPrivileges($row){

        return $row['Privilege_idPrivilege'];

    }

    public function fetchDistinctCreatedOn(){
        $this->stmt = $this->dbConnection->prepare('SELECT DISTINCT createddate FROM articles ');
        $this->result = $this->stmt->execute();
        return $this->result;
    }

    public function countCreatedDates($createdDate){
        $this->stmt = $this->dbConnection->prepare('SELECT COUNT(createddate) FROM articles WHERE createddate =:createdDate ');
        $this->stmt->bindParam(':createdDate', $createdDate, PDO::PARAM_STR);
        $this->result = $this->stmt->execute();
        return $this->result;
    }
    }//end of Data Access
?>