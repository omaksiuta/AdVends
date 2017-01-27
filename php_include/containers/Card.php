<?php

class Card
{
    public $frontLanguage = 'en';
    public $backLanguage = 'ru';

    public function withImage($page, $wid, $enName, $imgSrc, $imgAlt)
    {
        print $this->frontLanguage;

//        echo __CLASS__; // foo
//        var_dump($this);
        $resultHtml = "";
        $resultHtml .= "<div class='category-card'>";
        $resultHtml .= "    <div class='category-card-name'>";
        $resultHtml .= "        <a href = '" . $page . "?id=$wid'>";
        $resultHtml .= "        " . $enName;
        $resultHtml .= "        </a>";
        $resultHtml .= "    </div>";
        $resultHtml .= "    <div>";
        $resultHtml .= "         <img class='flashcard-img' src = '$imgSrc' alt = '$imgAlt'>";
        $resultHtml .= "    </div>";
        $resultHtml .= "</div>";

        return $resultHtml;
    }
}


