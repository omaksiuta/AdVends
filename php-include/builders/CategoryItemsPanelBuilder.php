<!--https://sourcemaking.com/design_patterns/builder/java/2-->
<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/Database.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/HtmlCorrector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/builders/AbstractHtmlBuilder.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/builders/CardBuilder.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/domain_objects/Card.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/enums/CardType.php";


class CategoryItemsPanelBuilder extends AbstractHtmlBuilder
{
    private $categoryPage = NULL;
    private $arrayOfSqlRows = NULL;
    private $maxItemsToShow = 0;

    function __construct()
    {
        $database = new Database();
        $this->arrayOfSqlRows = $database->getItemsByCategory();
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

        $counter = 0;

        foreach ($this->arrayOfSqlRows as $rowOfItem) {
            if (strlen(str_replace(' ', '', $rowOfItem['WID'])) != 0) {
                if ($counter < $this->maxItemsToShow) {

//            echo "<br/> WID" . $rowOfItem['WID'];
                    $card = new Card();
                    $card->setWid($rowOfItem['WID']);
                    $card->setParentWid($rowOfItem['PARENT_WID']);
                    $card->setWebPagePath($this->categoryPage);
                    $card->setFrontImgSrc("http://images.freeimages.com/images/home-grids/180/school-desks-1418686.jpg");
                    $card->setBackImgSrc("http://images.freeimages.com/images/home-grids/180/school-desks-1418686.jpg");
                    $card->setFrontImgAlt('front alt nature. front alt good');
                    $card->setBackImgAlt('front alt nature. front alt good');
                    $card->setFrontName($rowOfItem['EN']);
                    $card->setBackName($rowOfItem['RU']);

                    $cardBuilder = new CardBuilder($card, CardType::HEADER_WITH_IMAGE);

                    $cardHtml = HtmlCorrector::coverWithDiv($cardBuilder->buildHtml(), NULL, 'category-item-card');
//            echo HtmlCorrector::coverWithTextArea($cardHtml);
                    $resultHtml .= $cardHtml;

                    $counter++;
                };
            };
        };
        return $resultHtml;
    }
}
