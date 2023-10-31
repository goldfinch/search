1) add config search.yml and register searchable object

```
---
Name: app-search
After:
  - "#goldfinch-search"
------
Goldfinch\Search\Search:
  ...
```

2) add searchable method to the registered object

```
public static function searchable($q, $request)
{
    return BlogPost::get()->filter('Text:PartialMatch', $q);
    // return BlogPost::get()->filter('SearchFields:Fulltext', $q);
}
```


3) configuration for registered object only (add within the object)

```
private static $searchable_pagination = 10;
private static $searchable_limit_items = false;
```
