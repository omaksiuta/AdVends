<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/containers/AbstractHtmlContainer.php";

class Card extends AbstractHtmlContainer
{
    private $frontName = NULL;
    private $backName = NULL;
    private $frontImgAlt = NULL;
    private $backImgAlt = NULL;

    private $page = NULL;
    private $categoryFrontName = NULL;

    private $wid = NULL;
    private $subItemsCount = NULL;
    private $imgSrc = NULL;

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function setCategoryFrontName($categoryFrontName)
    {
        $this->categoryFrontName = $categoryFrontName;
    }


    public function setWid($wid)
    {
        $this->wid = $wid;
    }

    public function setSubItemsCount($subItemsCount)
    {
        $this->subItemsCount = $subItemsCount;
    }

    public function setFrontName($frontName)
    {
        $this->frontName = $frontName;
    }

    public function setBackName($backName)
    {
        $this->backName = $backName;
    }

    public function setImgSrc($imgSrc)
    {
        $this->imgSrc = $imgSrc;
    }

    public function setFrontImgAlt($frontImgAlt)
    {
        $this->frontImgAlt = $frontImgAlt;
    }

//    public function withCategoryNameAndItsCount()
//    {
//        $resultHtml = "    <div class=''>";
//        $resultHtml .= "        <a href = '" . $this->page . "?id=$this->wid'>";
//        $resultHtml .= "        " . $this->frontName . " <b>" . $this->subItemsCount . "</b>";
//        $resultHtml .= "        </a>";
//        $resultHtml .= "    </div>";
//
//        return $resultHtml;
//    }

    public function buildWithImageOnly()
    {
        $resultHtml = "<div class='category-card-icon'>";
        $resultHtml .= "    <div class='category-card-name'>";
        $resultHtml .= "        <a href = '" . $this->page . "?id=$this->wid'>";
        $resultHtml .= "         <img class='flashcard-img' src = '$this->imgSrc' alt = '$this->frontImgAlt'>";
        $resultHtml .= "        </a>";
        $resultHtml .= "    </div>";
        $resultHtml .= "</div>";

        return $resultHtml;
    }

    public function buildWithNameAndImage()
    {
        $resultHtml = "<div class='category-card'>";
        $resultHtml .= "    <div class='category-card-name'>";
        $resultHtml .= "        <a href = '" . $this->page . "?id=$this->wid'>";
        $resultHtml .= "        " . $this->frontName;
        $resultHtml .= "        </a>";
        $resultHtml .= "    </div>";
        $resultHtml .= "    <div>";
        $resultHtml .= "         <img class='flashcard-img' src = '$this->imgSrc' alt = '$this->frontImgAlt'>";
        $resultHtml .= "    </div>";
        $resultHtml .= "</div>";

        return $resultHtml;
    }
}


