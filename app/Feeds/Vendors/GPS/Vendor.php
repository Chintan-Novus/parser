<?php

namespace App\Feeds\Vendors\GPS;

use App\Feeds\Feed\FeedItem;
use App\Feeds\Processor\HttpProcessor;

class Vendor extends HttpProcessor
{
    public const CATEGORY_LINK_CSS_SELECTORS = [ 'div.paginations a' ];
    public const PRODUCT_LINK_CSS_SELECTORS = [ 'tr.productListing-odd a:first-child' ];

    protected array $first = [ 'https://www.thegreenpetshop.com/collections/all' ];

    public function isValidFeedItem( FeedItem $fi ): bool
    {
        return !empty( $fi->getMpn() );
    }
}