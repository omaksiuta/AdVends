<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/containers/AbstractHtmlContainer.php";

class ImageContainer extends AbstractHtmlContainer
{
    private $imgSrc = NULL;
    private $imgAlt = NULL;
    private $imgClass = NULL;

    public function setImgSrc($imgSrc)
    {
        $this->imgSrc = $imgSrc;
    }

    public function setImgAlt($imgAlt)
    {
        $this->imgAlt = $imgAlt;
    }

    public function setImgClass($imgClass)
    {
        $this->imgClass = $imgClass;
    }

    public function getHtml()
    {
        $result = "<img"
            . HtmlCorrector::addIdAndOrClassAttribute(NULL, $this->imgClass)
            . HtmlCorrector::addTagAttribute('src', $this->imgSrc)
            . HtmlCorrector::addTagAttribute('alt', $this->imgAlt)
            . ">";
        echo $result;
        return $result;
    }
}


