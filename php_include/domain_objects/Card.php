<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/domain_objects/AbstractDomainObject.php";

class Card extends AbstractDomainObject
{
    private $frontName = NULL;
    private $backName = NULL;
    private $frontImg = NULL;
    private $backImg = NULL;
    private $page = NULL;
    private $wid = NULL;
    private $parent_wid = NULL;

    public function getFrontName()
    {
        return $this->frontName;
    }

    public function setFrontName($frontName)
    {
        $this->frontName = $frontName;
    }

    public function getBackName()
    {
        return $this->backName;
    }

    public function setBackName($backName)
    {
        $this->backName = $backName;
    }

    public function getFrontImg()
    {
        return $this->frontImg;
    }

    public function setFrontImg($frontImg)
    {
        $this->frontImg = $frontImg;
    }

    public function getBackImg()
    {
        return $this->backImg;
    }

    public function setBackImg($backImg)
    {
        $this->backImg = $backImg;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function getWid()
    {
        return $this->wid;
    }

    public function setWid($wid)
    {
        $this->wid = $wid;
    }

    function getParentWid()
    {
        return $this->parent_wid;
    }

    public function setParentWid($parent_wid)
    {
        $this->parent_wid = $parent_wid;
    }
}


