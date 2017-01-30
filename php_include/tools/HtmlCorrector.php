<?php


class HtmlCorrector
{

    public static function add_div($string, $id = NULL, $class = NULL)
    {
        $result = '<div';
        if ($id != NULL) {
            $result .= ' id=' . $id;
        }
        if ($class != NULL) {
            $result .= ' class=' . $class;
        }
        $result .= '>';
        $result .= $string;
        $result .= '</div>';

        return $result;
    }
}