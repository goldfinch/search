<?php

namespace Goldfinch\Search;

use SilverStripe\CMS\Model\SiteTree;
use Goldfinch\Search\SearchController;

class Search extends SiteTree
{
    private static $controller_name = SearchController::class;

    private static $table_name = 'Search';

    private static $default_sort = "\"Sort\"";

    private static $icon = null;

    private static $icon_class = 'font-icon-search';

    private static $base_description = 'Search';
}
