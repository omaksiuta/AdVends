<?php


class HtmlCorrector
{

    public static function createTag($tagName, $tagAttributes = NULL, $innerHtml = NULL)
    {
        $tagName = strtolower(trim($tagName));

        $result = '<' . $tagName;
        if ($tagAttributes != NULL) {
            $result .= $tagAttributes;
        }
        $result .= '>';

        if ($tagName != 'img') {
            if ($innerHtml != NULL) {
                $result .= $innerHtml;
            }
            $result .= '</' . $tagName;
            $result .= ' >';
        }
        return $result;
    }

    public static function addTagAttribute($attribute, $value)
    {
        $result = '';
        if ($value != NULL) {
            // Reduce multiple spaces.
            $attribute = preg_replace("/ {2,}/", ' ', trim($attribute));
            $attribute = strtolower(trim($attribute));

            $value = preg_replace("/ {2,}/", ' ', trim($value));

            $result = strtolower(" " . $attribute . "=" . "'" . $value . "'");
        };
        return $result;

    }

    public static function addClassAttribute($class = NULL)
    {
        $result = '';
        if ($class != NULL) {
            $result .= HtmlCorrector::addTagAttribute('class', $class);
        }
        return $result;
    }

    public static function addIdAttribute($id = NULL)
    {
        $result = '';
        if ($id != NULL) {
            $result .= HtmlCorrector::addTagAttribute('id', $id);
        }
        return $result;
    }

    public static function coverWithDiv($innerContent, $id = NULL, $class = NULL)
    {
        $tagAttributes = HtmlCorrector::addIdAttribute($id);
        $tagAttributes .= HtmlCorrector::addClassAttribute($class);
        return HtmlCorrector::createTag('div', $tagAttributes, $innerContent);
    }

    public static function coverWithSpan($innerContent, $id = NULL, $class = NULL)
    {
        $tagAttributes = HtmlCorrector::addIdAttribute($id);
        $tagAttributes .= HtmlCorrector::addClassAttribute($class);
        return HtmlCorrector::createTag('span', $tagAttributes, $innerContent);
    }

    public static function coverWithTextArea($innerContent)
    {
        return HtmlCorrector::createTag('textarea', NULL, $innerContent);
    }

    public static function coverWithHref($innerContent, $href, $target = NULL, $id = NULL, $class = NULL)
    {
        $tagAttributes = HtmlCorrector::addTagAttribute('href', $href);
        $tagAttributes .= HtmlCorrector::addIdAttribute($id);
        $tagAttributes .= HtmlCorrector::addClassAttribute($class);
        $tagAttributes .= HtmlCorrector::addTagAttribute('target', $target);

        return HtmlCorrector::createTag('a', $tagAttributes, $innerContent);
    }
}