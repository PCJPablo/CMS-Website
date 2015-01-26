<?php

require_once __DIR__.'/../Data/dbcon.php';

class Template {

    private $name;
    private $desc;
    private $state;
    private $css;
    private $createdDate;
    private $createdBy;
    private $modifiedBy;
    private $modifiedDate;

    public function  __construct($name, $desc, $state, $css, $createdDate, $createdBy, $modifiedBy, $modifiedDate){
        $this->name = $name;
        $this->desc = $desc;
        $this->state = $state;
        $this->css = $css;
        $this->createdDate = $createdDate;
        $this->createdBy = $createdBy;
        $this->modifiedBy = $modifiedBy;
        $this->modifiedDate = $modifiedDate;
    }

    public function addTemplate()
    {
        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->addTemplate($this->name, $this->desc, $this->state, $this->css, $this->createdDate, $this->createdBy, $this->modifiedBy, $this->modifiedDate);
        $myDataAccess->selectRecentTemplate();
        $r=$myDataAccess->fetchArticle();

        $id= $myDataAccess->fetchTemplateID($r);
        $myDataAccess->resetTemplate($this->modifiedDate,$this->modifiedBy,$id);
        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";

    }

    public static function retrieveSome($start,$count, $search)
    {
        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();
        if(empty($search)){
            $myDataAccess->selectTemplate($start,$count);
        }
        else{
            $myDataAccess->searchTemplate($search);
        }

        while($row = $myDataAccess->fetchTemplate())
        {
            $currentTemplate = new self($myDataAccess->fetchTemplateName($row),
                $myDataAccess->fetchTemplateDesc($row),  $myDataAccess->fetchTemplateState($row),
                $myDataAccess->fetchTemplateCSS($row),  $myDataAccess->fetchTemplateCreatedDate($row),
                $myDataAccess->fetchTemplateCreatedBy($row), $myDataAccess->fetchTemplateModifiedBy($row),
                $myDataAccess->fetchTemplateModifiedDate($row));
            $currentTemplate->id = $myDataAccess->fetchTemplateID($row);
            $arrayOfTemplateObjects[] = $currentTemplate;
        }

        $myDataAccess->closeDB();

        return $arrayOfTemplateObjects;
    }

    public function delete($id){

        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->deleteTemplate($id);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";
    }


    public static function update($id, $name, $desc, $state, $css, $modifyDate,$modifiedby){

        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->updateTemplate($id, $name, $desc, $state, $css, $modifyDate,$modifiedby);
        if($state==1){
        $myDataAccess->resetTemplate($modifyDate,$modifiedby,$id);
        }

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";
    }

    public static function getActiveCSS(){

        $myDataAccess = new DataAccess();
        $myDataAccess->connectToDB();
        $myDataAccess->getActiveCSS();
       // $recordsAffected = $myDataAccess->getActiveCSS();
       while($row = $myDataAccess->fetchTemplate()){
            $currentTemplate = new self($myDataAccess->fetchTemplateName($row),
                $myDataAccess->fetchTemplateDesc($row),  $myDataAccess->fetchTemplateState($row),
                $myDataAccess->fetchTemplateCSS($row),  $myDataAccess->fetchTemplateCreatedDate($row),
                $myDataAccess->fetchTemplateCreatedBy($row), $myDataAccess->fetchTemplateModifiedBy($row),
                $myDataAccess->fetchTemplateModifiedDate($row));
            $currentTemplate->id = $myDataAccess->fetchTemplateID($row);
       }

        $myDataAccess->closeDB();
        return $currentTemplate;

    }

    public function getCSS(){
        return $this->css;
    }
} 