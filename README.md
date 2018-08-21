
# laravel-json-query-log

add database log into JsonResponse

avoid N+1 query, see query result  

example:

```
\Illuminate\Http\JsonResponse
{
  "hi": "hello",
  "_query_log": [
    "select * from text"
  ]
}
```

## install
`composer require nonerame/laravel-json-query-log --dev`

publish config

```
php artisan vendor:publish --provider="Nonegrame\LaravelJsonQueryLog\Providers\DatabaseQueryServiceProvider"
```


## usage

add `DEBUG_QUERY_ENABLED=true` to `.env`

or

editor config/queryLog.php

and run
```
php artisan config:clear
```