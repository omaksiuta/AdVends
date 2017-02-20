<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    dvends.com/wp-content/themes/advends/inc
    <?php
//    require "../inc/standardFunctions.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/inc/standardFunctions.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/tools/Database.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/tools/Http.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/tools/EncodeDecode.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/inc/builders/AllCategoriesPanelBuilder.php";


    //    define("CSS_ROOT_PATH", getHostProtocol() . $_SERVER['HTTP_HOST'] . "/wp-content/themes/twentyfourteen/page-page-templates/css/");
    define("CSS_ROOT_PATH", getHostProtocol() . $_SERVER['HTTP_HOST'] . "/inc/css/");

    ?>

    <title>FlashCards</title>
<!--<!--    We need to tell it to dynamically link to the themes folder. Replace your code with this.-->-->
<!--    <link href="--><?php //bloginfo('template_directory');?><!--/blog.css" rel="stylesheet">-->
    <link type="text/css" rel="stylesheet" href="<?php echo CSS_ROOT_PATH; ?>card.css" media="all"/>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
</head>

<body>


<?php
/* Template Name: home.php */
// get_header();
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