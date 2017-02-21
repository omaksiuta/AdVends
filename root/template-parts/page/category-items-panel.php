<div class='category-items-panel'>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/Http.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/EncodeDecode.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/builders/CategoryItemsPanelBuilder.php";

    $style = get_template_directory_uri() . "/css/card.css";//    echo $style . '<br />';
    wp_register_style('my-style', $style);
    wp_enqueue_style('my-style');

    $http = new Http();
    $currentPage = $http->currentPage();

    $categoryItemsPanelBuilder = new CategoryItemsPanelBuilder();
    $categoryItemsPanelBuilder->setCategoryPage($currentPage);
    $categoryItemsPanelBuilder->setMaxItemsToShow(10);

    echo $categoryItemsPanelBuilder->buildHtml();
    ?>
</div>