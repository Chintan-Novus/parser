<?php

namespace App\Feeds\Vendors\GPS;

use App\Feeds\Parser\HtmlParser;
use App\Feeds\Utils\ParserCrawler;
use App\Helpers\StringHelper;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class Parser extends HtmlParser
{
    private const MAIN_DOMAIN = 'https://www.thegreenpetshop.com/collections/all';

    private array $dims = [];
    private array $shorts = [];
    private ?array $attrs = null;
    private ?float $shipping_weight = null;
    private ?float $list_price = null;
    private ?int $avail = null;
    private string $mpn = '';
    private string $product = '';

    public function beforeParse(): void
    {
        $productName = $this->getText( 'form h1' );
        $productDescription = $this->getText( '.product-content .content' );
        $this->product = StringHelper::normalizeSpaceInString($productName);
        $this->shorts[] = StringHelper::normalizeSpaceInString($productDescription);
        $this->mpn = StringHelper::normalizeSpaceInString($productName);
//        $this->shorts = StringHelper::normalizeSpaceInString($productDescription);
        $this->avail = 10;
    }

    public function getMpn(): string
    {
        return $this->mpn;
    }

    public function getProduct(): string
    {
        return $this->product ?: $this->getText( 'form h1' );
    }

    public function getCostToUs(): float
    {
        return StringHelper::getMoney( $this->getMoney( '#ProductPrice' ) );
    }

    public function getImages(): array
    {
            $images = $this->getSrcImages('.mainImgSlide img');
        if(count($images) > 0) {
            return $images;
        }
        return $this->getSrcImages('.product-main-slider img');
    }

    public function getDimX(): ?float
    {
        return $this->dims[ 'x' ] ?? null;
    }

    public function getDimY(): ?float
    {
        return $this->dims[ 'y' ] ?? null;
    }

    public function getShortDescription(): array
    {
        return $this->shorts;
    }

    public function getAttributes(): ?array
    {
        return $this->attrs ?? null;
    }

    public function getListPrice(): ?float
    {
        return $this->list_price;
    }

    public function getShippingWeight(): ?float
    {
        return $this->shipping_weight;
    }

    public function getAvail(): ?int
    {
        return $this->avail;
    }


}