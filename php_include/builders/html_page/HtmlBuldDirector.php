<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php_include/builders/AbstractBuildDirector.php";

class HtmlBuldDirector extends AbstractBuildDirector
{
    private $builder = NULL;

    public function __construct(AbstractHtmlBuilder $builder_in)
    {
        $this->builder = $builder_in;
    }

    public function buildHtml()
    {
        $this->builder->setTitle('Testing the HTMLPage Title');

        $this->builder->formatPage();
    }

    public function getHtml()
    {
        return $this->builder->getHtml();
    }
}
