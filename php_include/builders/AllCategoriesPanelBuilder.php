<!--https://sourcemaking.com/design_patterns/builder/java/2-->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/tools/Database.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/builders/AbstractHtmlBuilder.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/tools/HtmlCorrector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/containers/CategoryAndCount.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/containers/ImageIcon.php";


class AllCategoriesPanelBuilder extends AbstractHtmlBuilder
{
    private $categoryPage = NULL;
    private $arrayOfSqlRows = NULL;
    private $maxItemsToShow = 0;

    function __construct()
    {
        $database = new Database();
        $this->arrayOfSqlRows = $database->getAllCategoriesData();
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
        foreach ($this->arrayOfSqlRows as $rowOfCategory) {
            $category_wid = $rowOfCategory['WID'];
            $categoryItemsCount = $rowOfCategory['ITEMS_COUNT'];

            if ($categoryItemsCount > 0) {

                //Create Header
                $categoryAndCount = new CategoryAndCount();
                $categoryAndCount->setCategoryPage($this->categoryPage);
                $categoryAndCount->setCategoryWid($category_wid);
                $categoryAndCount->setCategoryName($rowOfCategory['EN']);
                $categoryAndCount->setCategoryItemsCount($categoryItemsCount);
                $header = HtmlCorrector::add_div($categoryAndCount->getHtml(), NULL, 'category-text-and-count');

                //Search for sub-items
                $imageIcons = '';

                $counter = 0;
                foreach ($this->arrayOfSqlRows as $rowOfItem) {
                    $item_parent_wid = $rowOfItem['PARENT_WID'];
                    if ($item_parent_wid == $category_wid) {
                        if ($counter < $this->maxItemsToShow) {
                            $imageIcon = new ImageIcon();
                            $imageIcon->setImgSrc("http://images.freeimages.com/images/home-grids/180/school-desks-1418686.jpg");
                            $imageIcon->setImgClass('category-img-icon');
                            $imageIcon->setImgAlt('alt nature. alt good');
                            $imageIcons .= $imageIcon->getHtml();
                        };
                        $counter++;
                    };
                };
                $imageIcons = HtmlCorrector::add_div($imageIcons);

                $resultHtml .= HtmlCorrector::add_div($header . $imageIcons, NULL, 'categoryPanel');
            };
        };
        return $resultHtml;//HtmlCorrector::add_div($resultHtml, 'allCategoriesPanel');
    }
}
