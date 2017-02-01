<?php


class HtmlCorrector
{
    public static function addTagAttribute($attribute, $value)
    {
        $result = " " . $attribute . "=" . "'" . $value . "' ";
        return $result;
    }

    public static function addIdAndOrClassAttribute($id = NULL, $class = NULL)
    {
        $result = '';
        if ($id != NULL) {
            $result .= HtmlCorrector::addTagAttribute('id', $id);
        }
        if ($class != NULL) {
            $result .= HtmlCorrector::addTagAttribute('class', $class);
        }
        return $result;
    }

    public static function coverWithDiv($innerContent, $id = NULL, $class = NULL)
    {
        $result = '<div';
        HtmlCorrector::addIdAndOrClassAttribute($id, $class);
        $result .= '>';
        $result .= $innerContent;
        $result .= '</div>';

        return $result;
    }

    public static function coverWithTextArea($string)
    {
        $result = '<textarea>';
        $result .= $string;
        $result .= '</textarea>';

        return $result;
    }

    public static function coverWithHref($innerContent, $href, $target = NULL, $id = NULL, $class = NULL)
    {
        $result = '<a';

        HtmlCorrector::addTagAttribute('href', $href);

        HtmlCorrector::addIdAndOrClassAttribute($id, $class);

        HtmlCorrector::addTagAttribute('target', $target);

        $result .= '>';

        $result .= $innerContent;

        $result .= '</a>';

//        $result = " < span class='category-item-header' > ";
//        $result .= "        <a href = '" . $this->card->getPage() . "?id=" . $this->card->getWid() . "' > ";
//        $result .= "         <img class='category-item-img' src = '$this->imgSrc' alt = '$this->frontImgAlt' > ";
//        $result .= "        </a > ";

        return $result;
    }
}