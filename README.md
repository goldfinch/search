1) add config search.yml and register searchable object

2) add searchable method to the registered object

```
public static function searchable($q, $request)
{
    return BlogPost::get()->filter('Text:PartialMatch', $q);
    // return BlogPost::get()->filter('SearchFields:Fulltext', $q);
}
```
