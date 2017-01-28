<?php

require_once 'Card.php';

class Panel
{
    public function all_categories_panel($currentPage, $arrayOfSqlRows)
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
                $resultHtml .= "<a href='" . $currentPage . "?cat=$category_wid'>";
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
                        $imgSrc = 'http://www.leapfrogs.com.au/wp-content/uploads/Active-kids-pic4.jpg';
                        $imgAlt = 'kids jump';
                        $card = new Card();
//                        $card->frontLanguage='DE';

                        $resultHtml .= $card->withImage($currentPage, $item_wid, $item_en, $imgSrc, $imgAlt);

//                    $resultHtml .= "</li>";
                    };
                };
//            $resultHtml .= "</ul>";
                $resultHtml .= "</div>";
            };
        };

        return $resultHtml;
    }

}