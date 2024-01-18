<?php

namespace Goldfinch\Search;

use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\CMS\Controllers\ContentController;

class SearchController extends ContentController
{
    public function index(HTTPRequest $request)
    {
        $results = new ArrayList;
        $objectResults = new ArrayList;
        $message = null;
        $searchDisplay = true;

        // /search?q=hat
        $q = substr($request->getVar('q') ?? '', 0, 16);
        $q = trim($q);

        if ($q === '')
        {
            $searchDisplay = false;
        }
        else if (strlen($q) >= 3)
        {
            $cfg = ss_config(Search::class);

            if (!empty($cfg['searchable']))
            {
                foreach ($cfg['searchable'] as $item)
                {
                    if (method_exists($item, 'searchable'))
                    {
                        $cfgItem = ss_config($item);

                        $list = $item::searchable($q, $request);

                        $results->merge($list);

                        $this->paginatedResults($list, $request, $cfgItem, $cfg);

                        $objectResults->push(new ArrayData([
                            'ClassName' => $item,
                            'Results' => $list,
                            'q' => $q,
                        ]));
                    }
                }
            }

            $this->paginatedResults($results, $request, $cfg);
        }
        else
        {
            $message = 'Sorry, your search query is too short';
        }

        $data = new ArrayData([
            'Link' => $this->Link(),
            'SearchDisplay' => $searchDisplay,
            'Message' => $message,
            'ObjectResults' => $objectResults,
            'Results' => $results,
            'q' => $q,
        ]);

        return $this->customise([
            'Layout' => $data->renderWith(Search::class),
        ])->renderWith('Page');
    }

    private function paginatedResults(&$results, $request, $cfg, $baseCfg = null)
    {
        // # searchable_pagination option
        if (isset($cfg['searchable_pagination']))
        {
            $searchable_pagination = $cfg['searchable_pagination'];
        }
        else if ($baseCfg && isset($baseCfg['searchable_pagination']))
        {
            $searchable_pagination = $baseCfg['searchable_pagination'];
        }
        else
        {
            $searchable_pagination = false;
        }

        // # searchable_limit_items option
        if (isset($cfg['searchable_limit_items']))
        {
            $searchable_limit_items = $cfg['searchable_limit_items'];
        }
        else if ($baseCfg && isset($baseCfg['searchable_limit_items']))
        {
            $searchable_limit_items = $baseCfg['searchable_limit_items'];
        }
        else
        {
            $searchable_limit_items = false;
        }

        if ($searchable_pagination)
        {
            $results = new PaginatedList($results, $request);

            if ($searchable_limit_items)
            {
                $results->setLimitItems($searchable_limit_items);
            }
            else
            {
                $results->setPageLength($searchable_pagination);
            }
        }
    }
}
