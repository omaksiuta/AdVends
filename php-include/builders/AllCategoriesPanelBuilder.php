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
    private $maxItemsToShow = NULL;
    private $maxSubItemsToShow = NULL;

    private $database = NULL;

    function __construct()
    {
        $this->database = new Database();
    }

    public function setCategoryPage($categoryPage)
    {
        $this->categoryPage = $categoryPage;
    }

    public function setMaxItemsToShow($maxItemsToShow)
    {
        $this->maxItemsToShow = $maxItemsToShow;

//        echo "maxItemsToShow   after set is " . $this->maxItemsToShow . "<br />";

    }

    public function setMaxSubItemsToShow($maxSubItemsToShow)
    {
        $this->maxSubItemsToShow = $maxSubItemsToShow;

//        echo "maxSubItemsToShow   after set is " . $this->maxSubItemsToShow . "<br />";
    }

    public function buildHtml()
    {
        $resultHtml = '';

        $arrayOfSqlRows_CategoriesNameAndCount = $this->database->getAllCategoriesWithCountOfItems();
//        echo sizeof($arrayOfSqlRows_CategoriesNameAndCount) . '<br />';

        foreach ($arrayOfSqlRows_CategoriesNameAndCount as $rowOfCategory) {
            $categoryWid = $rowOfCategory['WID'];
            $categoryItemsCount = $rowOfCategory['ITEMS_COUNT'];

            if (strlen(trim($categoryWid)) > 1) {
//                echo "categoryWid is - " . $categoryWid . " categoryItemsCount is: " . $categoryItemsCount . "<br />";

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
//            echo sizeof($arrayOfSqlRows_CategoryItems) . '<br />';

                $imageIcons = '';

                $counterSubItems = 1;

                foreach ($arrayOfSqlRows_CategoryItems as $rowOfItem) {
                    $item_wid = $rowOfItem['WID'];
                    $item_parent_wid = $rowOfItem['PARENT_WID'];

//                    echo "maxSubItemsToShow is " . $this->maxSubItemsToShow . "<br />";

                    if ($counterSubItems > $this->maxSubItemsToShow) {
                        break;
                    };
                    if (strlen(trim($item_wid)) > 1) {
//                        echo "item_wid is - " . $item_wid . "<br />";
                        //build img icon
                        $imageTag = new ImageContainer();
                        $imageTag->setImgSrc("http://images.freeimages.com/images/home-grids/180/school-desks-1418686.jpg");
                        $imageTag->setImgClass('category-card-img-icon');
                        $imageTag->setImgAlt('alt nature. alt good');
                        $imageIcons .= $imageTag->getHtml();
                        $counterSubItems++;
                    };

                };
                $imageIcons = HtmlCorrector::coverWithDiv($imageIcons, NULL, 'category-card-body');

                $categoryHtml = $cardHeader . $imageIcons;

                $resultHtml .= HtmlCorrector::coverWithDiv($categoryHtml, NULL, 'category-card');
//            echo $resultHtml;
            };
        };
        return $resultHtml;
    }
}
