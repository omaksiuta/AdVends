<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php

/* Template Name: category.php */
//get_header();
?>

<head>
    <?php
    //    define("TEMPLATE_PATH", get_template_directory());
    //    echo TEMPLATE_PATH;
//    echo get_theme_root() . '<br />';
//    echo get_template_directory() . '<br />';

    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/Http.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/tools/EncodeDecode.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php-include/builders/CategoryItemsPanelBuilder.php";
    ?>

    <title>FlashCards Category</title>

    <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory(); ?>/inc/css/card.css" media="all"/>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
</head>

<body>


<div id='categoryItemsPanel'>
    <?php

    $http = new Http();
    $currentPage = $http->currentPage();

    $categoryItemsPanelBuilder = new CategoryItemsPanelBuilder();
    $categoryItemsPanelBuilder->setCategoryPage($currentPage);
    $categoryItemsPanelBuilder->setMaxItemsToShow(10);

    echo $categoryItemsPanelBuilder->buildHtml();
    ?>
</div>