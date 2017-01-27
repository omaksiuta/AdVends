<?php

class Menu
{
    public static function allCategoriesMenu($currentPage, $arrayOfSqlRows)
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
                $resultHtml .= "<a href='" . $currentPage . "?cat=$category_wid'>" . $category_en . " <b>" . $category_itemsCount . "</b>" . "</a>";
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
                        $resultHtml .= "<a href='" . $currentPage . "?cat=$item_wid'>" . $item_en . "</a>";
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
}