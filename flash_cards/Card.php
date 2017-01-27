<?php

class Card
{
    public $frontLanguage = 'en';
    public $backLanguage = 'ru';

    public function generate($wid, $withImage = true)
    {
        echo __CLASS__; // foo
        var_dump($this);


    }
}


