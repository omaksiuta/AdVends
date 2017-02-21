<div class='all-categories-panel'>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . "/php-include/standardFunctions.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/Database.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/Http.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/EncodeDecode.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/php-include/builders/AllCategoriesPanelBuilder.php";

    //define("CSS_ROOT_PATH", getHostProtocol() . $_SERVER['HTTP_HOST'] . "/php-include/css/");
    echo get_stylesheet_uri() . '<br />';

    $style = get_template_directory() . "/page-templates/css/card.css";
    $style = "advends.com/wp-content/themes/advends-theme/page-templates/css/card.css";
    echo $style . '<br />';
    wp_register_style('style', $style);

    $http = new Http();
    $currentPage = $http->currentPage();

    $allCategoriesPanelBuilder = new AllCategoriesPanelBuilder();
    $allCategoriesPanelBuilder->setCategoryPage($currentPage);
    $allCategoriesPanelBuilder->setMaxItemsToShow(10);

    echo $allCategoriesPanelBuilder->buildHtml();
    ?>
</div>