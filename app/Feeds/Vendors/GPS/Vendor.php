<?php

namespace App\Feeds\Vendors\GPS;

use App\Feeds\Feed\FeedItem;
use App\Feeds\Processor\HttpProcessor;
use Illuminate\Support\Facades\Log;

class Vendor extends HttpProcessor
{
    public const CATEGORY_LINK_CSS_SELECTORS = [ '.paginations > .page:not(:first-child) a' ];
    public const PRODUCT_LINK_CSS_SELECTORS = [ '.gridProductInfo a:not(.btn):not(.jdgm-star)' ];

    protected array $first = [ 'https://www.thegreenpetshop.com/collections/all' ];

    public function isValidFeedItem( FeedItem $fi ): bool
    {
        $isValid = !empty( $fi->getMpn() );
        return $isValid;
    }
}