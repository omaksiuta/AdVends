<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/containers/AbstractHtmlContainer.php";

class ImageContainer extends AbstractHtmlContainer
{
    private $imgSrc = NULL;
    private $imgAlt = NULL;
    private $imgId = NULL;
    private $imgClass = NULL;

    function __construct()
    {
    }

    public function setImgId($imgId)
    {
        $this->imgId = $imgId;
    }


    public function setImgClass($imgClass)
    {
        $this->imgClass = $imgClass;
    }

    public function setImgSrc($imgSrc)
    {
        $this->imgSrc = $imgSrc;
    }

    public function setImgAlt($imgAlt)
    {
        $this->imgAlt = $imgAlt;
    }


    public function getHtml()
    {
        $tagAttributes = HtmlCorrector::addIdAttribute($this->imgId);

        $tagAttributes .= HtmlCorrector::addClassAttribute($this->imgClass);

        $tagAttributes .= HtmlCorrector::addTagAttribute('src', $this->imgSrc);

        $tagAttributes .= HtmlCorrector::addTagAttribute('alt', $this->imgAlt);

        return HtmlCorrector::createTag('img', $tagAttributes);
    }
}


