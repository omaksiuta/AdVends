<div class='all-categories-panel'>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . "/php-include/standardFunctions.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/Database.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/Http.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/EncodeDecode.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/php-include/builders/AllCategoriesPanelBuilder.php";

    $style = get_template_directory_uri() . "/css/card.css";//    echo $style . '<br />';
    wp_register_style('my-style', $style);
    wp_enqueue_style('my-style');

    $http = new Http();
    $currentPage = $http->currentPage();
    $allCategoriesPanelBuilder = new AllCategoriesPanelBuilder();
    $allCategoriesPanelBuilder->setCategoryPage($currentPage);
    $allCategoriesPanelBuilder->setMaxItemsToShow(10);

    echo $allCategoriesPanelBuilder->buildHtml();
    ?>
</div>
<!--http://stackoverflow.com/questions/3472087/how-to-use-wp-enqueue-style-in-my-wordpress-theme-->
<!--https://wp-kama.ru/function/wp_add_inline_style-->