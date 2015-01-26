<?php
/**
 * Created by PhpStorm.
 * User: inet2005
 * Date: 12/2/14
 * Time: 2:05 PM
 */
require_once __DIR__.'/../Data/dbcon.php';

Class WebPage{

    private $id;
    private $name;
    private $desc;
    private $alias;
    private $creationdate;
    private $modifieddate;
    private $createdby;
    private $modifiedby;

    function __construct($alias, $createdby, $modifiedby, $desc, $name)
    {
        $this->alias = $alias;
        $this->createdby = $createdby;
        $this->modifiedby = $modifiedby;
        $this->desc = $desc;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @return mixed
     */
    public function getCreatedby()
    {
        return $this->createdby;
    }

    /**
     * @return mixed
     */
    public function getCreationdate()
    {
        return $this->creationdate;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getModifiedby()
    {
        return $this->modifiedby;
    }

    /**
     * @return mixed
     */
    public function getModifieddate()
    {
        return $this->modifieddate;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    public static function deleteWebPage($wid)
{

    $myDataAccess = new DataAccess();
    $myDataAccess->connectToDB();
    $myDataAccess->deleteWebPage($wid);
    $myDataAccess->closeDB();
    return "Web Page successfully deleted.";
}


public function addWebPage()
{

    $myDataAccess = new dataAccess();
    $myDataAccess->connectToDB();
    $time = gmdate('Y-m-d');

    //need to determine the proper id...
//    $myDataAccess->searchWebPage();
//
//    $addRow = 0;
//    while($webPageResults = $myDataAccess->fetchWebPageExists())
//    {
//        //Inserts the user editor privilege of the person's id.
//        $addRow++;
//    }
//    $addRow++;
//    //********************* this needs to equal the id of the user logged in... ************************
//    $loggedInId = 1;

    $myDataAccess->addWebPage( $this->name, $this->desc, $this->alias, $time, $_SESSION['id']);

    $myDataAccess->closeDB();

    return "Webpage has been successfuly added.";
}

    public static function updateWebPage($id, $name,$desc,$alias,$modifiedby)
    {

        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();
        $currentTime = gmdate('Y-m-d');
        $myDataAccess->updateWebPage($id,$name,$desc,$alias,$currentTime,$modifiedby);
        $myDataAccess->closeDB();
        return "Web Page successfully updated.";
    }

    public static function getWebPage($id){

        $dataAccess = new DataAccess();
        $dataAccess->connectToDB();

        $dataAccess->searchWebPage($id);
        $row=$dataAccess->fetchWebPage();
        $currentWebPage = new self($dataAccess->fetchWebPageAlias($row),$dataAccess->fetchWebPageCreatedBy($row),$dataAccess->fetchWebPageModifiedBy($row),$dataAccess->fetchWebPageDesc($row),
            $dataAccess->fetchWebPageName($row));
        $dataAccess->closeDB();

        return $currentWebPage;


    }

    public static function getAllWebPages(){
        $myDataAccess=new DataAccess();
        $myDataAccess->connectToDB();
        $myDataAccess->getAllWebPages();

        while($row = $myDataAccess->fetchWebPage()){
            $currentWebpage = new self($myDataAccess->fetchWebPageAlias($row), $myDataAccess->fetchWebPageCreatedBy($row),
            $myDataAccess->fetchWebPageModifiedBy($row), $myDataAccess->fetchWebPageDesc($row),$myDataAccess->fetchWebPageName($row));
            $currentWebpage->id = $myDataAccess->fetchWebPageId($row);
            $arrayWebpages[] = $currentWebpage;

        }
        $myDataAccess->closeDB();
        return $arrayWebpages;
    }

    public static function getAllWebPageIDs(){
        $dataAccess=new DataAccess();
        $dataAccess->connectToDB();
        $dataAccess->selectAllWebPageIDS();

        while($row = $dataAccess->fetchWebPage()){
            $webPageIds[]= $dataAccess->fetchWebPageId($row);

        }
        $dataAccess->closeDB();
        if(isset($webPageIds)){
            return $webPageIds;
        }

    }

    public static function getNextWebPage(){
        $dataAccess = new DataAccess();
        $dataAccess->connectToDB();

        $dataAccess->fetchNextWebPage();
        $row=$dataAccess->fetchWebPage();
        $currentWebPage = new self($dataAccess->fetchWebPageAlias($row),$dataAccess->fetchWebPageCreatedBy($row),$dataAccess->fetchWebPageModifiedBy($row),$dataAccess->fetchWebPageDesc($row),$dataAccess->fetchWebPageId($row),
            $dataAccess->fetchWebPageName($row));
        $dataAccess->closeDB();

        return $currentWebPage;

    }
//    public function searchNameWebPage($search, $searchSelect)
//    {
//        require("../kirbyData/pdo.php");
//        $myDataAccess = new database();
//        $myDataAccess->connectToDB();
//        $myDataAccess->searchNameWebPagePrivilege($search);
//        $statusNameWebPage = $myDataAccess->fetchSearchWebPageNamePrivilege($searchSelect);
//        $myDataAccess->closeDB();
//        return $statusNameWebPage;
//    }
//
//    public function searchIdWebPage($search, $searchSelect)
//    {
//        $myDataAccess = new database();
//        $myDataAccess->connectToDB();
//        $myDataAccess->searchNameWebPagePrivilege($search);
//        $statusIdWebPage = $myDataAccess->fetchSearchWebPageNamePrivilege($searchSelect);
//        return $statusIdWebPage;
//        $myDataAccess->closeDB();
//    }
//
//    public function searchDescWebPage($search, $searchSelect)
//    {
//        $myDataAccess = new database();
//        $myDataAccess->connectToDB();
//        $myDataAccess->searchNameWebPagePrivilege($search);
//        $statusIdWebPage = $myDataAccess->fetchSearchWebPageNamePrivilege($searchSelect);
//        return $statusIdWebPage;
//        $myDataAccess->closeDB();
//    }
//
//    public function searchAliasWebPage($search, $searchSelect)
//    {
//        $myDataAccess = new database();
//        $myDataAccess->connectToDB();
//        $myDataAccess->searchNameWebPagePrivilege($search);
//        $statusIdWebPage = $myDataAccess->fetchSearchWebPageNamePrivilege($searchSelect);
//        return $statusIdWebPage;
//        $myDataAccess->closeDB();
//    }
//
//    public function searchCreationDateWebPage($search, $searchSelect)
//    {
//        $myDataAccess = new database();
//        $myDataAccess->connectToDB();
//        $myDataAccess->searchNameWebPagePrivilege($search);
//        $statusIdWebPage = $myDataAccess->fetchSearchWebPageNamePrivilege($searchSelect);
//        return $statusIdWebPage;
//        $myDataAccess->closeDB();
//    }
//
//    public function searchModifiedDateWebPage($search, $searchSelect)
//    {
//        $myDataAccess = new database();
//        $myDataAccess->connectToDB();
//        $myDataAccess->searchNameWebPagePrivilege($search);
//        $statusIdWebPage = $myDataAccess->fetchSearchWebPageNamePrivilege($searchSelect);
//        return $statusIdWebPage;
//        $myDataAccess->closeDB();
//    }
//
//    public function searchCreatedByWebPage($search, $searchSelect)
//    {
//        $myDataAccess = new database();
//        $myDataAccess->connectToDB();
//        $myDataAccess->searchNameWebPagePrivilege($search);
//        $statusIdWebPage = $myDataAccess->fetchSearchWebPageNamePrivilege($searchSelect);
//        return $statusIdWebPage;
//        $myDataAccess->closeDB();
//    }
//
//    public function searchModifiedByWebPage($search, $searchSelect)
//    {
//        $myDataAccess = new database();
//        $myDataAccess->connectToDB();
//        $myDataAccess->searchNameWebPagePrivilege($search);
//        $statusIdWebPage = $myDataAccess->fetchSearchWebPageNamePrivilege($searchSelect);
//        return $statusIdWebPage;
//        $myDataAccess->closeDB();
//    }
}
?>