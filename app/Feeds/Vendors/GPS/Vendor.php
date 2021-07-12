<?php

namespace App\Feeds\Vendors\GPS;

use App\Feeds\Feed\FeedItem;
use App\Feeds\Processor\SitemapHttpProcessor;

class Vendor extends SitemapHttpProcessor
{
    public const CATEGORY_LINK_CSS_SELECTORS = ['.paginations > .page:not(:first-child) a'];
    public const PRODUCT_LINK_CSS_SELECTORS = ['.gridProductInfo a:not(.btn):not(.jdgm-star)'];

    protected array $first = ['https://www.thegreenpetshop.com/sitemap_products_1.xml?from=749639925858&to=4348246163554'];

    public function isValidFeedItem(FeedItem $fi): bool
    {
        return !empty($fi->getMpn()) || count($fi->getChildProducts()) > 0;
    }
}