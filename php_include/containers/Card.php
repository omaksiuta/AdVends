<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/containers/AbstractHtmlContainer.php";

class Card extends AbstractHtmlContainer
{
    private $header = NULL;
    private $body = NULL;
    private $footer = NULL;

    private $frontName = NULL;
    private $backName = NULL;
    private $frontImgAlt = NULL;
    private $backImgAlt = NULL;

    private $page = NULL;

    private $wid = NULL;
    private $imgSrc = NULL;

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function setWid($wid)
    {
        $this->wid = $wid;
    }

    public function setHeader($header)
    {
        $this->header = $header;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function setFooter($footer)
    {
        $this->footer = $footer;
    }    public function setFrontName($frontName)
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



    function getHtml()
    {
        // TODO: Implement getHtml() method.
    }
}


