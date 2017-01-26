<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <!--http://tutsforweb.blogspot.co.uk/2012/02/creating-menu-from-database-data.html-->
    <!--http://phpflow.com/php/dynamic-tree-with-jstree-php-and-mysql/-->
    <!-- http://php.net/manual/en/mysqli-stmt.get-result.php -->
    <!-- http://www.w3schools.com/php/func_mysqli_fetch_array.asp -->
    <title>FlashCards</title>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . "/php_include/standardFunctions.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/php_include/encodingFunctions.php";
    define("ROOT_PATH", getHostProtocol() . $_SERVER['HTTP_HOST'] . "/wp-content/themes/twentyfourteen/page-templates/"); ?>

    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>cards.css" media="all"/>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>

    <script type="text/javascript">


    </script>


</head>

<body>


<?php


/* Template Name: home.php */
// get_header();

/*http page functions*/
function currentPage()
{
    return trim(basename($_SERVER['PHP_SELF']));
}

function userLanguage()
{
    return "EN";
}


/*db functions*/
function connectDb()
{
    $servername = "advends.com";
    $username = "advends";
    $password = "VfifYfcnz!23";
    $database = "advends_wp1";
    $conn = mysqli_connect($servername, $username, $password, $database);
    mysqli_set_charset($conn, "utf8");

    /* check connection */
    if (!$conn) {
        $error = mysqli_connect_error();
        $errno = mysqli_connect_errno();
        print "$errno: $error\n";
        exit();
    };
    return $conn;
}

function getHomePageVocabularyFromDbIntoArray($dbConnection)
{
    $sql = "
                    SELECT
                        v1.WID
                        ,v1.PARENT_WID
                        ,v1.EN
                        ,v1.RU  
                        ,(SELECT count(*)  FROM tbl_vocabulary v2 where v2.PARENT_WID=v1.WID) as ITEMS_COUNT
                    FROM tbl_vocabulary v1
                    JOIN tbl_vocabulary v2 on v1.WID=v2.WID
                    GROUP BY v1.EN
                    ORDER BY v1.PARENT_WID, ITEMS_COUNT DESC;
    ";
    //        echo $sql;
    if ($result = mysqli_query($dbConnection, $sql)) {
        //Create $arrayOfSqlRows
        while ($rowFromSqlResult = $result->fetch_array()) {
            $arrayOfSqlRows[] = $rowFromSqlResult;
        }
        mysqli_free_result($result);
    };
    mysqli_close($dbConnection);
    return $arrayOfSqlRows;
}

/*gui functions*/
function genCategoriesMenu($arrayOfSqlRows)
{
    $resultHtml = "";

    foreach ($arrayOfSqlRows as $rowOfCategory) {
        $category_wid = $rowOfCategory['WID'];
        $category_parent_wid = $rowOfCategory['PARENT_WID'];
        $category_itemsCount = $rowOfCategory['ITEMS_COUNT'];
        $category_en = $rowOfCategory['EN'];
        $category_ru = $rowOfCategory['RU'];

        if ($category_itemsCount > 0) {
            $resultHtml .= "<li>";
            $resultHtml .= "<a href='" . currentPage() . "?cat=$category_wid'>" . $category_en . " <b>" . $category_itemsCount . "</b>" . "</a>";
            $resultHtml .= "<ul>";
            //Search for sub-items
            foreach ($arrayOfSqlRows as $rowOfItem) {
                $item_wid = $rowOfItem['WID'];
                $item_parent_wid = $rowOfItem['PARENT_WID'];
                $item_itemsCount = $rowOfItem['ITEMS_COUNT'];
                $item_en = $rowOfItem['EN'];
                $item_ru = $rowOfItem['RU'];

                if ($item_parent_wid == $category_wid) {
                    $resultHtml .= "<li>";
                    $resultHtml .= "<a href='" . currentPage() . "?cat=$item_wid'>" . $item_en . "</a>";
                    $resultHtml .= "</li>";
                };
            };
            $resultHtml .= "</ul>";
            $resultHtml .= "</li>";
        };
    };

    if (strlen($resultHtml) > 0) {
        $resultHtml = "<ul>" . $resultHtml;
        $resultHtml .= "</ul>";
    };
    return $resultHtml;
}

function genCategoriesPanel($arrayOfSqlRows)
{
    $resultHtml = "";

    foreach ($arrayOfSqlRows as $rowOfCategory) {
        $category_wid = $rowOfCategory['WID'];
        $category_parent_wid = $rowOfCategory['PARENT_WID'];
        $category_itemsCount = $rowOfCategory['ITEMS_COUNT'];
        $category_en = $rowOfCategory['EN'];
        $category_ru = $rowOfCategory['RU'];

        if ($category_itemsCount > 0) {
            $resultHtml .= "<div>";
            $resultHtml .= "<div>";
            $resultHtml .= "<a href='" . currentPage() . "?cat=$category_wid'>";
            $resultHtml .= $category_en . " <b>" . $category_itemsCount . "</b>";
//            $resultHtml .= "<img  class=\"flashcard-img\" src = 'http://www.planningcapital.com/wp-content/uploads/2016/01/ActiveVsPassive.jpg' alt = 'active and passive>";
            $resultHtml .= "</a>";
            $resultHtml .= "</div>";
//            $resultHtml .= "<ul>";
            //Search for sub-items
            foreach ($arrayOfSqlRows as $rowOfItem) {
                $item_wid = $rowOfItem['WID'];
                $item_parent_wid = $rowOfItem['PARENT_WID'];
                $item_itemsCount = $rowOfItem['ITEMS_COUNT'];
                $item_en = $rowOfItem['EN'];
                $item_ru = $rowOfItem['RU'];

                if ($item_parent_wid == $category_wid) {
//                    $resultHtml .= "<li>";
                    $resultHtml .= "<div class='category-card'>";
                    $resultHtml .= "    <div class='category-card-name'>";
                    $resultHtml .= "        <a href = '" . currentPage() . "?cat=$item_wid'>";
                    $resultHtml .= "        " . $item_en;
                    $resultHtml .= "        </a>";
                    $resultHtml .= "    </div>";
                    $resultHtml .= "    <div>";
                    $resultHtml .= "         <img class='flashcard-img' src = 'http://www.leapfrogs.com.au/wp-content/uploads/Active-kids-pic4.jpg' alt = 'kids jump'>";
                    $resultHtml .= "    </div>";
                    $resultHtml .= "</div>";
//                    $resultHtml .= "</li>";
                };
            };
//            $resultHtml .= "</ul>";
            $resultHtml .= "</div>";
        };
    };

    return $resultHtml;
}

?>

<div id='categories'>
    <?php
    $arrayOfSqlRows = getHomePageVocabularyFromDbIntoArray(connectDb());
    echo genCategoriesPanel($arrayOfSqlRows);
    ?>
</div>