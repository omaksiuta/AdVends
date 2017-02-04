<?php /* Template Name: test.php */ ?>
<?php get_header(); ?>



<div id='allCategoriesPanel' class="row">
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . "/inc/standardFunctions.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/tools/Database.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/tools/Http.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/tools/EncodeDecode.php";

    require $_SERVER['DOCUMENT_ROOT'] . "/inc/builders/AllCategoriesPanelBuilder.php";


    //    define("CSS_ROOT_PATH", getHostProtocol() . $_SERVER['HTTP_HOST'] . "/wp-content/themes/twentyfourteen/page-templates/css/");
    define("CSS_ROOT_PATH", getHostProtocol() . $_SERVER['HTTP_HOST'] . "/inc/css/");

    ?>

    <?php
    $http = new Http();
    $currentPage = $http->currentPage();

    $allCategoriesPanelBuilder = new AllCategoriesPanelBuilder();
    $allCategoriesPanelBuilder->setCategoryPage($currentPage);
    $allCategoriesPanelBuilder->setMaxItemsToShow(12);

    echo $allCategoriesPanelBuilder->buildHtml();
    ?>
</div>

<div class="row">


    <div class="col-sm-8 blog-main">

<!--        --><?php //get_template_part('content', get_post_format()); ?>

    </div> <!-- /.blog-main -->

    <?php get_sidebar(); ?>

</div> <!-- /.row -->

<?php get_footer(); ?>

