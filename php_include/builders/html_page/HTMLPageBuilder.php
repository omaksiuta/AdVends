<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/builders/AbstractHtmlBuilder.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/builders/html_page/HTMLPage.php";

class HTMLHtmlBuilder extends AbstractHtmlBuilder
{
    private $page = NULL;

    function __construct()
    {
        $this->page = new HTMLPage();
    }

    function setTitle($title_in)
    {
        $this->page->setTitle($title_in);
    }

    function setHeading($heading_in)
    {
        $this->page->setHeading($heading_in);
    }

    function setText($text_in)
    {
        $this->page->setText($text_in);
    }

    function formatPage()
    {
        $this->page->formatPage();
    }

    public function buildHtml()
    {
        $this->builder->setTitle('Testing the HTMLPage');
        $this->builder->setHeading('Testing the HTMLPage');
        $this->builder->setText('Testing, testing, testing!');
        $this->builder->setText('Testing, testing, testing, or!');
        $this->builder->setText('Testing, testing, testing, more!');
        $this->builder->formatPage();
    }

    function getHtml()
    {
        return $this->page;
    }
}