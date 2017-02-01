<?php

require $_SERVER['DOCUMENT_ROOT'] . "/php_include/builders/html_page/HTMLPageBuilder.php";
require $_SERVER['DOCUMENT_ROOT'] . "/php_include/builders/html_page/HtmlBuldDirector.php";
//https://sourcemaking.com/design_patterns/builder/php/1
writeln('BEGIN TESTING BUILDER PATTERN');
writeln('');
$pageBuilder = new HTMLHtmlBuilder();
$pageDirector = new HtmlBuldDirector($pageBuilder);
$pageDirector->buildHtml();
$page = $pageDirector->getHtml();
writeln($page->showPage());
writeln('');
writeln('END TESTING BUILDER PATTERN');

function writeln($line_in)
{
    echo $line_in . "<br/>";
}




