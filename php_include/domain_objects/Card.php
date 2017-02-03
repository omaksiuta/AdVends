<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/domain_objects/AbstractDomainObject.php";

class Card extends AbstractDomainObject
{
    private $frontName = NULL;
    private $backName = NULL;
    private $frontImgSrc = NULL;
    private $backImgSrc = NULL;
    private $frontImgAlt = NULL;
    private $backImgAlt = NULL;
    private $webPagePath = NULL;
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

    public function getFrontImgSrc()
    {
        return $this->frontImgSrc;
    }

    public function setFrontImgSrc($frontImgSrc)
    {
        $this->frontImgSrc = $frontImgSrc;
    }

    public function getBackImgSrc()
    {
        return $this->backImgSrc;
    }

    public function setBackImgSrc($backImgSrc)
    {
        $this->backImgSrc = $backImgSrc;
    }

    public function getWebPagePath()
    {
        return $this->webPagePath;
    }

    public function setWebPagePath($webPagePath)
    {
        $this->webPagePath = $webPagePath;
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

    public function getFrontImgAlt()
    {
        return $this->frontImgAlt;
    }

    public function setFrontImgAlt($frontImgAlt)
    {
        $this->frontImgAlt = $frontImgAlt;
    }

    public function getBackImgAlt()
    {
        return $this->backImgAlt;
    }

    public function setBackImgAlt($backImgAlt)
    {
        $this->backImgAlt = $backImgAlt;
    }
}


