<?php

namespace App\Feeds\Vendors\GPS;

use App\Feeds\Parser\HtmlParser;
use App\Feeds\Utils\ParserCrawler;
use App\Helpers\StringHelper;

class Parser extends HtmlParser
{

    private const MAIN_DOMAIN = 'https://www.thegreenpetshop.com/collections/all/products/';
    private string $desc = '';
    private  string $feature = '';
    private  string $productName = '';
    private ?float $price = null;
    private ?int $quantity = null;

    public function beforeParse(): void
    {
        $body = $this->getHtml( 'div#tab-1' );
        $array = explode( '<p>', $body );

        foreach($array as $value){
            $this->desc = $value;
        }
        $this->filter( 'ul li' )->each( function ( ParserCrawler $c ) {
            $this->feature = $c;
        });

        $this->quantity = $this->getHtml('input#Quantity');
    }


    public function getProduct(): string
    {
        return $this->productName ?: $this->getText( 'h1' );
    }

    public  function  getListPrice(): ?float
    {
        return  $this->price ?: $this->getHtml('span#ProductPrice');
    }


    public function getImages(): array
    {
        return [ self::MAIN_DOMAIN . $this->getAttr( 'div.mainImgSlide slick-slide img', 'src' ) ];
    }


    public function getAttributes(): ?array
    {

    }

}