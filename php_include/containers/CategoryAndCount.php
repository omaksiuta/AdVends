<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/containers/AbstractHtmlContainer.php";

class CategoryAndCount extends AbstractHtmlContainer
{
    private $categoryPage = NULL;
    private $categoryWid = NULL;
    private $categoryName = NULL;
    private $categoryItemsCount = NULL;
    private $categoryItems = NULL;

    function __construct()
    {
    }

    public function setCategoryPage($categoryPage)
    {
        $this->categoryPage = $categoryPage;
    }

    public function setCategoryWid($categoryWid)
    {
        $this->categoryWid = $categoryWid;
    }

    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
    }

    public function setCategoryItems($categoryItems)
    {
        $this->categoryItems = $categoryItems;
    }

    public function setCategoryItemsCount($categoryItemsCount)
    {
        $this->categoryItemsCount = $categoryItemsCount;
    }

    public function getHtml()
    {
        $resultHtml = "<a href = ' . $this->categoryPage . '?id=' . $this->categoryWid . '>";
        $resultHtml .= $this->categoryName . " " . $this->categoryItemsCount;
        $resultHtml .= "</a>";
        return $resultHtml;
    }
}


