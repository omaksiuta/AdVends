<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . "/php_include/standardFunctions.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/tools/Database.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/tools/Http.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/tools/EncodeDecode.php";

    include_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/containers/Panel.php";

    require $_SERVER['DOCUMENT_ROOT'] . "/php_include/builders/html_page/HTMLPageBuilder.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/php_include/builders/html_page/HtmlBuldDirector.php";

    require $_SERVER['DOCUMENT_ROOT'] . "/php_include/builders/categories_panel/CategoriesPanelBuilder.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/php_include/builders/categories_panel/CategoriesPanelDirector.php";


    define("CSS_ROOT_PATH", getHostProtocol() . $_SERVER['HTTP_HOST'] . "/wp-content/themes/twentyfourteen/page-templates/css/");
    ?>

    <title>FlashCards</title>


    <link type="text/css" rel="stylesheet" href="<?php echo CSS_ROOT_PATH; ?>cards.css" media="all"/>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script type="text/javascript">
    </script>


</head>

<body>


<?php

function writeln($line_in)
{
    echo $line_in . "<br/>";
}

/* Template Name: home.php */
// get_header();

function userLanguage()
{
    return "EN";
}

?>

<div id='categories'>
    <?php
    $database = new Database();
    $arrayOfSqlRows = $database->get_vocabulary_data();

    $http = new Http();
    $currentPage = $http->current_page();
    //
    //    $panel = new Panel();
    //    echo $panel->all_categories_panel($currentPage, $arrayOfSqlRows);


    echo "lllllllllllllllllll";
    $allCategoriesPanelBuilder = new CategoriesPanelBuilder();
    $allCategoriesPanelBuilder->setCurrentPage($currentPage);
    $allCategoriesPanelBuilder->setArrayOfSqlRows($arrayOfSqlRows);
    $allCategoriesPanelBuilder->buildHtml();
    $code = $allCategoriesPanelBuilder->getHtml();
    echo $code;
    echo "lllllllllllllllllll";


    //    writeln('BEGIN TESTING BUILDER PATTERN');
    //    writeln('');
    //    $pageBuilder = new HTMLHtmlBuilder();
    //    $pageDirector = new HtmlBuldDirector($pageBuilder);
    //    $pageDirector->buildHtml();
    //    $page = $pageDirector->getHtml();
    //    writeln($page->showPage());
    //    writeln('');
    //    writeln('END TESTING BUILDER PATTERN');
    ?>
</div>