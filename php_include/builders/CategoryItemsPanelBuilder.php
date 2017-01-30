<!--https://sourcemaking.com/design_patterns/builder/java/2-->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/tools/Database.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/builders/AbstractHtmlBuilder.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/tools/HtmlCorrector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/containers/Card.php";


class CategoryItemsPanelBuilder extends AbstractHtmlBuilder
{
    private $categoryPage = NULL;
    private $arrayOfSqlRows = NULL;
    private $ItemType = NULL;
    private $maxItemsToShow = 0;

    function __construct()
    {
        $database = new Database();
        $this->arrayOfSqlRows = $database->getCategoryItems();
    }

    public function setCategoryPage($categoryPage)
    {
        $this->categoryPage = $categoryPage;
    }

    public function setMaxItemsToShow($maxItemsToShow)
    {
        $this->maxItemsToShow = $maxItemsToShow;
    }

    public function buildHtml()
    {
        $resultHtml = '';

        foreach ($this->arrayOfSqlRows as $rowOfItem) {
            $row_wid = $rowOfItem['WID'];
            $row_en = $rowOfItem['EN'];
            $row_ru = $rowOfItem['RU'];

            $card = new Card();
            $card->setPage($this->categoryPage);
            $card->setWid($row_wid);
            $card->setFrontName($row_en);
            $card->setBackName($row_ru);
            $cardHtml = $card->getHtml();

            $resultHtml .= HtmlCorrector::add_div($cardHtml,NULL, 'category-card');
        };
        return $resultHtml;//HtmlCorrector::add_div($resultHtml, 'allCategoriesPanel');
    }
}
