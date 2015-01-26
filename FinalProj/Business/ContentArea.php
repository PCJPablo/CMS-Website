<?php
/**
 * Created by PhpStorm.
 * User: inet2005
 * Date: 11/27/14
 * Time: 2:35 PM
 */
require_once __DIR__.'/../Data/dbcon.php';

class ContentArea{
    private $idcontenarea;
    private $cname;
    private $alias;
    private $corder;
    private $cdesc;
    private $createdby;
    private $modifiedby;

    /**
     * @param mixed $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param mixed $cdesc
     */
    public function setCdesc($cdesc)
    {
        $this->cdesc = $cdesc;
    }

    /**
     * @return mixed
     */
    public function getCdesc()
    {
        return $this->cdesc;
    }

    /**
     * @param mixed $cname
     */
    public function setCname($cname)
    {
        $this->cname = $cname;
    }

    /**
     * @return mixed
     */
    public function getCname()
    {
        return $this->cname;
    }

    /**
     * @param mixed $corder
     */
    public function setCorder($corder)
    {
        $this->corder = $corder;
    }

    /**
     * @return mixed
     */
    public function getCorder()
    {
        return $this->corder;
    }

    /**
     * @param mixed $createdby
     */
    public function setCreatedby($createdby)
    {
        $this->createdby = $createdby;
    }

    /**
     * @return mixed
     */
    public function getCreatedby()
    {
        return $this->createdby;
    }

    /**
     * @param mixed $idcontentarea
     */
    public function setIdcontenarea($idcontenarea)
    {
        $this->idcontenarea = $idcontenarea;
    }

    /**
     * @return mixed
     */
    public function getIdcontenarea()
    {
        return $this->idcontentarea;
    }

    /**
     * @param mixed $modifiedby
     */
    public function setModifiedby($modifiedby)
    {
        $this->modifiedby = $modifiedby;
    }

    /**
     * @return mixed
     */
    public function getModifiedby()
    {
        return $this->modifiedby;
    }

    function __construct($alias, $cdesc, $cname, $corder, $createdby, $idcontentarea, $modifiedby)
    {
        $this->alias = $alias;
        $this->cdesc = $cdesc;
        $this->cname = $cname;
        $this->corder = $corder;
        $this->createdby = $createdby;
        $this->idcontentarea = $idcontentarea;
        $this->modifiedby = $modifiedby;
    }



    public function save(){

        $dataAccess = new DataAccess;
        $dataAccess->connectToDB();

        $recordsAffected = $dataAccess->insertContent($this->cname, $this->alias,$this->corder,$this->cdesc,
            $this->createdby,$this->createdby);
        $dataAccess->closeDB();

        return "$recordsAffected row(s) affected";

    }

    public static function update($idcontenarea, $cname, $alias, $corder,$cdesc,$modifiedby){

        $dataAccess = new DataAccess;
        $dataAccess->connectToDB();

        $recordsAffected = $dataAccess->updateContent($idcontenarea,$cname, $alias,$cdesc,$corder, $modifiedby);
        $dataAccess->closeDB();

        return "$recordsAffected row(s) affected";


    }



    public static function getContent($id){
        $dataAccess = new DataAccess;
        $dataAccess->connectToDB();

        $dataAccess->selectContent($id);
        $row=$dataAccess->fetchContent();
        $currentContent = new self($dataAccess->fetchContentAlias($row),$dataAccess->fetchContentDesc($row),$dataAccess->fetchContentName($row),$dataAccess->fetchContentOrder($row),
            $dataAccess->fetchContentCreatedBy($row),$dataAccess->fetchContentID($row),$dataAccess->fetchContentModifiedBy($row));

        return $currentContent;
    }

    public static function getAllContent(){

        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();
        $myDataAccess->selectAllContent();
        while($row = $myDataAccess->fetchContent())
        {
            $currentContent = new self($myDataAccess->fetchContentAlias($row),
                $myDataAccess->fetchContentDesc($row),  $myDataAccess->fetchContentName($row),
                $myDataAccess->fetchContentOrder($row),  $myDataAccess->fetchContentCreatedBy($row), $myDataAccess->fetchContentID($row),
                $myDataAccess->fetchContentModifiedBy($row));
            $currentContent->id = $myDataAccess->fetchContentID($row);
            $arrayOfContentObjects[] = $currentContent;
        }

        $myDataAccess->closeDB();

        return $arrayOfContentObjects;
    }

    public static function delete($idcontenarea){
        $dataAccess = new DataAccess;
        $dataAccess->connectToDB();

        $recordsAffected = $dataAccess->deleteContent($idcontenarea);
        $dataAccess->closeDB();

        return "$recordsAffected row(s) affected";
    }


}
?>