<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/containers/AbstractHtmlContainer.php";

class ImageIcon extends AbstractHtmlContainer
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
        return "<img class='$this->imgClass' src = '$this->imgSrc' alt = '$this->imgAlt'>";
    }
}


