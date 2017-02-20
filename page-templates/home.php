<?php
/* Template Name: home.php */
// get_header();
require $_SERVER['DOCUMENT_ROOT'] . "/php-include/standardFunctions.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/Database.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/Http.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/EncodeDecode.php";
require $_SERVER['DOCUMENT_ROOT'] . "/php-include/builders/AllCategoriesPanelBuilder.php";

//define("CSS_ROOT_PATH", getHostProtocol() . $_SERVER['HTTP_HOST'] . "/php-include/css/");


wp_enqueue_style('style', get_template_directory() . "page-templates/css/card.css");

?>


<div id='allCategoriesPanel'>
    <?php
    $http = new Http();
    $currentPage = $http->currentPage();

    $allCategoriesPanelBuilder = new AllCategoriesPanelBuilder();
    $allCategoriesPanelBuilder->setCategoryPage($currentPage);
    $allCategoriesPanelBuilder->setMaxItemsToShow(10);

    echo $allCategoriesPanelBuilder->buildHtml();
    ?>
</div>