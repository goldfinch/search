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

    protected function onBeforeWrite()
    {
        parent::onBeforeWrite();
    }

    public function onBeforeDelete()
    {
        parent::onBeforeDelete();
    }

    public function validate()
    {
        $result = parent::validate();

        return $result;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        //

        return $fields;
    }

    public function getSettingsFields()
    {
        $fields = parent::getSettingsFields();

        // ..

        return $fields;
    }
}
