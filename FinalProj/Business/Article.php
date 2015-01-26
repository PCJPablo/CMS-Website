<?php

    require_once __DIR__.'/../Data/dbcon.php';


class Article{
    private $idarticles;
    private $aname;
    private $atitle;
    private $adesc;
    private $html;
    private $page;
    private $modifiedby;
    private $createdby;
    private $contentarea;
    private $allpages;


    function __construct($aname, $atitle,$adesc,$html,$page,$modifiedby,$createdby,$contentarea,$allpages)
    {
        $this->adesc = $adesc;
        $this->allpages = $allpages;
        $this->aname = $aname;
        $this->atitle = $atitle;
        $this->contentarea = $contentarea;
        $this->createdby = $createdby;
        $this->html = $html;
        $this->modifiedby = $modifiedby;
        $this->page = $page;
    }

    /**
     * @param mixed $adesc
     */
    public function setAdesc($adesc)
    {
        $this->adesc = $adesc;
    }

    /**
     * @return mixed
     */
    public function getAdesc()
    {
        return $this->adesc;
    }

    /**
     * @param mixed $allpages
     */
    public function setAllpages($allpages)
    {
        $this->allpages = $allpages;
    }

    /**
     * @return mixed
     */
    public function getAllpages()
    {
        return $this->allpages;
    }

    /**
     * @param mixed $aname
     */
    public function setAname($aname)
    {
        $this->aname = $aname;
    }

    /**
     * @return mixed
     */
    public function getAname()
    {
        return $this->aname;
    }

    /**
     * @param mixed $atitle
     */
    public function setAtitle($atitle)
    {
        $this->atitle = $atitle;
    }

    /**
     * @return mixed
     */
    public function getAtitle()
    {
        return $this->atitle;
    }

    /**
     * @param mixed $contentarea
     */
    public function setContentarea($contentarea)
    {
        $this->contentarea = $contentarea;
    }

    /**
     * @return mixed
     */
    public function getContentarea()
    {
        return $this->contentarea;
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
     * @param mixed $createddate
     */
    public function setCreateddate($createddate)
    {
        $this->createddate = $createddate;
    }

    /**
     * @return mixed
     */
    public function getCreateddate()
    {
        return $this->createddate;
    }

    /**
     * @param mixed $html
     */
    public function setHtml($html)
    {
        $this->html = $html;
    }

    /**
     * @return mixed
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param mixed $idarticles
     */
    public function setIdarticles($idarticles)
    {
        $this->idarticles = $idarticles;
    }

    /**
     * @return mixed
     */
    public function getIdarticles()
    {
        return $this->idarticles;
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

    /**
     * @param mixed $modifieddate
     */
    public function setModifieddate($modifieddate)
    {
        $this->modifieddate = $modifieddate;
    }

    /**
     * @return mixed
     */
    public function getModifieddate()
    {
        return $this->modifieddate;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }




    public function save(){

        $dataAccess = new DataAccess;
        $dataAccess->connectToDB();

        $recordsAffected = $dataAccess->insertArticle($this->aname, $this->atitle,$this->adesc,$this->html,
            $this->page,$this->createdby, $this->contentarea,$this->allpages);
        $dataAccess->closeDB();

        return "$recordsAffected row(s) affected";

    }





    public static function getArticle($id){
        $dataAccess = new DataAccess;
        $dataAccess->connectToDB();

        $dataAccess->selectArticle($id);
        $row=$dataAccess->fetchArticle();
        $currentArticle = new self($dataAccess->fetchArticleName($row),$dataAccess->fetchArticleTitle($row),$dataAccess->fetchArticleDesc($row),
            $dataAccess->fetchArticlehtml($row),$dataAccess->fetchArticlePage($row),1,
            1, $dataAccess->fetchArticleContentArea($row),$dataAccess->fetchArticleAllPages($row));
        $currentArticle->setIdarticles($dataAccess->fetchArticleID($row));
        return $currentArticle;


    }

    public static function update($idarticles, $aname, $atitle, $adesc,$html,$page,$modifiedby,$contentarea,$allpages){

        $dataAccess = new DataAccess;
        $dataAccess->connectToDB();

        $recordsAffected = $dataAccess->updateArticle($idarticles,$aname, $atitle,$adesc,$html,
            $page,$modifiedby,$contentarea,$allpages);
        $dataAccess->closeDB();

        return "$recordsAffected row(s) affected";


    }

    public static function getArticleFromContent($contentRow, $page){

        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();
        $myDataAccess->selectArticleFromContent($contentRow, $page);
        while($row = $myDataAccess->fetchArticle())
        {
            $currentArticle = new self($myDataAccess->fetchArticleName($row),
                $myDataAccess->fetchArticleTitle($row),  $myDataAccess->fetchArticleDesc($row),
                $myDataAccess->fetchArticlehtml($row),  $myDataAccess->fetchArticlePage($row), 1,
                1, $myDataAccess->fetchArticleContentArea($row), $myDataAccess->fetchArticleAllPages($row));
            $currentArticle->setIdarticles($myDataAccess->fetchArticleID($row));
            $arrayOfArticleObjects[] = $currentArticle;
        }

        $myDataAccess->closeDB();
        if(isset($arrayOfArticleObjects)){
            return $arrayOfArticleObjects;
        }
        else
            return null;
    }

    public static function removeArticle($id){
        $mydataAccess = new DataAccess();
        $mydataAccess->connectToDB();
        $recordsaffected=$mydataAccess->removeArticleFromPage($id);

        return "$recordsaffected row(s) affected";

    }

    public static function getChartData(){

        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();
        $myDataAccess->fetchDistinctCreatedOn();
        $row = $myDataAccess->fetchArticle();

        while($row = $myDataAccess->fetchArticle())
        {
//            $currentArticle = new self($myDataAccess->fetchArticleName($row),
//                $myDataAccess->fetchArticleTitle($row),  $myDataAccess->fetchArticleDesc($row),
//                $myDataAccess->fetchArticlehtml($row),  $myDataAccess->fetchArticlePage($row), 1,
//                1, $myDataAccess->fetchArticleContentArea($row), $myDataAccess->fetchArticleAllPages($row));
//            $currentArticle->setIdarticles($myDataAccess->fetchArticleID($row));
            $arrayOfArticleCreatedDates[] = $myDataAccess->fetchArticleCreatedDate($row);
        }

        return $arrayOfArticleCreatedDates;
    }

    public static function fetchCreatedOnCount($arrayOfArticleCreatedDates){

        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();

        for($x = 0; $x < count($arrayOfArticleCreatedDates); $x++){
            $myDataAccess->countCreatedDates($arrayOfArticleCreatedDates[$x]);
            $row = $myDataAccess->fetchArticle();
            $createdDatesCount[] = $row['COUNT(createddate)'];
        }

        return $createdDatesCount;
    }
}


?>