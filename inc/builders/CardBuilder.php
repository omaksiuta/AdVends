<!--https://sourcemaking.com/design_patterns/builder/java/2-->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/tools/HtmlCorrector.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/builders/AbstractHtmlBuilder.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/containers/ImageContainer.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/domain_objects/Card.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/enums/CardType.php";

class CardBuilder extends AbstractHtmlBuilder
{
    private $card = NULL;
    private $cardType = NULL;

    function __construct(Card $card, $cardType = CardType::IMAGE_ONLY)
    {
        $this->card = $card;
        $this->cardType = $cardType;
    }


    private function buildheader()
    {
        $resultHtml = $this->card->getFrontName();

        $href = $this->card->getWebPagePath() . "?id=" . $this->card->getWid();
        $resultHtml = HtmlCorrector::coverWithHref($resultHtml, $href);

        $resultHtml = HtmlCorrector::coverWithSpan($resultHtml, NULL, 'category-item-card-header');

        return $resultHtml;
    }

    private function buildBodyWithImage()
    {
        //build img icon
        $imageTag = new ImageContainer();
        $imageTag->setImgSrc($this->card->getFrontImgSrc());
        $imageTag->setImgClass('category-item-card-img');
        $imageTag->setImgAlt($this->card->getFrontImgAlt());

        $resultHtml = $imageTag->getHtml();

        $resultHtml = HtmlCorrector::coverWithDiv($resultHtml, NULL, 'category-item-card-body');

//        $href = $this->card->getWebPagePath() . "?id='" . $this->card->getWid() . "'";
//        $resultHtml = HtmlCorrector::coverWithHref($resultHtml, $href);

        return $resultHtml;
    }

    private function buildBodyWithText()
    {
        return $this->buildheader();
    }

    private function buildFooter()
    {
        return $this->buildheader();
    }

    public function buildHtml()
    {
        $resultHtml = '';
//        echo "<br/> cardType" . $this->cardType;
        switch ($this->cardType) {
            case NULL:
                echo "cardType==NULL";
                break;
            case CardType::IMAGE_ONLY:
                $resultHtml = $this->buildBodyWithImage();
                break;
            case CardType::BODY_WITH_TEXT:
                $resultHtml = $this->buildBodyWithText();
                break;
            case CardType::HEADER_WITH_IMAGE:
                $resultHtml = $this->buildheader() . $this->buildBodyWithImage();
                break;
            case CardType::FOOTER_WITH_IMAGE:
                $resultHtml = $this->buildFooter() . $this->buildBodyWithImage();
                break;
            default:
//                $resultHtml = $this->buildBodyWithImage();
                break;
        };
//        echo HtmlCorrector::code_as_text($resultHtml);
        return $resultHtml;
    }
}