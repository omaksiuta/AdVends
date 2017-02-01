<!--https://sourcemaking.com/design_patterns/builder/java/2-->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/tools/Database.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/tools/HtmlCorrector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/builders/AbstractHtmlBuilder.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/builders/CardBuilder.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/domain_objects/Card.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/enums/CardType.php";


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
            $row_en = $rowOfItem['EN'];
            $row_ru = $rowOfItem['RU'];

            $card = new Card();
            $card->setWid($rowOfItem['WID']);
            $card->setParentWid($rowOfItem['PARENT_WID']);
            $card->setPage($this->categoryPage);
            $card->setFrontName($row_en);
            $card->setBackName($row_ru);

            $cardBuilder = new CardBuilder($card, CardType::HEADER_WITH_IMAGE);

            $resultHtml .= HtmlCorrector::coverWithDiv($cardBuilder->buildHtml(), NULL, 'category-card');
        };
        return $resultHtml;//HtmlCorrector::add_div($resultHtml, 'allCategoriesPanel');
    }
}
