<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . "/inc/standardFunctions.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/tools/Http.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/tools/EncodeDecode.php";

    require $_SERVER['DOCUMENT_ROOT'] . "/inc/builders/CategoryItemsPanelBuilder.php";
    //    define("CSS_ROOT_PATH", getHostProtocol() . $_SERVER['HTTP_HOST'] . "/wp-content/themes/twentyfourteen/page-templates/css/");
    define("CSS_ROOT_PATH", getHostProtocol() . $_SERVER['HTTP_HOST'] . "/inc/css/");

    ?>

    <title>FlashCards Category</title>

    <link type="text/css" rel="stylesheet" href="<?php echo CSS_ROOT_PATH; ?>card.css" media="all"/>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
</head>

<body>


<?php

/* Template Name: category.php */
//get_header();
?>


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