<?php

class CardBuilder extends AbstractHtmlBuilder
{
    private $card = NULL;
    private $cardType = NULL;

    function __construct(Card $card, $cardType)
    {
        $this->card = $card;
        $this->cardType = $cardType;
    }



    private function buildheader()
    {
        $resultHtml = "    <span class='category-item-header'>";
        $resultHtml .= "        <a href = '" . $this->card->getPage() . "?id=".$this->card->getWid()."'>";
        $resultHtml .= "         <img class='category-item-img' src = '$this->imgSrc' alt = '$this->frontImgAlt'>";
        $resultHtml .= "        </a>";
        $resultHtml .= "    </span>";
        return $resultHtml;
    }

    private function buildBodyWithImage()
    {
        $resultHtml = "    <div class='category-item-header'>";
        $resultHtml .= "        <a href = '" . $this->page . "?id=$this->wid'>";
        $resultHtml .= "         <img class='category-item-img' src = '$this->imgSrc' alt = '$this->frontImgAlt'>";
        $resultHtml .= "        </a>";
        $resultHtml .= "    </div>";
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
            case CardType::HEADER_WITH_IMAGE:

                $resultHtml = $this->buildheader() . $this->buildBodyWithImage();
                break;
            case CardType::FOOTER_WITH_IMAGE:
                $resultHtml = $this->buildFooter() . $this->buildBodyWithImage();
                break;
            default:
//                $resultHtml = $this->buildBodyWithImage();
                break;
        }

//        echo HtmlCorrector::code_as_text($resultHtml);
        return $resultHtml;
    }
}