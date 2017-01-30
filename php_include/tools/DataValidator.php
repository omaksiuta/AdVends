<?php


class DataValidator
{
    function isArray($mixed)
    {
        return is_array($mixed) || $mixed instanceof Traversable ? true : false;
    }
}