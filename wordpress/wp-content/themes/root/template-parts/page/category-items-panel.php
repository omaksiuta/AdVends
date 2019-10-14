<div class='category-items-panel'>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . "/php-include/standardFunctions.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/Database.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/Http.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/EncodeDecode.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/php-include/builders/CategoryItemsPanelBuilder.php";

    $style = get_template_directory_uri() . "/css/card.css";//    echo $style . '<br />';
    wp_register_style('my-style', $style);
    wp_enqueue_style('my-style');

    //    echo "call of cipb";

    $http = new Http();
    $currentPage = $http->currentPage();
    $categoryItemsPanelBuilder = new CategoryItemsPanelBuilder();
    $categoryItemsPanelBuilder->setCategoryWid('w0000106');
    $categoryItemsPanelBuilder->setCategoryPage($currentPage);
    $categoryItemsPanelBuilder->setMaxItemsToShow(20);
    $resultHtml = $categoryItemsPanelBuilder->buildHtml();
    echo $resultHtml;
    ?>
</div>