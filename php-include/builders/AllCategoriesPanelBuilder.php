<!--https://sourcemaking.com/design_patterns/builder/java/2-->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/Database.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/builders/AbstractHtmlBuilder.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/HtmlCorrector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/containers/CategoryAndCountContainer.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/containers/ImageContainer.php";


class AllCategoriesPanelBuilder extends AbstractHtmlBuilder
{
    private $categoryPage = NULL;
    private $maxItemsToShow = 0;
    private $database = NULL;

    function __construct()
    {
        $this->database = new Database();
//        echo sizeof($this->arrayOfSqlRows);
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

        $arrayOfSqlRows_CategoriesNameAndCount = $this->database->getAllCategoriesWithCountOfItems();
        echo sizeof($arrayOfSqlRows_CategoriesNameAndCount) . '<br />';

        foreach ($arrayOfSqlRows_CategoriesNameAndCount as $rowOfCategory) {
            $categoryWid = $rowOfCategory['WID'];
            $categoryItemsCount = $rowOfCategory['ITEMS_COUNT'];

            //Create Header
            $categoryAndCount = new CategoryAndCountContainer();
            $categoryAndCount->setCategoryPage($this->categoryPage);
            $categoryAndCount->setCategoryWid($categoryWid);
            $categoryAndCount->setCategoryName($rowOfCategory['EN']);
            $categoryAndCount->setCategoryItemsCount($categoryItemsCount);

            $cardHeader = $categoryAndCount->getHtml();

            $href = $this->categoryPage . "categories/" . "?id=" . $categoryWid;

            $cardHeader = HtmlCorrector::coverWithHref($cardHeader, $href);

            $cardHeader = HtmlCorrector::coverWithDiv($cardHeader, NULL, 'category-card-text-and-count');

            //Search for sub-items
            $arrayOfSqlRows_CategoryItems = $this->database->getItemsByCategory($categoryWid);
            echo sizeof($arrayOfSqlRows_CategoryItems) . '<br />';


            $imageIcons = '';

            $counter = 0;
            foreach ($arrayOfSqlRows_CategoryItems as $rowOfItem) {
                $item_parent_wid = $rowOfItem['PARENT_WID'];//to add name or moew
                if ($counter < $this->maxItemsToShow) {
                    //build img icon
                    $imageTag = new ImageContainer();
                    $imageTag->setImgSrc("http://images.freeimages.com/images/home-grids/180/school-desks-1418686.jpg");
                    $imageTag->setImgClass('category-card-img-icon');
                    $imageTag->setImgAlt('alt nature. alt good');
                    $imageIcons .= $imageTag->getHtml();
                };
                $counter++;
            };
            $imageIcons = HtmlCorrector::coverWithDiv($imageIcons, NULL, 'category-card-body');

            $resultHtml = $cardHeader . $imageIcons;

            $resultHtml .= HtmlCorrector::coverWithDiv($resultHtml, NULL, 'category-card');
        };
        return $resultHtml;
    }
}
